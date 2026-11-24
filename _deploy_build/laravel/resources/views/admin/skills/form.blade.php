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

        <input type="hidden" name="level" value="{{ old('level', $skill->level ?? 100) }}">

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Skill Name *</label>
            <input type="text" name="name" value="{{ old('name', $skill->name) }}" required placeholder="e.g. Flutter, Dart, Bloc"
                   class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div class="space-y-2">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Category (English) *</label>
                    <input type="text" id="cat-en-input" name="category" value="{{ old('category', $skill->getRawOriginal('category') ?? 'Mobile Development') }}" required placeholder="e.g. Mobile Development"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">التصنيف (عربي)</label>
                    <input type="text" id="cat-ar-input" name="category_ar" dir="rtl" value="{{ old('category_ar', $skill->category_ar) }}" placeholder="مثال: تطوير تطبيقات الموبايل"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
            </div>

            <!-- Quick Category Presets -->
            <div class="pt-1">
                <span class="text-[11px] text-slate-400 block mb-1.5 font-medium">Quick Category Presets:</span>
                <div class="flex flex-wrap gap-1.5">
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
                                class="px-2.5 py-1 text-[11px] rounded-lg bg-slate-100 dark:bg-slate-900 hover:bg-blue-50 dark:hover:bg-blue-950/40 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 border border-slate-200 dark:border-slate-800 transition">
                            {{ $preset['en'] }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-2">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Icon Tag / Identifier</label>
                <input type="text" id="icon-input" name="icon" value="{{ old('icon', $skill->icon) }}" placeholder="e.g. flutter, dart, bloc, api, firebase"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none font-mono">
            </div>

            <!-- Quick Icon Chips -->
            <div>
                <span class="text-[11px] text-slate-400 block mb-1.5 font-medium">Click icon to select:</span>
                <div class="flex flex-wrap gap-1.5">
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
                                class="px-2.5 py-1 text-[11px] rounded-lg bg-slate-100 dark:bg-slate-900 hover:bg-blue-50 dark:hover:bg-blue-950/40 text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 border border-slate-200 dark:border-slate-800 transition flex items-center gap-1.5">
                            <i class="{{ $ic['icon'] }}"></i>
                            <span>{{ $ic['label'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Sort Order</label>
            <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $skill->sort_order ?? 0) }}"
                   class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div class="pt-2">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $skill->is_featured) ? 'checked' : '' }}
                       class="rounded bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 text-blue-600 focus:ring-0">
                <span class="text-sm font-semibold text-slate-900 dark:text-white flex items-center gap-1.5">
                    <span>Highlight as Featured Skill on Home</span>
                    <i class="fa-solid fa-star text-xs text-amber-500"></i>
                </span>
            </label>
        </div>

        <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25">
                {{ $skill->exists ? 'Update Skill' : 'Create Skill' }}
            </button>
        </div>
    </form>
</div>
@endsection
