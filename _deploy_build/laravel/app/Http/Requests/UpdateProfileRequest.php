<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'sometimes|required|string|max:255',
            'title' => 'sometimes|required|string|max:255',
            'bio' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ];
    }
}
