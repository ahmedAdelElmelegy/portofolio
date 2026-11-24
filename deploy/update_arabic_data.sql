-- ============================================================
-- كود إضافة الأعمدة العربية وتحديث البيانات باللغتين العربية والإنجليزية
-- تشغيل مباشر على phpMyAdmin
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------------------------------------
-- 1. إضافة الأعمدة العربية (إذا لم تكن موجودة)
-- ------------------------------------------------------------
-- profiles
SET @col = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'profiles' AND COLUMN_NAME = 'full_name_ar');
SET @stmt = IF(@col = 0, 'ALTER TABLE `profiles` ADD `full_name_ar` VARCHAR(255) NULL AFTER `full_name`, ADD `role_ar` VARCHAR(255) NULL AFTER `role`, ADD `tagline_ar` VARCHAR(255) NULL AFTER `tagline`, ADD `title_ar` VARCHAR(255) NULL AFTER `title`, ADD `bio_ar` TEXT NULL AFTER `bio`, ADD `location_ar` VARCHAR(255) NULL AFTER `location`;', 'SELECT "profiles base columns exist";');
PREPARE s FROM @stmt; EXECUTE s; DEALLOCATE PREPARE s;

SET @col2 = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'profiles' AND COLUMN_NAME = 'title_ar');
SET @stmt2 = IF(@col2 = 0, 'ALTER TABLE `profiles` ADD `title_ar` VARCHAR(255) NULL AFTER `title`;', 'SELECT "title_ar exists";');
PREPARE s2 FROM @stmt2; EXECUTE s2; DEALLOCATE PREPARE s2;

-- experiences
SET @col = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'experiences' AND COLUMN_NAME = 'title_ar');
SET @stmt = IF(@col = 0, 'ALTER TABLE `experiences` ADD `title_ar` VARCHAR(255) NULL AFTER `title`, ADD `organization_ar` VARCHAR(255) NULL AFTER `organization`, ADD `location_ar` VARCHAR(255) NULL AFTER `location`, ADD `description_ar` TEXT NULL AFTER `description`;', 'SELECT "experiences columns exist";');
PREPARE s FROM @stmt; EXECUTE s; DEALLOCATE PREPARE s;

-- skills
SET @col = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'skills' AND COLUMN_NAME = 'category_ar');
SET @stmt = IF(@col = 0, 'ALTER TABLE `skills` ADD `category_ar` VARCHAR(100) NULL AFTER `category`;', 'SELECT "skills columns exist";');
PREPARE s FROM @stmt; EXECUTE s; DEALLOCATE PREPARE s;

-- work_processes
SET @col = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'work_processes' AND COLUMN_NAME = 'title_ar');
SET @stmt = IF(@col = 0, 'ALTER TABLE `work_processes` ADD `title_ar` VARCHAR(255) NULL AFTER `title`, ADD `description_ar` TEXT NULL AFTER `description`;', 'SELECT "work_processes columns exist";');
PREPARE s FROM @stmt; EXECUTE s; DEALLOCATE PREPARE s;

-- projects
SET @col = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'projects' AND COLUMN_NAME = 'name_ar');
SET @stmt = IF(@col = 0, 'ALTER TABLE `projects` ADD `name_ar` VARCHAR(255) NULL AFTER `name`, ADD `short_description_ar` VARCHAR(500) NULL AFTER `short_description`, ADD `description_ar` TEXT NULL AFTER `description`;', 'SELECT "projects columns exist";');
PREPARE s FROM @stmt; EXECUTE s; DEALLOCATE PREPARE s;

-- project_features
SET @col = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'project_features' AND COLUMN_NAME = 'description_ar');
SET @stmt = IF(@col = 0, 'ALTER TABLE `project_features` ADD `description_ar` TEXT NULL AFTER `description`;', 'SELECT "project_features columns exist";');
PREPARE s FROM @stmt; EXECUTE s; DEALLOCATE PREPARE s;

