---
description: Pre-release checklist for Laravel apps: quality gates, security, configuration, and deployment steps.
---

# /pre-deploy

Run the checks, report real results, and list blockers. Do not deploy automatically.

## Quality gates

- [ ] `php artisan test` passes.
- [ ] `./vendor/bin/pint --test` clean; static analysis clean (if configured).
- [ ] `composer audit` and `npm audit` reviewed.
- [ ] `npm run build` succeeds; assets referenced via `@vite`.
- [ ] `php artisan migrate --pretend` reviewed; migrations are backward-safe; backup plan exists.

## Configuration

- [ ] `APP_ENV=production`, `APP_DEBUG=false`, correct `APP_URL`, unique `APP_KEY`.
- [ ] DB, mail, queue, cache, session, filesystem drivers configured for production.
- [ ] `SESSION_SECURE_COOKIE=true` on HTTPS; trusted proxies configured if behind a proxy/CDN.
- [ ] No secrets in the repo; `.env.example` is up to date.
- [ ] Debugbar/Telescope disabled or restricted.

## Application

- [ ] Admin routes protected; policies cover all resources.
- [ ] Public forms rate-limited and spam protected.
- [ ] `php artisan storage:link` done; upload directories writable.
- [ ] Error pages (404/419/500) styled; logs configured (daily) and writable.
- [ ] SEO basics: titles, meta, sitemap/robots, canonical, favicon; Open Graph images.
- [ ] Mail deliverability (SPF/DKIM) for contact/notification emails.

## Deploy steps (adapt to host)

1. Put the app in maintenance mode if needed (`php artisan down`).
2. Pull code; `composer install --no-dev --optimize-autoloader`.
3. `php artisan migrate --force`.
4. `php artisan optimize` (config/route/view/event cache).
5. Restart queue workers (`php artisan queue:restart`).
6. `php artisan up`; smoke-test home, login, admin, a form submit, and an upload.

## Output

Pass/fail per item, blockers, and a rollback note.
