@props([
    'name',
    'maxWidth' => 'md',
    'title' => null,
])

@php
$maxWidthClasses = [
    'sm'  => 'max-w-sm',
    'md'  => 'max-w-md',
    'lg'  => 'max-w-lg',
    'xl'  => 'max-w-xl',
    '2xl' => 'max-w-2xl',
][$maxWidth] ?? 'max-w-md';
@endphp

<div x-data="{ show: false }"
     x-show="show"
     x-cloak
     @open-modal.window="if ($event.detail === '{{ $name }}') show = true"
     @close-modal.window="if ($event.detail === '{{ $name }}') show = false"
     @keydown.escape.window="show = false"
     class="fixed inset-0 z-50 overflow-y-auto"
     role="dialog"
     aria-modal="true">

    <!-- Glassmorphic Backdrop -->
    <div x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-950/75 backdrop-blur-md transition-opacity"
         @click="show = false"></div>

    <!-- Centered Modal Content Card -->
    <div class="flex min-h-full items-center justify-center p-4 sm:p-6 text-center">
        <div x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-3"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
             @click.away="show = false"
             class="relative w-full {{ $maxWidthClasses }} transform overflow-hidden rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-start shadow-2xl shadow-blue-500/10 transition-all">

            <!-- Optional Header -->
            @if(isset($header) || $title)
                <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-800/80 flex items-center justify-between">
                    <div>
                        @if(isset($header))
                            {{ $header }}
                        @else
                            <h3 class="text-base sm:text-lg font-black text-slate-900 dark:text-white">{{ $title }}</h3>
                        @endif
                    </div>
                    <button @click="show = false" 
                            type="button" 
                            class="w-8 h-8 rounded-xl flex items-center justify-center text-slate-400 hover:text-slate-600 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
            @endif

            <!-- Body -->
            <div class="p-6">
                {{ $slot }}
            </div>

            <!-- Optional Footer -->
            @if(isset($footer))
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-950/60 border-t border-slate-200 dark:border-slate-800/80 flex items-center justify-end gap-3">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>

