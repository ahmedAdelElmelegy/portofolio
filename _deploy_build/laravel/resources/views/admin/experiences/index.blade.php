@extends('layouts.admin')

@section('title', __('Experience & Education'))

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ __('Experience & Education Timeline') }}</h1>
            <p class="text-slate-400 text-sm mt-1">{{ __('Manage your career history, companies, and academic degrees.') }}</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25 flex items-center gap-2 self-start">
            <i class="fa-solid fa-plus"></i>
            <span>{{ __('Add Timeline Entry') }}</span>
        </a>
    </div>

    @foreach(['work' => __('Work Experience'), 'education' => __('Education & Degrees')] as $typeKey => $typeLabel)
        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6">
            <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                <i class="fa-solid {{ $typeKey === 'work' ? 'fa-briefcase text-blue-400' : 'fa-graduation-cap text-purple-400' }}"></i>
                <span>{{ $typeLabel }}</span>
                <span class="text-xs text-slate-500 font-normal">({{ isset($experiences[$typeKey]) ? count($experiences[$typeKey]) : 0 }})</span>
            </h2>

            @if(!isset($experiences[$typeKey]) || $experiences[$typeKey]->isEmpty())
                <p class="text-xs text-slate-500 italic py-2">{{ __('No entries added in this section yet.') }}</p>
            @else
                <div class="divide-y divide-slate-800">
                    @foreach($experiences[$typeKey] as $entry)
                        <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-base font-bold text-slate-900 dark:text-white">{{ $entry->title }}</h3>
                                    @if($entry->is_current)
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-500/20 text-emerald-400">{{ __('Current') }}</span>
                                    @endif
                                </div>
                                <p class="text-sm text-slate-700 dark:text-slate-300 font-medium">{{ $entry->organization }} <span class="text-slate-500">•</span> <span class="text-xs text-slate-600 dark:text-slate-400">{{ $entry->location ?? __('Remote') }}</span></p>
                                <p class="text-xs text-slate-500 mt-1 font-mono">{{ $entry->date_range }}</p>
                                @if($entry->description)
                                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 max-w-2xl leading-relaxed">{{ $entry->description }}</p>
                                @endif
                            </div>

                            <div class="flex items-center gap-2 self-end sm:self-center">
                                <a href="{{ route('admin.experiences.edit', $entry) }}" title="{{ __('Edit') }}" class="p-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white rounded-lg hover:bg-slate-100 dark:hover:bg-slate-900">
                                    <i class="fa-solid fa-pen text-sm"></i>
                                </a>
                                <form id="delete-exp-{{ $entry->id }}" action="{{ route('admin.experiences.destroy', $entry) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" @click="$dispatch('confirm-action', { formId: 'delete-exp-{{ $entry->id }}', title: @js(__('Delete Timeline Item?')), message: @js(__('Are you sure you want to delete this experience/education item?')) })" title="{{ __('Delete') }}" class="p-2 text-slate-600 dark:text-slate-400 hover:text-red-400 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-900">
                                        <i class="fa-solid fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
</div>
@endsection
