<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use App\Traits\ApiResponse;

class SkillController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $skills = Skill::latest()->get();

        return $this->successResponse(
            SkillResource::collection($skills),
            'skills fetched successfully',
            200
        );
    }

    public function store(StoreSkillRequest $request)
    {
        $skill = Skill::create($request->validated());

        return $this->successResponse(
            new SkillResource($skill),
            'skill created successfully',
            201
        );
    }

    public function show(Skill $skill)
    {
        return $this->successResponse(
            new SkillResource($skill),
            'skill fetched successfully',
            200
        );
    }

    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        $skill->update($request->validated());

        return $this->successResponse(
            new SkillResource($skill),
            'skill updated successfully',
            200
        );
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return $this->successResponse(
            null,
            'skill deleted successfully',
            200
        );
    }
}
