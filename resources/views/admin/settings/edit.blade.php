@extends('layouts.admin')

@section('title', __('Site Settings'))

@section('content')
<div class="w-full space-y-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ __('General Site Settings') }}</h1>
        <p class="text-slate-400 text-sm mt-1">{{ __('Configure global portfolio titles, SEO meta tags, and copyright information.') }}</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Site Title *') }}</label>
            <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'Ahmed Adel — Flutter Developer') }}" required
                   class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Site Tagline') }}</label>
            <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? 'Building beautiful cross-platform apps') }}"
                   class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('SEO Meta Description') }}</label>
            <textarea name="seo_description" rows="3"
                      class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('seo_description', $settings['seo_description'] ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Copyright Year') }}</label>
            <input type="text" name="copyright_year" value="{{ old('copyright_year', $settings['copyright_year'] ?? date('Y')) }}"
                   class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25">
                {{ __('Save Site Settings') }}
            </button>
        </div>
    </form>
</div>
@endsection
