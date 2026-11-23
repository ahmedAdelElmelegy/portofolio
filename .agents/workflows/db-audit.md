---
description: Audit the database schema, migrations, models, and queries; report findings before changing anything.
---

# /db-audit

Review-only by default. Do **not** change files until the user approves specific fixes.

## Steps

1. Inventory: list all migrations, models, relationships, factories, and seeders. Dump the effective schema (`php artisan schema:dump` is not required; reading migrations or `php artisan db:table <name>` is enough).
2. For each table check:
   - Primary key, correct types (money, dates, booleans, statuses), nullability, defaults.
   - Foreign keys exist and have a deliberate on-delete rule; orphan risks.
   - Indexes cover real filter/sort/join patterns (search the code for `where`, `orderBy`, `join`, scopes); find missing and redundant indexes.
   - Unique constraints for business keys (slug, email, composite pivots); soft-delete interaction.
   - Naming consistency (snake_case, plural tables, `*_at`, `is_*`).
3. Models: `$fillable`/`$guarded`, casts, enum usage, relation definitions on both sides, scopes, `HasFactory`.
4. Query audit: grep for N+1 risks (relations accessed in loops/Blade without `with`), unbounded `->get()` / `all()`, queries in views, raw SQL, `count()` on collections.
5. Migration hygiene: missing `down()`, edited-after-deploy signs, data work inside schema migrations, fresh-migrate/rollback viability.
6. Seeders/factories: validity, idempotency of production seeders.

## Output

1. **Critical** (data loss, security, broken integrity) — with file/line.
2. **High** (performance, missing constraints/indexes).
3. **Medium / Low** (naming, consistency, cleanliness).
4. Proposed migrations (as a plan, not applied) in priority order, with risk notes (locking, backfill, rollback).
5. Questions that block a correct recommendation.

Separate confirmed issues from potential risks. Do not recommend a redesign without a concrete benefit.
