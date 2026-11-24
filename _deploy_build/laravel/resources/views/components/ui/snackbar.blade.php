{{-- 
    Global Reusable Snackbar / Toast Notification Component
    Supports: success, error, warning, info
    Triggers via:
      1. Laravel flash messages (session('success'), session('error'), etc.)
      2. Alpine.js event: $dispatch('toast', { message: 'Text', type: 'success', duration: 4000 })
      3. JavaScript helper: window.snackbar('Text', 'success') or window.toast('Text', 'success')
--}}

<div x-data="{
        toasts: [],
        add(toast) {
            const id = Date.now() + Math.random().toString(36).substr(2, 4);
            const duration = toast.duration || 4500;
            const newToast = {
                id: id,
                type: toast.type || 'info', // success, error, warning, info
                message: toast.message || '',
                title: toast.title || null,
                duration: duration,
                progress: 100,
                interval: null
            };
            this.toasts.push(newToast);

            // Animate progress bar & auto-dismiss
            const start = Date.now();
            newToast.interval = setInterval(() => {
                const elapsed = Date.now() - start;
                const remaining = Math.max(0, 100 - (elapsed / duration) * 100);
                newToast.progress = remaining;
                if (remaining <= 0) {
                    clearInterval(newToast.interval);
                    this.remove(id);
                }
            }, 30);
        },
        remove(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index !== -1) {
                if (this.toasts[index].interval) clearInterval(this.toasts[index].interval);
                this.toasts.splice(index, 1);
            }
        }
    }"
    @toast.window="add($event.detail)"
    x-init="
        window.snackbar = (message, type = 'success', duration = 4500, title = null) => {
            window.dispatchEvent(new CustomEvent('toast', { detail: { message, type, duration, title } }));
        };
        window.toast = window.snackbar;

        @if(session('success'))
            add({ type: 'success', message: @js(session('success')), title: @js(__('Success')) });
        @endif
        @if(session('error'))
            add({ type: 'error', message: @js(session('error')), title: @js(__('Error')) });
        @endif
        @if(session('warning'))
            add({ type: 'warning', message: @js(session('warning')), title: @js(__('Notice')) });
        @endif
        @if(session('info'))
            add({ type: 'info', message: @js(session('info')), title: @js(__('Info')) });
        @endif
    "
    class="fixed bottom-5 end-5 z-[9999] flex flex-col gap-3 w-full max-w-sm pointer-events-none px-4 sm:px-0">
    
    <template x-for="t in toasts" :key="t.id">
        <div x-show="true"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
             class="pointer-events-auto relative overflow-hidden rounded-2xl border backdrop-blur-xl shadow-2xl p-4 flex items-start gap-3.5 transition group"
             :class="{
                 'bg-emerald-950/90 dark:bg-emerald-950/95 border-emerald-500/40 text-emerald-100 shadow-emerald-500/10': t.type === 'success',
                 'bg-rose-950/90 dark:bg-rose-950/95 border-rose-500/40 text-rose-100 shadow-rose-500/10': t.type === 'error',
                 'bg-amber-950/90 dark:bg-amber-950/95 border-amber-500/40 text-amber-100 shadow-amber-500/10': t.type === 'warning',
                 'bg-slate-900/90 dark:bg-slate-900/95 border-blue-500/40 text-slate-100 shadow-blue-500/10': t.type === 'info'
             }">
             
            <!-- Icon with glowing pulse container -->
            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-inner"
                 :class="{
                     'bg-emerald-500/20 text-emerald-400': t.type === 'success',
                     'bg-rose-500/20 text-rose-400': t.type === 'error',
                     'bg-amber-500/20 text-amber-400': t.type === 'warning',
                     'bg-blue-500/20 text-blue-400': t.type === 'info'
                 }">
                <i class="fa-solid text-base"
                   :class="{
                       'fa-circle-check': t.type === 'success',
                       'fa-circle-xmark': t.type === 'error',
                       'fa-triangle-exclamation': t.type === 'warning',
                       'fa-circle-info': t.type === 'info'
                   }"></i>
            </div>

            <!-- Content Area -->
            <div class="flex-1 min-w-0 pt-0.5">
                <template x-if="t.title">
                    <p class="text-xs font-black uppercase tracking-wider mb-0.5"
                       :class="{
                           'text-emerald-400': t.type === 'success',
                           'text-rose-400': t.type === 'error',
                           'text-amber-400': t.type === 'warning',
                           'text-blue-400': t.type === 'info'
                       }"
                       x-text="t.title"></p>
                </template>
                <p class="text-xs sm:text-sm font-semibold leading-relaxed text-white/95" x-text="t.message"></p>
            </div>

            <!-- Close Button -->
            <button @click="remove(t.id)" 
                    type="button" 
                    aria-label="Close alert"
                    class="text-white/40 hover:text-white transition p-1 rounded-lg shrink-0 -me-1 -mt-1">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>

            <!-- Subtle Progress Countdown Bar -->
            <div class="absolute bottom-0 inset-x-0 h-1 bg-white/10 overflow-hidden">
                <div class="h-full transition-all ease-linear"
                     :style="'width: ' + t.progress + '%'"
                     :class="{
                         'bg-emerald-400': t.type === 'success',
                         'bg-rose-400': t.type === 'error',
                         'bg-amber-400': t.type === 'warning',
                         'bg-blue-400': t.type === 'info'
                     }"></div>
            </div>
        </div>
    </template>
</div>

