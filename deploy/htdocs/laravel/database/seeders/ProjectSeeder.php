<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Project 1
        $project1 = Project::create([
            'title' => 'E-Commerce Platform',
            'slug' => 'e-commerce-platform',
            'description' => 'A full-featured e-commerce platform built with Laravel and React. It includes product management, a shopping cart, payment integration with Stripe, and a comprehensive admin dashboard.',
            'short_description' => 'Full-featured online shop built with Laravel, React, and Stripe.',
            'technologies' => ['Laravel', 'React', 'MySQL', 'Stripe', 'Tailwind CSS'],
            'github_link' => 'https://github.com/example/ecommerce',
            'live_link' => 'https://ecommerce-demo.example.com',
            'cover_image' => 'projects/ecommerce-cover.jpg',
            'is_featured' => true,
            'started_at' => '2026-01-01',
            'finished_at' => '2026-03-15',
        ]);

        $project1->images()->createMany([
            ['image_path' => 'projects/ecommerce-detail-1.jpg'],
            ['image_path' => 'projects/ecommerce-detail-2.jpg'],
        ]);

        // Project 2
        $project2 = Project::create([
            'title' => 'Creative Portfolio Website',
            'slug' => 'creative-portfolio-website',
            'description' => 'A dynamic and modern portfolio website showcasing skills, projects, and contact information. Built using a Laravel API backend and a Next.js frontend.',
            'short_description' => 'Modern responsive portfolio built with Next.js and Laravel API.',
            'technologies' => ['Laravel', 'Next.js', 'PostgreSQL', 'Tailwind CSS', 'Framer Motion'],
            'github_link' => 'https://github.com/example/portfolio',
            'live_link' => 'https://myportfolio-demo.example.com',
            'cover_image' => 'projects/portfolio-cover.jpg',
            'is_featured' => true,
            'started_at' => '2026-04-01',
            'finished_at' => '2026-05-10',
        ]);

        $project2->images()->createMany([
            ['image_path' => 'projects/portfolio-detail-1.jpg'],
        ]);

        // Project 3
        $project3 = Project::create([
            'title' => 'Task Management Board',
            'slug' => 'task-management-board',
            'description' => 'A collaborative task management application similar to Trello, featuring interactive drag-and-drop Kanban boards, workspace division, and real-time socket-based updates.',
            'short_description' => 'Kanban board for team collaboration with real-time updates.',
            'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Pusher', 'Tailwind CSS'],
            'github_link' => 'https://github.com/example/kanban',
            'live_link' => null,
            'cover_image' => 'projects/kanban-cover.jpg',
            'is_featured' => false,
            'started_at' => '2026-06-01',
            'finished_at' => null,
        ]);

        $project3->images()->createMany([
            ['image_path' => 'projects/kanban-detail-1.jpg'],
            ['image_path' => 'projects/kanban-detail-2.jpg'],
        ]);
    }
}
