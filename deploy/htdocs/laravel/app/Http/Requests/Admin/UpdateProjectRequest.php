<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'app_url' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
            'technologies' => ['nullable', 'array'],
            'technologies.*' => ['nullable', 'string', 'max:100'],
            'features' => ['nullable', 'array'],
            'features.*' => ['nullable', 'string', 'max:255'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'max:4096'],
        ];
    }
}
