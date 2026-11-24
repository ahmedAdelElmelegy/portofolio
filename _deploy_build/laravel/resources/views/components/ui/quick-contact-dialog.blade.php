@props(['profile'])

@php
$cleanPhone = preg_replace('/[^0-9]/', '', $profile?->phone ?? '01069371116');
if (str_starts_with($cleanPhone, '0')) {
    $waPhone = '20' . substr($cleanPhone, 1);
} else {
    $waPhone = $cleanPhone;
}
@endphp

<x-ui.modal name="quick-contact-modal" maxWidth="md">
    <div class="text-center">
        <!-- Avatar / Icon badge -->
        <div class="mx-auto w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-600 to-cyan-500 p-0.5 shadow-xl shadow-blue-500/25 mb-4 flex items-center justify-center">
            @if($profile && $profile->avatar)
                <img src="{{ $profile->avatar_url }}" alt="{{ $profile->full_name }}" class="w-full h-full object-cover rounded-[14px]">
            @else
                <div class="w-full h-full rounded-[14px] bg-slate-900 flex items-center justify-center text-white text-xl font-black">
                    <i class="fa-solid fa-phone-volume text-cyan-400"></i>
                </div>
            @endif
        </div>

        <h3 class="text-lg font-black text-slate-900 dark:text-white">
            {{ __('Get in Touch') }} — {{ $profile?->full_name ?? 'Ahmed Adel' }}
        </h3>
        <p class="text-xs text-blue-600 dark:text-blue-400 font-bold mt-1">
            {{ $profile?->role ?? 'Flutter Developer' }}
        </p>

        <!-- Phone Number Box -->
        <div class="my-5 p-4 rounded-2xl bg-slate-100 dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 flex items-center justify-between">
            <div class="text-start">
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 block">{{ __('Phone Number') }}</span>
                <span class="text-base sm:text-lg font-black font-mono text-slate-900 dark:text-white">{{ $profile?->phone ?? '01069371116' }}</span>
            </div>

            <button type="button" 
                    @click="
                        navigator.clipboard.writeText('{{ $profile?->phone ?? '01069371116' }}');
                        window.snackbar(@js(__('Phone number copied to clipboard!')), 'success', 3500);
                    "
                    class="px-3.5 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-md shadow-blue-500/20 active:scale-95">
                <i class="fa-regular fa-copy"></i>
                <span>{{ __('Copy') }}</span>
            </button>
        </div>

        <!-- Action Links Grid -->
        <div class="space-y-2.5">
            <!-- WhatsApp Web Direct -->
            <a href="https://wa.me/{{ $waPhone }}" 
               target="_blank"
               class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-500 hover:to-green-500 text-white font-extrabold text-xs sm:text-sm flex items-center justify-center gap-2.5 shadow-lg shadow-emerald-600/25 transition">
                <i class="fa-brands fa-whatsapp text-lg"></i>
                <span>{{ __('Chat on WhatsApp') }}</span>
            </a>

            <!-- Direct Call Link (Mobile safe) -->
            <a href="tel:{{ $profile?->phone ?? '01069371116' }}"
               class="w-full py-3 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 font-bold text-xs sm:text-sm flex items-center justify-center gap-2 transition">
                <i class="fa-solid fa-phone text-xs text-blue-500"></i>
                <span>{{ __('Direct Dial (Mobile)') }}</span>
            </a>

            @if($profile?->email)
                <!-- Email Link -->
                <button type="button"
                        @click="
                            navigator.clipboard.writeText('{{ $profile->email }}');
                            window.snackbar(@js(__('Email address copied to clipboard!')), 'info', 3500);
                        "
                        class="w-full py-2.5 px-4 rounded-xl border border-slate-200 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800/50 text-slate-600 dark:text-slate-400 font-semibold text-xs flex items-center justify-center gap-2 transition">
                    <i class="fa-regular fa-envelope text-amber-500"></i>
                    <span>{{ __('Copy Email') }}: {{ $profile->email }}</span>
                </button>
            @endif
        </div>
    </div>
</x-ui.modal>

