---
name: admin-dashboard
description: Blueprint for a Blade + Tailwind admin dashboard: layout, sidebar, stat cards, tables, filters, flash messages, and auth-protected route structure. Use when creating or extending an admin area or portfolio/CMS dashboard.
---

# Admin Dashboard Blueprint

## Route structure

```php
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('projects', ProjectController::class)->except('show');
    // add more modules here
});
```
Protect the group with an admin check (middleware `can:access-admin` or a role middleware) — never rely on hidden links.

## Layout — `layouts/admin.blade.php`

- `<html lang dir>` aware of locale/RTL; `@vite(['resources/css/app.css','resources/js/app.js'])`.
- Sidebar (collapsible on mobile via Alpine `x-data="{ open: false }"`), top bar (user menu, logout form with `@csrf`), main content slot, `<x-ui.flash />`, `@stack('scripts')`.
- Page header component: title + breadcrumbs + primary action slot.

## Components to create once, reuse everywhere

`admin/sidebar`, `admin/sidebar-link` (active state via `request()->routeIs()`), `admin/page-header`, `admin/stat-card`, `admin/table` (+ `th`, `td`), `admin/empty-state`, `ui/button`, `ui/field`, `ui/select`, `ui/textarea`, `ui/badge`, `ui/modal`, `ui/flash`, `ui/confirm-delete`.

## Dashboard home

- `DashboardController` (invokable) gathers counts in as few queries as possible (`Project::count()`, unread messages `ContactMessage::whereNull('read_at')->count()`), cached briefly if needed.
- Show: stat cards, latest items, quick actions. No heavy queries in the view.

## List pages

Search (`?q=`), filters (status), sort whitelist, pagination with `withQueryString()`, bulk actions optional, empty state, status badges, `@can`-guarded actions.

## Form pages

Shared `_form`, validation errors inline, preview for images, sticky save bar on long forms, disable-on-submit, unsaved-changes hint optional.

## Settings module (common in portfolio/CMS)

Single `settings` store (key/value or one row) with typed accessors and a cached `Setting::get('site_title')`; editable from one admin page; cache cleared on save.

## Checklist

- [ ] Whole admin group behind auth + admin authorization.
- [ ] Sidebar link per module, shown with `@can`.
- [ ] Consistent flash messages and empty states.
- [ ] Mobile-friendly (sidebar collapses, tables scroll horizontally).
- [ ] RTL-safe classes; Arabic labels via lang files.
- [ ] No N+1 on list pages; pagination everywhere.
