---
description: Diagnose and fix a bug methodically: reproduce, isolate, fix with a regression test.
---

# /debug

Provide: expected vs actual behavior, steps to reproduce, error message/stack trace, and the environment (local/staging/production).

## Steps

1. **Reproduce.** Confirm the failure (run the route/test/command). If it cannot be reproduced, say what is missing.
2. **Gather evidence:** `storage/logs/laravel.log`, the exact exception and stack trace, `php artisan route:list`, `php artisan about`, relevant config and `.env.example` keys, recent git changes (`git log`, `git diff`).
3. **Form hypotheses** ranked by likelihood; test them with the cheapest evidence first (logging, tinker, a failing test, query log via `DB::listen`). Do not change code on a guess.
4. **Identify the root cause**, not just the symptom. Explain it in plain words.
5. **Write a failing test** that captures the bug (see the testing rule).
6. **Fix minimally** in the right layer. Do not refactor unrelated code.
7. **Verify:** the new test passes, the full suite passes, and the original manual scenario works. Remove temporary logging.
8. **Report:** root cause, the fix, tests added, how it was verified, and how to prevent recurrence (a rule, a validation, an index, a constraint).

## Common Laravel suspects

Config/route/view cache stale (`php artisan optimize:clear`), missing `storage:link`, wrong `APP_URL`, mass-assignment (`$fillable`), N+1 or lazy-loading exceptions, validation/unique rule on update, policy not registered, middleware order, queue worker not running or running old code, file permissions on `storage/` and `bootstrap/cache`.
