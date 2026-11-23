<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Traits\ApiResponse;

class ProjectController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $projects = Project::with(['images', 'technologies', 'features'])
            ->published()
            ->ordered()
            ->get();

        return $this->successResponse(
            ProjectResource::collection($projects),
            'projects fetched successfully',
            200
        );
    }

    public function show(Project $project)
    {
        $project->load(['images', 'technologies', 'features']);

        return $this->successResponse(
            new ProjectResource($project),
            'project fetched successfully',
            200
        );
    }
}
