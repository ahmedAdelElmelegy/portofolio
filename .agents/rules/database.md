---
trigger: glob
globs: "database/**/*.php, app/Models/**/*.php"
description: Database design, migrations, Eloquent usage, indexing, and query performance for Laravel.
---

# Database & Eloquent Standard

Always read the real schema (migrations, `php artisan db:table`, or `schema:dump`) before changing it. Never assume a column or index exists.

## 1. Schema design

- **Tables:** plural snake_case (`project_images`). **Columns:** snake_case, singular, descriptive.
- **Primary key:** `id()` (bigint) by default. Use ULID/UUID only when IDs are exposed publicly and guessability matters (`ulid()` / `HasUlids`).
- **Foreign keys:** `foreignId('user_id')->constrained()->cascadeOnDelete()` (or `restrictOnDelete()` / `nullOnDelete()`). Choose the delete behavior deliberately and state why.
- **Pivot tables:** singular model names in alphabetical order (`project_skill`), composite unique key on both FKs, extra columns only when needed.
- **Booleans:** `is_` / `has_` prefix (`is_featured`). **Timestamps:** `*_at` suffix (`published_at`).
- **Money:** store integer minor units (`price_cents`) or `decimal(12,2)`. Never `float`.
- **Status/type fields:** `string` column + backed PHP enum (not DB `enum`, which is painful to alter). Add `index()` if filtered.
- **JSON columns:** only for genuinely schemaless data (settings, metadata). Anything you filter/sort/join on gets real columns.
- **Ordering:** `sort_order` unsigned integer when users reorder records.
- **Slugs:** `string('slug')->unique()` for public URLs; generate server-side.
- **Soft deletes:** use `softDeletes()` for user-facing content that may need recovery; remember unique indexes interact with soft-deleted rows.
- **Nullability:** columns are `NOT NULL` unless "unknown/absent" is a real state. Give sensible `default()`s.
- **Charset:** `utf8mb4` for MySQL/MariaDB (Arabic/emoji safe).
- **Polymorphic relations:** avoid unless the use case is clear (comments, media); they cannot have real FK constraints.

## 2. Indexes

- Index every column used in `WHERE`, `ORDER BY`, `JOIN`, or uniqueness on tables that will grow.
- Use composite indexes in the order **equality columns first, then range/sort column** (`['status', 'published_at']`).
- Do not index low-selectivity booleans alone; do not add speculative indexes "just in case".
- Unique constraints belong in the **database** *and* in validation (validation for UX, DB for truth).

## 3. Migrations

- One logical change per migration; descriptive file names (`add_sort_order_to_projects_table`).
- Always implement `down()` so rollback works.
- **Never edit a migration that has been committed to a shared branch or deployed.** Create a new migration.
- Schema changes and data backfills are **separate** migrations (or a seeder/command). Never put heavy data work in a schema migration.
- On large tables, avoid operations that lock for long; add nullable columns first, backfill, then tighten.
- Test with `php artisan migrate:fresh --seed` and `migrate:rollback` before finishing.
- If SQLite is used for tests, avoid vendor-specific column modifiers that SQLite cannot run, or document the limitation.

## 4. Models

- Declare `$fillable` explicitly. `$guarded = []` is forbidden.
- Use `casts()` (or `$casts` on older Laravel) for booleans, dates, enums, arrays/JSON, and encrypted attributes.
- Define **both sides** of relationships with return types (`HasMany`, `BelongsTo`, …).
- Put reusable filters in local scopes (`scopePublished`, `scopeFeatured`, `scopeOrdered`).
- Use `Attribute::make()` accessors for derived values (`full_name`, `cover_url`) instead of repeating logic in views.
- Use `HasFactory` and write a factory for every model.

## 5. Querying

- **Eager load** relations used in views: `with('category', 'tags')`. Use `withCount`, `withExists`, `withSum` instead of loading rows to count them.
- In non-production, enable `Model::preventLazyLoading(! app()->isProduction())` (and consider `Model::shouldBeStrict()`) in `AppServiceProvider::boot()` to catch N+1 queries early.
- **Select only needed columns** on large tables / list pages: `select('id','title','slug')`.
- **Paginate** every list (`paginate()` / `simplePaginate()`); never `->get()` an unbounded table to render a page.
- Use `chunkById()` / `lazyById()` / `cursor()` for batch jobs.
- Prefer Eloquent/query builder with bindings. If raw SQL is unavoidable, use bindings (`whereRaw('col = ?', [$v])`) — never string concatenation.
- Use `firstOrFail()` / route model binding for single records so missing data returns 404.
- Use `DB::transaction()` for multi-statement writes; use `lockForUpdate()` when concurrent updates matter.
- Avoid queries inside loops and inside Blade views.
- Use `updateOrCreate` / `upsert` for idempotent writes; `exists()` instead of `count() > 0`.

## 6. Factories & seeders

- Factories produce **valid, realistic** data (use `fake()`); states for variations (`->published()`).
- `DatabaseSeeder` calls focused seeders. Production-critical seed data (roles, default settings) must be idempotent (`updateOrCreate`).
- Never seed real passwords/secrets; read from env or generate.

## 7. Schema review checklist

- [ ] Every FK constrained with a deliberate on-delete rule.
- [ ] Every filtered/sorted/joined column indexed appropriately.
- [ ] Unique business keys enforced at DB level.
- [ ] Correct types (no float money, no string dates).
- [ ] Nullability and defaults justified.
- [ ] `down()` works; fresh migrate + seed works.
- [ ] Factory + seeder + model `$fillable`/casts/relations updated.
