<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\TambahCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_halaman');

        if ($perPage) {
            $categories = Category::latest()->paginate((int) $perPage);

            return ResponseHelper::paginate(
                $categories,
                $categories->items(),
                'Berhasil ambil data'
            );
        }

        return ResponseHelper::success(
            Category::latest()->get(),
            'Berhasil ambil data'
        );
    }

    public function store(TambahCategoryRequest $request)
    {
        return ResponseHelper::success(
            Category::create($request->validated()),
            'Kategori berhasil ditambahkan',
            201
        );
    }

    public function show(Category $category)
    {
        return ResponseHelper::success(
            $category,
            'Berhasil ambil data'
        );
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return ResponseHelper::success(
            $category,
            'Kategori berhasil diperbarui'
        );
    }

    public function destroy(Category $category)
    {
        if ($category->books()->exists()) {
            return ResponseHelper::error(
                'Kategori tidak dapat dihapus karena masih memiliki buku',
                'Kategori masih digunakan',
                400
            );
        }

        $category->delete();

        return ResponseHelper::success(
            null,
            'Kategori berhasil dihapus'
        );
    }
}
