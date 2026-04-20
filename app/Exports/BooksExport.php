<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BooksExport implements FromCollection, WithHeadings, WithMapping
{
    protected int $no = 0;
    protected ?int $perPage;
    protected int $page;

    public function __construct(?int $perPage = null, int $page = 1)
    {
        $this->perPage = $perPage;
        $this->page = $page;

        if ($perPage) {
            $this->no = ($page - 1) * $perPage;
        }
    }

    public function collection()
    {
        $query = Book::with('category')
            ->select(
                'id',
                'category_id',
                'judul',
                'penulis',
                'penerbit',
                'tahun_terbit',
                'stok',
                'deskripsi'
            )
            ->latest();

        if ($this->perPage) {
            $query->skip(($this->page - 1) * $this->perPage)
                  ->take($this->perPage);
        }

        return $query->get();
    }

    public function map($book): array
    {
        return [
            ++$this->no,
            $book->judul,
            $book->penulis,
            $book->penerbit,
            $book->tahun_terbit,
            $book->stok,
            $book->category?->nama ?? '-',
            $book->deskripsi,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Judul',
            'Penulis',
            'Penerbit',
            'Tahun Terbit',
            'Stok',
            'Kategori',
            'Deskripsi',
        ];
    }
}
