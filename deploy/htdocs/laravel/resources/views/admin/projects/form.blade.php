@extends('layouts.admin')

@section('title', $project->exists ? 'Edit Project' : 'Create Project')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-white">{{ $project->exists ? 'Edit Project: ' . $project->name : 'Create New Project' }}</h1>
            <p class="text-slate-400 text-sm mt-1">Configure project details, cover photo, tech stack, and screenshot gallery.</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="text-sm text-slate-400 hover:text-white">← Back to list</a>
    </div>

    <form action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-slate-950 border border-slate-800 rounded-2xl p-6 md:p-8 space-y-6"
          x-data="{
              techs: {{ json_encode($project->exists ? $project->technologies->pluck('name')->toArray() : ['Flutter', 'Dart']) }},
              features: {{ json_encode($project->exists ? $project->features->pluck('description')->toArray() : ['Clean architecture & scalable code']) }},
              addTech() { this.techs.push(''); },
              removeTech(i) { this.techs.splice(i, 1); },
              addFeature() { this.features.push(''); },
              removeFeature(i) { this.features.splice(i, 1); }
          }">
        @csrf
        @if($project->exists) @method('PUT') @endif

        <!-- Basic info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Project Name *</label>
                <input type="text" name="name" value="{{ old('name', $project->name) }}" required placeholder="e.g. Circle, Nurse Bot, Al Huda"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Sort Order</label>
                <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $project->sort_order ?? 0) }}"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Short Summary (for Card) *</label>
            <input type="text" name="short_description" value="{{ old('short_description', $project->short_description) }}" placeholder="Brief 1-line overview..."
                   class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Full Description *</label>
            <textarea name="description" rows="4" required placeholder="Detailed description of features, problem solved, architecture..."
                      class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('description', $project->description) }}</textarea>
        </div>

        <!-- Links -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">GitHub Repository URL</label>
                <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}" placeholder="https://github.com/..."
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">App / Demo / Drive Link</label>
                <input type="url" name="app_url" value="{{ old('app_url', $project->app_url) }}" placeholder="https://drive.google.com/..."
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <!-- Technologies Dynamic Rows -->
        <div class="pt-4 border-t border-slate-800">
            <div class="flex items-center justify-between mb-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300">Technologies Used</label>
                <button type="button" @click="addTech()" class="text-xs text-blue-400 hover:text-blue-300 font-bold flex items-center gap-1">
                    <i class="fa-solid fa-plus"></i> Add Tech Tag
                </button>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                <template x-for="(tech, idx) in techs" :key="idx">
                    <div class="flex items-center gap-1.5">
                        <input type="text" :name="'technologies[' + idx + ']'" x-model="techs[idx]" placeholder="e.g. Provider, Dio"
                               class="w-full px-3 py-1.5 bg-slate-900 border border-slate-800 rounded-lg text-white text-xs focus:border-blue-500 focus:outline-none">
                        <button type="button" @click="removeTech(idx)" class="p-1.5 text-slate-500 hover:text-red-400">
                            <i class="fa-solid fa-xmark text-xs"></i>
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <!-- Key Features Dynamic Rows -->
        <div class="pt-4 border-t border-slate-800">
            <div class="flex items-center justify-between mb-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300">Key Features List</label>
                <button type="button" @click="addFeature()" class="text-xs text-blue-400 hover:text-blue-300 font-bold flex items-center gap-1">
                    <i class="fa-solid fa-plus"></i> Add Feature Item
                </button>
            </div>
            <div class="space-y-2">
                <template x-for="(feat, idx) in features" :key="idx">
                    <div class="flex items-center gap-2">
                        <input type="text" :name="'features[' + idx + ']'" x-model="features[idx]" placeholder="e.g. Multi-language support"
                               class="w-full px-3 py-2 bg-slate-900 border border-slate-800 rounded-lg text-white text-xs focus:border-blue-500 focus:outline-none">
                        <button type="button" @click="removeFeature(idx)" class="p-2 text-slate-500 hover:text-red-400">
                            <i class="fa-solid fa-trash text-xs"></i>
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <!-- Images -->
        <div class="pt-4 border-t border-slate-800 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Cover image -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Cover Thumbnail Image</label>
                @if($project->cover_image)
                    <div class="mb-3">
                        <img src="{{ $project->cover_image_url }}" class="h-28 rounded-xl object-cover border border-slate-800">
                    </div>
                @endif
                <input type="file" name="cover_image" accept="image/*"
                       class="w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-800 file:text-white file:font-semibold hover:file:bg-slate-700">
            </div>

            <!-- Additional Gallery Screenshots -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Upload Gallery Screenshots (Multiple)</label>
                <input type="file" name="images[]" multiple accept="image/*"
                       class="w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-800 file:text-white file:font-semibold hover:file:bg-slate-700">
                <p class="text-[11px] text-slate-500 mt-2">You can select multiple screenshots to showcase the app screens.</p>
            </div>
        </div>

        <!-- Toggles -->
        <div class="pt-4 border-t border-slate-800 flex flex-wrap gap-6">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                       class="rounded bg-slate-900 border-slate-800 text-blue-600 focus:ring-0">
                <span class="text-sm font-semibold text-white">Highlight as Featured on Home</span>
            </label>

            <label class="flex items-center gap-3 cursor-pointer">
                <input type="hidden" name="published_at" value="">
                <input type="checkbox" name="published_at" value="{{ now() }}" {{ old('published_at', $project->exists ? $project->published_at : now()) ? 'checked' : '' }}
                       class="rounded bg-slate-900 border-slate-800 text-emerald-600 focus:ring-0">
                <span class="text-sm font-semibold text-white">Published (Visible to public)</span>
            </label>
        </div>

        <div class="pt-4 border-t border-slate-800 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25">
                {{ $project->exists ? 'Save Project Changes' : 'Create Project' }}
            </button>
        </div>
    </form>
</div>
@endsection

