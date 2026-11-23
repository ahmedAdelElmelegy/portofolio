---
description: Set up a fresh Laravel + Blade project with the standard tooling and baseline structure.
---

# /bootstrap-project

Use on a **new** project (or one missing the tooling). Confirm each step with the user before running destructive or dependency-adding commands. Report real command output.

## Steps

1. Verify PHP, Composer, Node, and the database are available (`php -v`, `composer -V`, `node -v`).
2. Create/confirm the Laravel app; copy `.env.example` → `.env`; `php artisan key:generate`; configure DB and run `php artisan migrate`.
3. Authentication: install **Laravel Breeze (Blade stack)** unless the project specifies otherwise. Review the generated routes/views before building on them.
4. Frontend: confirm Tailwind + Vite build (`npm install && npm run build`). Add Alpine only if not already present.
5. Quality tooling:
   - Laravel Pint (`composer require laravel/pint --dev`) — run `./vendor/bin/pint`.
   - Larastan (`composer require larastan/larastan --dev`) with a `phpstan.neon` starting at a realistic level (e.g. 5) and a plan to raise it.
   - Pest (`composer require pestphp/pest pestphp/pest-plugin-laravel --dev`) if the project does not already use PHPUnit.
6. `AppServiceProvider::boot()`: enable `Model::preventLazyLoading(! app()->isProduction())`, and optionally `Model::shouldBeStrict(! app()->isProduction())`, and `Password::defaults()`.
7. Create the layout skeleton: `layouts/app`, `layouts/admin`, UI components folder, flash/alert component (see skill `admin-dashboard`).
8. Add `.gitignore` sanity checks (`.env`, `storage` links, `node_modules`, `vendor`).
9. Create `lang/` structure if multilingual/RTL is required.
10. Run `/init-context`.
11. Commit baseline. Run `php artisan test` and report results.

## Output

A checklist of what was installed/configured, commands run with results, and next recommended modules.
