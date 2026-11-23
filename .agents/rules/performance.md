---
trigger: model_decision
description: Apply when optimizing speed, fixing slow pages or queries, adding caching, queues, or preparing for production traffic.
---

# Performance Standard

Measure first. Do not optimize without evidence (query count, timing, profiler output).

## 1. Database (biggest wins)

- Eliminate **N+1**: eager load (`with`), counts (`withCount`), and check with `preventLazyLoading` in dev.
- Add indexes that match real `WHERE/ORDER BY/JOIN` patterns (see database rule). Verify with `EXPLAIN`.
- Select only needed columns; paginate; avoid loading full models for counts/existence.
- Use `chunkById`/`lazyById`/`cursor` for big batches.
- Cache expensive aggregates, not trivial queries.

## 2. Caching

- `Cache::remember($key, $ttl, fn () => ...)` with **namespaced keys** (`site:settings`, `projects:featured`).
- Invalidate on write (Observer/Service) — a cache without invalidation is a bug.
- Prefer tags/versioned keys only if the cache driver supports them (not `file`/`database`).
- Production: `config:cache`, `route:cache`, `view:cache`, `event:cache` (or `php artisan optimize`).

## 3. Queues & scheduling

- Move slow/side-effect work (email, image processing, webhooks, exports) to queued jobs. Make jobs idempotent and set `tries`/`backoff`.
- Use the scheduler for recurring tasks; one cron entry (`schedule:run`).

## 4. Frontend & assets

- Vite production build; code-split large JS; avoid heavy libraries for small tasks.
- Images: resize/compress on upload, serve modern formats (WebP/AVIF) where possible, `loading="lazy"`, explicit `width`/`height`.
- Avoid large inline data in HTML; paginate or load on demand.
- Use HTTP caching headers/CDN for static assets.

## 5. Application

- Avoid heavy computation in Blade/loops; precompute in the controller/service.
- Avoid unnecessary global middleware and service-provider work on every request.
- Keep Debugbar/Telescope out of production.

## 6. Output

When asked to optimize, report: baseline measurement → change → new measurement, and any trade-offs (staleness, memory, complexity).
