---
trigger: always_on
description: Project-specific facts for the Portfolio project.
---

# Project Context — Personal Portfolio

- **Project name:** Portfolio Backend & API
- **Purpose / users:** Portfolio backend and RESTful API for personal portfolio (consumed by web / Flutter mobile app) + protected management endpoints for admin.
- **Laravel / PHP version:** Laravel 12.0 (`^12.0`), PHP `^8.2`
- **Auth approach:** Laravel Sanctum (`laravel/sanctum ^4.0`) with Bearer token authentication via `AuthController`.
- **Database engine:** MySQL (`database: portfolio`, host: `127.0.0.1:3306`)
- **Frontend / API:** RESTful JSON API (`routes/api.php`) + optional Blade admin / public views.
- **Locales / RTL:** Default English (`APP_LOCALE=en`), Arabic/English content.
- **Areas:** Public API endpoints (`GET /api/projects`, `/api/skills`, `/api/experiences`, `/api/education`, `/api/profiles`, `POST /api/contact-messages`) and Protected Admin API endpoints (`auth:sanctum`).
- **Roles & permissions:** Token-authenticated admin via Sanctum.
- **Key modules:** Profiles, Projects (with multi-image upload `project_images`), Skills, Experiences, Education, Contact Messages, Authentication.
- **Hosting / deploy:** Local development (XAMPP MySQL + `php artisan serve`).
- **Mail / queue / cache / storage drivers:** Queue: `database`, Cache: `database`, Session: `database`, Mail: `log`, Storage: `public` disk (`storage:link`).
- **Notable packages:** `laravel/sanctum`, `laravel/pint`, `laravel/pail`, `laravel/sail`, `phpunit/phpunit`.
