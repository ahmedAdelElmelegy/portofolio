---
trigger: model_decision
description: Apply when touching authentication, authorization, validation, forms, file uploads, user input, sessions, secrets, or anything exposed publicly.
---

# Security Standard

## 1. Authorization (the most-missed item)

- Every route that reads or writes protected data has **authentication** (`auth` middleware) **and authorization** (Policy via `$this->authorize()`, `Gate`, or `can:` middleware).
- Never trust IDs from the client: scope queries to the owner (`$request->user()->projects()->findOrFail($id)`) or authorize against the model (prevents **IDOR**).
- Admin areas: protect the whole route group with middleware, and check roles/permissions in policies — hiding a button in Blade is not security.

## 2. Validation & mass assignment

- Validate **all** input with FormRequests; persist only `$request->validated()`.
- Explicit `$fillable`; never `$guarded = []`; never `Model::create($request->all())`.
- Validate types, ranges, lengths, enum membership (`Rule::enum`), existence (`exists`), and uniqueness.
- Sensitive fields (`role`, `is_admin`, `user_id`, `status`) are never mass-assignable from user input.

## 3. Output & XSS

- Use `{{ }}` escaping. `{!! !!}` only for sanitized HTML (use an HTML purifier / allow-list for rich text).
- Do not put user data into inline `<script>`, `href="javascript:"`, or unescaped attributes.
- Set a sensible Content-Security-Policy where feasible.

## 4. CSRF, sessions, cookies

- `@csrf` on every state-changing form; keep `VerifyCsrfToken` exceptions minimal and justified.
- Production: `SESSION_SECURE_COOKIE=true`, `SESSION_HTTP_ONLY=true`, `SameSite=lax|strict`, `SESSION_DRIVER` appropriate for the host.
- Regenerate the session on login (Breeze/Fortify do this); invalidate on logout.

## 5. Authentication hygiene

- Use the framework's hashing (`Hash::make`, bcrypt/argon). Never roll your own crypto or store plaintext/reversible passwords.
- **Rate-limit** login, password reset, contact forms, and any public write endpoint (`throttle:5,1` or named `RateLimiter`).
- Add a honeypot field and/or captcha to public forms (contact, newsletter) to reduce spam.
- Require strong passwords (`Password::defaults()`); consider email verification and 2FA for admin accounts.

## 6. File uploads

- Validate with `file`, `image`, `mimes:`, `max:` (KB) and, for images, `dimensions:` when relevant. Never trust the client-provided extension/MIME alone.
- Store with generated names (`$file->store('dir', 'public')` / `Str::uuid()`); never use the original filename for the path.
- Never store uploads inside `app/` or executable directories; never allow `.php`, `.phtml`, `.svg` (unless sanitized), or HTML uploads to be served raw.
- Private documents go on a non-public disk and are served by an authorized controller (`Storage::download`, signed/temporary URLs).

## 7. Database & injection

- Query builder/Eloquent bind parameters automatically. For raw SQL always use bindings. Whitelist dynamic column names for sorting/filtering (`in_array($sort, ['title','created_at'], true)`).

## 8. Secrets & configuration

- Secrets only in `.env` (git-ignored) / host secret store; `.env.example` has keys but no values.
- Production: `APP_DEBUG=false`, `APP_ENV=production`, unique `APP_KEY`.
- Never log secrets, tokens, full request bodies with passwords, or personal data.
- Rotate any credential that was ever committed.

## 9. Redirects, URLs, and links

- Never redirect to a user-supplied URL without validating against an allow-list (open redirect).
- Use signed URLs (`URL::temporarySignedRoute`) for one-time or expiring links.
- External links with `target="_blank"` get `rel="noopener noreferrer"`.

## 10. Dependencies & deployment

- Run `composer audit` and `npm audit` periodically; keep Laravel and packages patched.
- HTTPS only; HSTS enabled by the host/reverse proxy.
- Disable directory listing; document root must be `public/`.
- Restrict Telescope/Debugbar/Horizon dashboards to local or authorized admins.

## 11. Review checklist

- [ ] Auth + policy on every new route.
- [ ] FormRequest validation; `validated()` only.
- [ ] No `{!! !!}` with user content.
- [ ] Uploads validated and stored safely.
- [ ] Public forms rate-limited + spam protected.
- [ ] No secrets or debug output committed.
