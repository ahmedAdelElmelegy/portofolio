-- ============================================================
-- كود تحديث قاعدة البيانات بدون أخطاء Foreign Key
-- يستخدم DELETE بدلاً من TRUNCATE مع ترتيب الجداول الصحيح
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------------------------------------
-- 1. حذف السجلات القديمة من الجداول الفرعية أولاً ثم الرئيسية
-- ------------------------------------------------------------
DELETE FROM `project_features`;
DELETE FROM `project_technologies`;
DELETE FROM `project_images`;
DELETE FROM `projects`;
DELETE FROM `skills`;
DELETE FROM `experiences`;
DELETE FROM `profiles`;

ALTER TABLE `project_features` AUTO_INCREMENT = 1;
ALTER TABLE `project_technologies` AUTO_INCREMENT = 1;
ALTER TABLE `projects` AUTO_INCREMENT = 1;
ALTER TABLE `skills` AUTO_INCREMENT = 1;
ALTER TABLE `experiences` AUTO_INCREMENT = 1;
ALTER TABLE `profiles` AUTO_INCREMENT = 1;

-- ------------------------------------------------------------
-- 2. إدخال بيانات البروفايل ورابط السيرة الذاتية ورقم الهاتف
-- ------------------------------------------------------------
INSERT INTO `profiles` (`id`, `user_id`, `full_name`, `role`, `tagline`, `title`, `bio`, `email`, `phone`, `location`, `avatar`, `cv_file`, `github_url`, `linkedin_url`, `twitter_url`, `whatsapp`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'Ahmed Adel', 'Flutter Developer', 'Mobile App Engineer & Clean Architecture Enthusiast', 'Flutter Developer', 'I am a dedicated Flutter developer with hands-on experience in building mobile apps, integrating APIs, managing Firebase services, and applying clean architecture principles. I learn rapidly, adapt to new challenges, and focus on writing maintainable, scalable code. I enjoy collaborating with teams and transforming ideas into polished user-friendly applications.', 'ahmedadelelmelegy2@gmail.com', '01069371116', 'Shebin El-Kom, Menoufia, Egypt', 'avatars/avatar.png', 'https://drive.google.com/drive/u/0/mobile/folders/1Du__WLyTM0zhOU2ZfzEAYIz5cjqcjS0Q?hl=ar&sort=13&direction=a', 'https://github.com/ahmedAdelElmelegy', 'https://www.linkedin.com/in/ahmed-adel-110467373', NULL, '01069371116', 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00');

-- ------------------------------------------------------------
-- 3. إدخال بيانات الخبرات والتعليم
-- ------------------------------------------------------------
INSERT INTO `experiences` (`id`, `title`, `organization`, `location`, `start_date`, `end_date`, `is_current`, `description`, `type`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Faculty of Electronic Engineering', 'Menoufia University', 'Menoufia, Egypt', '2020-09-01', '2025-06-30', 0, 'Studying Electronic & Computer Engineering with emphasis on algorithms, data structures, mobile computing, and software engineering.', 'education', 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(2, 'Flutter Development Intern', 'Acme Integrated Engineering System (IES)', 'Cairo, Egypt', '2025-09-01', '2025-11-30', 0, 'Developed production-grade Flutter features, handled REST API integration, state management, and applied clean architecture standards.', 'work', 2, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(3, 'Flutter Development Intern', 'PureSoft', 'Shebin El-Kom, Egypt', '2025-08-01', '2025-09-30', 0, 'Contributed to building cross-platform Flutter applications, responsive UI implementations, local caching, and bug fixing.', 'work', 3, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(4, 'UI/UX Training Program', 'Information Technology Institute (ITI)', 'Shebin El-Kom, Egypt', '2024-07-01', '2024-08-31', 0, 'Intensive professional training in user experience research, wireframing, interactive prototyping, and design systems using Figma.', 'work', 4, '2026-11-23 10:53:03', '2026-11-24 10:35:00');

-- ------------------------------------------------------------
-- 4. إدخال بيانات المهارات (26 مهارة فلاتر وموبايل)
-- ------------------------------------------------------------
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

-- ------------------------------------------------------------
-- 5. إدخال بيانات المشاريع الرئيسية
-- ------------------------------------------------------------
INSERT INTO `projects` (`id`, `name`, `slug`, `description`, `short_description`, `cover_image`, `github_url`, `app_url`, `is_featured`, `sort_order`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Circle', 'circle', 'A modern e-commerce application that enables users to browse products, manage carts, track orders, and complete secure payments.', 'Full-featured e-commerce app with cart, orders, payments, and location tracking.', 'projects/covers/circle.webp', 'https://github.com/ahmedAdelElmelegy/circle', 'https://drive.google.com/drive/folders/1YXjEpk_U1PD__ukwibCRFM0QAIcBbsxR?usp=drive_link', 1, 1, '2026-11-23 12:16:11', '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(2, 'Nurse Bot', 'nurse-bot', 'An AI-powered application that summarizes books and answers user questions using an intelligent chatbot.', 'AI chatbot app with book summarization powered by Gemini API.', 'projects/covers/nurse-bot.webp', 'https://github.com/ahmedAdelElmelegy/nurse-bot', 'https://github.com/ahmedAdelElmelegy/nurse-bot', 1, 2, '2026-11-23 12:16:11', '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(3, 'Al Huda', 'al-huda', 'An Islamic guidance application providing accurate prayer times, Quran access, reminders, and location-based services.', 'Islamic app with prayer times, Quran reader, Azkar, and mosque location.', 'projects/covers/al-huda.webp', 'https://github.com/ahmedAdelElmelegy/Al-Huda', 'https://drive.google.com/drive/folders/1_kftNvH6CxjfBcckoT3TaeMhODjR5wgc?usp=drive_link', 1, 3, '2026-11-23 12:16:11', '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(4, 'BMI Tracker', 'bmi-tracker', 'A lightweight BMI calculator app that calculates body mass index based on user input with a clean UI.', 'BMI calculator with real-time calculation, health tips, and responsive design.', 'projects/covers/bmi-tracker.webp', 'https://github.com/ahmedAdelElmelegy/Bmi_calculator', 'https://drive.google.com/drive/folders/1DGskNTvXAF3rn5iAlbhXPP6_fDmHMcHc?usp=drive_link', 0, 4, '2026-11-23 12:16:11', '2026-11-23 10:53:03', '2026-11-24 10:35:00');

-- ------------------------------------------------------------
-- 6. إدخال مميزات المشاريع (Project Features)
-- ------------------------------------------------------------
INSERT INTO `project_features` (`id`, `project_id`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
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

-- ------------------------------------------------------------
-- 7. إدخال تقنيات المشاريع (Project Technologies)
-- ------------------------------------------------------------
INSERT INTO `project_technologies` (`id`, `project_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES
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

SET FOREIGN_KEY_CHECKS = 1;
