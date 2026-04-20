<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\TambahBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Exports\BooksExport;
use App\Imports\BooksImport;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_halaman');

        if ($perPage) {
            $books = Book::with('category')
                ->latest()
                ->paginate((int) $perPage);

            return ResponseHelper::paginate(
                $books,
                BookResource::collection($books->items()),
                'Berhasil ambil data'
            );
        }

        return ResponseHelper::success(
            BookResource::collection(
                Book::with('category')->latest()->get()
            ),
            'Berhasil ambil data'
        );
    }

    public function store(TambahBookRequest $request)
    {
        return ResponseHelper::success(
            new BookResource(
                Book::create($request->validated())
            ),
            'Buku berhasil ditambahkan',
            201
        );
    }

    public function show(Book $book)
    {
        return ResponseHelper::success(
            new BookResource($book),
            'Berhasil ambil data'
        );
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return ResponseHelper::success(
            new BookResource($book),
            'Buku berhasil diperbarui'
        );
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return ResponseHelper::success(
            null,
            'Buku berhasil dihapus'
        );
    }


    public function exportExcel(Request $request)
    {
        $perPage = $request->get('per_halaman');
        $page = (int) $request->get('page', 1);

        if (!$perPage) {
            return Excel::download(
                new BooksExport(),
                'data-buku-all.xlsx'
            );
        }

        return Excel::download(
            new BooksExport((int) $perPage, $page),
            'data-buku-page-' . $page . '.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $perPage = $request->get('per_halaman');
        $page = (int) $request->get('page', 1);

        $query = Book::with('category')->latest();

        if ($perPage) {
            $query->skip(($page - 1) * $perPage)
                  ->take((int) $perPage);
            $filename = 'data-buku-page-' . $page . '.pdf';
        } else {
            $filename = 'data-buku-all.pdf';
        }

        $books = $query->get();

        $pdf = Pdf::loadView('pdf.books', compact('books', 'page', 'perPage'));

        return response()->streamDownload(
            fn () => print($pdf->output()),
            $filename,
            ['Content-Type' => 'application/pdf']
        );
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new BooksImport, $request->file('file'));

        return ResponseHelper::success(
            null,
            'Import data buku berhasil'
        );
    }
}
