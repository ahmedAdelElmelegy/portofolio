<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Models\Project;
use App\Models\ProjectFeature;
use App\Models\ProjectImage;
use App\Models\ProjectTechnology;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectAdminController extends Controller
{
    public function index()
    {
        $projects = Project::withCount(['images', 'technologies', 'features'])
            ->ordered()
            ->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.form', ['project' => new Project]);
    }

    public function store(StoreProjectRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $data['slug'] = Str::slug($data['name']) ?: ('project-' . time());
            $data['published_at'] = $data['published_at'] ?? now();

            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
            }

            $project = Project::create($data);

            $this->syncTechnologies($project, $request->input('technologies', []));
            $this->syncFeatures($project, $request->input('features', []), $request->input('features_ar', []));
            $this->storeImages($project, $request->file('images', []));
        });

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load(['images', 'technologies', 'features']);

        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $project->load(['images', 'technologies', 'features']);

        return view('admin.projects.form', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        DB::transaction(function () use ($request, $project) {
            $data = $request->validated();
            if (empty($project->published_at) && empty($data['published_at'])) {
                $data['published_at'] = now();
            }

            if ($request->hasFile('cover_image')) {
                Storage::disk('public')->delete($project->cover_image ?? '');
                $data['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
            }

            $project->update($data);

            $this->syncTechnologies($project, $request->input('technologies', []));
            $this->syncFeatures($project, $request->input('features', []), $request->input('features_ar', []));
            $this->storeImages($project, $request->file('images', []));
        });

        return redirect()->route('admin.projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        $project->delete(); // booted() handles file cleanup

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }

    public function destroyImage(Project $project, ProjectImage $image)
    {
        abort_unless($image->project_id === $project->id, 403);
        $image->delete(); // booted() deletes file

        return back()->with('success', 'Image removed.');
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function syncTechnologies(Project $project, array $names): void
    {
        $project->technologies()->delete();
        foreach (array_filter($names) as $i => $name) {
            ProjectTechnology::create(['project_id' => $project->id, 'name' => trim($name), 'sort_order' => $i + 1]);
        }
    }

    private function syncFeatures(Project $project, array $descriptions, array $descriptionsAr = []): void
    {
        $project->features()->delete();
        foreach (array_filter($descriptions) as $i => $desc) {
            ProjectFeature::create([
                'project_id' => $project->id,
                'description' => trim($desc),
                'description_ar' => !empty($descriptionsAr[$i]) ? trim($descriptionsAr[$i]) : null,
                'sort_order' => $i + 1,
            ]);
        }
    }

    private function storeImages(Project $project, array $files): void
    {
        $offset = $project->images()->max('sort_order') ?? 0;
        foreach ($files as $i => $file) {
            $path = $file->store('projects/gallery', 'public');
            ProjectImage::create(['project_id' => $project->id, 'image_path' => $path, 'sort_order' => $offset + $i + 1]);
        }
    }
}
