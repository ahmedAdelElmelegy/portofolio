---
trigger: glob
globs: "app/**/*.php, routes/**/*.php, bootstrap/**/*.php, config/**/*.php"
description: Laravel layering, controllers, requests, services, routing, and error handling.
---

# Architecture Standard

## 1. Request flow

```
Route → Middleware → Controller → FormRequest → Service/Action → Model → DB
                                  ↓
                               View (Blade) / Redirect
```

| Layer | Responsibility | Must NOT |
|---|---|---|
| Route | Map URL → controller, name it, attach middleware | Contain logic/closures (breaks `route:cache`) |
| Controller | Authorize, call FormRequest/Service, return a response | Validate inline, contain business rules, build big queries |
| FormRequest | Validation + `authorize()` + input normalization | Touch the DB beyond `exists`/`unique` rules |
| Service / Action | Business operations, transactions, file handling, side effects | Know about HTTP (`Request`, `redirect`, `session`) |
| Model | Relationships, scopes, casts, accessors, small domain helpers | Send emails, call external APIs, render views |
| Policy | Who may do what to which model | Query unrelated data |
| Blade | Presentation only | Queries, business rules, `@php` blocks |

## 2. Controllers

- Prefer **resource controllers** (`index, create, store, show, edit, update, destroy`). More than ~7 public methods ⇒ split into another controller.
- One-off endpoints → **single-action (invokable) controllers**.
- Always: `authorize()` or route middleware `can:`; type-hint FormRequests; use **route model binding**.
- Return `redirect()->route(...)->with('success', __('...'))` after writes (Post/Redirect/Get). Never render a view from a POST.
- Keep each action ≤ ~15 lines. If it grows, move logic to a Service/Action.

## 3. FormRequests

- One per write action (`StoreXRequest`, `UpdateXRequest`) unless rules are identical — then share via a base class or trait.
- Use `$request->validated()` — never `$request->all()` — when persisting.
- Normalize in `prepareForValidation()` (trim, slug, boolean casting).
- Use `Rule::unique(...)->ignore($model)` on updates.
- Provide translated custom messages/attributes through lang files, not hard-coded strings.

## 4. Services and Actions

- **Simple CRUD** with no side effects can stay in the controller: `Model::create($request->validated())`.
- Introduce a **Service** (`app/Services/ProjectService.php`) when a feature has several related operations, file uploads, or multi-table writes.
- Introduce an **Action** (`app/Actions/PublishProject.php`, single `handle()` method) for one reusable, self-contained operation.
- Wrap multi-write operations in `DB::transaction()`.
- Inject dependencies via the constructor; resolve through the container. Do not instantiate services with `new` in controllers.
- Services return models/collections/values or throw domain exceptions. They never return `Response` objects.

## 5. Models

- Keep them cohesive: relationships, `casts()`, scopes (`scopePublished`), accessors/mutators (`Attribute::make`), and small domain methods.
- Use **backed enums** for fixed value sets (status, role, type) and cast them.
- Use **local scopes** for repeated query fragments; do not repeat the same `where` chain in three controllers.
- No `Repository` layer by default. Add one only if the project already uses it or you must isolate a non-Eloquent data source.

## 6. Side effects

- Emails, notifications, webhooks, image processing → **Events/Listeners, Notifications, or queued Jobs**. Never block the request on slow work.
- Observers are fine for model-lifecycle housekeeping (slug, cache bust); keep them small and documented.

## 7. Routing

- Group by concern with `prefix`, `name`, and `middleware` (e.g. `admin.` prefix + `auth` + `verified`).
- Use `Route::resource()` / `Route::singleton()` where it fits; name every route.
- Public vs admin routes live in separate files or clearly separated groups.
- No closures except trivial health/redirect routes.

## 8. Configuration & environment

- `env()` is allowed only inside `config/*.php`. Elsewhere use `config('key')`.
- New settings → add to a config file with a sensible default and document in `.env.example`.

## 9. Errors & logging

- Throw specific exceptions; catch only where you can act on them.
- Never `catch (\Throwable $e) {}` silently. Log with context (`Log::error('msg', ['id' => $id, 'exception' => $e])`) and show the user a safe message.
- Never log passwords, tokens, or personal data.

## 10. File uploads

- Use the `Storage` facade with a named disk; store files with generated names; delete the old file when replacing or deleting a record (in the Service or an Observer).
- Public files via `php artisan storage:link`; private files served through an authorized controller.

## 11. Naming

| Thing | Convention | Example |
|---|---|---|
| Model | Singular PascalCase | `Project` |
| Table | Plural snake_case | `projects` |
| Controller | `{Model}Controller` | `ProjectController` |
| FormRequest | `{Action}{Model}Request` | `StoreProjectRequest` |
| Policy | `{Model}Policy` | `ProjectPolicy` |
| Service | `{Model}Service` | `ProjectService` |
| Action | Verb phrase | `PublishProject` |
| Enum | Singular noun | `ProjectStatus` |
| Route name | `area.resource.action` | `admin.projects.index` |
| View | `area/resource/action.blade.php` | `admin/projects/index.blade.php` |

## 12. Large applications

Standard Laravel folders are the default. If the project is large and already groups code by domain (`app/Domain/...` or modules), follow that structure instead of introducing a new one.
