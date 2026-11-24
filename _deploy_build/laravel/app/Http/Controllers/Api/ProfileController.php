<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $profiles = Profile::latest()->get();

        return $this->successResponse(
            ProfileResource::collection($profiles),
            'profiles fetched successfully',
            200
        );
    }

    public function store(StoreProfileRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('profiles', 'public');
        }

        if ($request->hasFile('cv_file')) {
            $data['cv_file'] = $request->file('cv_file')->store('profiles', 'public');
        }

        $profile = Profile::create($data);

        return $this->successResponse(
            new ProfileResource($profile),
            'profile created successfully',
            201
        );
    }

    public function show(Profile $profile)
    {
        return $this->successResponse(
            new ProfileResource($profile),
            'profile fetched successfully',
            200
        );
    }

    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('profiles', 'public');
        }

        if ($request->hasFile('cv_file')) {
            if ($profile->cv_file) {
                Storage::disk('public')->delete($profile->cv_file);
            }
            $data['cv_file'] = $request->file('cv_file')->store('profiles', 'public');
        }

        $profile->update($data);

        return $this->successResponse(
            new ProfileResource($profile),
            'profile updated successfully',
            200
        );
    }

    public function destroy(Profile $profile)
    {
        if ($profile->avatar) {
            Storage::disk('public')->delete($profile->avatar);
        }

        if ($profile->cv_file) {
            Storage::disk('public')->delete($profile->cv_file);
        }

        $profile->delete();

        return $this->successResponse(
            null,
            'profile deleted successfully',
            200
        );
    }
}
