<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class TambahBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id'  => 'required|exists:categories,id',

            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'nullable|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1900',
            'stok'         => 'required|integer|min:0',
            'deskripsi'    => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists'   => 'Kategori tidak valid',

            'judul.required'        => 'Judul buku wajib diisi',
            'penulis.required'      => 'Penulis wajib diisi',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi',
            'tahun_terbit.digits'   => 'Tahun terbit harus 4 digit',
            'stok.required'         => 'Stok wajib diisi',
        ];
    }
}
