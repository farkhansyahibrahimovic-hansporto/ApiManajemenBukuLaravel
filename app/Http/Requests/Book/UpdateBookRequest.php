<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id'  => 'sometimes|exists:categories,id',

            'judul'        => 'sometimes|string|max:255',
            'penulis'      => 'sometimes|string|max:255',
            'penerbit'     => 'nullable|string|max:255',
            'tahun_terbit' => 'sometimes|digits:4|integer|min:1900',
            'stok'         => 'sometimes|integer|min:0',
            'deskripsi'    => 'nullable|string',
        ];
    }
}
