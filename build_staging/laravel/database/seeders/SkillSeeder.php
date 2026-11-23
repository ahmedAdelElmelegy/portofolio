<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            [
                'name' => 'Laravel',
                'category' => 'Backend',
                'level' => 90,
                'icon' => 'laravel-icon',
            ],
            [
                'name' => 'PHP',
                'category' => 'Backend',
                'level' => 95,
                'icon' => 'php-icon',
            ],
            [
                'name' => 'React',
                'category' => 'Frontend',
                'level' => 80,
                'icon' => 'react-icon',
            ],
            [
                'name' => 'MySQL',
                'category' => 'Database',
                'level' => 85,
                'icon' => 'mysql-icon',
            ],
            [
                'name' => 'Flutter',
                'category' => 'Mobile',
                'level' => 75,
                'icon' => 'flutter-icon',
            ],
            [
                'name' => 'Git & GitHub',
                'category' => 'Tools',
                'level' => 90,
                'icon' => 'git-icon',
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
