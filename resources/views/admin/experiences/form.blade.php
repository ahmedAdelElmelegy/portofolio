@extends('layouts.admin')

@section('title', $experience->exists ? __('Edit Timeline Entry') : __('Add Timeline Entry'))

@section('content')
<div class="w-full space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $experience->exists ? __('Edit Timeline Entry') : __('Create Timeline Entry') }}</h1>
        <a href="{{ route('admin.experiences.index') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white inline-flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left rtl:rotate-180 text-xs"></i>
            <span>{{ __('Back to list') }}</span>
        </a>
    </div>

    <form action="{{ $experience->exists ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}"
          method="POST"
          class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 space-y-5">
        @csrf
        @if($experience->exists) @method('PUT') @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Entry Type *') }}</label>
                <select name="type" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                    <option value="work" {{ old('type', $experience->type) === 'work' ? 'selected' : '' }}>{{ __('Work Experience') }}</option>
                    <option value="education" {{ old('type', $experience->type) === 'education' ? 'selected' : '' }}>{{ __('Education / Academic') }}</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Sort Order') }}</label>
                <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $experience->sort_order ?? 0) }}"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <!-- Title EN & AR -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Role / Title (English) *') }}</label>
                <input type="text" name="title" value="{{ old('title', $experience->getRawOriginal('title')) }}" required placeholder="e.g. Flutter Development Intern"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">المسمى / التخصص (عربي)</label>
                <input type="text" name="title_ar" dir="rtl" value="{{ old('title_ar', $experience->title_ar) }}" placeholder="مثال: متدرب تطوير فلاتر"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <!-- Organization EN & AR -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Organization / University (English) *') }}</label>
                <input type="text" name="organization" value="{{ old('organization', $experience->getRawOriginal('organization')) }}" required placeholder="e.g. PureSoft or Menoufia University"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">الجهة / المؤسسة (عربي)</label>
                <input type="text" name="organization_ar" dir="rtl" value="{{ old('organization_ar', $experience->organization_ar) }}" placeholder="مثال: شركة بيور سوفت"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <!-- Location EN & AR -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Location (English)') }}</label>
                <input type="text" name="location" value="{{ old('location', $experience->getRawOriginal('location')) }}" placeholder="e.g. Cairo, Egypt"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">الموقع (عربي)</label>
                <input type="text" name="location_ar" dir="rtl" value="{{ old('location_ar', $experience->location_ar) }}" placeholder="مثال: القاهرة، مصر"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Start Date *') }}</label>
                <input type="date" name="start_date" value="{{ old('start_date', $experience->start_date?->format('Y-m-d')) }}" required
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('End Date') }}</label>
                <input type="date" name="end_date" value="{{ old('end_date', $experience->end_date?->format('Y-m-d')) }}"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="pt-1">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="hidden" name="is_current" value="0">
                <input type="checkbox" name="is_current" value="1" {{ old('is_current', $experience->is_current) ? 'checked' : '' }}
                       class="rounded bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 text-blue-600 focus:ring-0">
                <span class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('Currently Active / Ongoing Here') }}</span>
            </label>
        </div>

        <!-- Description EN & AR -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Description (English)') }}</label>
                <textarea name="description" rows="3" placeholder="Key responsibilities and achievements..."
                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('description', $experience->getRawOriginal('description')) }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">التفاصيل والمهام (عربي)</label>
                <textarea name="description_ar" dir="rtl" rows="3" placeholder="أهم المهام والإنجازات بالعربية..."
                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('description_ar', $experience->description_ar) }}</textarea>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25">
                {{ $experience->exists ? __('Update Timeline Entry') : __('Create Timeline Entry') }}
            </button>
        </div>
    </form>
</div>
@endsection
