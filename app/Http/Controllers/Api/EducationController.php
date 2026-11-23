<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Http\Resources\EducationResource;
use App\Models\Education;
use App\Traits\ApiResponse;

class EducationController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $education = Education::latest()->get();

        return $this->successResponse(
            EducationResource::collection($education),
            'education fetched successfully',
            200
        );
    }

    public function store(StoreEducationRequest $request)
    {
        $edu = Education::create($request->validated());

        return $this->successResponse(
            new EducationResource($edu),
            'education created successfully',
            201
        );
    }

    public function show(Education $education)
    {
        return $this->successResponse(
            new EducationResource($education),
            'education fetched successfully',
            200
        );
    }

    public function update(UpdateEducationRequest $request, Education $education)
    {
        $education->update($request->validated());

        return $this->successResponse(
            new EducationResource($education),
            'education updated successfully',
            200
        );
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return $this->successResponse(
            null,
            'education deleted successfully',
            200
        );
    }
}
