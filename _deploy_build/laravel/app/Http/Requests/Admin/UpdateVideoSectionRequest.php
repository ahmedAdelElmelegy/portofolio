<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        return [
            'badge' => ['nullable', 'string', 'max:100'],
            'badge_ar' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:1000'],
            'subtitle_ar' => ['nullable', 'string', 'max:1000'],
            'video' => ['nullable', 'file', 'mimes:mp4,mov,ogg,qt,webm,mkv', 'max:102400'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:10240'],
            'is_active' => ['boolean'],
            'items' => ['nullable', 'array'],
            'items.*.id' => ['nullable', 'integer'],
            'items.*.title' => ['required_with:items', 'string', 'max:255'],
            'items.*.title_ar' => ['nullable', 'string', 'max:255'],
            'items.*.value' => ['nullable', 'string', 'max:255'],
            'items.*.value_ar' => ['nullable', 'string', 'max:255'],
            'items.*.url' => ['nullable', 'string', 'max:500'],
            'items.*.icon' => ['nullable', 'string', 'max:100'],
            'items.*.badge' => ['nullable', 'string', 'max:100'],
            'items.*.sort_order' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'video.file' => 'الملف المرفوع يجب أن يكون ملف فيديو صالح.',
            'video.mimes' => 'صيغة الفيديو غير مدعومة. الصيغ المسموحة هي: mp4, webm, mov, qt, ogg, mkv.',
            'video.max' => 'حجم ملف الفيديو يتجاوز الحد الأقصى المسموح به (100 ميجابايت).',
            'title.required' => 'حقل عنوان القسم مطلوب.',
        ];
    }
}
