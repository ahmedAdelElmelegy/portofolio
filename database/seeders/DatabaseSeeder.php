<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectFeature;
use App\Models\ProjectImage;
use App\Models\ProjectTechnology;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\User;
use App\Models\VideoSection;
use App\Models\WorkProcess;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ─────────────────────────────────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@portfolio.test'],
            [
                'name' => 'Ahmed Adel',
                'password' => Hash::make('password'),
            ]
        );

        // ── Profile ────────────────────────────────────────────────────────
        Profile::updateOrCreate(['user_id' => $admin->id], [
            'full_name' => 'Ahmed Adel',
            'role' => 'Flutter Developer',
            'tagline' => 'Flutter Developer & Mobile App Engineer',
            'title' => 'Flutter Developer',
            'bio' => 'A passionate Flutter Developer with expertise in building beautiful, scalable, and high-performance mobile applications. Experienced in clean architecture, state management, REST APIs, and UI/UX design.',
            'email' => 'ahmedadelelmelegy@gmail.com',
            'phone' => null,
            'location' => 'Egypt',
            'avatar' => 'avatars/avatar.png',
            'cv_file' => null,
            'github_url' => 'https://github.com/ahmedAdelElmelegy',
            'linkedin_url' => 'https://linkedin.com/in/ahmed-adel',
            'twitter_url' => null,
            'whatsapp' => null,
            'is_active' => true,
        ]);

        // ── Skills ─────────────────────────────────────────────────────────
        $skills = [
            // Flutter & Dart
            ['name' => 'Flutter', 'category' => 'Mobile', 'level' => 95, 'icon' => 'flutter', 'sort_order' => 1, 'is_featured' => true],
            ['name' => 'Dart', 'category' => 'Mobile', 'level' => 90, 'icon' => 'dart', 'sort_order' => 2, 'is_featured' => true],
            // Architecture
            ['name' => 'MVVM Architecture', 'category' => 'Architecture', 'level' => 85, 'icon' => 'architecture', 'sort_order' => 3, 'is_featured' => true],
            ['name' => 'Clean Architecture', 'category' => 'Architecture', 'level' => 80, 'icon' => 'layers', 'sort_order' => 4, 'is_featured' => false],
            ['name' => 'Cubit / Bloc', 'category' => 'State Management', 'level' => 85, 'icon' => 'bloc', 'sort_order' => 5, 'is_featured' => true],
            ['name' => 'Provider', 'category' => 'State Management', 'level' => 80, 'icon' => 'provider', 'sort_order' => 6, 'is_featured' => false],
            // Backend / APIs
            ['name' => 'REST APIs (Dio)', 'category' => 'Backend', 'level' => 85, 'icon' => 'api', 'sort_order' => 7, 'is_featured' => true],
            ['name' => 'Laravel', 'category' => 'Backend', 'level' => 75, 'icon' => 'laravel', 'sort_order' => 8, 'is_featured' => false],
            // Tools
            ['name' => 'Git & GitHub', 'category' => 'Tools', 'level' => 90, 'icon' => 'github', 'sort_order' => 9, 'is_featured' => false],
            ['name' => 'Figma', 'category' => 'Design', 'level' => 70, 'icon' => 'figma', 'sort_order' => 10, 'is_featured' => false],
            ['name' => 'Google Maps', 'category' => 'Mobile', 'level' => 80, 'icon' => 'maps', 'sort_order' => 11, 'is_featured' => false],
            ['name' => 'Firebase', 'category' => 'Backend', 'level' => 75, 'icon' => 'firebase', 'sort_order' => 12, 'is_featured' => false],
            ['name' => 'Get It (DI)', 'category' => 'Architecture', 'level' => 85, 'icon' => 'di', 'sort_order' => 13, 'is_featured' => false],
            ['name' => 'Push Notifications', 'category' => 'Mobile', 'level' => 75, 'icon' => 'notifications', 'sort_order' => 14, 'is_featured' => false],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill['name']], $skill);
        }

        // ── Experiences ────────────────────────────────────────────────────
        $experiences = [
            [
                'title' => 'Flutter Developer',
                'organization' => 'Freelance',
                'location' => 'Remote',
                'start_date' => '2023-01-01',
                'end_date' => null,
                'is_current' => true,
                'description' => 'Building cross-platform mobile applications for clients using Flutter, clean architecture, and modern state management patterns.',
                'type' => 'work',
                'sort_order' => 1,
            ],
            [
                'title' => 'Bachelor of Computer Science',
                'organization' => 'Egyptian University',
                'location' => 'Egypt',
                'start_date' => '2020-09-01',
                'end_date' => '2024-06-01',
                'is_current' => false,
                'description' => 'Studied computer science fundamentals including algorithms, data structures, software engineering, and mobile development.',
                'type' => 'education',
                'sort_order' => 2,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::updateOrCreate(
                ['title' => $exp['title'], 'organization' => $exp['organization']],
                $exp
            );
        }

        // ── Work Processes ─────────────────────────────────────────────────
        $processes = [
            ['title' => 'Research & Requirement Analysis', 'description' => 'Understanding user needs, defining project scope, and planning app features and data flow.', 'icon' => 'search', 'sort_order' => 1],
            ['title' => 'UI/UX Design', 'description' => 'Designing wireframes, UI components, color systems, and typography using Figma.', 'icon' => 'design_services', 'sort_order' => 2],
            ['title' => 'Project Architecture', 'description' => 'Setting up clean architecture, MVVM pattern, dependency injection, and scalable folder structure.', 'icon' => 'architecture', 'sort_order' => 3],
            ['title' => 'API Integration & Data Handling', 'description' => 'Integrating REST APIs, building data models, handling pagination, caching, and network errors.', 'icon' => 'api', 'sort_order' => 4],
            ['title' => 'Feature Development', 'description' => 'Implementing features, state management, animations, and responsive UI across devices.', 'icon' => 'extension', 'sort_order' => 5],
            ['title' => 'Testing & Optimization', 'description' => 'Testing UI and APIs, handling edge cases, optimizing performance, and preparing for release.', 'icon' => 'bug_report', 'sort_order' => 6],
        ];

        foreach ($processes as $process) {
            WorkProcess::updateOrCreate(['title' => $process['title']], $process);
        }

        // ── Projects ───────────────────────────────────────────────────────
        $projects = [
            [
                'name' => 'Circle',
                'slug' => 'circle',
                'description' => 'A modern e-commerce application that enables users to browse products, manage carts, track orders, and complete secure payments.',
                'short_description' => 'Full-featured e-commerce app with cart, orders, payments, and location tracking.',
                'cover_image' => 'projects/covers/circle.webp',
                'github_url' => 'https://github.com/ahmedAdelElmelegy/circle',
                'app_url' => 'https://drive.google.com/drive/folders/1YXjEpk_U1PD__ukwibCRFM0QAIcBbsxR?usp=drive_link',
                'is_featured' => true,
                'sort_order' => 1,
                'published_at' => now(),
                'technologies' => ['Flutter', 'Dart', 'MVVM Architecture', 'Provider', 'Get It (DI)', 'REST APIs (Dio)', 'Google Maps', 'Payment Integration', 'Multi-Language Support'],
                'features' => ['Product listing & categories', 'Shopping cart management', 'Order tracking', 'Payment processing', 'User authentication & profile', 'Location tracking', 'Multi-language support', 'Clean architecture & scalable code'],
                'gallery_folder' => 'project1',
            ],
            [
                'name' => 'Nurse Bot',
                'slug' => 'nurse-bot',
                'description' => 'An AI-powered application that summarizes books and answers user questions using an intelligent chatbot.',
                'short_description' => 'AI chatbot app with book summarization powered by Gemini API.',
                'cover_image' => 'projects/covers/nurse-bot.webp',
                'github_url' => 'https://github.com/ahmedAdelElmelegy/nurse-bot',
                'app_url' => 'https://github.com/ahmedAdelElmelegy/nurse-bot',
                'is_featured' => true,
                'sort_order' => 2,
                'published_at' => now(),
                'technologies' => ['Flutter', 'Dart', 'Gemini API', 'Provider', 'AI Chat Assistant', 'Book Summarization', 'URL Launcher'],
                'features' => ['Chatbot for Q&A', 'AI-powered book summarization', 'Interactive chatbot for Q&A', 'User-friendly interface', 'Book links', 'Quotes', 'Offline reading support', 'Clean & responsive UI'],
                'gallery_folder' => 'project3',
            ],
            [
                'name' => 'Al Huda',
                'slug' => 'al-huda',
                'description' => 'An Islamic guidance application providing accurate prayer times, Quran access, reminders, and location-based services.',
                'short_description' => 'Islamic app with prayer times, Quran reader, Azkar, and mosque location.',
                'cover_image' => 'projects/covers/al-huda.webp',
                'github_url' => 'https://github.com/ahmedAdelElmelegy/Al-Huda',
                'app_url' => 'https://drive.google.com/drive/folders/1_kftNvH6CxjfBcckoT3TaeMhODjR5wgc?usp=drive_link',
                'is_featured' => true,
                'sort_order' => 3,
                'published_at' => now(),
                'technologies' => ['Flutter', 'Dart', 'MVVM Architecture', 'Cubit / Bloc', 'Get It (DI)', 'REST APIs (Dio)', 'Prayer Times', 'Quran Reader', 'Push Notifications', 'Google Maps', 'Multi-Language Support'],
                'features' => ['Accurate prayer times & alerts', 'Quran reading & audio playback', 'Adjustable Quran font size', 'Quran reader with bookmarks', 'Doaa & supplications', 'Azkar for morning & evening with notifications', 'Digital Sebha (tasbeeh counter)', 'Asmaa Allah al-Husna (99 Names)', 'Mosque location tracking', 'Smart reminders & notifications', 'Multi-language support', 'Offline access for Quran & prayers'],
                'gallery_folder' => 'project2',
            ],
            [
                'name' => 'BMI Tracker',
                'slug' => 'bmi-tracker',
                'description' => 'A lightweight BMI calculator app that calculates body mass index based on user input with a clean UI.',
                'short_description' => 'BMI calculator with real-time calculation, health tips, and responsive design.',
                'cover_image' => 'projects/covers/bmi-tracker.webp',
                'github_url' => 'https://github.com/ahmedAdelElmelegy/Bmi_calculator',
                'app_url' => 'https://drive.google.com/drive/folders/1DGskNTvXAF3rn5iAlbhXPP6_fDmHMcHc?usp=drive_link',
                'is_featured' => false,
                'sort_order' => 4,
                'published_at' => now(),
                'technologies' => ['Flutter', 'Dart', 'MVVM Architecture', 'Cubit / Bloc', 'Responsive UI'],
                'features' => ['Real-time BMI calculation', 'User-friendly interface', 'Responsive design for mobile & tablet', 'Health tips & category guidance', 'MVVM Architecture & maintainable code'],
                'gallery_folder' => 'project4',
            ],
        ];

        foreach ($projects as $data) {
            $techList = $data['technologies'];
            $featureList = $data['features'];
            $galleryFolder = $data['gallery_folder'] ?? null;
            unset($data['technologies'], $data['features'], $data['gallery_folder']);

            $project = Project::updateOrCreate(['slug' => $data['slug']], $data);

            // Seed technologies
            $project->technologies()->delete();
            foreach ($techList as $i => $tech) {
                ProjectTechnology::create([
                    'project_id' => $project->id,
                    'name' => $tech,
                    'sort_order' => $i + 1,
                ]);
            }

            // Seed features
            $project->features()->delete();
            foreach ($featureList as $i => $feature) {
                ProjectFeature::create([
                    'project_id' => $project->id,
                    'description' => $feature,
                    'sort_order' => $i + 1,
                ]);
            }

            // Seed gallery images if directory exists
            if ($galleryFolder) {
                $dir = storage_path('app/public/projects/gallery/'.$galleryFolder);
                if (File::exists($dir)) {
                    $project->images()->delete();
                    $files = File::files($dir);
                    foreach (array_slice($files, 0, 8) as $idx => $f) {
                        ProjectImage::create([
                            'project_id' => $project->id,
                            'image_path' => 'projects/gallery/'.$galleryFolder.'/'.$f->getFilename(),
                            'sort_order' => $idx + 1,
                        ]);
                    }
                }
            }
        }

        // ── Settings ───────────────────────────────────────────────────────
        $settings = [
            'site_name' => 'Ahmed Adel — Flutter Developer',
            'site_tagline' => 'Building beautiful cross-platform apps',
            'seo_description' => 'Personal portfolio of Ahmed Adel, a Flutter Developer specializing in clean architecture, state management, and mobile app development.',
            'copyright_year' => (string) date('Y'),
            'primary_color' => '#3B82F6',
            'accent_color' => '#F59E0B',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        // ── Video Showcase Section ─────────────────────────────────────────
        $videoSection = VideoSection::updateOrCreate(
            ['id' => 1],
            [
                'badge' => 'Interactive Showcase',
                'title' => 'Get To Know Me & Connect',
                'subtitle' => 'Watch this short interactive presentation highlighting who I am, my contact channels, and professional profiles.',
                'video_path' => 'videos/intro.mp4',
                'cover_image' => null,
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        $videoItems = [
            [
                'title' => 'Email Address',
                'value' => 'ahmedadelelmelegy2@gmail.com',
                'url' => 'mailto:ahmedadelelmelegy2@gmail.com',
                'icon' => 'fa-solid fa-envelope',
                'badge' => 'Direct Contact',
                'sort_order' => 1,
            ],
            [
                'title' => 'LinkedIn Profile',
                'value' => 'ahmed-adel-110467373',
                'url' => 'https://www.linkedin.com/in/ahmed-adel-110467373',
                'icon' => 'fa-brands fa-linkedin',
                'badge' => 'Professional',
                'sort_order' => 2,
            ],
            [
                'title' => 'GitHub Portfolio',
                'value' => 'ahmedAdelElmelegy',
                'url' => 'https://github.com/ahmedAdelElmelegy',
                'icon' => 'fa-brands fa-github',
                'badge' => 'Open Source',
                'sort_order' => 3,
            ],
            [
                'title' => 'Flutter & Mobile Engineering',
                'value' => 'Clean Architecture & Scalable Apps',
                'url' => '#projects',
                'icon' => 'fa-solid fa-mobile-screen-button',
                'badge' => 'Specialization',
                'sort_order' => 4,
            ],
        ];

        $videoSection->items()->delete();
        foreach ($videoItems as $item) {
            $videoSection->items()->create($item);
        }
    }
}
