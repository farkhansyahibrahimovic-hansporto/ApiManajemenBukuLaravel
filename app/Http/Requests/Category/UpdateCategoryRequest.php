<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('categories', 'nama')
                    ->ignore($this->route('category')),
            ],
            'deskripsi' => 'nullable|string',
        ];
    }
}
