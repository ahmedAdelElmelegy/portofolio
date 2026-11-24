@extends('layouts.admin')

@section('title', $project->exists ? 'Edit Project' : 'Create Project')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $project->exists ? 'Edit Project: ' . $project->name : 'Create New Project' }}</h1>
            <p class="text-slate-400 text-sm mt-1">Configure project details, cover photo, tech stack, and screenshot gallery.</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">← Back to list</a>
    </div>

    <form action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 space-y-6"
          x-data="{
              techs: {{ json_encode($project->exists ? $project->technologies->pluck('name')->toArray() : ['Flutter', 'Dart']) }},
              features: {{ json_encode($project->exists ? $project->features->map(fn($f) => ['en' => $f->getRawOriginal('description'), 'ar' => $f->description_ar ?? ''])->toArray() : [['en' => 'Clean architecture & scalable code', 'ar' => 'معمارية برمجية نظيفة وقابلة للتوسع']]) }},
              addTech() { this.techs.push(''); },
              removeTech(i) { this.techs.splice(i, 1); },
              addFeature() { this.features.push({en: '', ar: ''}); },
              removeFeature(i) { this.features.splice(i, 1); }
          }">
        @csrf
        @if($project->exists) @method('PUT') @endif

        <!-- Basic info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Project Name (English) *</label>
                <input type="text" name="name" value="{{ old('name', $project->getRawOriginal('name')) }}" required placeholder="e.g. Circle, Nurse Bot, Al Huda"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">اسم المشروع (عربي)</label>
                <input type="text" name="name_ar" dir="rtl" value="{{ old('name_ar', $project->name_ar) }}" placeholder="مثال: سيركل، الممرض الآلي، الهدى"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Sort Order</label>
                <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $project->sort_order ?? 0) }}"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <!-- Short Description EN & AR -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Short Summary (English) *</label>
                <input type="text" name="short_description" value="{{ old('short_description', $project->getRawOriginal('short_description')) }}" placeholder="Brief 1-line overview..."
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">النبذة المختصرة للكارت (عربي)</label>
                <input type="text" name="short_description_ar" dir="rtl" value="{{ old('short_description_ar', $project->short_description_ar) }}" placeholder="نبذة مختصرة من سطر واحد..."
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <!-- Full Description EN & AR -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Full Description (English) *</label>
                <textarea name="description" rows="4" required placeholder="Detailed description of features, problem solved, architecture..."
                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('description', $project->getRawOriginal('description')) }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">الشرح الكامل للمشروع (عربي)</label>
                <textarea name="description_ar" dir="rtl" rows="4" placeholder="شرح مفصل للمشروع والمشكلة التقنية التي يحلها..."
                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('description_ar', $project->description_ar) }}</textarea>
            </div>
        </div>

        <!-- Project Links (GitHub, Android, iOS, Web Demo) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2 flex items-center gap-1.5">
                    <i class="fa-brands fa-github text-slate-600 dark:text-slate-400"></i>
                    <span>GitHub URL</span>
                </label>
                <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}" placeholder="https://github.com/..."
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-xs sm:text-sm focus:border-blue-500 focus:outline-none">
                <span class="text-[11px] text-slate-400 mt-1 block">Leave empty to hide GitHub icon</span>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 mb-2 flex items-center gap-1.5">
                    <i class="fa-brands fa-android"></i>
                    <span>Android (Play / APK)</span>
                </label>
                <input type="url" name="android_url" value="{{ old('android_url', $project->android_url) }}" placeholder="https://play.google.com/..."
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-xs sm:text-sm focus:border-emerald-500 focus:outline-none">
                <span class="text-[11px] text-slate-400 mt-1 block">Google Play, APK, or Drive link</span>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-sky-600 dark:text-sky-400 mb-2 flex items-center gap-1.5">
                    <i class="fa-brands fa-apple"></i>
                    <span>iOS (App Store / TestFlight)</span>
                </label>
                <input type="url" name="ios_url" value="{{ old('ios_url', $project->ios_url) }}" placeholder="https://apps.apple.com/..."
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-xs sm:text-sm focus:border-sky-500 focus:outline-none">
                <span class="text-[11px] text-slate-400 mt-1 block">App Store or TestFlight link</span>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2 flex items-center gap-1.5">
                    <i class="fa-solid fa-globe text-blue-500"></i>
                    <span>Web Demo / Live URL</span>
                </label>
                <input type="url" name="app_url" value="{{ old('app_url', $project->app_url) }}" placeholder="https://example.com/..."
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-xs sm:text-sm focus:border-blue-500 focus:outline-none">
                <span class="text-[11px] text-slate-400 mt-1 block">Optional live demo / landing page</span>
            </div>
        </div>

        <!-- Cover Image & Gallery -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Cover Image</label>
                @if($project->cover_image)
                    <div class="mb-3">
                        <img src="{{ $project->cover_image_url }}" class="h-20 w-32 object-cover rounded-xl border border-slate-200 dark:border-slate-800">
                    </div>
                @endif
                <input type="file" name="cover_image" accept="image/*"
                       class="w-full text-xs text-slate-600 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-800 file:text-white file:font-semibold hover:file:bg-slate-700">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Add Screenshots (Gallery)</label>
                <input type="file" name="images[]" multiple accept="image/*"
                       class="w-full text-xs text-slate-600 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-800 file:text-white file:font-semibold hover:file:bg-slate-700">
            </div>
        </div>

        <!-- Featured & Publish Status -->
        <div class="flex items-center gap-6 pt-2">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                       class="rounded bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 text-blue-600 focus:ring-0">
                <span class="text-sm font-semibold text-slate-900 dark:text-white">Featured on Home Showcase</span>
            </label>
        </div>

        <!-- Dynamic Technologies & Features -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-200 dark:border-slate-800">
            <!-- Tech stack chips -->
            <div>
                <div class="flex items-center justify-between mb-3">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300">Technologies Used</label>
                    <button type="button" @click="addTech()" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-bold">+ Add Tech</button>
                </div>
                <div class="space-y-2">
                    <template x-for="(t, i) in techs" :key="i">
                        <div class="flex items-center gap-2">
                            <input type="text" :name="'technologies[' + i + ']'" x-model="techs[i]" placeholder="e.g. Flutter, Dio, Bloc"
                                   class="flex-1 px-3 py-1.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg text-slate-900 dark:text-white text-xs focus:border-blue-500 focus:outline-none">
                            <button type="button" @click="removeTech(i)" class="text-red-500 hover:text-red-400 px-2 py-1"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Features list (EN & AR) -->
            <div>
                <div class="flex items-center justify-between mb-3">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300">Key Features (English & عربي)</label>
                    <button type="button" @click="addFeature()" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-bold">+ Add Feature</button>
                </div>
                <div class="space-y-2.5">
                    <template x-for="(f, i) in features" :key="i">
                        <div class="p-2.5 rounded-xl border border-slate-200 dark:border-slate-800 space-y-1.5 bg-slate-50/50 dark:bg-slate-900/50">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider" x-text="'Feature #' + (i + 1)"></span>
                                <button type="button" @click="removeFeature(i)" class="text-red-500 hover:text-red-400 text-xs px-1"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                            <input type="text" :name="'features[' + i + ']'" x-model="features[i].en" placeholder="Feature in English..."
                                   class="w-full px-3 py-1.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg text-slate-900 dark:text-white text-xs focus:border-blue-500 focus:outline-none">
                            <input type="text" :name="'features_ar[' + i + ']'" x-model="features[i].ar" dir="rtl" placeholder="وصف الخاصية بالعربية..."
                                   class="w-full px-3 py-1.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg text-slate-900 dark:text-white text-xs focus:border-blue-500 focus:outline-none">
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-slate-900 dark:text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25">
                {{ $project->exists ? 'Update Project' : 'Create Project' }}
            </button>
        </div>
    </form>
</div>
@endsection