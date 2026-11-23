-- ============================================================
-- Database Export for InfinityFree Deployment (MySQL / MariaDB)
-- Generated: 2026-11-23 18:48:23
-- ============================================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET time_zone = '+00:00';

-- ------------------------------------------------------------
-- Table: `users`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'Ahmed Adel', 'admin@portfolio.test', NULL, '$2y$12$WsyTKyzVhh5t2ncXKUJBeuzjldShTMK0AO8YPeXbGF.TjeUpplZ2K', NULL, '2026-11-23 18:46:15', '2026-11-23 18:46:15');

-- ------------------------------------------------------------
-- Table: `password_reset_tokens`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: `sessions`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: `cache`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: `cache_locks`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: `jobs`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: `job_batches`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `job_batches`;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: `failed_jobs`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: `personal_access_tokens`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: `profiles`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT 'Flutter Developer',
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `profiles`
INSERT INTO `profiles` (`id`, `user_id`, `full_name`, `title`, `bio`, `email`, `phone`, `location`, `avatar`, `cv_file`, `created_at`, `updated_at`, `role`, `tagline`, `github_url`, `linkedin_url`, `twitter_url`, `whatsapp`, `is_active`) VALUES (1, 1, 'Ahmed Adel', 'Flutter Developer', 'A passionate Flutter Developer with expertise in building beautiful, scalable, and high-performance mobile applications. Experienced in clean architecture, state management, REST APIs, and UI/UX design.', 'ahmedadelelmelegy@gmail.com', NULL, 'Egypt', 'avatars/avatar.png', NULL, '2026-11-23 18:46:15', '2026-11-23 18:46:15', 'Flutter Developer', 'Flutter Developer & Mobile App Engineer', 'https://github.com/ahmedAdelElmelegy', 'https://linkedin.com/in/ahmed-adel', NULL, NULL, 1);

-- ------------------------------------------------------------
-- Table: `skills`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `skills`
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (1, 'Flutter', 'Mobile', 95, 'flutter', '2026-11-23 18:46:15', '2026-11-23 18:46:15', 1, 1);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (2, 'Dart', 'Mobile', 90, 'dart', '2026-11-23 18:46:15', '2026-11-23 18:46:15', 2, 1);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (3, 'MVVM Architecture', 'Architecture', 85, 'architecture', '2026-11-23 18:46:16', '2026-11-23 18:46:16', 3, 1);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (4, 'Clean Architecture', 'Architecture', 80, 'layers', '2026-11-23 18:46:16', '2026-11-23 18:46:16', 4, 0);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (5, 'Cubit / Bloc', 'State Management', 85, 'bloc', '2026-11-23 18:46:16', '2026-11-23 18:46:16', 5, 1);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (6, 'Provider', 'State Management', 80, 'provider', '2026-11-23 18:46:16', '2026-11-23 18:46:16', 6, 0);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (7, 'REST APIs (Dio)', 'Backend', 85, 'api', '2026-11-23 18:46:16', '2026-11-23 18:46:16', 7, 1);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (8, 'Laravel', 'Backend', 75, 'laravel', '2026-11-23 18:46:16', '2026-11-23 18:46:16', 8, 0);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (9, 'Git & GitHub', 'Tools', 90, 'github', '2026-11-23 18:46:16', '2026-11-23 18:46:16', 9, 0);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (10, 'Figma', 'Design', 70, 'figma', '2026-11-23 18:46:16', '2026-11-23 18:46:16', 10, 0);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (11, 'Google Maps', 'Mobile', 80, 'maps', '2026-11-23 18:46:16', '2026-11-23 18:46:16', 11, 0);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (12, 'Firebase', 'Backend', 75, 'firebase', '2026-11-23 18:46:17', '2026-11-23 18:46:17', 12, 0);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (13, 'Get It (DI)', 'Architecture', 85, 'di', '2026-11-23 18:46:17', '2026-11-23 18:46:17', 13, 0);
INSERT INTO `skills` (`id`, `name`, `category`, `level`, `icon`, `created_at`, `updated_at`, `sort_order`, `is_featured`) VALUES (14, 'Push Notifications', 'Mobile', 75, 'notifications', '2026-11-23 18:46:17', '2026-11-23 18:46:17', 14, 0);

