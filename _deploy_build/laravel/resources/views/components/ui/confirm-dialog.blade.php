{{-- 
    Custom Reusable Confirmation Dialog
    Replaces browser native confirm('...') with an accessible, dark/light bilingual dialog.
    Trigger via:
      1. $dispatch('confirm-action', { formId: 'delete-form-1', title: 'Delete Project?', message: '...' })
      2. window.confirmDelete(formId, message, title)
--}}

<div x-data="{
        show: false,
        formId: null,
        title: @js(__('Confirm Deletion')),
        message: @js(__('Are you sure you want to delete this item? This action cannot be undone.')),
        confirmText: @js(__('Delete Permanently')),
        cancelText: @js(__('Cancel')),
        confirmAction(data) {
            this.formId = data.formId || null;
            if (data.title) this.title = data.title;
            if (data.message) this.message = data.message;
            if (data.confirmText) this.confirmText = data.confirmText;
            if (data.cancelText) this.cancelText = data.cancelText;
            this.show = true;
        },
        execute() {
            if (this.formId) {
                const targetForm = document.getElementById(this.formId);
                if (targetForm) {
                    targetForm.submit();
                }
            }
            this.show = false;
        }
    }"
    @confirm-action.window="confirmAction($event.detail)"
    x-init="
        window.confirmDelete = (formId, message = null, title = null) => {
            window.dispatchEvent(new CustomEvent('confirm-action', {
                detail: { formId, message, title }
            }));
        };
    "
    x-show="show"
    x-cloak
    @keydown.escape.window="show = false"
    class="fixed inset-0 z-[9990] overflow-y-auto"
    role="dialog"
    aria-modal="true">

    <!-- Backdrop -->
    <div x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-950/80 backdrop-blur-md"
         @click="show = false"></div>

    <!-- Centered Card -->
    <div class="flex min-h-full items-center justify-center p-4 sm:p-6 text-center">
        <div x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-3"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
             @click.away="show = false"
             class="relative w-full max-w-md transform overflow-hidden rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 text-start shadow-2xl shadow-rose-500/10 transition-all">

            <div class="flex items-start gap-4">
                <!-- Glowing Warning Icon -->
                <div class="w-12 h-12 rounded-2xl bg-rose-500/15 border border-rose-500/30 flex items-center justify-center shrink-0 text-rose-500 shadow-lg shadow-rose-500/20">
                    <i class="fa-solid fa-triangle-exclamation text-xl animate-pulse"></i>
                </div>

                <div class="flex-1 min-w-0">
                    <h3 class="text-base sm:text-lg font-black text-slate-900 dark:text-white" x-text="title"></h3>
                    <p class="mt-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed" x-text="message"></p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 pt-4 border-t border-slate-200 dark:border-slate-800/80 flex items-center justify-end gap-3">
                <button type="button" 
                        @click="show = false"
                        class="px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-slate-700 dark:text-slate-300 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 transition">
                    <span x-text="cancelText"></span>
                </button>

                <button type="button" 
                        @click="execute()"
                        class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-extrabold text-white bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 shadow-lg shadow-rose-600/30 transition flex items-center gap-2">
                    <i class="fa-solid fa-trash-can text-xs"></i>
                    <span x-text="confirmText"></span>
                </button>
            </div>
        </div>
    </div>
</div>

