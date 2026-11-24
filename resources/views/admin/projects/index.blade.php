@extends('layouts.admin')

@section('title', 'Projects')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Project Showcase Management</h1>
            <p class="text-slate-400 text-sm mt-1">Manage all projects, technology stacks, feature lists, and screenshot galleries.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-slate-900 dark:text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25 flex items-center gap-2 self-start">
            <i class="fa-solid fa-plus"></i>
            <span>Add New Project</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($projects as $project)
            <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden flex flex-col justify-between group hover:border-slate-700 transition">
                <div class="p-6">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $project->name }}</h3>
                                @if($project->is_featured)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-500/20 text-amber-400">Featured</span>
                                @endif
                                @if($project->published_at)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-500/20 text-emerald-400">Published</span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-800 text-slate-600 dark:text-slate-400">Draft</span>
                                @endif
                            </div>
                            <p class="text-xs text-blue-400 font-mono mt-0.5">/projects/{{ $project->slug }}</p>
                        </div>

                        <div class="flex items-center gap-1">
                            <a href="{{ route('admin.projects.show', $project) }}" title="View details" class="p-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white rounded-lg hover:bg-slate-100 dark:hover:bg-slate-900">
                                <i class="fa-solid fa-eye text-sm"></i>
                            </a>
                            <a href="{{ route('admin.projects.edit', $project) }}" title="Edit" class="p-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white rounded-lg hover:bg-slate-100 dark:hover:bg-slate-900">
                                <i class="fa-solid fa-pen text-sm"></i>
                            </a>
                            <form id="delete-proj-{{ $project->id }}" action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" @click="$dispatch('confirm-action', { formId: 'delete-proj-{{ $project->id }}', title: @js(__('Delete Project?')), message: @js(__('Are you sure you want to delete this project and all its screenshots?')) })" title="Delete" class="p-2 text-slate-600 dark:text-slate-400 hover:text-red-400 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-900">
                                    <i class="fa-solid fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2 mb-4 leading-relaxed">
                        {{ $project->short_description ?? Str::limit($project->description, 120) }}
                    </p>

                    <div class="flex items-center gap-4 text-xs text-slate-500 font-medium pt-3 border-t border-slate-200 dark:border-slate-800">
                        <span><i class="fa-solid fa-microchip mr-1.5 text-slate-600 dark:text-slate-400"></i>{{ $project->technologies_count }} Tech tags</span>
                        <span><i class="fa-solid fa-list-check mr-1.5 text-slate-600 dark:text-slate-400"></i>{{ $project->features_count }} Features</span>
                        <span><i class="fa-regular fa-images mr-1.5 text-slate-600 dark:text-slate-400"></i>{{ $project->images_count }} Screenshots</span>
                    </div>
                </div>

                <div class="px-6 py-3 bg-slate-50/80 dark:bg-slate-900/60 border-t border-slate-200 dark:border-slate-800 flex items-center justify-between text-xs">
                    <div class="flex items-center gap-3">
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="text-slate-400 hover:text-slate-900 dark:hover:text-white flex items-center gap-1">
                                <i class="fa-brands fa-github"></i>
                                <span>Code</span>
                            </a>
                        @endif
                        @if($project->app_url)
                            <a href="{{ $project->app_url }}" target="_blank" class="text-slate-400 hover:text-blue-400 flex items-center gap-1">
                                <i class="fa-solid fa-link"></i>
                                <span>Live / Drive</span>
                            </a>
                        @endif
                    </div>
                    <a href="{{ route('projects.show', $project->slug) }}" target="_blank" class="text-blue-400 hover:underline font-semibold">
                        Preview public page →
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