-- ------------------------------------------------------------
-- Table: `projects`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `short_description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `app_url` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projects_slug_unique` (`slug`),
  KEY `projects_is_featured_sort_order_index` (`is_featured`,`sort_order`),
  KEY `projects_is_featured_index` (`is_featured`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `projects`
INSERT INTO `projects` (`id`, `name`, `slug`, `description`, `short_description`, `cover_image`, `github_url`, `app_url`, `is_featured`, `sort_order`, `published_at`, `created_at`, `updated_at`) VALUES (1, 'Circle', 'circle', 'A modern e-commerce application that enables users to browse products, manage carts, track orders, and complete secure payments.', 'Full-featured e-commerce app with cart, orders, payments, and location tracking.', 'projects/covers/circle.webp', 'https://github.com/ahmedAdelElmelegy/circle', 'https://drive.google.com/drive/folders/1YXjEpk_U1PD__ukwibCRFM0QAIcBbsxR?usp=drive_link', 1, 1, '2026-11-23 18:46:18', '2026-11-23 18:46:18', '2026-11-23 18:46:18');
INSERT INTO `projects` (`id`, `name`, `slug`, `description`, `short_description`, `cover_image`, `github_url`, `app_url`, `is_featured`, `sort_order`, `published_at`, `created_at`, `updated_at`) VALUES (2, 'Nurse Bot', 'nurse-bot', 'An AI-powered application that summarizes books and answers user questions using an intelligent chatbot.', 'AI chatbot app with book summarization powered by Gemini API.', 'projects/covers/nurse-bot.webp', 'https://github.com/ahmedAdelElmelegy/nurse-bot', 'https://github.com/ahmedAdelElmelegy/nurse-bot', 1, 2, '2026-11-23 18:46:18', '2026-11-23 18:46:21', '2026-11-23 18:46:21');
INSERT INTO `projects` (`id`, `name`, `slug`, `description`, `short_description`, `cover_image`, `github_url`, `app_url`, `is_featured`, `sort_order`, `published_at`, `created_at`, `updated_at`) VALUES (3, 'Al Huda', 'al-huda', 'An Islamic guidance application providing accurate prayer times, Quran access, reminders, and location-based services.', 'Islamic app with prayer times, Quran reader, Azkar, and mosque location.', 'projects/covers/al-huda.webp', 'https://github.com/ahmedAdelElmelegy/Al-Huda', 'https://drive.google.com/drive/folders/1_kftNvH6CxjfBcckoT3TaeMhODjR5wgc?usp=drive_link', 1, 3, '2026-11-23 18:46:18', '2026-11-23 18:46:24', '2026-11-23 18:46:24');
INSERT INTO `projects` (`id`, `name`, `slug`, `description`, `short_description`, `cover_image`, `github_url`, `app_url`, `is_featured`, `sort_order`, `published_at`, `created_at`, `updated_at`) VALUES (4, 'BMI Tracker', 'bmi-tracker', 'A lightweight BMI calculator app that calculates body mass index based on user input with a clean UI.', 'BMI calculator with real-time calculation, health tips, and responsive design.', 'projects/covers/bmi-tracker.webp', 'https://github.com/ahmedAdelElmelegy/Bmi_calculator', 'https://drive.google.com/drive/folders/1DGskNTvXAF3rn5iAlbhXPP6_fDmHMcHc?usp=drive_link', 0, 4, '2026-11-23 18:46:18', '2026-11-23 18:46:27', '2026-11-23 18:46:27');

-- ------------------------------------------------------------
-- Table: `project_images`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `project_images`;
CREATE TABLE `project_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_images_project_id_foreign` (`project_id`),
  CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `project_images`
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 1, 'projects/gallery/project1/project11.webp', 1, '2026-11-23 18:46:20', '2026-11-23 18:46:20');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 1, 'projects/gallery/project1/project12.webp', 2, '2026-11-23 18:46:20', '2026-11-23 18:46:20');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 1, 'projects/gallery/project1/project13.webp', 3, '2026-11-23 18:46:21', '2026-11-23 18:46:21');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (4, 1, 'projects/gallery/project1/project14.webp', 4, '2026-11-23 18:46:21', '2026-11-23 18:46:21');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (5, 1, 'projects/gallery/project1/project15.webp', 5, '2026-11-23 18:46:21', '2026-11-23 18:46:21');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (6, 1, 'projects/gallery/project1/project16.webp', 6, '2026-11-23 18:46:21', '2026-11-23 18:46:21');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (7, 1, 'projects/gallery/project1/project17.webp', 7, '2026-11-23 18:46:21', '2026-11-23 18:46:21');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (8, 1, 'projects/gallery/project1/project18.webp', 8, '2026-11-23 18:46:21', '2026-11-23 18:46:21');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (9, 2, 'projects/gallery/project3/project31.webp', 1, '2026-11-23 18:46:23', '2026-11-23 18:46:23');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (10, 2, 'projects/gallery/project3/project32.webp', 2, '2026-11-23 18:46:23', '2026-11-23 18:46:23');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (11, 2, 'projects/gallery/project3/project33.webp', 3, '2026-11-23 18:46:23', '2026-11-23 18:46:23');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (12, 2, 'projects/gallery/project3/project34.webp', 4, '2026-11-23 18:46:23', '2026-11-23 18:46:23');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (13, 2, 'projects/gallery/project3/project35.webp', 5, '2026-11-23 18:46:23', '2026-11-23 18:46:23');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (14, 2, 'projects/gallery/project3/project36.webp', 6, '2026-11-23 18:46:23', '2026-11-23 18:46:23');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (15, 3, 'projects/gallery/project2/21.webp', 1, '2026-11-23 18:46:26', '2026-11-23 18:46:26');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (16, 3, 'projects/gallery/project2/22.webp', 2, '2026-11-23 18:46:26', '2026-11-23 18:46:26');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (17, 3, 'projects/gallery/project2/23.webp', 3, '2026-11-23 18:46:27', '2026-11-23 18:46:27');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (18, 3, 'projects/gallery/project2/24.webp', 4, '2026-11-23 18:46:27', '2026-11-23 18:46:27');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (19, 3, 'projects/gallery/project2/25.webp', 5, '2026-11-23 18:46:27', '2026-11-23 18:46:27');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (20, 3, 'projects/gallery/project2/26.webp', 6, '2026-11-23 18:46:27', '2026-11-23 18:46:27');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (21, 3, 'projects/gallery/project2/27.webp', 7, '2026-11-23 18:46:27', '2026-11-23 18:46:27');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (22, 3, 'projects/gallery/project2/28.webp', 8, '2026-11-23 18:46:27', '2026-11-23 18:46:27');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (23, 4, 'projects/gallery/project4/project41.webp', 1, '2026-11-23 18:46:29', '2026-11-23 18:46:29');
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES (24, 4, 'projects/gallery/project4/project42.webp', 2, '2026-11-23 18:46:29', '2026-11-23 18:46:29');

