@extends('layouts.portfolio')

@section('title', $project->name . ' — Case Study')
@section('meta_description', $project->short_description ?? Str::limit($project->description, 150))

@section('content')
<main class="py-12 md:py-20 max-w-5xl mx-auto px-6 space-y-12">
    <!-- Back button -->
    <a href="{{ route('home') }}#projects" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-400 hover:text-white transition">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Back to all projects</span>
    </a>

    <!-- Project Header -->
    <div class="space-y-4">
        <div class="flex items-center gap-3">
            <h1 class="text-4xl sm:text-5xl font-black text-white">{{ $project->name }}</h1>
            @if($project->is_featured)
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-400 border border-amber-500/30">Featured Project</span>
            @endif
        </div>
        <p class="text-lg text-slate-300 leading-relaxed max-w-3xl">{{ $project->short_description }}</p>

        <!-- Links -->
        <div class="flex flex-wrap items-center gap-4 pt-2">
            @if($project->github_url)
                <a href="{{ $project->github_url }}" target="_blank" class="px-6 py-2.5 bg-slate-900 hover:bg-slate-850 border border-slate-800 text-white font-bold text-xs rounded-xl transition flex items-center gap-2">
                    <i class="fa-brands fa-github text-sm"></i>
                    <span>GitHub Repository</span>
                </a>
            @endif
            @if($project->app_url)
                <a href="{{ $project->app_url }}" target="_blank" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-xl transition flex items-center gap-2 shadow-lg shadow-blue-500/25">
                    <i class="fa-solid fa-link text-xs"></i>
                    <span>Live App / APK Download</span>
                </a>
            @endif
        </div>
    </div>

    <!-- Tech Stack & Features -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Tech Stack -->
        <div class="bg-slate-950 border border-slate-800/80 rounded-3xl p-7">
            <h2 class="text-sm font-bold uppercase tracking-wider text-blue-400 mb-4">Technologies & Architecture</h2>
            <div class="flex flex-wrap gap-2">
                @forelse($project->technologies as $t)
                    <span class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-900 text-white border border-slate-800">
                        {{ $t->name }}
                    </span>
                @empty
                    <span class="text-xs text-slate-500">Not specified.</span>
                @endforelse
            </div>
        </div>

        <!-- Features list -->
        <div class="bg-slate-950 border border-slate-800/80 rounded-3xl p-7">
            <h2 class="text-sm font-bold uppercase tracking-wider text-blue-400 mb-4">Core Application Features</h2>
            <ul class="space-y-2 text-xs text-slate-300">
                @forelse($project->features as $f)
                    <li class="flex items-start gap-2.5">
                        <i class="fa-solid fa-circle-check text-emerald-400 mt-0.5"></i>
                        <span>{{ $f->description }}</span>
                    </li>
                @empty
                    <li class="text-slate-500">No features specified.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Detailed Description -->
    <div class="bg-slate-950 border border-slate-800/80 rounded-3xl p-8 space-y-4">
        <h2 class="text-xl font-bold text-white">Project Overview & Problem Solved</h2>
        <div class="text-sm text-slate-300 leading-relaxed whitespace-pre-line">
            {{ $project->description }}
        </div>
    </div>

    <!-- Screenshots Gallery -->
    @if($project->images->isNotEmpty())
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-white">Screenshot Gallery ({{ $project->images->count() }})</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach($project->images as $img)
                    <a href="{{ $img->image_url }}" target="_blank" class="block rounded-2xl overflow-hidden border border-slate-800 hover:border-blue-500/50 transition group">
                        <img src="{{ $img->image_url }}" alt="Screenshot" class="w-full h-52 object-cover group-hover:scale-105 transition duration-300">
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</main>
@endsection