-- video_sections
SET @col = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'video_sections' AND COLUMN_NAME = 'title_ar');
SET @stmt = IF(@col = 0, 'ALTER TABLE `video_sections` ADD `badge_ar` VARCHAR(100) NULL AFTER `badge`, ADD `title_ar` VARCHAR(255) NULL AFTER `title`, ADD `subtitle_ar` TEXT NULL AFTER `subtitle`;', 'SELECT "video_sections columns exist";');
PREPARE s FROM @stmt; EXECUTE s; DEALLOCATE PREPARE s;

-- video_content_items
SET @col = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'video_content_items' AND COLUMN_NAME = 'title_ar');
SET @stmt = IF(@col = 0, 'ALTER TABLE `video_content_items` ADD `title_ar` VARCHAR(255) NULL AFTER `title`, ADD `value_ar` VARCHAR(255) NULL AFTER `value`;', 'SELECT "video_content_items columns exist";');
PREPARE s FROM @stmt; EXECUTE s; DEALLOCATE PREPARE s;

-- ------------------------------------------------------------
-- 2. تفريغ الجداول قبل إعادة الإدخال بالبيانات الكاملة (عربي + إنجليزي)
-- ------------------------------------------------------------
DELETE FROM `project_features`;
DELETE FROM `project_technologies`;
DELETE FROM `project_images`;
DELETE FROM `projects`;
DELETE FROM `skills`;
DELETE FROM `experiences`;
DELETE FROM `work_processes`;
DELETE FROM `profiles`;

ALTER TABLE `project_features` AUTO_INCREMENT = 1;
ALTER TABLE `project_technologies` AUTO_INCREMENT = 1;
ALTER TABLE `projects` AUTO_INCREMENT = 1;
ALTER TABLE `skills` AUTO_INCREMENT = 1;
ALTER TABLE `experiences` AUTO_INCREMENT = 1;
ALTER TABLE `work_processes` AUTO_INCREMENT = 1;
ALTER TABLE `profiles` AUTO_INCREMENT = 1;

