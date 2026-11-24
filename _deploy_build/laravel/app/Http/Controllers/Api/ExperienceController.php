<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
use App\Traits\ApiResponse;

class ExperienceController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $experiences = Experience::latest()->get();

        return $this->successResponse(
            ExperienceResource::collection($experiences),
            'experiences fetched successfully',
            200
        );
    }

    public function store(StoreExperienceRequest $request)
    {
        $experience = Experience::create($request->validated());

        return $this->successResponse(
            new ExperienceResource($experience),
            'experience created successfully',
            201
        );
    }

    public function show(Experience $experience)
    {
        return $this->successResponse(
            new ExperienceResource($experience),
            'experience fetched successfully',
            200
        );
    }

    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->validated());

        return $this->successResponse(
            new ExperienceResource($experience),
            'experience updated successfully',
            200
        );
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return $this->successResponse(
            null,
            'experience deleted successfully',
            200
        );
    }
}
