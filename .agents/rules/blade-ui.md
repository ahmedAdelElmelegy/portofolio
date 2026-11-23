---
trigger: glob
globs: "**/*.blade.php, resources/css/**, resources/js/**, resources/lang/**, lang/**, tailwind.config.js, vite.config.js"
description: Blade templates, components, layouts, forms, Tailwind, RTL, accessibility, and frontend conventions.
---

# Blade & UI Standard

## 1. Structure

```
resources/views/
├── layouts/            app.blade.php (public), admin.blade.php, guest.blade.php
├── components/         reusable <x-*> components (anonymous or class-based)
│   ├── ui/             button, card, badge, modal, alert, input, select, textarea, ...
│   └── admin/          sidebar, topbar, table, page-header, empty-state, ...
├── admin/{resource}/   index, create, edit, show, _form
├── pages/ or site/     public pages
└── partials/           small non-reusable fragments
```

Follow the project's existing structure if it differs.

## 2. Hard rules

- **No queries, business logic, or `@php` blocks** in views. Data arrives from the controller (or a View Composer / View Component class for shared data).
- Escape by default: `{{ $x }}`. Use `{!! !!}` **only** for content that is sanitized server-side (e.g. purified rich text) and add a comment saying why.
- Every form has `@csrf`; non-GET/POST forms have `@method('PUT|PATCH|DELETE')`.
- Repopulate with `old('field', $model->field ?? '')` and show errors with `@error('field')`.
- Use `route('name', $params)` — never hard-coded URLs.
- Use `__('key')` / `@lang` for user-facing strings when the project is (or may become) multilingual; otherwise follow project convention.
- Authorization in views via `@can` / `@cannot` — but the real enforcement is always in the controller/policy.
- Prefer `@forelse` with `@empty` over `@foreach` + `@if(count())`.

## 3. Components

- **Anonymous components** (`resources/views/components/*.blade.php`) by default; class-based only when logic is needed.
- Declare props: `@props(['variant' => 'primary', 'type' => 'button'])`; merge attributes: `{{ $attributes->merge(['class' => '...']) }}`.
- Use slots (`{{ $slot }}`, named `<x-slot:header>`) instead of copy-pasting markup.
- A component should do one thing and be styled via props/variants, not by duplicating the file.
- Extract markup into a component when it appears **3+ times** or has non-trivial behavior.

## 4. Layouts

- Pages `@extends` or use `<x-layouts.app>`; define `title`, meta, and `@stack('scripts')` / `@stack('styles')` hooks.
- Load assets with `@vite([...])`; never hard-link CDN scripts in pages without reason.
- Set `<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $dir }}">` when RTL is possible.

## 5. Forms

- Every input has a visible `<label for>` and `id`; show validation messages under the field, with `aria-invalid` / `aria-describedby` where practical.
- Use one `_form.blade.php` partial shared by `create` and `edit`.
- File inputs: `enctype="multipart/form-data"`, show the current file/preview, validate type & size server-side.
- Destructive actions (delete) use a form with `@method('DELETE')` plus a confirmation step (modal or `confirm`).
- Disable the submit button on submit to prevent double posts (small Alpine/JS snippet).

## 6. Tables & lists (admin)

- Use a reusable table component; include search/filter query-string support, sorting where useful, and **pagination** (`{{ $items->withQueryString()->links() }}`).
- Always provide an **empty state**; show status badges via an enum-aware component.
- Show action buttons (edit/delete) only when `@can`.

## 7. Flash messages & feedback

- A single `<x-ui.alert>` / `<x-flash />` component renders `session('success'|'error'|'warning')` consistently in the layout.
- Provide loading/disabled states for async actions.

## 8. Tailwind & CSS

- Utility-first; avoid custom CSS unless a pattern repeats (then `@apply` in a small component class or make a Blade component).
- Keep class order readable (layout → spacing → typography → color → state). Prettier plugin for Tailwind if installed.
- Design tokens (colors, fonts, radii) live in the Tailwind config / CSS variables — no scattered hex codes.
- Mobile-first, responsive breakpoints; test at 360px, 768px, 1280px.
- Use **logical properties** (`ms-*`, `me-*`, `ps-*`, `pe-*`, `text-start`) so RTL works without rewrites.
- Support dark mode only if the project requires it, via a single strategy (`class` or `media`).

## 9. JavaScript

- Alpine.js for dropdowns, modals, tabs, toggles. No jQuery unless the project already uses it.
- Put JS in `resources/js` and bundle with Vite; avoid long inline `<script>` blocks. Small `x-data` expressions are fine.
- Never build HTML from untrusted strings (`innerHTML`); use `textContent` or Alpine bindings.

## 10. Accessibility & SEO

- Semantic HTML (`header, nav, main, section, footer`), one `<h1>` per page, logical heading order.
- `alt` on all images (empty `alt=""` for decorative), `width`/`height` + `loading="lazy"` for below-the-fold images.
- Visible focus styles; sufficient color contrast; buttons are `<button>`, links are `<a>`.
- Public pages: unique `<title>`, meta description, Open Graph tags, canonical URL.

## 11. UI states checklist

For every screen: **loading**, **empty**, **error/validation**, **success**, **unauthorized**, **long text/overflow**, **mobile**, **RTL/LTR**.
