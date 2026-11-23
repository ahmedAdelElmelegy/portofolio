<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $projectId = $this->route('project') ? $this->route('project')->id : null;

        return [
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|unique:projects,slug,'.$projectId,
            'description' => 'sometimes|required|string',
            'short_description' => 'nullable|string',
            'technologies' => 'nullable|array',
            'github_link' => 'nullable|url',
            'live_link' => 'nullable|url',
            'cover_image' => 'nullable|image|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'is_featured' => 'boolean',
        ];
    }
}
