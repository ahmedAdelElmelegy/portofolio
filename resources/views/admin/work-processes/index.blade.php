@extends('layouts.admin')

@section('title', 'Work Process (Methodology)')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Work Process Methodology</h1>
            <p class="text-slate-400 text-sm mt-1">The 6 developmental steps featured in your portfolio to showcase your professional workflow.</p>
        </div>
        <a href="{{ route('admin.work-processes.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-slate-900 dark:text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25 flex items-center gap-2 self-start">
            <i class="fa-solid fa-plus"></i>
            <span>Add Step</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($processes as $process)
            <div class="p-6 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl flex flex-col justify-between group hover:border-blue-500/50 transition">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-8 h-8 rounded-lg bg-blue-500/10 text-blue-400 font-extrabold text-sm flex items-center justify-center">
                            {{ $process->sort_order }}
                        </span>
                        <div class="flex items-center gap-1 opacity-70 group-hover:opacity-100 transition">
                            <a href="{{ route('admin.work-processes.edit', $process) }}" class="p-1.5 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white rounded hover:bg-slate-100 dark:hover:bg-slate-800">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>
                            <form id="delete-proc-{{ $process->id }}" action="{{ route('admin.work-processes.destroy', $process) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" @click="$dispatch('confirm-action', { formId: 'delete-proc-{{ $process->id }}', title: @js(__('Delete Process Step?')), message: @js(__('Are you sure you want to delete this step?')) })" class="p-1.5 text-slate-600 dark:text-slate-400 hover:text-red-400 rounded hover:bg-slate-100 dark:hover:bg-slate-800">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">{{ $process->title }}</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{{ $process->description }}</p>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-200/80 dark:border-slate-800/60 flex items-center justify-between text-xs text-slate-500">
                    <span>Icon: <code class="text-blue-400">{{ $process->icon ?? 'default' }}</code></span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

