---
description: Build a complete CRUD module (migration to tests) following the project's Laravel + Blade standards.
---

# /new-module

Provide: module name, fields (name, type, nullable, unique, default), relationships, who may access it, list-page needs (search/filter/sort), and any file uploads. If something is missing, ask **one** focused question or state assumptions.

Read the skill `crud-module` and the rules `architecture`, `database`, `blade-ui`, `security`, `testing` first. Inspect the closest existing module and copy its patterns.

## Steps

1. **Plan** (wait for approval if the module touches existing tables or auth): list tables/columns, relations, routes, files to create, policies, tests.
2. **Database:** migration (+ `down()`), model (`$fillable`, `casts()`, relations, scopes), enum(s), factory, seeder.
3. **Backend:** FormRequests (Store/Update), Policy (and registration if not auto-discovered), Service/Action *only if needed*, Controller, routes (named, grouped, with middleware).
4. **Frontend:** `index`, `create`, `edit`, `_form`, optional `show`; reuse table/alert/button components; empty state; pagination; confirm-delete.
5. **Navigation:** add the link to the admin sidebar behind `@can`.
6. **Tests:** happy path, validation, authorization (guest + unauthorized), file upload if applicable.
7. **Validate:** `php artisan migrate:fresh --seed`, `./vendor/bin/pint`, static analysis if configured, `php artisan test`.
8. **Report** using the final report format from `AGENTS.md`.

## Guardrails

- No N+1 on the index page (eager load what the view uses).
- No unrelated refactors. No new dependencies without justification.
