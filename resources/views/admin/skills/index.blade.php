@extends('layouts.admin')

@section('title', 'Skills')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Skills Management</h1>
            <p class="text-slate-400 text-sm mt-1">Organize your technical skills, categories, and icons.</p>
        </div>
        <a href="{{ route('admin.skills.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25 flex items-center gap-2 self-start">
            <i class="fa-solid fa-plus"></i>
            <span>Add New Skill</span>
        </a>
    </div>

    @foreach($skills as $category => $skillList)
        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6">
            <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center justify-between">
                <span class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                    <span>{{ $category ?? 'General' }}</span>
                </span>
                <span class="text-xs text-slate-500 font-mono">({{ count($skillList) }} skills)</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($skillList as $skill)
                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 flex items-center justify-between group hover:border-blue-500/40 transition">
                        <div class="min-w-0 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-blue-500/10 text-blue-500 flex items-center justify-center font-bold text-sm flex-shrink-0">
                                <i class="{{ $skill->fa_icon_class }}"></i>
                            </div>
                            <div class="truncate">
                                <p class="text-sm font-semibold text-slate-900 dark:text-white truncate flex items-center gap-1.5">
                                    <span>{{ $skill->name }}</span>
                                    @if($skill->is_featured)
                                        <span class="px-1.5 py-0.2 rounded text-[10px] font-bold bg-amber-500/20 text-amber-400">Featured</span>
                                    @endif
                                </p>
                                <p class="text-xs text-slate-400 truncate">
                                    <span class="font-mono text-[11px]">{{ $skill->icon ?: 'code' }}</span>
                                    @if($skill->sort_order)
                                        • <span class="text-[11px]">#{{ $skill->sort_order }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-1 opacity-80 group-hover:opacity-100 transition flex-shrink-0">
                            <a href="{{ route('admin.skills.edit', $skill) }}" class="p-1.5 text-slate-400 hover:text-slate-900 dark:hover:text-white rounded hover:bg-slate-200 dark:hover:bg-slate-800">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>
                            <form id="delete-skill-{{ $skill->id }}" action="{{ route('admin.skills.destroy', $skill) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" @click="$dispatch('confirm-action', { formId: 'delete-skill-{{ $skill->id }}', title: @js(__('Delete Skill?')), message: @js(__('Are you sure you want to delete this skill?')) })" class="p-1.5 text-slate-400 hover:text-red-400 rounded hover:bg-slate-200 dark:hover:bg-slate-800">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection
