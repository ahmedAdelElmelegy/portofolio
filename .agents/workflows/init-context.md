---
description: Inspect the repository and fill project-context.md and project-conventions.md with verified facts.
---

# /init-context

Goal: replace the TODO placeholders in `.agents/rules/project-context.md` and `.agents/rules/project-conventions.md` with **verified** facts. Do not modify any application code.

## Steps

1. Read `composer.json` (Laravel/PHP versions, packages), `package.json`, `.env.example`, `config/database.php`, `config/app.php` (locale), `vite.config.js`, `tailwind.config.js`.
2. Inspect `routes/` (web/admin/api files, naming, middleware groups) and `app/` (Controllers, Requests, Services, Actions, Policies, Models, Enums, Observers).
3. Inspect `resources/views/` (layouts, components namespace, admin vs public) and `lang/`.
4. Inspect `database/migrations/` (naming, FK style, soft deletes, enums), factories, and seeders.
5. Inspect `tests/` (Pest or PHPUnit, helpers, DB used) and quality tooling (`pint.json`, `phpstan.neon`, CI files).
6. Open one simple CRUD module end-to-end (route → controller → request → view → test) and record its pattern.
7. Fill both files. Keep each under ~40 lines. Use facts only; write `unknown` where something cannot be verified.
8. Report any mismatch between the generic rules and the real codebase, with a recommendation for each.

## Output

- The two updated files.
- A short list of mismatches and risks.
- Questions for the owner that block correct future work (max 5).
