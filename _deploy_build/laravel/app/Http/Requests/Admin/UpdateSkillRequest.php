<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'category_ar' => ['nullable', 'string', 'max:100'],
            'level' => ['required', 'integer', 'between:0,100'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['integer', 'min:0'],
            'is_featured' => ['boolean'],
        ];
    }
}
