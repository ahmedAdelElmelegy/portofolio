<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if ($user) {
            Profile::create([
                'user_id' => $user->id,
                'full_name' => 'John Doe',
                'title' => 'Senior Full Stack Developer',
                'bio' => 'Passionate software engineer with 5+ years of experience in building modern web applications using Laravel, React, and Vue.js.',
                'email' => $user->email,
                'phone' => '+1234567890',
                'location' => 'Cairo, Egypt',
                'avatar' => 'profiles/avatar.png',
                'cv_file' => 'profiles/cv.pdf',
            ]);
        }
    }
}
