---
name: blade-component
description: Reference patterns for building reusable Blade components (buttons, inputs, cards, badges, modals, alerts) with props, slots, attribute merging, and accessibility. Use when creating or refactoring UI components.
---

# Blade Component Playbook

Prefer **anonymous components** in `resources/views/components/`. Use a class component only when logic is needed.

## Button — `components/ui/button.blade.php`

```blade
@props([
    'variant' => 'primary',   // primary | secondary | danger | ghost
    'size' => 'md',           // sm | md | lg
    'type' => 'button',
    'href' => null,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-lg font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none';
    $variants = [
        'primary'   => 'bg-indigo-600 text-white hover:bg-indigo-700 focus-visible:ring-indigo-500',
        'secondary' => 'bg-gray-100 text-gray-900 hover:bg-gray-200 focus-visible:ring-gray-400',
        'danger'    => 'bg-red-600 text-white hover:bg-red-700 focus-visible:ring-red-500',
        'ghost'     => 'text-gray-700 hover:bg-gray-100 focus-visible:ring-gray-400',
    ];
    $sizes = ['sm' => 'px-3 py-1.5 text-sm', 'md' => 'px-4 py-2 text-sm', 'lg' => 'px-5 py-3 text-base'];
    $classes = "$base {$variants[$variant]} {$sizes[$size]}";
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
```
(The `@php` block is acceptable inside a component to compute *presentation classes only*.)

Usage: `<x-ui.button variant="danger" size="sm">Delete</x-ui.button>`

## Form field — `components/ui/field.blade.php`

```blade
@props(['name', 'label', 'type' => 'text', 'value' => null, 'required' => false, 'hint' => null])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }} @if($required)<span class="text-red-600" aria-hidden="true">*</span>@endif
    </label>

    <input
        id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
        value="{{ old($name, $value) }}"
        @required($required)
        @error($name) aria-invalid="true" aria-describedby="{{ $name }}-error" @enderror
        {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500']) }}
    >

    @if ($hint)<p class="mt-1 text-xs text-gray-500">{{ $hint }}</p>@endif
    @error($name)<p id="{{ $name }}-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
</div>
```

## Flash/alert — `components/ui/flash.blade.php`

```blade
@foreach (['success' => 'green', 'error' => 'red', 'warning' => 'yellow'] as $key => $color)
    @if (session($key))
        <div role="alert" class="mb-4 rounded-lg border border-{{ $color }}-200 bg-{{ $color }}-50 px-4 py-3 text-sm text-{{ $color }}-800">
            {{ session($key) }}
        </div>
    @endif
@endforeach
```
Note: Tailwind cannot see dynamically built class names. Safelist them, or map explicit full class strings as in the button example.

## Status badge — enum aware

```blade
@props(['status'])
<span {{ $attributes->merge(['class' => 'inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium '.($status->value === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700')]) }}>
    {{ $status->label() }}
</span>
```

## Checklist

- [ ] Props declared with defaults; attributes merged.
- [ ] Slots used instead of duplicated markup.
- [ ] Accessible: labels, `aria-*`, focus styles, semantic elements.
- [ ] No queries or business logic; only presentation.
- [ ] Logical Tailwind properties (`ms/me/ps/pe`) so RTL works.
- [ ] Works at 360px width and in both LTR/RTL.
