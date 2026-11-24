@extends('layouts.admin')

@section('title', 'Video Showcase Section')

@section('content')
<div class="max-w-5xl space-y-6"
     x-data="{
        isSubmitting: false,
        videoPreviewUrl: null,
        videoFileName: '',
        videoFileSizeMB: 0,
        sizeError: '',
        handleVideoChange(event) {
            const file = event.target.files[0];
            if (!file) return;

            this.videoFileName = file.name;
            this.videoFileSizeMB = (file.size / (1024 * 1024)).toFixed(2);

            if (file.size > 100 * 1024 * 1024) {
                this.sizeError = 'حجم الملف (' + this.videoFileSizeMB + ' MB) يتجاوز الحد الأقصى المسموح به (100 MB).';
                this.videoPreviewUrl = null;
                return;
            }

            this.sizeError = '';
            this.videoPreviewUrl = URL.createObjectURL(file);
        }
     }">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Video Showcase & Interactive Content</h1>
            <p class="text-slate-400 text-sm mt-1">Manage the video presentation and interactive contact / highlight cards displayed on your portfolio.</p>
        </div>
        <a href="{{ route('home') }}#video-showcase" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-2 bg-blue-600/10 border border-blue-500/30 text-blue-400 hover:bg-blue-600/20 text-xs font-semibold rounded-xl transition">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>Preview on Site</span>
        </a>
    </div>

    <form action="{{ route('admin.video-section.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6"
          @submit="isSubmitting = true">
        @csrf
        @method('PUT')

        <!-- Section Details & Video File Card -->
        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 space-y-6">
            <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 border-b border-slate-200 dark:border-slate-800 pb-3">
                <i class="fa-solid fa-film text-blue-500"></i>
                <span>Section Information & Media</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Badge -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Section Badge</label>
                    <input type="text" name="badge" value="{{ old('badge', $videoSection->badge) }}" placeholder="e.g. Interactive Showcase"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>

                <!-- Active status -->
                <div class="flex items-center md:pt-6">
                    <label class="inline-flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $videoSection->is_active) ? 'checked' : '' }}
                               class="w-5 h-5 rounded border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-blue-600 focus:ring-blue-500 focus:ring-offset-slate-950">
                        <span class="text-sm font-semibold text-slate-800 dark:text-slate-200">Show this section on portfolio</span>
                    </label>
                </div>

                <!-- Title -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Section Title *</label>
                    <input type="text" name="title" value="{{ old('title', $videoSection->title) }}" required placeholder="e.g. Get To Know Me & Connect"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>

                <!-- Subtitle -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Section Subtitle / Description</label>
                    <textarea name="subtitle" rows="2" placeholder="Brief introduction accompanying the video..."
                              class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('subtitle', $videoSection->subtitle) }}</textarea>
                </div>
            </div>

            <!-- Video File & Preview -->
            <div class="pt-4 border-t border-slate-200 dark:border-slate-800 grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Upload / Replace Video File (.mp4, .webm, .mov)</label>
                    <input type="file" name="video" accept="video/mp4,video/webm,video/quicktime,video/x-matroska"
                           @change="handleVideoChange($event)"
                           class="w-full text-sm text-slate-600 dark:text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500 cursor-pointer">
                    
                    <p class="text-xs text-slate-500 mt-2">Maximum file size: 100MB. Recommended: MP4 (H.264).</p>

                    <!-- File selected indicator -->
                    <template x-if="videoFileName">
                        <div class="mt-3 p-3 bg-blue-500/10 border border-blue-500/20 rounded-xl text-xs text-blue-400 flex items-center justify-between">
                            <span class="truncate font-medium" x-text="'Selected: ' + videoFileName + ' (' + videoFileSizeMB + ' MB)'"></span>
                            <span class="text-emerald-400 font-bold ml-2">Ready to upload</span>
                        </div>
                    </template>

                    <!-- Client-side size error -->
                    <template x-if="sizeError">
                        <div class="mt-3 p-3 bg-red-500/10 border border-red-500/30 rounded-xl text-xs text-red-400 flex items-center gap-2">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span x-text="sizeError"></span>
                        </div>
                    </template>

                    @error('video')
                        <div class="mt-2 text-xs text-red-400 font-semibold">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <span class="block text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 mb-2">
                        <span x-show="!videoPreviewUrl">Current Saved Video</span>
                        <span x-show="videoPreviewUrl" class="text-blue-400">Newly Selected Video Preview</span>
                    </span>

                    <div class="relative rounded-2xl overflow-hidden bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 aspect-video flex items-center justify-center shadow-lg">
                        <!-- Preview for newly picked video -->
                        <template x-if="videoPreviewUrl">
                            <video :src="videoPreviewUrl" controls autoplay muted class="w-full h-full object-cover"></video>
                        </template>

                        <!-- Current saved video if no new file picked -->
                        <template x-if="!videoPreviewUrl">
                            <div>
                                @if($videoSection->video_path)
                                    <video controls class="w-full h-full object-cover">
                                        <source src="{{ asset('storage/' . $videoSection->video_path) }}?v={{ $videoSection->updated_at?->timestamp }}" type="video/mp4">
                                        <source src="{{ asset('storage/' . $videoSection->video_path) }}?v={{ $videoSection->updated_at?->timestamp }}" type="video/webm">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <div class="p-8 text-center text-slate-500 text-sm">
                                        No video uploaded yet.
                                    </div>
                                @endif
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Items / Cards Repeater -->
        @php
            $initialItems = $videoSection->items->map(function($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'value' => $item->value,
                    'url' => $item->url,
                    'icon' => $item->icon ?: 'fa-solid fa-link',
                    'badge' => $item->badge,
                    'sort_order' => $item->sort_order,
                ];
            })->values();
        @endphp

        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 space-y-6"
             x-data="{
                items: {{ $initialItems->toJson() }},
                addItem() {
                    this.items.push({
                        id: null,
                        title: '',
                        value: '',
                        url: '',
                        icon: 'fa-solid fa-link',
                        badge: '',
                        sort_order: this.items.length + 1
                    });
                },
                removeItem(index) {
                    this.items.splice(index, 1);
                }
             }">

            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-3">
                <div>
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-layer-group text-blue-500"></i>
                        <span>Interactive Content Cards</span>
                    </h2>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-0.5">Cards displayed alongside the video (emails, links, social profiles, key stats).</p>
                </div>
                <button type="button" @click="addItem()" class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-blue-600 hover:bg-blue-500 text-slate-900 dark:text-white text-xs font-semibold rounded-xl transition shadow-md shadow-blue-500/20">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add New Card</span>
                </button>
            </div>

            <!-- Empty state -->
            <div x-show="items.length === 0" class="p-8 text-center border border-dashed border-slate-200 dark:border-slate-800 rounded-xl text-slate-500 text-sm">
                <i class="fa-solid fa-id-card text-3xl mb-2 text-slate-600 block"></i>
                No content cards added yet. Click "Add New Card" above to add your first interactive card.
            </div>

            <!-- List of Items -->
            <div class="space-y-4">
                <template x-for="(item, index) in items" :key="index">
                    <div class="p-4 bg-slate-50/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800/80 rounded-xl space-y-3 relative group">
                        <input type="hidden" :name="'items[' + index + '][id]'" :value="item.id">
                        <input type="hidden" :name="'items[' + index + '][sort_order]'" :value="index + 1">

                        <div class="flex items-center justify-between pb-2 border-b border-slate-200/80 dark:border-slate-800/60">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-md bg-blue-500/20 text-blue-400 text-xs font-bold flex items-center justify-center" x-text="index + 1"></span>
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400">Card #<span x-text="index + 1"></span></span>
                            </div>
                            <button type="button" @click="removeItem(index)" class="text-red-400/70 hover:text-red-400 p-1 text-sm transition" title="Remove Card">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <!-- Title -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Card Title *</label>
                                <input type="text" :name="'items[' + index + '][title]'" x-model="item.title" required placeholder="e.g. Email Address"
                                       class="w-full px-3 py-2 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-lg text-slate-900 dark:text-white text-xs focus:border-blue-500 focus:outline-none">
                            </div>

                            <!-- Value -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Value / Text</label>
                                <input type="text" :name="'items[' + index + '][value]'" x-model="item.value" placeholder="e.g. ahmedadelelmelegy2@gmail.com"
                                       class="w-full px-3 py-2 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-lg text-slate-900 dark:text-white text-xs focus:border-blue-500 focus:outline-none">
                            </div>

                            <!-- URL -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Action URL / Link</label>
                                <input type="text" :name="'items[' + index + '][url]'" x-model="item.url" placeholder="e.g. mailto:..., https://linkedin.com/..."
                                       class="w-full px-3 py-2 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-lg text-slate-900 dark:text-white text-xs focus:border-blue-500 focus:outline-none">
                            </div>

                            <!-- FontAwesome Icon Class -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1 flex items-center justify-between">
                                    <span>Icon (FontAwesome Class)</span>
                                    <i :class="item.icon || 'fa-solid fa-link'" class="text-blue-400 text-sm"></i>
                                </label>
                                <input type="text" :name="'items[' + index + '][icon]'" x-model="item.icon" placeholder="e.g. fa-solid fa-envelope"
                                       class="w-full px-3 py-2 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-lg text-slate-900 dark:text-white text-xs focus:border-blue-500 focus:outline-none">
                            </div>

                            <!-- Badge/Tag -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Badge Tag</label>
                                <input type="text" :name="'items[' + index + '][badge]'" x-model="item.badge" placeholder="e.g. Primary, Official, Verified"
                                       class="w-full px-3 py-2 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-lg text-slate-900 dark:text-white text-xs focus:border-blue-500 focus:outline-none">
                            </div>

                            <!-- Pre-filled icon helper -->
                            <div class="flex items-end gap-1.5 pb-1">
                                <span class="text-[10px] text-slate-500 block mb-1">Quick icons:</span>
                                <div class="flex flex-wrap gap-1">
                                    <button type="button" @click="item.icon = 'fa-solid fa-envelope'" class="p-1 px-1.5 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white rounded text-xs" title="Envelope">
                                        <i class="fa-solid fa-envelope"></i>
                                    </button>
                                    <button type="button" @click="item.icon = 'fa-brands fa-linkedin'" class="p-1 px-1.5 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white rounded text-xs" title="LinkedIn">
                                        <i class="fa-brands fa-linkedin"></i>
                                    </button>
                                    <button type="button" @click="item.icon = 'fa-brands fa-github'" class="p-1 px-1.5 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white rounded text-xs" title="GitHub">
                                        <i class="fa-brands fa-github"></i>
                                    </button>
                                    <button type="button" @click="item.icon = 'fa-brands fa-whatsapp'" class="p-1 px-1.5 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white rounded text-xs" title="WhatsApp">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </button>
                                    <button type="button" @click="item.icon = 'fa-solid fa-mobile-screen-button'" class="p-1 px-1.5 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white rounded text-xs" title="Mobile App">
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Submit Button with Upload Loading State -->
        <div class="flex items-center justify-end gap-4 pt-2">
            <button type="submit"
                    :disabled="isSubmitting || !!sizeError"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-500 disabled:opacity-50 disabled:cursor-not-allowed text-slate-900 dark:text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25 flex items-center gap-2">
                <template x-if="isSubmitting">
                    <span class="inline-flex items-center gap-2">
                        <i class="fa-solid fa-circle-notch animate-spin"></i>
                        <span>جاري رفع الفيديو وحفظ التغييرات... يرجى الانتظار</span>
                    </span>
                </template>
                <template x-if="!isSubmitting">
                    <span class="inline-flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save All Changes</span>
                    </span>
                </template>
            </button>
        </div>
    </form>
</div>
@endsection
