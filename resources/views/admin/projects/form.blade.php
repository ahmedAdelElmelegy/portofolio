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
              coverPreview: null,
              galleryPreviews: [],
              addTech() { this.techs.push(''); },
              removeTech(i) { this.techs.splice(i, 1); },
              toggleTech(name) {
                  const idx = this.techs.indexOf(name);
                  if (idx !== -1) {
                      this.techs.splice(idx, 1);
                  } else {
                      const emptyIdx = this.techs.indexOf('');
                      if (emptyIdx !== -1) {
                          this.techs[emptyIdx] = name;
                      } else {
                          this.techs.push(name);
                      }
                  }
              },
              hasTech(name) {
                  return this.techs.includes(name);
              },
              addFeature() { this.features.push({en: '', ar: ''}); },
              removeFeature(i) { this.features.splice(i, 1); },
              addPresetFeature(en, ar) {
                  const exists = this.features.some(f => f.en === en);
                  if (!exists) {
                      if (this.features.length === 1 && !this.features[0].en && !this.features[0].ar) {
                          this.features[0] = { en, ar };
                      } else {
                          this.features.push({ en, ar });
                      }
                      if (window.snackbar) window.snackbar('Feature added: ' + en, 'success', 2500);
                  } else {
                      if (window.snackbar) window.snackbar('Feature already in list!', 'info', 2500);
                  }
              },
              handleCoverChange(event) {
                  const file = event.target.files[0];
                  if (file) {
                      this.coverPreview = URL.createObjectURL(file);
                  }
              },
              clearCover() {
                  this.coverPreview = null;
                  this.$refs.coverInput.value = '';
              },
              handleGalleryChange(event) {
                  this.galleryPreviews = [];
                  Array.from(event.target.files).forEach((file, index) => {
                      this.galleryPreviews.push({
                          id: index,
                          name: file.name,
                          size: (file.size / 1024).toFixed(1) + ' KB',
                          url: URL.createObjectURL(file)
                      });
                  });
              },
              clearGallery() {
                  this.galleryPreviews = [];
                  this.$refs.galleryInput.value = '';
              }
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

        <!-- Cover Image & Gallery (With Live Previews) -->
        <div class="space-y-6 pt-2 border-t border-slate-200 dark:border-slate-800">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- 1. Cover Image Section -->
                <div class="p-5 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50 space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300">
                            {{ __('Cover Image (Main Card Thumbnail)') }}
                        </label>
                        <template x-if="coverPreview">
                            <button type="button" @click="clearCover()" class="text-xs text-rose-500 hover:text-rose-400 font-bold flex items-center gap-1">
                                <i class="fa-solid fa-xmark"></i>
                                <span>Cancel New Image</span>
                            </button>
                        </template>
                    </div>

                    <!-- New Cover Live Preview -->
                    <template x-if="coverPreview">
                        <div class="relative rounded-2xl overflow-hidden border-2 border-emerald-500 shadow-lg group">
                            <img :src="coverPreview" class="h-44 w-full object-cover">
                            <div class="absolute top-2 start-2 bg-emerald-600 text-white text-[10px] font-black uppercase px-2.5 py-1 rounded-lg shadow">
                                New Selection Preview
                            </div>
                        </div>
                    </template>

                    <!-- Existing Cover Image (If no new selection) -->
                    @if($project->cover_image)
                        <div x-show="!coverPreview" class="relative rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-sm group">
                            <img src="{{ $project->cover_image_url }}" alt="Cover" class="h-44 w-full object-cover">
                            <div class="absolute top-2 start-2 bg-slate-900/80 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-lg">
                                Current Cover Image
                            </div>
                        </div>
                    @endif

                    <!-- Upload Input -->
                    <div>
                        <input type="file" 
                               name="cover_image" 
                               accept="image/*"
                               x-ref="coverInput"
                               @change="handleCoverChange($event)"
                               class="w-full text-xs text-slate-600 dark:text-slate-400 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:bg-blue-600 file:text-white file:font-bold hover:file:bg-blue-500 file:cursor-pointer transition">
                        <p class="text-[11px] text-slate-400 mt-1.5">Recommended ratio: 16:9 or 4:3 (JPEG, PNG, WebP up to 4MB)</p>
                    </div>
                </div>

                <!-- 2. Add New Screenshots Section (Multi-Upload with Live Preview) -->
                <div class="p-5 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50 space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300">
                            {{ __('Add Screenshots (Gallery)') }}
                        </label>
                        <template x-if="galleryPreviews.length > 0">
                            <button type="button" @click="clearGallery()" class="text-xs text-rose-500 hover:text-rose-400 font-bold flex items-center gap-1">
                                <i class="fa-solid fa-trash-can"></i>
                                <span>Clear Selected (<span x-text="galleryPreviews.length"></span>)</span>
                            </button>
                        </template>
                    </div>

                    <!-- Upload Input -->
                    <div>
                        <input type="file" 
                               name="images[]" 
                               multiple 
                               accept="image/*"
                               x-ref="galleryInput"
                               @change="handleGalleryChange($event)"
                               class="w-full text-xs text-slate-600 dark:text-slate-400 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:bg-slate-800 file:text-white file:font-bold hover:file:bg-slate-700 file:cursor-pointer transition">
                        <p class="text-[11px] text-slate-400 mt-1.5">You can select multiple images at once (Mobile mockups, screenshots, etc.)</p>
                    </div>

                    <!-- Newly Selected Files Live Previews -->
                    <template x-if="galleryPreviews.length > 0">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs font-bold text-emerald-600 dark:text-emerald-400">
                                <span><i class="fa-solid fa-circle-check me-1"></i> Ready to upload (<span x-text="galleryPreviews.length"></span> images):</span>
                            </div>
                            <div class="grid grid-cols-3 sm:grid-cols-4 gap-2.5 max-h-48 overflow-y-auto p-1">
                                <template x-for="(img, idx) in galleryPreviews" :key="idx">
                                    <div class="relative rounded-xl overflow-hidden border-2 border-emerald-500/60 shadow group">
                                        <img :src="img.url" class="h-20 w-full object-cover">
                                        <div class="absolute bottom-0 inset-x-0 bg-slate-950/80 px-1 py-0.5 text-[9px] text-white truncate text-center" x-text="img.size"></div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- 3. Existing Gallery Screenshots (Only in Edit Mode) -->
            @if($project->exists && $project->images->count() > 0)
                <div class="p-5 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-white">
                                {{ __('Current Gallery Screenshots') }}
                            </h3>
                            <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-blue-500/10 text-blue-600 dark:text-blue-400">
                                {{ $project->images->count() }} images
                            </span>
                        </div>
                        <span class="text-xs text-slate-400">Click the trash icon to delete any screenshot</span>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3 pt-1">
                        @foreach($project->images as $img)
                            <div class="relative group rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 shadow-sm hover:shadow-md transition">
                                <img src="{{ $img->image_url }}" alt="Screenshot" class="w-full h-28 object-cover group-hover:scale-105 transition duration-300">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition flex items-end justify-between p-2">
                                    <span class="text-[10px] font-mono text-white/80">#{{ $loop->iteration }}</span>
                                    <button type="button" 
                                            @click="$dispatch('confirm-action', { formId: 'del-img-{{ $img->id }}', title: @js(__('Delete Screenshot?')), message: @js(__('Are you sure you want to permanently delete this screenshot?')) })"
                                            class="w-7 h-7 rounded-lg bg-rose-600 hover:bg-rose-500 text-white flex items-center justify-center shadow transition"
                                            title="Delete Screenshot">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
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
                <div class="flex items-center justify-between mb-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300">Technologies Used</label>
                    <button type="button" @click="addTech()" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-bold">+ Add Custom Tech</button>
                </div>

                <!-- Quick-Pick Suggestions Cloud -->
                <div class="mb-3 p-3 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase tracking-wider text-slate-500 flex items-center gap-1">
                            <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i>
                            <span>{{ __('Quick Suggestions (Click to Add / Remove):') }}</span>
                        </span>
                        <span class="text-[10px] text-blue-500 font-bold" x-text="techs.filter(t => t.trim()).length + ' selected'"></span>
                    </div>

                    <div class="flex flex-wrap gap-1.5 max-h-40 overflow-y-auto p-0.5">
                        @php
                        $techSuggestions = [
                            'Flutter', 'Dart', 'Clean Architecture', 'MVVM Architecture', 'Repository Pattern', 'Get It (DI)',
                            'Bloc / Cubit', 'Provider', 'Riverpod', 'GetX',
                            'REST APIs (Dio)', 'Retrofit', 'WebSockets', 'Pusher', 'GraphQL',
                            'Hive DB', 'SQLite', 'SharedPreferences', 'Offline-First',
                            'Firebase Auth', 'FCM Push Notifications', 'Cloud Firestore', 'Firebase Storage',
                            'Google Maps', 'Payment Integration', 'Paymob', 'Stripe', 'Biometric Auth', 'In-App Purchases',
                            'PHP Laravel', 'Laravel Sanctum', 'JWT Auth', 'MySQL', 'Redis Cache', 'Queues & Jobs'
                        ];
                        @endphp
                        @foreach($techSuggestions as $suggest)
                            <button type="button" 
                                    @click="toggleTech('{{ $suggest }}')"
                                    :class="hasTech('{{ $suggest }}') 
                                        ? 'bg-blue-600 text-white border-blue-600 shadow-sm shadow-blue-500/25 ring-1 ring-blue-400' 
                                        : 'bg-white dark:bg-slate-950 text-slate-700 dark:text-slate-300 border-slate-200 dark:border-slate-800 hover:border-blue-400 dark:hover:border-blue-500'"
                                    class="px-2.5 py-1 rounded-lg border text-[11px] font-bold transition flex items-center gap-1 active:scale-95">
                                <template x-if="hasTech('{{ $suggest }}')">
                                    <i class="fa-solid fa-check text-[10px]"></i>
                                </template>
                                <span>{{ $suggest }}</span>
                            </button>
                        @endforeach
                    </div>
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
                <div class="flex items-center justify-between mb-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300">Key Features (English & عربي)</label>
                    <button type="button" @click="addFeature()" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-bold">+ Add Custom Feature</button>
                </div>

                <!-- Quick Presets Dropdown/List -->
                <div class="mb-3 p-3 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 space-y-2"
                     x-data="{ showPresets: false }">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase tracking-wider text-slate-500 flex items-center gap-1">
                            <i class="fa-solid fa-bolt text-amber-500"></i>
                            <span>{{ __('Quick Presets (1-Click EN + AR):') }}</span>
                        </span>
                        <button type="button" @click="showPresets = !showPresets" class="text-[11px] text-blue-600 dark:text-blue-400 font-bold hover:underline flex items-center gap-1">
                            <span x-text="showPresets ? 'Close Presets' : 'Choose from 11 Presets'"></span>
                            <i class="fa-solid text-[9px]" :class="showPresets ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>
                    </div>

                    <div x-show="showPresets" x-transition class="space-y-1.5 pt-1 max-h-48 overflow-y-auto p-0.5">
                        @php
                        $featurePresets = [
                            ['en' => 'Clean Architecture & Scalable Code', 'ar' => 'بناء الكود وفق معمارية نظيفة قابلة للتوسع والصيانة'],
                            ['en' => 'Offline-First with Local Caching', 'ar' => 'دعم العمل الكامل بدون إنترنت مع مزامنة تلقائية للبيانات'],
                            ['en' => 'Secure Token Authentication (Sanctum/JWT)', 'ar' => 'تسجيل دخول وتوثيق آمن ومحمي بالتوكن'],
                            ['en' => 'Push Notifications via FCM', 'ar' => 'إرسال واستقبال إشعارات فورية وتنبيهات ذكية عبر FCM'],
                            ['en' => 'Live Chat & Real-Time Messaging', 'ar' => 'محادثة فورية مباشرة مع دعم الرسائل اللحظية'],
                            ['en' => 'Online Payment & Secure Checkout', 'ar' => 'إتمام الدفع الإلكتروني الآمن مع دعم بوابات دفع متعددة'],
                            ['en' => 'Multi-Language Support (Arabic & English)', 'ar' => 'دعم كامل ومتكامل للغتين العربية والإنجليزية مع RTL'],
                            ['en' => 'Google Maps & Real-time Location Tracking', 'ar' => 'تحديد المواقع بدقة وتتبع التحرك المباشر على الخريطة'],
                            ['en' => 'Biometric Login (Face ID & Fingerprint)', 'ar' => 'تسجيل دخول سريع وآمن بالبصمة والتعرف على الوجه'],
                            ['en' => 'Advanced Filtering & Full-Text Search', 'ar' => 'بحث متقدم وفلترة متعددة وسريعة للنتائج'],
                            ['en' => 'Dark & Light Mode Support', 'ar' => 'دعم الوضع الليلي والنهاري التلقائي مع حفظ تفضيل المستخدم'],
                        ];
                        @endphp
                        @foreach($featurePresets as $preset)
                            <button type="button" 
                                    @click="addPresetFeature(@js($preset['en']), @js($preset['ar']))"
                                    class="w-full text-start px-2.5 py-1.5 rounded-xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 hover:border-blue-500 hover:bg-blue-50/50 dark:hover:bg-blue-950/30 transition group flex items-center justify-between">
                                <div class="truncate text-[11px] flex-1 pe-2">
                                    <span class="font-bold text-slate-800 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-400">{{ $preset['en'] }}</span>
                                    <span class="text-slate-400 mx-1">•</span>
                                    <span class="text-slate-500 dark:text-slate-400 font-sans" dir="rtl">{{ $preset['ar'] }}</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-md bg-blue-500/10 text-blue-600 dark:text-blue-400 text-[10px] font-extrabold shrink-0">+ Add</span>
                            </button>
                        @endforeach
                    </div>
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

    {{-- Hidden Delete Forms for Existing Screenshots --}}
    @if($project->exists)
        @foreach($project->images as $img)
            <form id="del-img-{{ $img->id }}" action="{{ route('admin.projects.images.destroy', [$project, $img]) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    @endif
</div>
@endsection