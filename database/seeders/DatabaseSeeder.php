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

        // ── Profile (Matched to Flutter AAA project) ───────────────────────
        Profile::updateOrCreate(['user_id' => $admin->id], [
            'full_name' => 'Ahmed Adel',
            'role' => 'Flutter Developer',
            'tagline' => 'Mobile App Engineer & Clean Architecture Enthusiast',
            'title' => 'Flutter Developer',
            'bio' => 'I am a dedicated Flutter developer with hands-on experience in building mobile apps, integrating APIs, managing Firebase services, and applying clean architecture principles. I learn rapidly, adapt to new challenges, and focus on writing maintainable, scalable code. I enjoy collaborating with teams and transforming ideas into polished user-friendly applications.',
            'email' => 'ahmedadelelmelegy2@gmail.com',
            'phone' => '01069371116',
            'location' => 'Shebin El-Kom, Menoufia, Egypt',
            'avatar' => 'avatars/avatar.png',
            'cv_file' => null,
            'github_url' => 'https://github.com/ahmedAdelElmelegy',
            'linkedin_url' => 'https://www.linkedin.com/in/ahmed-adel-110467373',
            'twitter_url' => null,
            'whatsapp' => '01069371116',
            'is_active' => true,
        ]);

        // ── Skills (Matched to Flutter AAA skill_section.dart) ─────────────
        Skill::truncate();
        $skills = [
            // 1. Frameworks & Architecture
            ['name' => 'Clean Architecture', 'category' => 'Frameworks & Architecture', 'level' => 90, 'icon' => 'layers', 'sort_order' => 1, 'is_featured' => true],
            ['name' => 'MVVM', 'category' => 'Frameworks & Architecture', 'level' => 90, 'icon' => 'architecture', 'sort_order' => 2, 'is_featured' => true],
            ['name' => 'MVC', 'category' => 'Frameworks & Architecture', 'level' => 85, 'icon' => 'diagram-project', 'sort_order' => 3, 'is_featured' => false],

            // 2. Mobile Development
            ['name' => 'Flutter Apps', 'category' => 'Mobile Development', 'level' => 95, 'icon' => 'flutter', 'sort_order' => 4, 'is_featured' => true],
            ['name' => 'Responsive & Adaptive Design', 'category' => 'Mobile Development', 'level' => 90, 'icon' => 'mobile-screen-button', 'sort_order' => 5, 'is_featured' => true],
            ['name' => 'Bloc', 'category' => 'Mobile Development', 'level' => 90, 'icon' => 'cubes', 'sort_order' => 6, 'is_featured' => true],
            ['name' => 'Cubit', 'category' => 'Mobile Development', 'level' => 90, 'icon' => 'cube', 'sort_order' => 7, 'is_featured' => true],
            ['name' => 'GetX', 'category' => 'Mobile Development', 'level' => 85, 'icon' => 'bolt', 'sort_order' => 8, 'is_featured' => false],
            ['name' => 'Provider', 'category' => 'Mobile Development', 'level' => 85, 'icon' => 'share-nodes', 'sort_order' => 9, 'is_featured' => false],

            // 3. API & Backend Integration
            ['name' => 'REST APIs (Dio & Http)', 'category' => 'API & Backend Integration', 'level' => 90, 'icon' => 'network-wired', 'sort_order' => 10, 'is_featured' => true],
            ['name' => 'Firebase Authentication', 'category' => 'API & Backend Integration', 'level' => 85, 'icon' => 'fire', 'sort_order' => 11, 'is_featured' => false],
            ['name' => 'Cloud Firestore', 'category' => 'API & Backend Integration', 'level' => 85, 'icon' => 'database', 'sort_order' => 12, 'is_featured' => false],
            ['name' => 'Local Storage (Hive, SharedPreferences, Sqflite)', 'category' => 'API & Backend Integration', 'level' => 88, 'icon' => 'hard-drive', 'sort_order' => 13, 'is_featured' => false],
            ['name' => 'Postman', 'category' => 'API & Backend Integration', 'level' => 85, 'icon' => 'paper-plane', 'sort_order' => 14, 'is_featured' => false],

            // 4. Hardware & Device Features
            ['name' => 'Google Maps', 'category' => 'Hardware & Device Features', 'level' => 85, 'icon' => 'map-location-dot', 'sort_order' => 15, 'is_featured' => false],
            ['name' => 'Location Services', 'category' => 'Hardware & Device Features', 'level' => 85, 'icon' => 'location-crosshairs', 'sort_order' => 16, 'is_featured' => false],
            ['name' => 'Push Notifications (FCM)', 'category' => 'Hardware & Device Features', 'level' => 85, 'icon' => 'bell', 'sort_order' => 17, 'is_featured' => false],

            // 5. Tools & Platforms
            ['name' => 'Visual Studio Code', 'category' => 'Tools & Platforms', 'level' => 95, 'icon' => 'code', 'sort_order' => 18, 'is_featured' => false],
            ['name' => 'Android Studio', 'category' => 'Tools & Platforms', 'level' => 90, 'icon' => 'android', 'sort_order' => 19, 'is_featured' => false],
            ['name' => 'Git', 'category' => 'Tools & Platforms', 'level' => 90, 'icon' => 'code-branch', 'sort_order' => 20, 'is_featured' => false],
            ['name' => 'GitHub', 'category' => 'Tools & Platforms', 'level' => 90, 'icon' => 'github', 'sort_order' => 21, 'is_featured' => true],

            // 6. Programming Languages
            ['name' => 'Dart', 'category' => 'Programming Languages', 'level' => 95, 'icon' => 'terminal', 'sort_order' => 22, 'is_featured' => true],
            ['name' => 'Java', 'category' => 'Programming Languages', 'level' => 80, 'icon' => 'java', 'sort_order' => 23, 'is_featured' => false],
            ['name' => 'C++', 'category' => 'Programming Languages', 'level' => 75, 'icon' => 'microchip', 'sort_order' => 24, 'is_featured' => false],
            ['name' => 'Python', 'category' => 'Programming Languages', 'level' => 70, 'icon' => 'python', 'sort_order' => 25, 'is_featured' => false],

            // 7. Payment Integration
            ['name' => 'Stripe Payment', 'category' => 'Payment Integration', 'level' => 85, 'icon' => 'credit-card', 'sort_order' => 26, 'is_featured' => true],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // ── Experiences & Education (Matched to Flutter AAA) ───────────────
        Experience::truncate();
        $experiences = [
            // Education
            [
                'title' => 'Faculty of Electronic Engineering',
                'organization' => 'Menoufia University',
                'location' => 'Menoufia, Egypt',
                'start_date' => '2020-09-01',
                'end_date' => '2025-06-30',
                'is_current' => false,
                'description' => 'Studying Electronic & Computer Engineering with emphasis on algorithms, data structures, mobile computing, and software engineering.',
                'type' => 'education',
                'sort_order' => 1,
            ],
            // Work Experiences / Internships
            [
                'title' => 'Flutter Development Intern',
                'organization' => 'Acme Integrated Engineering System (IES)',
                'location' => 'Cairo, Egypt',
                'start_date' => '2025-09-01',
                'end_date' => '2025-11-30',
                'is_current' => false,
                'description' => 'Developed production-grade Flutter features, handled REST API integration, state management, and applied clean architecture standards.',
                'type' => 'work',
                'sort_order' => 1,
            ],
            [
                'title' => 'Flutter Development Intern',
                'organization' => 'PureSoft',
                'location' => 'Shebin El-Kom, Egypt',
                'start_date' => '2025-08-01',
                'end_date' => '2025-09-30',
                'is_current' => false,
                'description' => 'Contributed to building cross-platform Flutter applications, responsive UI implementations, local caching, and bug fixing.',
                'type' => 'work',
                'sort_order' => 2,
            ],
            [
                'title' => 'UI/UX Training Program',
                'organization' => 'Information Technology Institute (ITI)',
                'location' => 'Shebin El-Kom, Egypt',
                'start_date' => '2024-07-01',
                'end_date' => '2024-08-31',
                'is_current' => false,
                'description' => 'Intensive professional training in user experience research, wireframing, interactive prototyping, and design systems using Figma.',
                'type' => 'work',
                'sort_order' => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::create($exp);
        }

        // ── Work Processes (Matched to Flutter AAA app_constants.dart) ─────
        WorkProcess::truncate();
        $processes = [
            ['title' => 'Research & Requirement Analysis', 'description' => 'Understanding user needs, defining project scope, and planning app features and data flow.', 'icon' => 'search', 'sort_order' => 1],
            ['title' => 'UI/UX Design', 'description' => 'Designing wireframes, UI components, color systems, and typography using Figma.', 'icon' => 'design_services', 'sort_order' => 2],
            ['title' => 'Project Architecture', 'description' => 'Setting up clean architecture, MVVM pattern, dependency injection, and scalable folder structure.', 'icon' => 'architecture', 'sort_order' => 3],
            ['title' => 'API Integration & Data Handling', 'description' => 'Integrating REST APIs, building data models, handling pagination, caching, and network errors.', 'icon' => 'api', 'sort_order' => 4],
            ['title' => 'Feature Development', 'description' => 'Implementing features, state management, animations, and responsive UI across devices.', 'icon' => 'extension', 'sort_order' => 5],
            ['title' => 'Testing & Optimization', 'description' => 'Testing UI and APIs, handling edge cases, optimizing performance, and preparing for release.', 'icon' => 'bug_report', 'sort_order' => 6],
        ];

        foreach ($processes as $process) {
            WorkProcess::create($process);
        }

        // ── Projects (Matched to Flutter AAA project_model.dart) ───────────
        // Clean out any dummy projects
        Project::whereNotIn('slug', ['circle', 'nurse-bot', 'al-huda', 'bmi-tracker'])->delete();

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
                'title' => 'Phone & WhatsApp',
                'value' => '+201069371116',
                'url' => 'https://wa.me/201069371116',
                'icon' => 'fa-brands fa-whatsapp',
                'badge' => 'Call & Chat',
                'sort_order' => 4,
            ],
        ];

        $videoSection->items()->delete();
        foreach ($videoItems as $item) {
            $videoSection->items()->create($item);
        }
    }
}
