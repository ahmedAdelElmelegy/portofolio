<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'company' => 'Tech Solutions Corp',
                'position' => 'Senior Backend Developer',
                'description' => 'Led a team of 4 developers to build high-performance APIs using Laravel. Integrated third-party APIs and payment processors like Stripe and PayPal. Optimized database queries which reduced load times by 40%.',
                'start_date' => '2024-06-01',
                'end_date' => null, // Ongoing
            ],
            [
                'company' => 'Creative Web Agency',
                'position' => 'Full Stack Developer',
                'description' => 'Developed and maintained robust client websites using Laravel, Vue.js, and MySQL. Collaborated with designers to convert Figma designs into pixel-perfect responsive user interfaces.',
                'start_date' => '2022-03-15',
                'end_date' => '2024-05-30',
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }
    }
}