-- ------------------------------------------------------------
-- Table: `project_technologies`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `project_technologies`;
CREATE TABLE `project_technologies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_technologies_project_id_foreign` (`project_id`),
  CONSTRAINT `project_technologies_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `project_technologies`
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 1, 'Flutter', 1, '2026-11-23 18:46:18', '2026-11-23 18:46:18');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 1, 'Dart', 2, '2026-11-23 18:46:18', '2026-11-23 18:46:18');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 1, 'MVVM Architecture', 3, '2026-11-23 18:46:18', '2026-11-23 18:46:18');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (4, 1, 'Provider', 4, '2026-11-23 18:46:19', '2026-11-23 18:46:19');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (5, 1, 'Get It (DI)', 5, '2026-11-23 18:46:19', '2026-11-23 18:46:19');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (6, 1, 'REST APIs (Dio)', 6, '2026-11-23 18:46:19', '2026-11-23 18:46:19');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (7, 1, 'Google Maps', 7, '2026-11-23 18:46:19', '2026-11-23 18:46:19');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (8, 1, 'Payment Integration', 8, '2026-11-23 18:46:19', '2026-11-23 18:46:19');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (9, 1, 'Multi-Language Support', 9, '2026-11-23 18:46:19', '2026-11-23 18:46:19');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (10, 2, 'Flutter', 1, '2026-11-23 18:46:21', '2026-11-23 18:46:21');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (11, 2, 'Dart', 2, '2026-11-23 18:46:21', '2026-11-23 18:46:21');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (12, 2, 'Gemini API', 3, '2026-11-23 18:46:22', '2026-11-23 18:46:22');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (13, 2, 'Provider', 4, '2026-11-23 18:46:22', '2026-11-23 18:46:22');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (14, 2, 'AI Chat Assistant', 5, '2026-11-23 18:46:22', '2026-11-23 18:46:22');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (15, 2, 'Book Summarization', 6, '2026-11-23 18:46:22', '2026-11-23 18:46:22');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (16, 2, 'URL Launcher', 7, '2026-11-23 18:46:22', '2026-11-23 18:46:22');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (17, 3, 'Flutter', 1, '2026-11-23 18:46:24', '2026-11-23 18:46:24');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (18, 3, 'Dart', 2, '2026-11-23 18:46:24', '2026-11-23 18:46:24');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (19, 3, 'MVVM Architecture', 3, '2026-11-23 18:46:24', '2026-11-23 18:46:24');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (20, 3, 'Cubit / Bloc', 4, '2026-11-23 18:46:24', '2026-11-23 18:46:24');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (21, 3, 'Get It (DI)', 5, '2026-11-23 18:46:24', '2026-11-23 18:46:24');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (22, 3, 'REST APIs (Dio)', 6, '2026-11-23 18:46:24', '2026-11-23 18:46:24');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (23, 3, 'Prayer Times', 7, '2026-11-23 18:46:24', '2026-11-23 18:46:24');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (24, 3, 'Quran Reader', 8, '2026-11-23 18:46:24', '2026-11-23 18:46:24');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (25, 3, 'Push Notifications', 9, '2026-11-23 18:46:25', '2026-11-23 18:46:25');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (26, 3, 'Google Maps', 10, '2026-11-23 18:46:25', '2026-11-23 18:46:25');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (27, 3, 'Multi-Language Support', 11, '2026-11-23 18:46:25', '2026-11-23 18:46:25');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (28, 4, 'Flutter', 1, '2026-11-23 18:46:27', '2026-11-23 18:46:27');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (29, 4, 'Dart', 2, '2026-11-23 18:46:28', '2026-11-23 18:46:28');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (30, 4, 'MVVM Architecture', 3, '2026-11-23 18:46:28', '2026-11-23 18:46:28');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (31, 4, 'Cubit / Bloc', 4, '2026-11-23 18:46:28', '2026-11-23 18:46:28');
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (32, 4, 'Responsive UI', 5, '2026-11-23 18:46:28', '2026-11-23 18:46:28');

-- ------------------------------------------------------------
-- Table: `project_features`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `project_features`;
CREATE TABLE `project_features` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_features_project_id_foreign` (`project_id`),
  CONSTRAINT `project_features_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `project_features`
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 1, 'Product listing & categories', 1, '2026-11-23 18:46:19', '2026-11-23 18:46:19');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 1, 'Shopping cart management', 2, '2026-11-23 18:46:19', '2026-11-23 18:46:19');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 1, 'Order tracking', 3, '2026-11-23 18:46:19', '2026-11-23 18:46:19');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (4, 1, 'Payment processing', 4, '2026-11-23 18:46:20', '2026-11-23 18:46:20');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (5, 1, 'User authentication & profile', 5, '2026-11-23 18:46:20', '2026-11-23 18:46:20');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (6, 1, 'Location tracking', 6, '2026-11-23 18:46:20', '2026-11-23 18:46:20');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (7, 1, 'Multi-language support', 7, '2026-11-23 18:46:20', '2026-11-23 18:46:20');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (8, 1, 'Clean architecture & scalable code', 8, '2026-11-23 18:46:20', '2026-11-23 18:46:20');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (9, 2, 'Chatbot for Q&A', 1, '2026-11-23 18:46:22', '2026-11-23 18:46:22');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (10, 2, 'AI-powered book summarization', 2, '2026-11-23 18:46:22', '2026-11-23 18:46:22');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (11, 2, 'Interactive chatbot for Q&A', 3, '2026-11-23 18:46:22', '2026-11-23 18:46:22');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (12, 2, 'User-friendly interface', 4, '2026-11-23 18:46:22', '2026-11-23 18:46:22');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (13, 2, 'Book links', 5, '2026-11-23 18:46:23', '2026-11-23 18:46:23');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (14, 2, 'Quotes', 6, '2026-11-23 18:46:23', '2026-11-23 18:46:23');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (15, 2, 'Offline reading support', 7, '2026-11-23 18:46:23', '2026-11-23 18:46:23');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (16, 2, 'Clean & responsive UI', 8, '2026-11-23 18:46:23', '2026-11-23 18:46:23');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (17, 3, 'Accurate prayer times & alerts', 1, '2026-11-23 18:46:25', '2026-11-23 18:46:25');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (18, 3, 'Quran reading & audio playback', 2, '2026-11-23 18:46:25', '2026-11-23 18:46:25');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (19, 3, 'Adjustable Quran font size', 3, '2026-11-23 18:46:25', '2026-11-23 18:46:25');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (20, 3, 'Quran reader with bookmarks', 4, '2026-11-23 18:46:25', '2026-11-23 18:46:25');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (21, 3, 'Doaa & supplications', 5, '2026-11-23 18:46:25', '2026-11-23 18:46:25');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (22, 3, 'Azkar for morning & evening with notifications', 6, '2026-11-23 18:46:25', '2026-11-23 18:46:25');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (23, 3, 'Digital Sebha (tasbeeh counter)', 7, '2026-11-23 18:46:26', '2026-11-23 18:46:26');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (24, 3, 'Asmaa Allah al-Husna (99 Names)', 8, '2026-11-23 18:46:26', '2026-11-23 18:46:26');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (25, 3, 'Mosque location tracking', 9, '2026-11-23 18:46:26', '2026-11-23 18:46:26');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (26, 3, 'Smart reminders & notifications', 10, '2026-11-23 18:46:26', '2026-11-23 18:46:26');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (27, 3, 'Multi-language support', 11, '2026-11-23 18:46:26', '2026-11-23 18:46:26');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (28, 3, 'Offline access for Quran & prayers', 12, '2026-11-23 18:46:26', '2026-11-23 18:46:26');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (29, 4, 'Real-time BMI calculation', 1, '2026-11-23 18:46:28', '2026-11-23 18:46:28');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (30, 4, 'User-friendly interface', 2, '2026-11-23 18:46:28', '2026-11-23 18:46:28');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (31, 4, 'Responsive design for mobile & tablet', 3, '2026-11-23 18:46:28', '2026-11-23 18:46:28');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (32, 4, 'Health tips & category guidance', 4, '2026-11-23 18:46:28', '2026-11-23 18:46:28');
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (33, 4, 'MVVM Architecture & maintainable code', 5, '2026-11-23 18:46:28', '2026-11-23 18:46:28');

-- ------------------------------------------------------------
-- Table: `experiences`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `experiences`;
CREATE TABLE `experiences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `is_current` tinyint(1) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'work',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `experiences_type_index` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `experiences`
INSERT INTO `experiences` (`id`, `title`, `organization`, `location`, `start_date`, `end_date`, `is_current`, `description`, `type`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 'Flutter Developer', 'Freelance', 'Remote', '2023-01-01 00:00:00', NULL, 1, 'Building cross-platform mobile applications for clients using Flutter, clean architecture, and modern state management patterns.', 'work', 1, '2026-11-23 18:46:17', '2026-11-23 18:46:17');
INSERT INTO `experiences` (`id`, `title`, `organization`, `location`, `start_date`, `end_date`, `is_current`, `description`, `type`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 'Bachelor of Computer Science', 'Egyptian University', 'Egypt', '2020-09-01 00:00:00', '2024-06-01 00:00:00', 0, 'Studied computer science fundamentals including algorithms, data structures, software engineering, and mobile development.', 'education', 2, '2026-11-23 18:46:17', '2026-11-23 18:46:17');