-- ------------------------------------------------------------
-- 3. إدخال البروفايل (عربي + إنجليزي ورابط السيرة الذاتية)
-- ------------------------------------------------------------
INSERT INTO `profiles` (`id`, `user_id`, `full_name`, `full_name_ar`, `role`, `role_ar`, `tagline`, `tagline_ar`, `title`, `title_ar`, `bio`, `bio_ar`, `email`, `phone`, `location`, `location_ar`, `avatar`, `cv_file`, `github_url`, `linkedin_url`, `twitter_url`, `whatsapp`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'Ahmed Adel', 'أحمد عادل', 'Flutter Developer', 'مطور تطبيقات فلاتر', 'Mobile App Engineer & Clean Architecture Enthusiast', 'مهندس تطبيقات الموبايل وشغوف بالـ Clean Architecture', 'Flutter Developer', 'مطور تطبيقات فلاتر',
'I am a dedicated Flutter developer with hands-on experience in building mobile apps, integrating APIs, managing Firebase services, and applying clean architecture principles. I learn rapidly, adapt to new challenges, and focus on writing maintainable, scalable code. I enjoy collaborating with teams and transforming ideas into polished user-friendly applications.',
'أنا مطور تطبيقات فلاتر شغوف ولدي خبرة عملية في بناء تطبيقات الموبايل، والربط مع الـ APIs، وإدارة خدمات Firebase، وتطبيق مبادئ المعمارية النظيفة (Clean Architecture). أتعلم بسرعة وأتكيف مع التحديات التقنية الجديدة، وأركز على كتابة كود منظم وقابل للتوسع والصيانة. أستمتع بالعمل الجماعي وتحويل الأفكار إلى تطبيقات عملية ومتقنة للمستخدمين.',
'ahmedadelelmelegy2@gmail.com', '01069371116', 'Shebin El-Kom, Menoufia, Egypt', 'شبين الكوم، المنوفية، مصر', 'avatars/avatar.png', 'https://drive.google.com/drive/u/0/mobile/folders/1Du__WLyTM0zhOU2ZfzEAYIz5cjqcjS0Q?hl=ar&sort=13&direction=a', 'https://github.com/ahmedAdelElmelegy', 'https://www.linkedin.com/in/ahmed-adel-110467373', NULL, '01069371116', 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00');

-- ------------------------------------------------------------
-- 4. إدخال الخبرات والتعليم (عربي + إنجليزي)
-- ------------------------------------------------------------
INSERT INTO `experiences` (`id`, `title`, `title_ar`, `organization`, `organization_ar`, `location`, `location_ar`, `start_date`, `end_date`, `is_current`, `description`, `description_ar`, `type`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Faculty of Electronic Engineering', 'كلية الهندسة الإلكترونية', 'Menoufia University', 'جامعة المنوفية', 'Menoufia, Egypt', 'المنوفية، مصر', '2020-09-01', '2025-06-30', 0,
'Studying Electronic & Computer Engineering with emphasis on algorithms, data structures, mobile computing, and software engineering.',
'دراسة هندسة الإلكترونيات وهندسة الحاسبات مع التركيز الأكاديمي على الخوارزميات، وهياكل البيانات، وحوسبة وبرمجيات وتطبيقات الموبايل.',
'education', 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),

(2, 'Flutter Development Intern', 'متدرب تطوير تطبيقات فلاتر', 'Acme Integrated Engineering System (IES)', 'شركة Acme Integrated Engineering System (IES)', 'Cairo, Egypt', 'القاهرة، مصر', '2025-09-01', '2025-11-30', 0,
'Developed production-grade Flutter features, handled REST API integration, state management, and applied clean architecture standards.',
'تطوير مميزات برمجية حقيقية لتطبيقات فلاتر، والربط الاحترافي مع واجهات REST APIs، وإدارة الحالة (State Management)، وتطبيق معايير المعمارية النظيفة Clean Architecture.',
'work', 2, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),

(3, 'Flutter Development Intern', 'متدرب تطوير تطبيقات فلاتر', 'PureSoft', 'شركة بيور سوفت (PureSoft)', 'Shebin El-Kom, Egypt', 'شبين الكوم، مصر', '2025-08-01', '2025-09-30', 0,
'Contributed to building cross-platform Flutter applications, responsive UI implementations, local caching, and bug fixing.',
'المساهمة في بناء تطبيقات فلاتر لعدة منصات، وتصميم واجهات متجاوبة، واستخدام التخزين المحلي، وحل المشكلات البرمجية والأخطاء التقنية.',
'work', 3, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),

(4, 'UI/UX Training Program', 'برنامج تدريب تصميم واجهات وتجربة المستخدم (UI/UX)', 'Information Technology Institute (ITI)', 'معهد تكنولوجيا المعلومات (ITI)', 'Shebin El-Kom, Egypt', 'شبين الكوم، مصر', '2024-07-01', '2024-08-31', 0,
'Intensive professional training in user experience research, wireframing, interactive prototyping, and design systems using Figma.',
'تدريب احترافي مكثف في أبحاث تجربة المستخدم (UX Research)، وتخطيط الهياكل السلكية (Wireframing)، وبناء النماذج التفاعلية، وتطبيق أنظمة التصميم باستخدام Figma.',
'work', 4, '2026-11-23 10:53:03', '2026-11-24 10:35:00');

-- ------------------------------------------------------------
-- 5. إدخال المهارات التقنية وتصنيفاتها باللغتين
-- ------------------------------------------------------------
INSERT INTO `skills` (`id`, `name`, `category`, `category_ar`, `level`, `icon`, `sort_order`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 'Clean Architecture', 'Frameworks & Architecture', 'المعمارية والأنماط الهيكلية', 90, 'layers', 1, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(2, 'MVVM', 'Frameworks & Architecture', 'المعمارية والأنماط الهيكلية', 90, 'architecture', 2, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(3, 'MVC', 'Frameworks & Architecture', 'المعمارية والأنماط الهيكلية', 85, 'diagram-project', 3, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(4, 'Flutter Apps', 'Mobile Development', 'تطوير تطبيقات الموبايل', 95, 'flutter', 4, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(5, 'Responsive & Adaptive Design', 'Mobile Development', 'تطوير تطبيقات الموبايل', 90, 'mobile-screen-button', 5, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(6, 'Bloc', 'Mobile Development', 'تطوير تطبيقات الموبايل', 90, 'cubes', 6, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(7, 'Cubit', 'Mobile Development', 'تطوير تطبيقات الموبايل', 90, 'cube', 7, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(8, 'GetX', 'Mobile Development', 'تطوير تطبيقات الموبايل', 85, 'bolt', 8, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(9, 'Provider', 'Mobile Development', 'تطوير تطبيقات الموبايل', 85, 'share-nodes', 9, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(10, 'REST APIs (Dio & Http)', 'API & Backend Integration', 'الربط البرمجي والـ APIs', 90, 'network-wired', 10, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(11, 'Firebase Authentication', 'API & Backend Integration', 'الربط البرمجي والـ APIs', 85, 'fire', 11, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(12, 'Cloud Firestore', 'API & Backend Integration', 'الربط البرمجي والـ APIs', 85, 'database', 12, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(13, 'Local Storage (Hive, SharedPreferences, Sqflite)', 'API & Backend Integration', 'الربط البرمجي والـ APIs', 88, 'hard-drive', 13, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(14, 'Postman', 'API & Backend Integration', 'الربط البرمجي والـ APIs', 85, 'paper-plane', 14, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(15, 'Google Maps', 'Hardware & Device Features', 'خصائص ومستشعرات الجهاز', 85, 'map-location-dot', 15, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(16, 'Location Services', 'Hardware & Device Features', 'خصائص ومستشعرات الجهاز', 85, 'location-crosshairs', 16, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(17, 'Push Notifications (FCM)', 'Hardware & Device Features', 'خصائص ومستشعرات الجهاز', 85, 'bell', 17, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(18, 'Visual Studio Code', 'Tools & Platforms', 'أدوات وبيئات التطوير', 95, 'code', 18, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(19, 'Android Studio', 'Tools & Platforms', 'أدوات وبيئات التطوير', 90, 'android', 19, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(20, 'Git', 'Tools & Platforms', 'أدوات وبيئات التطوير', 90, 'code-branch', 20, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(21, 'GitHub', 'Tools & Platforms', 'أدوات وبيئات التطوير', 90, 'github', 21, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(22, 'Dart', 'Programming Languages', 'لغات البرمجة', 95, 'terminal', 22, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(23, 'Java', 'Programming Languages', 'لغات البرمجة', 80, 'java', 23, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(24, 'C++', 'Programming Languages', 'لغات البرمجة', 75, 'microchip', 24, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(25, 'Python', 'Programming Languages', 'لغات البرمجة', 70, 'python', 25, 0, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),
(26, 'Stripe Payment', 'Payment Integration', 'بوابات الدفع الإلكتروني', 85, 'credit-card', 26, 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00');

-- ------------------------------------------------------------
-- 6. إدخال خطوات العمل ومنهجية التطوير (Work Processes)
-- ------------------------------------------------------------
INSERT INTO `work_processes` (`id`, `title`, `title_ar`, `description`, `description_ar`, `icon`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Requirement Gathering & Analysis', 'جمع المتطلبات والتحليل',
'Understanding the app scope, target audience, business goals, and outlining technical architecture and user stories.',
'فهم نطاق التطبيق والجمهور المستهدف وأهداف العمل، ورسم المعمارية التقنية ومسارات المستخدم بدقة.',
'search', 1, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),

(2, 'UI/UX & Wireframing', 'تصميم واجهات وتجربة المستخدم',
'Designing intuitive, modern user interfaces with responsive layouts following Material Design and iOS guidelines.',
'تصميم واجهات مستخدم تفاعلية وعصرية متجاوبة ومتوافقة تماماً مع معايير Material Design وإرشادات iOS.',
'design_services', 2, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),

(3, 'Clean Architecture & Core Development', 'بناء المعمارية النظيفة والتطوير',
'Writing robust Dart & Flutter code with separation of concerns: presentation, domain, and data layers using Bloc/Cubit.',
'كتابة كود فلاتر قوي بفصل المسؤوليات: طبقة العرض (UI)، وطبقة الـ Domain، وطبقة البيانات مع Bloc و Cubit.',
'architecture', 3, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),

(4, 'API Integration & Local Storage', 'الربط البرمجي والتخزين المحلي',
'Integrating RESTful endpoints, Firebase backends, caching mechanisms with Hive/Sqflite, and secure tokens.',
'ربط واجهات الـ RESTful وخدمات Firebase، وتفعيل التخزين المؤقت عبر Hive/Sqflite وحماية جلسات المستخدم.',
'api', 4, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),

(5, 'Testing & Quality Assurance', 'الاختبار وضمان الجودة',
'Testing across multiple device sizes, edge cases, responsiveness, offline modes, and performance profiling.',
'اختبار التطبيق على مختلف أحجام الشاشات، ومعالجة الحالات الخاصة، والعمل في وضع عدم الاتصال، وتحسين سرعة الأداء.',
'bug_report', 5, '2026-11-23 10:53:03', '2026-11-24 10:35:00'),

(6, 'Deployment & Continuous Support', 'الإطلاق والنشر والمتابعة',
'Building optimized APK/AAB release bundles, App Store/Play Store readiness, documentation, and maintenance.',
'بناء حزم APK و AAB مجهزة للمتاجر الرسمية، والتوثيق البرمجي الكامل، وتقديم الدعم والصيانة المستمرة.',
'rocket_launch', 6, '2026-11-23 10:53:03', '2026-11-24 10:35:00');

-- ------------------------------------------------------------
-- 7. إدخال بيانات المشاريع الرئيسية (عربي + إنجليزي)
-- ------------------------------------------------------------
INSERT INTO `projects` (`id`, `name`, `name_ar`, `slug`, `description`, `description_ar`, `short_description`, `short_description_ar`, `cover_image`, `github_url`, `app_url`, `is_featured`, `sort_order`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Circle', 'سيركل (Circle)', 'circle',
'A modern e-commerce application that enables users to browse products, manage carts, track orders, and complete secure payments.',
'تطبيق تجارة إلكترونية متطور يتيح للمستخدمين تصفح المنتجات بمختلف أقسامها، وإدارة سلة المشتريات، وتتبع مسار الطلبات لحظياً، وإتمام عمليات الدفع بأمان وسهولة.',
'Full-featured e-commerce app with cart, orders, payments, and location tracking.',
'تطبيق متجر إلكتروني متكامل يحتوي على سلة التسوق، وتتبع الطلبات، والدفع الإلكتروني، وتحديد الموقع.',
'projects/covers/circle.webp', 'https://github.com/ahmedAdelElmelegy/circle', 'https://drive.google.com/drive/folders/1YXjEpk_U1PD__ukwibCRFM0QAIcBbsxR?usp=drive_link', 1, 1, '2026-11-23 12:16:11', '2026-11-23 10:53:03', '2026-11-24 10:35:00'),

(2, 'Nurse Bot', 'نيرس بوت (Nurse Bot)', 'nurse-bot',
'An AI-powered application that summarizes books and answers user questions using an intelligent chatbot.',
'تطبيق يعتمد على الذكاء الاصطناعي لتلخيص الكتب الطبية والعلمية والإجابة على أسئلة المستخدمين بدقة وسرعة من خلال شات بوت تفاعلي ذكي.',
'AI chatbot app with book summarization powered by Gemini API.',
'تطبيق شات بوت ذكي لتلخيص الكتب والإجابة على الاستفسارات مدعوم بـ Gemini AI.',
'projects/covers/nurse-bot.webp', 'https://github.com/ahmedAdelElmelegy/nurse-bot', 'https://github.com/ahmedAdelElmelegy/nurse-bot', 1, 2, '2026-11-23 12:16:11', '2026-11-23 10:53:03', '2026-11-24 10:35:00'),

(3, 'Al Huda', 'الهدى (Al Huda)', 'al-huda',
'An Islamic guidance application providing accurate prayer times, Quran access, reminders, and location-based services.',
'تطبيق إسلامي متكامل يقدم مواقيت صلاة دقيقة، وتلاوة القرآن الكريم وتصفحه، وإشعارات الأذكار، وتحديد اتجاه القبلة والمساجد القريبة عبر الخرائط.',
'Islamic app with prayer times, Quran reader, Azkar, and mosque location.',
'تطبيق إسلامي شامل لمواقيت الصلاة، وقراءة القرآن، والأذكار، وتحديد أقرب المساجد.',
'projects/covers/al-huda.webp', 'https://github.com/ahmedAdelElmelegy/Al-Huda', 'https://drive.google.com/drive/folders/1_kftNvH6CxjfBcckoT3TaeMhODjR5wgc?usp=drive_link', 1, 3, '2026-11-23 12:16:11', '2026-11-23 10:53:03', '2026-11-24 10:35:00'),

(4, 'BMI Tracker', 'حاسبة مؤشر كتلة الجسم (BMI Tracker)', 'bmi-tracker',
'A lightweight BMI calculator app that calculates body mass index based on user input with a clean UI.',
'تطبيق خفيف وسريع لحساب مؤشر كتلة الجسم (BMI) بدقة وتحديد الوزن المثالي وتقديم إرشادات صحية بتصميم جذاب وبسيط ومريح للعين.',
'BMI calculator with real-time calculation, health tips, and responsive design.',
'تطبيق لحساب مؤشر كتلة الجسم لحظياً مع نصائح صحية وواجهة متجاوبة.',
'projects/covers/bmi-tracker.webp', 'https://github.com/ahmedAdelElmelegy/Bmi_calculator', 'https://drive.google.com/drive/folders/1DGskNTvXAF3rn5iAlbhXPP6_fDmHMcHc?usp=drive_link', 0, 4, '2026-11-23 12:16:11', '2026-11-23 10:53:03', '2026-11-24 10:35:00');

-- ------------------------------------------------------------
-- 8. إدخال مميزات المشاريع (عربي + إنجليزي)
-- ------------------------------------------------------------
INSERT INTO `project_features` (`id`, `project_id`, `description`, `description_ar`, `sort_order`, `created_at`, `updated_at`) VALUES
(51, 1, 'Product listing & categories', 'عرض وتصنيف المنتجات والأقسام بسهولة', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(52, 1, 'Shopping cart management', 'إدارة سلة التسوق والكميات والأسعار الإجمالية', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(53, 1, 'Order tracking', 'تتبع حالة الشحن والطلبات لحظة بلحظة', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(54, 1, 'Payment processing', 'إتمام الدفع الإلكتروني الآمن عبر Stripe', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(55, 1, 'User authentication & profile', 'تسجيل الدخول وإدارة الحساب والبيانات الشخصية', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(56, 1, 'Location tracking', 'تحديد الموقع الجغرافي وتوصيل الطلبات بدقة', 6, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(57, 1, 'Multi-language support', 'دعم كامل للغتين العربية والإنجليزية', 7, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(58, 1, 'Clean architecture & scalable code', 'بناء الكود بمعمارية نظيفة قابلة للتوسع والصيانة', 8, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),

(59, 2, 'Chatbot for Q&A', 'محادثة ذكية وسريعة للإجابة على التساؤلات', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(60, 2, 'AI-powered book summarization', 'تلخيص الكتب والوثائق باستخدام تقنيات الذكاء الاصطناعي', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(61, 2, 'Interactive chatbot for Q&A', 'إجابات تفاعلية متخصصة وفورية', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(62, 2, 'User-friendly interface', 'واجهة سهلة وسلسة الاستخدام', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(63, 2, 'Book links', 'روابط مباشرة للوصول إلى الكتب والملفات', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(64, 2, 'Quotes', 'استخراج الاقتباسات الهامة والنقاط الجوهرية', 6, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(65, 2, 'Offline reading support', 'دعم حفظ الملخصات واستعراضها بدون إنترنت', 7, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(66, 2, 'Clean & responsive UI', 'واجهة عصرية متوافقة مع مختلف الشاشات', 8, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),

(67, 3, 'Accurate prayer times & alerts', 'مواقيت صلاة دقيقة مع تنبيهات الأذان', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(68, 3, 'Quran reading & audio playback', 'تلاوة وقراءة آيات القرآن الكريم بجودة عالية', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(69, 3, 'Adjustable Quran font size', 'التحكم في حجم خط المصحف لراحة القراءة', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(70, 3, 'Quran reader with bookmarks', 'قارئ قرآن مع ميزة حفظ العلامات المرجعية', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(71, 3, 'Doaa & supplications', 'أدعية نبوية ومأثورة مصنفة', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(72, 3, 'Azkar for morning & evening with notifications', 'أذكار الصباح والمساء مع إشعارات دورية تذكيرية', 6, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(73, 3, 'Digital Sebha (tasbeeh counter)', 'سبحة إلكترونية رقمية مع سجل التسبيح', 7, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(74, 3, 'Asmaa Allah al-Husna (99 Names)', 'أسماء الله الحسنى كاملة مع شروح ميسرة', 8, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(75, 3, 'Mosque location tracking', 'تحديد أماكن أقرب المساجد عبر الخريطة والـ GPS', 9, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(76, 3, 'Smart reminders & notifications', 'تنبيهات ذكية للعبادات والسنن', 10, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(77, 3, 'Multi-language support', 'دعم اللغتين العربية والإنجليزية', 11, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(78, 3, 'Offline access for Quran & prayers', 'العمل الكامل بدون الحاجة لإنترنت', 12, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),

(79, 4, 'Real-time BMI calculation', 'حساب مؤشر كتلة الجسم لحظياً وبدقة', 1, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(80, 4, 'User-friendly interface', 'واجهة استخدام واضحة ومبسطة', 2, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(81, 4, 'Responsive design for mobile & tablet', 'تصميم متجاوب للموبايل والأجهزة اللوحية', 3, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(82, 4, 'Health tips & category guidance', 'إرشادات ونصائح صحية حسب الفئة الوزنية', 4, '2026-11-23 12:16:11', '2026-11-23 12:16:11'),
(83, 4, 'MVVM Architecture & maintainable code', 'معمارية برمجية MVVM منظمة وعالية الأداء', 5, '2026-11-23 12:16:11', '2026-11-23 12:16:11');

-- ------------------------------------------------------------
-- 9. إدخال تقنيات المشاريع
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

-- ------------------------------------------------------------
-- 10. تحديث قسم الفيديو التفاعلي (عربي + إنجليزي)
-- ------------------------------------------------------------
UPDATE `video_sections` SET
    `badge_ar` = 'عرض تفاعلي',
    `title_ar` = 'تعرف علي وتواصل معي مباشرة',
    `subtitle_ar` = 'شاهد هذا العرض التفاعلي السريع لمعرفة مسيرتي المهنية وأبرز أعمالي وقنوات التواصل المباشرة.'
WHERE `id` = 1;

UPDATE `video_content_items` SET `title_ar` = 'حساب GitHub الرسمي', `value_ar` = 'مستودعات الأكواد مفتوحة المصدر' WHERE `id` = 1;
UPDATE `video_content_items` SET `title_ar` = 'الملف الشخصي على LinkedIn', `value_ar` = 'تواصل مهني وشبكة علاقات' WHERE `id` = 2;
UPDATE `video_content_items` SET `title_ar` = 'المحادثة عبر WhatsApp', `value_ar` = '01069371116' WHERE `id` = 3;
UPDATE `video_content_items` SET `title_ar` = 'مراسلة عبر البريد الإلكتروني', `value_ar` = 'ahmedadelelmelegy2@gmail.com' WHERE `id` = 4;

SET FOREIGN_KEY_CHECKS = 1;