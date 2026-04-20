<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class BooksImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function model(array $row)
    {
        $categoryId = null;

        if (!empty($row['kategori'])) {
            $category = Category::where('nama', trim($row['kategori']))->first();

            if (!$category) {
                throw new \Exception(
                    "Kategori '{$row['kategori']}' tidak ditemukan. Import dibatalkan."
                );
            }

            $categoryId = $category->id;
        }

        return new Book([
            'category_id'  => $categoryId,
            'judul'        => $row['judul'],
            'penulis'      => $row['penulis'],
            'penerbit'     => $row['penerbit'] ?? null,
            'tahun_terbit' => $row['tahun_terbit'],
            'stok'         => $row['stok'] ?? 0,
            'deskripsi'    => $row['deskripsi'] ?? null,
        ]);
    }
}
