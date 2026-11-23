---
trigger: always_on
description: Project-specific conventions that override the generic rules.
---

# Project Conventions

- **Code layout:** Standard Laravel 12 structure. API controllers in `app/Http/Controllers/Api/`, Eloquent models in `app/Models/`, form requests in `app/Http/Requests/`, API resources in `app/Http/Resources/`, traits in `app/Traits/`.
- **Controller/route style:** RESTful API controllers extending `App\Http\Controllers\Controller`. Uses `App\Traits\ApiResponse` trait for consistent JSON output (`$this->successResponse($data, $message, $code)`). Routes defined in `routes/api.php` with route model binding.
- **Validation style:** Dedicated FormRequest classes for every write action (`Store[Model]Request`, `Update[Model]Request`). `$request->validated()` is used for mass assignment.
- **API Response style:** Wrapped in `ApiResponse` trait: `successResponse($data, $message, $statusCode)` returning `{status: true, data: ..., message: ...}`. Data transformed using Laravel Eloquent API Resources (`ProjectResource`, `SkillResource`, etc.).
- **File uploads:** Stored to `public` disk via `$request->file('...')->store('<folder>', 'public')` (e.g., `projects` folder). `ProjectImage` model handles multi-image relations.
- **Database conventions:** Plural snake_case table names (`project_images`, `contact_messages`), unsigned bigint primary keys (`id`), foreign keys using `foreignId()->constrained()`, timestamps enabled.
- **Testing:** PHPUnit 11 with SQLite in-memory or MySQL as configured in `phpunit.xml`.
- **Quality tools:** Laravel Pint (`./vendor/bin/pint`) for PSR-12 code styling.
