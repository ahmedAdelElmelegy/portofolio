<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        $educations = [
            [
                'institution' => 'University of Computer Science',
                'degree' => 'Bachelor of Science',
                'field' => 'Computer Science and Information Systems',
                'start_date' => '2018-09-15',
                'end_date' => '2022-06-30',
            ],
            [
                'institution' => 'Online Tech Institute',
                'degree' => 'Advanced Certificate',
                'field' => 'Full-Stack Web Development Bootcamp',
                'start_date' => '2022-07-01',
                'end_date' => '2022-10-15',
            ],
        ];

        foreach ($educations as $education) {
            Education::create($education);
        }
    }
}
