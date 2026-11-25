@extends('layouts.admin')

@section('title', $workProcess->exists ? __('Edit Work Process') : __('Add Work Process'))

@section('content')
<div class="w-full space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $workProcess->exists ? __('Edit Process Step') : __('Create Process Step') }}</h1>
        <a href="{{ route('admin.work-processes.index') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white inline-flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left rtl:rotate-180 text-xs"></i>
            <span>{{ __('Back to list') }}</span>
        </a>
    </div>

    <form action="{{ $workProcess->exists ? route('admin.work-processes.update', $workProcess) : route('admin.work-processes.store') }}"
          method="POST"
          class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 space-y-5">
        @csrf
        @if($workProcess->exists) @method('PUT') @endif

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Step Title (English) *') }}</label>
                <input type="text" name="title" value="{{ old('title', $workProcess->getRawOriginal('title')) }}" required placeholder="e.g. Planning & Analysis"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Order # *') }}</label>
                <input type="number" name="sort_order" min="1" value="{{ old('sort_order', $workProcess->sort_order ?? 1) }}" required
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">عنوان الخطوة (عربي)</label>
            <input type="text" name="title_ar" dir="rtl" value="{{ old('title_ar', $workProcess->title_ar) }}" placeholder="مثال: التخطيط وتحليل المتطلبات"
                   class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Step Icon') }}</label>
            <input type="text" name="icon" value="{{ old('icon', $workProcess->icon) }}" placeholder="e.g. search, design_services, architecture, api, extension, bug_report" dir="ltr"
                   class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Description (English) *') }}</label>
            <textarea name="description" rows="3" required placeholder="What happens during this phase..."
                      class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('description', $workProcess->getRawOriginal('description')) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">الشرح التفصيلي (عربي)</label>
            <textarea name="description_ar" dir="rtl" rows="3" placeholder="تفاصيل وخطوات هذه المرحلة بالعربية..."
                      class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('description_ar', $workProcess->description_ar) }}</textarea>
        </div>

        <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25">
                {{ $workProcess->exists ? __('Update Step') : __('Create Step') }}
            </button>
        </div>
    </form>
</div>
@endsection
