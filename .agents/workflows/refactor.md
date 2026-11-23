---
description: Safely refactor code while preserving behavior, with tests as the safety net.
---

# /refactor

Provide: the target (file/class/module) and the goal (readability, remove duplication, split a fat controller, etc.).

## Steps

1. **Understand:** read the code, its callers, routes, views, and tests. List the observable behavior that must not change.
2. **Safety net:** run existing tests. If coverage is missing for the area, add characterization tests first (confirm they pass on the current code).
3. **Plan:** small, ordered steps (e.g. extract FormRequest → extract Service → slim controller → extract Blade component). State the benefit of each; skip steps without one.
4. **Execute step by step.** After each step run the relevant tests and Pint. Keep commits/diffs reviewable.
5. **Verify:** full `php artisan test`; static analysis; check routes (`php artisan route:list`) and affected views manually if no test covers them.
6. **Report:** before/after structure, behavior-preservation evidence, anything intentionally left alone.

## Guardrails

- No behavior changes mixed with refactoring. If a bug is found, report it separately.
- No public API/route/name changes unless required and called out.
- Do not introduce patterns (repositories, DTOs, interfaces) without a concrete payoff.
