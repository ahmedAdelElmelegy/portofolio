@extends('layouts.admin')

@section('title', $skill->exists ? __('Edit Skill') : __('Add Skill'))

@section('content')
<div class="w-full space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200 dark:border-slate-800">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $skill->exists ? __('Edit Skill') . ': ' . $skill->name : __('Create New Skill') }}</h1>
            <p class="text-slate-400 text-sm mt-1">{{ __('Configure skill details, bilingual categories, icon badges, and display order across the full screen.') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.skills.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition inline-flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left rtl:rotate-180 text-xs"></i>
                <span>{{ __('Back to list') }}</span>
            </a>
        </div>
    </div>

    <form action="{{ $skill->exists ? route('admin.skills.update', $skill) : route('admin.skills.store') }}"
          method="POST"
          class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-10 space-y-8 shadow-sm">
        @csrf
        @if($skill->exists) @method('PUT') @endif

        <input type="hidden" name="level" value="{{ old('level', $skill->level ?? 100) }}">

        <!-- Top Row: Skill Name & Sort Order & Featured -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            <div class="lg:col-span-6">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Skill Name *') }}</label>
                <input type="text" name="name" value="{{ old('name', $skill->name) }}" required placeholder="e.g. Flutter, Dart, Clean Architecture, BLoC"
                       class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <div class="lg:col-span-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Sort Order') }}</label>
                <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $skill->sort_order ?? 0) }}"
                       class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <div class="lg:col-span-3 pt-2 lg:pt-8">
                <label class="flex items-center gap-3 cursor-pointer p-2.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-blue-500/50 transition">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $skill->is_featured) ? 'checked' : '' }}
                           class="rounded bg-white dark:bg-slate-800 border-slate-300 dark:border-slate-700 text-blue-600 focus:ring-0">
                    <span class="text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5">
                        <span>{{ __('Featured on Home') }}</span>
                        <i class="fa-solid fa-star text-amber-500"></i>
                    </span>
                </label>
            </div>
        </div>

        <!-- Categories Row (English & Arabic) + Presets -->
        <div class="space-y-3 pt-4 border-t border-slate-100 dark:border-slate-800/80">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Category (English) *') }}</label>
                    <input type="text" id="cat-en-input" name="category" value="{{ old('category', $skill->getRawOriginal('category') ?? 'Mobile Development') }}" required placeholder="e.g. Mobile Development"
                           class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">التصنيف (عربي) *</label>
                    <input type="text" id="cat-ar-input" name="category_ar" dir="rtl" value="{{ old('category_ar', $skill->category_ar) }}" placeholder="مثال: تطوير تطبيقات الموبايل"
                           class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
            </div>

            <!-- Quick Category Presets Full Width -->
            <div class="pt-2">
                <span class="text-xs text-slate-400 block mb-2 font-bold uppercase tracking-wider">{{ __('Quick Category Presets (Click to Auto-Fill):') }}</span>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-2.5">
                    @php
                        $presets = [
                            ['en' => 'Mobile Development', 'ar' => 'تطوير تطبيقات الموبايل'],
                            ['en' => 'Architecture & State Management', 'ar' => 'الهيكلية وإدارة الحالة'],
                            ['en' => 'APIs & Cloud', 'ar' => 'واجهات الـ API والخدمات السحابية'],
                            ['en' => 'Databases & Storage', 'ar' => 'قواعد البيانات والتخزين المحلي'],
                            ['en' => 'Tools & DevOps', 'ar' => 'الأدوات وبيئة العمل'],
                        ];
                    @endphp
                    @foreach($presets as $preset)
                        <button type="button"
                                onclick="document.getElementById('cat-en-input').value = @js($preset['en']); document.getElementById('cat-ar-input').value = @js($preset['ar']);"
                                class="px-3.5 py-2.5 text-xs font-semibold rounded-xl bg-slate-50 dark:bg-slate-900 hover:bg-blue-50 dark:hover:bg-blue-950/40 text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 border border-slate-200 dark:border-slate-800 transition text-center">
                            {{ app()->getLocale() === 'ar' ? $preset['ar'] : $preset['en'] }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Icon Identifier + Full-width Quick Icon Chips -->
        <div class="space-y-3 pt-4 border-t border-slate-100 dark:border-slate-800/80">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Icon Tag / Identifier') }}</label>
                <input type="text" id="icon-input" name="icon" value="{{ old('icon', $skill->icon) }}" placeholder="e.g. flutter, dart, bloc, api, firebase"
                       class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none font-mono" dir="ltr">
            </div>

            <!-- Quick Icon Chips across full width -->
            <div class="pt-2">
                <span class="text-xs text-slate-400 block mb-2 font-bold uppercase tracking-wider">{{ __('Click Icon to Auto-Select:') }}</span>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2.5">
                    @php
                        $icons = [
                            ['tag' => 'flutter', 'icon' => 'fa-brands fa-flutter', 'label' => 'Flutter'],
                            ['tag' => 'dart', 'icon' => 'fa-solid fa-code', 'label' => 'Dart'],
                            ['tag' => 'cubes', 'icon' => 'fa-solid fa-cubes', 'label' => 'Bloc / Cubit'],
                            ['tag' => 'cube', 'icon' => 'fa-solid fa-cube', 'label' => 'Provider'],
                            ['tag' => 'network-wired', 'icon' => 'fa-solid fa-network-wired', 'label' => 'REST APIs / Dio'],
                            ['tag' => 'fire', 'icon' => 'fa-solid fa-fire', 'label' => 'Firebase'],
                            ['tag' => 'database', 'icon' => 'fa-solid fa-database', 'label' => 'SQLite / DB'],
                            ['tag' => 'hard-drive', 'icon' => 'fa-solid fa-hard-drive', 'label' => 'Storage / Hive'],
                            ['tag' => 'map-location-dot', 'icon' => 'fa-solid fa-map-location-dot', 'label' => 'Google Maps'],
                            ['tag' => 'git-alt', 'icon' => 'fa-brands fa-git-alt', 'label' => 'Git / GitHub'],
                            ['tag' => 'vial', 'icon' => 'fa-solid fa-vial', 'label' => 'Testing'],
                            ['tag' => 'code', 'icon' => 'fa-solid fa-code', 'label' => 'General Code'],
                        ];
                    @endphp
                    @foreach($icons as $ic)
                        <button type="button"
                                onclick="document.getElementById('icon-input').value = '{{ $ic['tag'] }}';"
                                class="px-3 py-2.5 text-xs font-semibold rounded-xl bg-slate-50 dark:bg-slate-900 hover:bg-blue-50 dark:hover:bg-blue-950/40 text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 border border-slate-200 dark:border-slate-800 transition flex items-center justify-center gap-2">
                            <i class="{{ $ic['icon'] }} text-sm text-blue-500"></i>
                            <span>{{ $ic['label'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-200 dark:border-slate-800 flex items-center justify-end gap-3">
            <a href="{{ route('admin.skills.index') }}" class="px-6 py-3 rounded-xl border border-slate-200 dark:border-slate-800 text-sm font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900 transition">
                {{ __('Cancel') }}
            </a>
            <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-sm rounded-xl transition shadow-xl shadow-blue-500/25">
                {{ $skill->exists ? __('Update Skill') : __('Create Skill') }}
            </button>
        </div>
    </form>
</div>
@endsection
