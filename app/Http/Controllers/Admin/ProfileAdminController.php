<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileAdminController extends Controller
{
    public function edit()
    {
        $profile = Profile::where('is_active', true)->first()
            ?? Profile::first()
            ?? Profile::create([
                'user_id' => Auth::id() ?? 1,
                'full_name' => Auth::user()?->name ?? 'Ahmed Adel',
                'email' => Auth::user()?->email ?? 'admin@portfolio.test',
                'role' => 'Flutter Developer',
                'bio' => 'Flutter Developer',
                'is_active' => true,
            ]);

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $profile = Profile::where('is_active', true)->first()
            ?? Profile::first()
            ?? new Profile;

        $data = $request->validated();
        $data['is_active'] = true;
        if (! $profile->exists) {
            $data['user_id'] = Auth::id() ?? 1;
        }

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('cv_file')) {
            if ($profile->cv_file) {
                Storage::disk('public')->delete($profile->cv_file);
            }
            $data['cv_file'] = $request->file('cv_file')->store('cv', 'public');
        }

        $profile->fill($data)->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
