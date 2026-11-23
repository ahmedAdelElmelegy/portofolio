---
description: Review code or a diff against the project's Laravel standards. Review only; do not modify code.
---

# /code-review

Target: the files, feature, or diff the user names (default: uncommitted changes / current branch vs main).

Read `AGENTS.md` and the rules relevant to the changed files.

## Review areas

1. **Correctness** vs requirements and edge cases (empty, null, concurrency, soft-deleted rows).
2. **Architecture:** thin controllers, FormRequests, service/action boundaries, no logic in Blade/routes.
3. **Database:** migrations safety, constraints, indexes, N+1, unbounded queries, transactions.
4. **Security:** authorization on every route, IDOR, mass assignment, XSS, uploads, CSRF, rate limits, secrets.
5. **Blade/UI:** components reuse, states (loading/empty/error), accessibility, RTL/responsive.
6. **Clean code:** naming, size, types, duplication, dead code, leftover debug code.
7. **Tests:** coverage of happy path, validation, authorization; flaky or weak assertions.
8. **Performance & maintainability** risks.

## Rules

- Report only actionable findings backed by the code. Cite file and line.
- For each finding: severity (Critical/High/Medium/Low), impact, and a concrete fix.
- Separate **confirmed bugs**, **potential risks**, and **style preferences**.
- Do not request broad refactors without a clear benefit.

## Output

1. Critical / High findings.
2. Medium / Low findings.
3. Missing tests.
4. What is done well.
5. Prioritized fix list. Offer to apply fixes only after the user approves.
