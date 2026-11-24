-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 نوفمبر 2026 الساعة 21:52
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- بنية الجدول `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'Project Collaboration Offer', 'Hello, I loved your portfolio! We have a freelance project and would love to collaborate with you. Let me know your availability for a quick call next week.', '2026-11-23 11:57:29', '2026-08-17 17:28:42', '2026-11-23 11:57:29'),
(2, 'Sarah Smith', 'sarah.s@example.com', 'Inquiry about Mobile Dev', 'Hi, do you build cross-platform mobile apps using Flutter? I saw it on your skills list and have an app idea.', NULL, '2026-08-17 17:28:42', '2026-08-17 17:28:42');

-- --------------------------------------------------------

--
-- بنية الجدول `experiences`
--

CREATE TABLE `experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `is_current` tinyint(1) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'work',
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `experiences`
--

INSERT INTO `experiences` (`id`, `title`, `organization`, `location`, `start_date`, `end_date`, `is_current`, `description`, `type`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Faculty of Electronic Engineering', 'Menoufia University', 'Menoufia, Egypt', '2020-09-01', '2025-06-30', 0, 'Studying Electronic & Computer Engineering with emphasis on algorithms, data structures, mobile computing, and software engineering.', 'education', 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(2, 'Flutter Development Intern', 'Acme Integrated Engineering System (IES)', 'Cairo, Egypt', '2025-09-01', '2025-11-30', 0, 'Developed production-grade Flutter features, handled REST API integration, state management, and applied clean architecture standards.', 'work', 2, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(3, 'Flutter Development Intern', 'PureSoft', 'Shebin El-Kom, Egypt', '2025-08-01', '2025-09-30', 0, 'Contributed to building cross-platform Flutter applications, responsive UI implementations, local caching, and bug fixing.', 'work', 3, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(4, 'UI/UX Training Program', 'Information Technology Institute (ITI)', 'Shebin El-Kom, Egypt', '2024-07-01', '2024-08-31', 0, 'Intensive professional training in user experience research, wireframing, interactive prototyping, and design systems using Figma.', 'work', 4, '2026-11-23 10:53:03', '2026-11-24 10:35:00');

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_29_004547_create_personal_access_tokens_table', 1),
(5, '2026_08_17_111358_create_profiles_table', 1),
(6, '2026_08_17_111552_create_skills_table', 1),
(7, '2026_08_17_111641_create_projects_table', 1),
(8, '2026_08_17_111723_create_project_images_table', 1),
(9, '2026_08_17_111743_create_education_table', 1),
(10, '2026_08_17_111743_create_experiences_table', 1),
(11, '2026_08_17_111819_create_contact_messages_table', 1),
(12, '2026_11_23_000001_update_profiles_table', 2),
(13, '2026_11_23_000002_update_skills_table', 2),
(14, '2026_11_23_000003_recreate_projects_table', 2),
(15, '2026_11_23_000004_create_project_technologies_table', 2),
(16, '2026_11_23_000005_create_project_features_table', 2),
(17, '2026_11_23_000006_recreate_experiences_table', 2),
(18, '2026_11_23_000007_create_work_processes_table', 2),
(19, '2026_11_23_000008_create_settings_table', 2),
(20, '2026_11_23_000009_update_contact_messages_table', 2),
(21, '2026_11_23_140213_create_video_sections_and_items_tables', 3);

-- --------------------------------------------------------

--
-- بنية الجدول `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'admin-token', '90a4574ed49753783711915c390bf2a1b0a423750b9175aa0890ebcca0f97d1b', '[\"*\"]', NULL, NULL, '2026-08-17 17:31:03', '2026-08-17 17:31:03'),
(2, 'App\\Models\\User', 1, 'admin-token', '0e5009debdcc44a1a8ebc1161ee24f4c0b4bbada79c7fbc03d0af8e2aff73332', '[\"*\"]', NULL, NULL, '2026-08-17 17:31:20', '2026-08-17 17:31:20'),
(3, 'App\\Models\\User', 1, 'admin-token', '8ea3acdfbd142be196348bd92d706da239d679bee4d8df03e027709fa1ac5cf7', '[\"*\"]', NULL, NULL, '2026-08-17 17:40:23', '2026-08-17 17:40:23');

-- --------------------------------------------------------

--
-- بنية الجدول `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `cv_file` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `full_name`, `role`, `tagline`, `title`, `bio`, `email`, `phone`, `location`, `avatar`, `cv_file`, `github_url`, `linkedin_url`, `twitter_url`, `whatsapp`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'Ahmed Adel', 'Flutter Developer', 'Mobile App Engineer & Clean Architecture Enthusiast', 'Flutter Developer', 'I am a dedicated Flutter developer with hands-on experience in building mobile apps, integrating APIs, managing Firebase services, and applying clean architecture principles. I learn rapidly, adapt to new challenges, and focus on writing maintainable, scalable code. I enjoy collaborating with teams and transforming ideas into polished user-friendly applications.', 'ahmedadelelmelegy2@gmail.com', '01069371116', 'Shebin El-Kom, Menoufia, Egypt', 'avatars/avatar.png', NULL, 'https://github.com/ahmedAdelElmelegy', 'https://www.linkedin.com/in/ahmed-adel-110467373', NULL, '01069371116', 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00');

-- --------------------------------------------------------

--
-- بنية الجدول `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `short_description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `app_url` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `projects`
--

INSERT INTO `projects` (`id`, `name`, `slug`, `description`, `short_description`, `cover_image`, `github_url`, `app_url`, `is_featured`, `sort_order`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Circle', 'circle', 'A modern e-commerce application that enables users to browse products, manage carts, track orders, and complete secure payments.', 'Full-featured e-commerce app with cart, orders, payments, and location tracking.', 'projects/covers/circle.webp', 'https://github.com/ahmedAdelElmelegy/circle', 'https://drive.google.com/drive/folders/1YXjEpk_U1PD__ukwibCRFM0QAIcBbsxR?usp=drive_link', 1, 1, '2026-11-23 12:16:11', '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(2, 'Nurse Bot', 'nurse-bot', 'An AI-powered application that summarizes books and answers user questions using an intelligent chatbot.', 'AI chatbot app with book summarization powered by Gemini API.', 'projects/covers/nurse-bot.webp', 'https://github.com/ahmedAdelElmelegy/nurse-bot', 'https://github.com/ahmedAdelElmelegy/nurse-bot', 1, 2, '2026-11-23 12:16:11', '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(3, 'Al Huda', 'al-huda', 'An Islamic guidance application providing accurate prayer times, Quran access, reminders, and location-based services.', 'Islamic app with prayer times, Quran reader, Azkar, and mosque location.', 'projects/covers/al-huda.webp', 'https://github.com/ahmedAdelElmelegy/Al-Huda', 'https://drive.google.com/drive/folders/1_kftNvH6CxjfBcckoT3TaeMhODjR5wgc?usp=drive_link', 1, 3, '2026-11-23 12:16:11', '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(4, 'BMI Tracker', 'bmi-tracker', 'A lightweight BMI calculator app that calculates body mass index based on user input with a clean UI.', 'BMI calculator with real-time calculation, health tips, and responsive design.', 'projects/covers/bmi-tracker.webp', 'https://github.com/ahmedAdelElmelegy/Bmi_calculator', 'https://drive.google.com/drive/folders/1DGskNTvXAF3rn5iAlbhXPP6_fDmHMcHc?usp=drive_link', 0, 4, '2026-11-23 12:16:11', '2026-11-23 10:53:03', '2026-11-24 10:35:00');

-- --------------------------------------------------------

--
-- بنية الجدول `project_features`
--

CREATE TABLE `project_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `project_features`
--

INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(34, 5, 'Clean architecture & scalable code', 1, '2026-11-23 11:01:17', '2026-11-23 11:01:17'),
(51, 1, 'Product listing & categories', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(52, 1, 'Shopping cart management', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(53, 1, 'Order tracking', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(54, 1, 'Payment processing', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(55, 1, 'User authentication & profile', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(56, 1, 'Location tracking', 6, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(57, 1, 'Multi-language support', 7, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(58, 1, 'Clean architecture & scalable code', 8, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(59, 2, 'Chatbot for Q&A', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(60, 2, 'AI-powered book summarization', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(61, 2, 'Interactive chatbot for Q&A', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(62, 2, 'User-friendly interface', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(63, 2, 'Book links', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(64, 2, 'Quotes', 6, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(65, 2, 'Offline reading support', 7, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(66, 2, 'Clean & responsive UI', 8, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(67, 3, 'Accurate prayer times & alerts', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(68, 3, 'Quran reading & audio playback', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(69, 3, 'Adjustable Quran font size', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(70, 3, 'Quran reader with bookmarks', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(71, 3, 'Doaa & supplications', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(72, 3, 'Azkar for morning & evening with notifications', 6, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(73, 3, 'Digital Sebha (tasbeeh counter)', 7, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(74, 3, 'Asmaa Allah al-Husna (99 Names)', 8, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(75, 3, 'Mosque location tracking', 9, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(76, 3, 'Smart reminders & notifications', 10, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(77, 3, 'Multi-language support', 11, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(78, 3, 'Offline access for Quran & prayers', 12, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(79, 4, 'Real-time BMI calculation', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(80, 4, 'User-friendly interface', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(81, 4, 'Responsive design for mobile & tablet', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(82, 4, 'Health tips & category guidance', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(83, 4, 'MVVM Architecture & maintainable code', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11');

-- --------------------------------------------------------

--
-- بنية الجدول `project_images`
--

CREATE TABLE `project_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `project_images`
--

INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES
(25, 1, 'projects/gallery/project1/project11.webp', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(26, 1, 'projects/gallery/project1/project12.webp', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(27, 1, 'projects/gallery/project1/project13.webp', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(28, 1, 'projects/gallery/project1/project14.webp', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(29, 1, 'projects/gallery/project1/project15.webp', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(30, 1, 'projects/gallery/project1/project16.webp', 6, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(31, 1, 'projects/gallery/project1/project17.webp', 7, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(32, 1, 'projects/gallery/project1/project18.webp', 8, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(33, 2, 'projects/gallery/project3/project31.webp', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(34, 2, 'projects/gallery/project3/project32.webp', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(35, 2, 'projects/gallery/project3/project33.webp', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(36, 2, 'projects/gallery/project3/project34.webp', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(37, 2, 'projects/gallery/project3/project35.webp', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(38, 2, 'projects/gallery/project3/project36.webp', 6, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(39, 3, 'projects/gallery/project2/21.webp', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(40, 3, 'projects/gallery/project2/22.webp', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(41, 3, 'projects/gallery/project2/23.webp', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(42, 3, 'projects/gallery/project2/24.webp', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(43, 3, 'projects/gallery/project2/25.webp', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(44, 3, 'projects/gallery/project2/26.webp', 6, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(45, 3, 'projects/gallery/project2/27.webp', 7, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(46, 3, 'projects/gallery/project2/28.webp', 8, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(47, 4, 'projects/gallery/project4/project41.webp', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(48, 4, 'projects/gallery/project4/project42.webp', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11');

-- --------------------------------------------------------

--
-- بنية الجدول `project_technologies`
--

CREATE TABLE `project_technologies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `project_technologies`
--

INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES
(33, 5, 'Flutter', 1, '2026-11-23 11:01:17', '2026-11-23 11:01:17'),
(34, 5, 'Dart', 2, '2026-11-23 11:01:17', '2026-11-23 11:01:17'),
(53, 1, 'Flutter', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(54, 1, 'Dart', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(55, 1, 'MVVM Architecture', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(56, 1, 'Provider', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(57, 1, 'Get It (DI)', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(58, 1, 'REST APIs (Dio)', 6, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(59, 1, 'Google Maps', 7, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(60, 1, 'Payment Integration', 8, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(61, 1, 'Multi-Language Support', 9, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(62, 2, 'Flutter', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(63, 2, 'Dart', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(64, 2, 'Gemini API', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(65, 2, 'Provider', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(66, 2, 'AI Chat Assistant', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(67, 2, 'Book Summarization', 6, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(68, 2, 'URL Launcher', 7, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(69, 3, 'Flutter', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(70, 3, 'Dart', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(71, 3, 'MVVM Architecture', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(72, 3, 'Cubit / Bloc', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(73, 3, 'Get It (DI)', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(74, 3, 'REST APIs (Dio)', 6, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(75, 3, 'Prayer Times', 7, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(76, 3, 'Quran Reader', 8, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(77, 3, 'Push Notifications', 9, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(78, 3, 'Google Maps', 10, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(79, 3, 'Multi-Language Support', 11, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(80, 4, 'Flutter', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(81, 4, 'Dart', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(82, 4, 'MVVM Architecture', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(83, 4, 'Cubit / Bloc', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(84, 4, 'Responsive UI', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11');

-- --------------------------------------------------------

--
-- بنية الجدول `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7FtVc9faOm3SYzmzryUcGShAfdluehLYUNi9JkLc', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUUJJMHUxNGU3cWtjSDZ6b0JtTGl1TDJOSm9vYlNGYVdkUkdGdVNRciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1795439113),
('HuA2BcmUHIHzqW0PqrHXsi7Y7Kk3EBm6oQeabxph', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFNRYjFKQUl2RVJjSnJMUG1PWVFqSHJZT1BoaVFERTJWc2FXWDg2NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1795438156),
('MF3oyNXncd5V0BcBVYuRNsWNBLxJDnxBrkxt2qOD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/158.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFZYYmNpQ3NFNmtWU3BTSnUwbEptNkNwZUdrZlJmZWhSVnppb2dMRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1795444355),
('p1tNnzSXbf9pyKPQS9WruuUVbSrU8mACkPE5Ufry', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/158.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZWlSUDJ3UlYzWGxnajVOalNVT214SnZTaWFRbHI4TktkOVN5aDhzZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi92aWRlby1zZWN0aW9uIjtzOjU6InJvdXRlIjtzOjI0OiJhZG1pbi52aWRlby1zZWN0aW9uLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1795445142);

-- --------------------------------------------------------

--
-- بنية الجدول `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Ahmed Adel — Flutter Developer', '2026-11-23 10:53:03', '2026-11-23 10:53:03'),
(2, 'site_tagline', 'Building beautiful cross-platform apps', '2026-11-23 10:53:03', '2026-11-23 10:53:03'),
(3, 'seo_description', 'Personal portfolio of Ahmed Adel, a Flutter Developer specializing in clean architecture, state management, and mobile app development.', '2026-11-23 10:53:03', '2026-11-23 10:53:03'),
(4, 'copyright_year', '2026', '2026-11-23 10:53:03', '2026-11-23 10:53:03'),
(5, 'primary_color', '#3B82F6', '2026-11-23 10:53:03', '2026-11-23 10:53:03'),
(6, 'accent_color', '#F59E0B', '2026-11-23 10:53:03', '2026-11-23 10:53:03');

-- --------------------------------------------------------

--
-- بنية الجدول `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `level` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `icon` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `skills`
--

INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `sort_order`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 'Clean Architecture', 'Frameworks & Architecture', 90, 'layers', 1, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(2, 'MVVM', 'Frameworks & Architecture', 90, 'architecture', 2, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(3, 'MVC', 'Frameworks & Architecture', 85, 'diagram-project', 3, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(4, 'Flutter Apps', 'Mobile Development', 95, 'flutter', 4, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(5, 'Responsive & Adaptive Design', 'Mobile Development', 90, 'mobile-screen-button', 5, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(6, 'Bloc', 'Mobile Development', 90, 'cubes', 6, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(7, 'Cubit', 'Mobile Development', 90, 'cube', 7, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(8, 'GetX', 'Mobile Development', 85, 'bolt', 8, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(9, 'Provider', 'Mobile Development', 85, 'share-nodes', 9, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(10, 'REST APIs (Dio & Http)', 'API & Backend Integration', 90, 'network-wired', 10, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(11, 'Firebase Authentication', 'API & Backend Integration', 85, 'fire', 11, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(12, 'Cloud Firestore', 'API & Backend Integration', 85, 'database', 12, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(13, 'Local Storage (Hive, SharedPreferences, Sqflite)', 'API & Backend Integration', 88, 'hard-drive', 13, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(14, 'Postman', 'API & Backend Integration', 85, 'paper-plane', 14, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(15, 'Google Maps', 'Hardware & Device Features', 85, 'map-location-dot', 15, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(16, 'Location Services', 'Hardware & Device Features', 85, 'location-crosshairs', 16, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(17, 'Push Notifications (FCM)', 'Hardware & Device Features', 85, 'bell', 17, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(18, 'Visual Studio Code', 'Tools & Platforms', 95, 'code', 18, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(19, 'Android Studio', 'Tools & Platforms', 90, 'android', 19, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(20, 'Git', 'Tools & Platforms', 90, 'code-branch', 20, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(21, 'GitHub', 'Tools & Platforms', 90, 'github', 21, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(22, 'Dart', 'Programming Languages', 95, 'terminal', 22, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(23, 'Java', 'Programming Languages', 80, 'java', 23, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(24, 'C++', 'Programming Languages', 75, 'microchip', 24, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(25, 'Python', 'Programming Languages', 70, 'python', 25, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(26, 'Stripe Payment', 'Payment Integration', 85, 'credit-card', 26, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2026-08-17 17:28:41', '$2y$12$dB8nSbrrde8M31l5bMVAU.xq3uar47UxaSw7jJXz76XdhZY54YkIi', 'XooVvuTV4h', '2026-08-17 17:28:42', '2026-08-17 17:28:42'),
(2, 'Ahmed Adel', 'admin@portfolio.test', NULL, '$2y$12$33h7shETWSYj9noGhorEae0NPLs024POSV1fqqlQcnmdqNRuntI12', NULL, '2026-11-23 10:51:08', '2026-11-23 10:51:08');

-- --------------------------------------------------------

--
-- بنية الجدول `video_content_items`
--

CREATE TABLE `video_content_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_section_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT 'fa-solid fa-link',
  `badge` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `video_content_items`
--

INSERT INTO `video_content_items` (`id`, `video_section_id`, `title`, `value`, `url`, `icon`, `badge`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Email Address', 'ahmedadelelmelegy2@gmail.com', 'mailto:ahmedadelelmelegy2@gmail.com', 'fa-solid fa-envelope', 'Direct Contact', 1, '2026-11-23 12:16:11', '2026-11-24 10:35:00'),
(2, 1, 'LinkedIn Profile', 'ahmed-adel-110467373', 'https://www.linkedin.com/in/ahmed-adel-110467373', 'fa-brands fa-linkedin', 'Professional', 2, '2026-11-23 12:16:11', '2026-11-24 10:35:00'),
(3, 1, 'GitHub Portfolio', 'ahmedAdelElmelegy', 'https://github.com/ahmedAdelElmelegy', 'fa-brands fa-github', 'Open Source', 3, '2026-11-23 12:16:11', '2026-11-24 10:35:00'),
(4, 1, 'Phone & WhatsApp', '+201069371116', 'https://wa.me/201069371116', 'fa-brands fa-whatsapp', 'Call & Chat', 4, '2026-11-23 12:16:11', '2026-11-24 10:35:00');

-- --------------------------------------------------------

--
-- بنية الجدول `video_sections`
--

CREATE TABLE `video_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `badge` varchar(255) DEFAULT 'Interactive Showcase',
  `title` varchar(255) NOT NULL DEFAULT 'Get To Know Me & Connect',
  `subtitle` text DEFAULT NULL,
  `video_path` varchar(255) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `video_sections`
--

INSERT INTO `video_sections` (`id`, `badge`, `title`, `subtitle`, `video_path`, `cover_image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Interactive Showcase', 'Get To Know Me & Connect', 'Watch this short interactive presentation highlighting who I am, my contact channels, and professional profiles.', 'videos/intro.mp4', NULL, 1, 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11');

-- --------------------------------------------------------

--
-- بنية الجدول `work_processes`
--

CREATE TABLE `work_processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `work_processes`
--

INSERT INTO `work_processes` (`id`, `title`, `description`, `icon`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Research & Requirement Analysis', 'Understanding user needs, defining project scope, and planning app features and data flow.', 'search', 1, '2026-11-23 10:53:03', '2026-11-23 10:53:03'),
(2, 'UI/UX Design', 'Designing wireframes, UI components, color systems, and typography using Figma.', 'design_services', 2, '2026-11-23 10:53:03', '2026-11-23 10:53:03'),
(3, 'Project Architecture', 'Setting up clean architecture, MVVM pattern, dependency injection, and scalable folder structure.', 'architecture', 3, '2026-11-23 10:53:03', '2026-11-23 10:53:03'),
(4, 'API Integration & Data Handling', 'Integrating REST APIs, building data models, handling pagination, caching, and network errors.', 'api', 4, '2026-11-23 10:53:03', '2026-11-23 10:53:03'),
(5, 'Feature Development', 'Implementing features, state management, animations, and responsive UI across devices.', 'extension', 5, '2026-11-23 10:53:03', '2026-11-23 10:53:03'),
(6, 'Testing & Optimization', 'Testing UI and APIs, handling edge cases, optimizing performance, and preparing for release.', 'bug_report', 6, '2026-11-23 10:53:03', '2026-11-23 10:53:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiences_type_index` (`type`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_slug_unique` (`slug`),
  ADD KEY `projects_is_featured_sort_order_index` (`is_featured`,`sort_order`),
  ADD KEY `projects_is_featured_index` (`is_featured`);

--
-- Indexes for table `project_features`
--
ALTER TABLE `project_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_features_project_id_foreign` (`project_id`);

--
-- Indexes for table `project_images`
--
ALTER TABLE `project_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_images_project_id_foreign` (`project_id`);

--
-- Indexes for table `project_technologies`
--
ALTER TABLE `project_technologies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_technologies_project_id_foreign` (`project_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `video_content_items`
--
ALTER TABLE `video_content_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_content_items_video_section_id_foreign` (`video_section_id`);

--
-- Indexes for table `video_sections`
--
ALTER TABLE `video_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_processes`
--
ALTER TABLE `work_processes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_features`
--
ALTER TABLE `project_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `project_images`
--
ALTER TABLE `project_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `project_technologies`
--
ALTER TABLE `project_technologies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `video_content_items`
--
ALTER TABLE `video_content_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `video_sections`
--
ALTER TABLE `video_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_processes`
--
ALTER TABLE `work_processes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- قيود الجداول `project_features`
--
ALTER TABLE `project_features`
  ADD CONSTRAINT `project_features_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- قيود الجداول `project_images`
--
ALTER TABLE `project_images`
  ADD CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- قيود الجداول `project_technologies`
--
ALTER TABLE `project_technologies`
  ADD CONSTRAINT `project_technologies_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- قيود الجداول `video_content_items`
--
ALTER TABLE `video_content_items`
  ADD CONSTRAINT `video_content_items_video_section_id_foreign` FOREIGN KEY (`video_section_id`) REFERENCES `video_sections` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
