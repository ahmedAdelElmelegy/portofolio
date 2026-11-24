@extends('layouts.admin')

@section('title', $skill->exists ? 'Edit Skill' : 'Add Skill')

@section('content')
<div class="max-w-xl space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $skill->exists ? 'Edit Skill' : 'Create New Skill' }}</h1>
        <a href="{{ route('admin.skills.index') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">← Back to list</a>
    </div>

    <form action="{{ $skill->exists ? route('admin.skills.update', $skill) : route('admin.skills.store') }}"
          method="POST"
          class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 space-y-5">
        @csrf
        @if($skill->exists) @method('PUT') @endif

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Skill Name *</label>
            <input type="text" name="name" value="{{ old('name', $skill->name) }}" required placeholder="e.g. Flutter, Dart, Bloc"
                   class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Category (English) *</label>
                <input type="text" name="category" value="{{ old('category', $skill->getRawOriginal('category') ?? 'Mobile Development') }}" required placeholder="e.g. Mobile Development"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">التصنيف (عربي)</label>
                <input type="text" name="category_ar" dir="rtl" value="{{ old('category_ar', $skill->category_ar) }}" placeholder="مثال: تطوير تطبيقات الموبايل"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Proficiency Level (%) *</label>
                <input type="number" name="level" min="0" max="100" value="{{ old('level', $skill->level ?? 85) }}" required
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Sort Order</label>
                <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $skill->sort_order ?? 0) }}"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Icon Tag / Identifier</label>
            <input type="text" name="icon" value="{{ old('icon', $skill->icon) }}" placeholder="e.g. flutter, dart, bloc, api"
                   class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div class="pt-2">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $skill->is_featured) ? 'checked' : '' }}
                       class="rounded bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 text-blue-600 focus:ring-0">
                <span class="text-sm font-semibold text-slate-900 dark:text-white">Highlight as Featured Skill on Home</span>
            </label>
        </div>

        <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-slate-900 dark:text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25">
                {{ $skill->exists ? 'Update Skill' : 'Create Skill' }}
            </button>
        </div>
    </form>
</div>
@endsection