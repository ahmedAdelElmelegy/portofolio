# Project Setup Checklist

Complete once per repository before substantial AI-assisted development. Fastest path: run the `/init-context` workflow and review its output, then use this list to fill gaps.

## 1. Identity
- Project name / purpose / target users:
- Public site, admin dashboard, API, or all:
- Languages (and RTL?):
- Hosting & deploy method:

## 2. Technical facts (verify in the repo)
- Laravel & PHP versions (`composer.json`):
- Database engine (`.env.example`, `config/database.php`):
- Auth package (Breeze / Fortify / Jetstream / custom):
- Roles & permissions approach:
- Frontend: Blade + Tailwind + Vite (+ Alpine?):
- Queue / cache / mail / storage drivers:
- Notable packages:

## 3. Actual structure
- Where do Services / Actions / Policies / Enums live?
- Route files and naming prefixes:
- Blade layouts and component namespaces:
- Lang files layout:

## 4. Quality tooling
- Pint config, Larastan level, Pest vs PHPUnit, CI:
- Test database (SQLite memory / MySQL):

## 5. Verify the instructions
Ask the AI:

> Run `/init-context`. Inspect this repository and report any mismatch between `AGENTS.md` / `.agents/` and the real codebase. Do not modify application code. Propose precise updates to `project-context.md` and `project-conventions.md`.

Review the report, then commit the updated files.

## 6. Before every feature, provide
- User story and acceptance criteria.
- Fields/data model (or "design it and show me first").
- Who can access it (roles).
- Design/screenshot for UI work.
- Edge cases: empty, error, permissions, large data.

Do not ask the AI to guess missing product decisions.