-- ------------------------------------------------------------
-- Table: `work_processes`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `work_processes`;
CREATE TABLE `work_processes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `work_processes`
INSERT INTO `work_processes` (`id`, `title`, `description`, `icon`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 'Research & Requirement Analysis', 'Understanding user needs, defining project scope, and planning app features and data flow.', 'search', 1, '2026-11-23 18:46:17', '2026-11-23 18:46:17');
INSERT INTO `work_processes` (`id`, `title`, `description`, `icon`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 'UI/UX Design', 'Designing wireframes, UI components, color systems, and typography using Figma.', 'design_services', 2, '2026-11-23 18:46:17', '2026-11-23 18:46:17');
INSERT INTO `work_processes` (`id`, `title`, `description`, `icon`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 'Project Architecture', 'Setting up clean architecture, MVVM pattern, dependency injection, and scalable folder structure.', 'architecture', 3, '2026-11-23 18:46:17', '2026-11-23 18:46:17');
INSERT INTO `work_processes` (`id`, `title`, `description`, `icon`, `sort_order`, `created_at`, `updated_at`) VALUES (4, 'API Integration & Data Handling', 'Integrating REST APIs, building data models, handling pagination, caching, and network errors.', 'api', 4, '2026-11-23 18:46:18', '2026-11-23 18:46:18');
INSERT INTO `work_processes` (`id`, `title`, `description`, `icon`, `sort_order`, `created_at`, `updated_at`) VALUES (5, 'Feature Development', 'Implementing features, state management, animations, and responsive UI across devices.', 'extension', 5, '2026-11-23 18:46:18', '2026-11-23 18:46:18');
INSERT INTO `work_processes` (`id`, `title`, `description`, `icon`, `sort_order`, `created_at`, `updated_at`) VALUES (6, 'Testing & Optimization', 'Testing UI and APIs, handling edge cases, optimizing performance, and preparing for release.', 'bug_report', 6, '2026-11-23 18:46:18', '2026-11-23 18:46:18');

-- ------------------------------------------------------------
-- Table: `settings`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `settings`
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (1, 'site_name', 'Ahmed Adel — Flutter Developer', '2026-11-23 18:46:29', '2026-11-23 18:46:29');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (2, 'site_tagline', 'Building beautiful cross-platform apps', '2026-11-23 18:46:29', '2026-11-23 18:46:29');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (3, 'seo_description', 'Personal portfolio of Ahmed Adel, a Flutter Developer specializing in clean architecture, state management, and mobile app development.', '2026-11-23 18:46:29', '2026-11-23 18:46:29');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (4, 'copyright_year', '2026', '2026-11-23 18:46:29', '2026-11-23 18:46:29');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (5, 'primary_color', '#3B82F6', '2026-11-23 18:46:29', '2026-11-23 18:46:29');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (6, 'accent_color', '#F59E0B', '2026-11-23 18:46:30', '2026-11-23 18:46:30');

-- ------------------------------------------------------------
-- Table: `contact_messages`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: `video_sections`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `video_sections`;
CREATE TABLE `video_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `badge` varchar(255) DEFAULT 'Interactive Showcase',
  `title` varchar(255) NOT NULL DEFAULT 'Get To Know Me & Connect',
  `subtitle` text DEFAULT NULL,
  `video_path` varchar(255) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `video_sections`
