@extends('layouts.portfolio')

@section('title', $project->name . ' — Case Study')
@section('meta_description', $project->short_description ?? Str::limit($project->description, 150))

@section('content')
<main class="py-12 md:py-20 max-w-5xl mx-auto px-6 space-y-12" x-data="{ activeImage: null }">
    <!-- Back button -->
    <a href="{{ route('home') }}#projects" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition">
        <i class="fa-solid fa-arrow-left rtl:rotate-180"></i>
        <span>{{ __('Back to all projects') }}</span>
    </a>

    <!-- Project Header -->
    <div class="space-y-4">
        <div class="flex items-center gap-3">
            <h1 class="text-4xl sm:text-5xl font-black text-slate-900 dark:text-white">{{ $project->name }}</h1>
            @if($project->is_featured)
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 border border-amber-500/30">{{ __('Featured Project') }}</span>
            @endif
        </div>
        <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">{{ $project->short_description }}</p>

        <!-- Links (GitHub, Android, iOS, Live Demo) -->
        <div class="flex flex-wrap items-center gap-3 pt-2">
            @if(!empty($project->github_url))
                <a href="{{ $project->github_url }}" target="_blank" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-900 dark:hover:bg-slate-800 border border-slate-300 dark:border-slate-800 text-slate-800 dark:text-white font-bold text-xs rounded-xl transition flex items-center gap-2 shadow-sm hover:scale-105">
                    <i class="fa-brands fa-github text-sm"></i>
                    <span>{{ __('GitHub Repository') }}</span>
                </a>
            @endif

            @if(!empty($project->android_url))
                <a href="{{ $project->android_url }}" target="_blank" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-xl transition flex items-center gap-2 shadow-lg shadow-emerald-600/25 hover:scale-105">
                    <i class="fa-brands fa-android text-base"></i>
                    <span>{{ __('Android (Google Play / APK)') }}</span>
                </a>
            @endif

            @if(!empty($project->ios_url))
                <a href="{{ $project->ios_url }}" target="_blank" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white dark:bg-sky-600 dark:hover:bg-sky-500 font-bold text-xs rounded-xl transition flex items-center gap-2 shadow-lg shadow-sky-600/25 hover:scale-105">
                    <i class="fa-brands fa-apple text-base"></i>
                    <span>{{ __('iOS (App Store / TestFlight)') }}</span>
                </a>
            @endif

            @if(!empty($project->app_url))
                <a href="{{ $project->app_url }}" target="_blank" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-xl transition flex items-center gap-2 shadow-lg shadow-blue-500/25 hover:scale-105">
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    <span>{{ __('Live Web Demo') }}</span>
                </a>
            @endif
        </div>
    </div>

    <!-- Tech Stack & Features -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Tech Stack -->
        <div class="bg-white dark:bg-slate-900/60 border border-slate-200/90 dark:border-slate-800/80 rounded-3xl p-7 shadow-sm transition-colors">
            <h2 class="text-sm font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400 mb-4">{{ __('Technologies & Architecture') }}</h2>
            <div class="flex flex-wrap gap-2">
                @forelse($project->technologies as $t)
                    <span class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 dark:bg-slate-900 text-slate-800 dark:text-white border border-slate-200 dark:border-slate-800">
                        {{ $t->name }}
                    </span>
                @empty
                    <span class="text-xs text-slate-500">Not specified.</span>
                @endforelse
            </div>
        </div>

        <!-- Features list -->
        <div class="bg-white dark:bg-slate-900/60 border border-slate-200/90 dark:border-slate-800/80 rounded-3xl p-7 shadow-sm transition-colors">
            <h2 class="text-sm font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400 mb-4">{{ __('Core Application Features') }}</h2>
            <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-300">
                @forelse($project->features as $f)
                    <li class="flex items-start gap-2.5">
                        <i class="fa-solid fa-circle-check text-emerald-500 dark:text-emerald-400 mt-0.5"></i>
                        <span>{{ $f->description }}</span>
                    </li>
                @empty
                    <li class="text-slate-500">No features specified.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Detailed Description -->
    <div class="bg-white dark:bg-slate-900/60 border border-slate-200/90 dark:border-slate-800/80 rounded-3xl p-8 space-y-4 shadow-sm transition-colors">
        <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ __('Project Overview & Problem Solved') }}</h2>
        <div class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed whitespace-pre-line">
            {{ $project->description }}
        </div>
    </div>

    <!-- Screenshots Gallery (Mobile Phone Mockup Cards & Lightbox) -->
    @if($project->images->isNotEmpty())
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Screenshot Gallery') }} ({{ $project->images->count() }})</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Click any mobile screenshot to view full-resolution display.') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">
                @foreach($project->images as $img)
                    <div @click="activeImage = '{{ $img->image_url }}'"
                         class="group relative aspect-[9/18.5] rounded-3xl overflow-hidden bg-slate-100 dark:bg-slate-900 border-2 border-slate-200 dark:border-slate-800 hover:border-blue-500/60 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer">
                        <!-- Simulated top speaker notch -->
                        <div class="absolute top-2.5 inset-x-0 mx-auto w-12 h-1 bg-slate-300 dark:bg-slate-700/60 rounded-full z-10 pointer-events-none"></div>
                        
                        <img src="{{ $img->image_url }}" alt="{{ $project->name }} Screenshot" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-blue-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="w-10 h-10 rounded-full bg-white/90 dark:bg-slate-900/90 text-blue-600 dark:text-blue-400 flex items-center justify-center shadow-lg group-hover:scale-110 transition">
                                <i class="fa-solid fa-magnifying-glass-plus text-sm"></i>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Lightbox Modal -->
        <div x-show="activeImage" x-cloak
             @keydown.escape.window="activeImage = null"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-slate-950/90 backdrop-blur-md"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div @click.outside="activeImage = null" class="relative max-w-sm sm:max-w-md w-full max-h-[90vh] flex flex-col items-center">
                <button type="button" @click="activeImage = null"
                        class="absolute -top-12 right-0 sm:-right-12 w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 text-white flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
                <img :src="activeImage" alt="Enlarged screenshot" class="w-auto max-h-[85vh] rounded-3xl object-contain shadow-2xl border border-white/10">
            </div>
        </div>
    @endif
</main>
@endsection
