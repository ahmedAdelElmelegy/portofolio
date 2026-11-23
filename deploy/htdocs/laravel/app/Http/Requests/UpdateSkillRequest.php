<?php

namespace App\Http\Requests;

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
            'name' => 'sometimes|required|string|max:255',
            'category' => 'nullable|string|max:255',
            'level' => 'sometimes|integer|min:0|max:100',
            'icon' => 'nullable|string|max:255',
        ];
    }
}