INSERT INTO `video_sections` (`id`, `badge`, `title`, `subtitle`, `video_path`, `cover_image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 'Interactive Showcase', 'Get To Know Me & Connect', 'Watch this short interactive presentation highlighting who I am, my contact channels, and professional profiles.', 'videos/intro.mp4', NULL, 1, 1, '2026-11-23 18:46:30', '2026-11-23 18:46:30');

-- ------------------------------------------------------------
-- Table: `video_content_items`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `video_content_items`;
CREATE TABLE `video_content_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `video_section_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT 'fa-solid fa-link',
  `badge` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `video_content_items_video_section_id_foreign` (`video_section_id`),
  CONSTRAINT `video_content_items_video_section_id_foreign` FOREIGN KEY (`video_section_id`) REFERENCES `video_sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `video_content_items`
INSERT INTO `video_content_items` (`id`, `video_section_id`, `title`, `value`, `url`, `icon`, `badge`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 1, 'Email Address', 'ahmedadelelmelegy2@gmail.com', 'mailto:ahmedadelelmelegy2@gmail.com', 'fa-solid fa-envelope', 'Direct Contact', 1, '2026-11-23 18:46:30', '2026-11-23 18:46:30');
INSERT INTO `video_content_items` (`id`, `video_section_id`, `title`, `value`, `url`, `icon`, `badge`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 1, 'LinkedIn Profile', 'ahmed-adel-110467373', 'https://www.linkedin.com/in/ahmed-adel-110467373', 'fa-brands fa-linkedin', 'Professional', 2, '2026-11-23 18:46:30', '2026-11-23 18:46:30');
INSERT INTO `video_content_items` (`id`, `video_section_id`, `title`, `value`, `url`, `icon`, `badge`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 1, 'GitHub Portfolio', 'ahmedAdelElmelegy', 'https://github.com/ahmedAdelElmelegy', 'fa-brands fa-github', 'Open Source', 3, '2026-11-23 18:46:30', '2026-11-23 18:46:30');
INSERT INTO `video_content_items` (`id`, `video_section_id`, `title`, `value`, `url`, `icon`, `badge`, `sort_order`, `created_at`, `updated_at`) VALUES (4, 1, 'Flutter & Mobile Engineering', 'Clean Architecture & Scalable Apps', '#projects', 'fa-solid fa-mobile-screen-button', 'Specialization', 4, '2026-11-23 18:46:30', '2026-11-23 18:46:30');

-- ------------------------------------------------------------
-- Table: `migrations`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2026_05_29_004547_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2026_08_17_111358_create_profiles_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2026_08_17_111552_create_skills_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2026_08_17_111641_create_projects_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2026_08_17_111723_create_project_images_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2026_08_17_111743_create_education_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2026_08_17_111743_create_experiences_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11, '2026_08_17_111819_create_contact_messages_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12, '2026_11_23_000001_update_profiles_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13, '2026_11_23_000002_update_skills_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14, '2026_11_23_000003_recreate_projects_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15, '2026_11_23_000004_create_project_technologies_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16, '2026_11_23_000005_create_project_features_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17, '2026_11_23_000006_recreate_experiences_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18, '2026_11_23_000007_create_work_processes_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19, '2026_11_23_000008_create_settings_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20, '2026_11_23_000009_update_contact_messages_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21, '2026_11_23_140213_create_video_sections_and_items_tables', 1);

SET FOREIGN_KEY_CHECKS=1;
