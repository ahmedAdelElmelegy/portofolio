@extends('layouts.admin')

@section('title', $project->name)

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $project->name }}</h1>
                @if($project->is_featured)
                    <span class="px-2 py-0.5 rounded text-xs font-bold bg-amber-500/20 text-amber-400">Featured</span>
                @endif
            </div>
            <p class="text-slate-400 text-sm mt-1">{{ $project->short_description }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.projects.edit', $project) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-slate-900 dark:text-white text-xs font-bold rounded-xl transition">
                <i class="fa-solid fa-pen mr-1"></i> Edit Project
            </a>
            <a href="{{ route('admin.projects.index') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white ml-2">← Back</a>
        </div>
    </div>

    <!-- Tech & Features summary -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6">
            <h2 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-3">Technologies Stack</h2>
            <div class="flex flex-wrap gap-2">
                @forelse($project->technologies as $tech)
                    <span class="px-2.5 py-1 rounded-lg text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                        {{ $tech->name }}
                    </span>
                @empty
                    <span class="text-xs text-slate-500">No technologies listed.</span>
                @endforelse
            </div>
        </div>

        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6">
            <h2 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-3">Key Features</h2>
            <ul class="space-y-1.5 text-xs text-slate-700 dark:text-slate-300">
                @forelse($project->features as $feature)
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-emerald-400 mt-0.5"></i>
                        <span>{{ $feature->description }}</span>
                    </li>
                @empty
                    <li class="text-slate-500">No features specified.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Screenshots Gallery & Delete functionality -->
    <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6">
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Project Gallery Screenshots ({{ $project->images->count() }})</h2>
        @if($project->images->isEmpty())
            <p class="text-xs text-slate-500 italic">No gallery screenshots uploaded yet. Edit project to add screenshots.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($project->images as $img)
                    <div class="relative group rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900">
                        <img src="{{ $img->image_url }}" class="w-full h-36 object-cover">
                        <form action="{{ route('admin.projects.images.destroy', [$project, $img]) }}" method="POST"
                              class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition"
                              onsubmit="return confirm('Remove this screenshot?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 rounded-lg bg-red-600/90 text-slate-900 dark:text-white hover:bg-red-500 shadow">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

