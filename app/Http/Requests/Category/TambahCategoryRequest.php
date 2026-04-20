<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class TambahCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255|unique:categories,nama',
            'deskripsi' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama kategori wajib diisi',
            'nama.unique'   => 'Nama kategori sudah digunakan',
        ];
    }
}
