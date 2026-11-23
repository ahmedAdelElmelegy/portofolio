@extends('layouts.admin')

@section('title', $experience->exists ? 'Edit Timeline Entry' : 'Add Timeline Entry')

@section('content')
<div class="max-w-2xl space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-extrabold text-white">{{ $experience->exists ? 'Edit Timeline Entry' : 'Create Timeline Entry' }}</h1>
        <a href="{{ route('admin.experiences.index') }}" class="text-sm text-slate-400 hover:text-white">← Back to list</a>
    </div>

    <form action="{{ $experience->exists ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}"
          method="POST"
          class="bg-slate-950 border border-slate-800 rounded-2xl p-6 md:p-8 space-y-5">
        @csrf
        @if($experience->exists) @method('PUT') @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Entry Type *</label>
                <select name="type" required class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
                    <option value="work" {{ old('type', $experience->type) === 'work' ? 'selected' : '' }}>Work Experience</option>
                    <option value="education" {{ old('type', $experience->type) === 'education' ? 'selected' : '' }}>Education / Academic</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Sort Order</label>
                <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $experience->sort_order ?? 0) }}"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Role / Title / Degree *</label>
            <input type="text" name="title" value="{{ old('title', $experience->title) }}" required placeholder="e.g. Senior Flutter Developer or Bachelor of CS"
                   class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Organization / University *</label>
                <input type="text" name="organization" value="{{ old('organization', $experience->organization) }}" required placeholder="e.g. Company or University"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Location</label>
                <input type="text" name="location" value="{{ old('location', $experience->location) }}" placeholder="e.g. Remote / Egypt"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Start Date *</label>
                <input type="date" name="start_date" value="{{ old('start_date', $experience->start_date?->format('Y-m-d')) }}" required
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">End Date (leave empty if current)</label>
                <input type="date" name="end_date" value="{{ old('end_date', $experience->end_date?->format('Y-m-d')) }}"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="hidden" name="is_current" value="0">
                <input type="checkbox" name="is_current" value="1" {{ old('is_current', $experience->is_current) ? 'checked' : '' }}
                       class="rounded bg-slate-900 border-slate-800 text-blue-600 focus:ring-0">
                <span class="text-sm font-semibold text-white">This is my current role / ongoing study</span>
            </label>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Description / Highlights</label>
            <textarea name="description" rows="4" placeholder="Responsibilities, achievements, core topics studied..."
                      class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('description', $experience->description) }}</textarea>
        </div>

        <div class="pt-4 border-t border-slate-800 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25">
                {{ $experience->exists ? 'Update Entry' : 'Create Entry' }}
            </button>
        </div>
    </form>
</div>
@endsection

