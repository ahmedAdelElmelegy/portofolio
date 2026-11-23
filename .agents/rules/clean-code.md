---
trigger: glob
globs: "**/*.php"
description: PHP and Laravel clean-code standards: style, typing, naming, structure, and maintainability.
---

# Clean Code Standard

## 1. Style & tooling

- Follow **PSR-12** via **Laravel Pint** (`./vendor/bin/pint`). Run it on changed files; never hand-format against Pint.
- If Larastan/PHPStan is installed, run `./vendor/bin/phpstan analyse` and do not add new baseline entries to hide errors.
- Do not mix formatting-only changes into feature diffs.

## 2. Types & modern PHP

- Add parameter, return, and property types everywhere. Avoid `mixed` unless truly required.
- Use constructor property promotion, `readonly` where appropriate, and **backed enums** instead of magic strings/ints.
- Use `match` over long `if/elseif` chains on one value; use null-safe `?->` and `??` sensibly.
- `declare(strict_types=1);` — follow the project convention; if the project uses it, add it to new files.
- Prefer value objects/enums/DTOs over associative arrays for structured data passed between layers.

## 3. Naming

- Intention-revealing names; no abbreviations except universal ones (`id`, `url`).
- Methods are verbs (`publish()`, `syncSkills()`); booleans read as questions (`isPublished`, `hasImages`, `canEdit`).
- Collections are plural (`$projects`), single items singular (`$project`).
- No generic dumping names: `Helper`, `Manager`, `Utils`, `Data`, `Handler` without a clear domain.

## 4. Functions & classes

- One reason to change per class. Flag methods > ~30 lines, classes > ~300 lines, and > 3–4 parameters (introduce a DTO/value object).
- **Early returns / guard clauses** to avoid deep nesting (max ~2–3 levels).
- No flag arguments that switch behavior; split into two methods.
- Avoid side effects in getters/accessors and in constructors.
- Prefer composition over inheritance; avoid deep inheritance trees and "god" base classes.
- Prefer dependency injection over static calls in services (facades are fine in controllers, routes, and framework glue).

## 5. Comments & documentation

- Code should explain **what**; comments explain **why** (constraints, trade-offs, workarounds).
- No commented-out code, no `TODO` without context/owner, no stale comments.
- PHPDoc only where types cannot be expressed natively (generics like `Collection<int, Project>`, array shapes).

## 6. Constants & configuration

- No magic numbers/strings: use enums, class constants, or config values.
- Business-tunable values (page sizes, limits) live in `config/` with env overrides.

## 7. Error handling

- Fail fast with clear exceptions; use custom exceptions for domain failures.
- No empty `catch`. No `@` suppression operator.
- Return types express absence (`?Project`) rather than sentinel values like `false`/`-1`.

## 8. DRY with judgment

- Extract duplication when the **same reason to change** exists. Do not merge code that only looks similar.
- Three similar occurrences is the signal to abstract; two is often fine.
- Do not build generic frameworks for a single use case (YAGNI).

## 9. Imports & structure

- One class per file; namespace matches path. Alphabetical `use` statements (Pint handles it); no unused imports.
- Keep controllers/models/services in their conventional folders unless the project defines otherwise.

## 10. Before finishing

- [ ] No `dd`, `dump`, `var_dump`, `ray`, `console.log`, leftover test routes.
- [ ] No unused variables, methods, imports, or files introduced by your change.
- [ ] Names and structure match neighboring code.
- [ ] Pint run; static analysis run if available.
