@if(isset($videoSection) && $videoSection && $videoSection->is_active)
<section id="video-showcase" class="max-w-7xl mx-auto px-6 scroll-mt-28">
    <div class="relative bg-white dark:bg-slate-900/90 border border-slate-200 dark:border-slate-800/80 rounded-3xl p-6 sm:p-10 lg:p-12 shadow-xl dark:shadow-2xl overflow-hidden backdrop-blur-xl transition-colors duration-200">
        <!-- Ambient decorative glow -->
        <div class="absolute -top-24 -left-24 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-12 relative z-10">
            @if(!empty($videoSection->badge))
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-600 dark:text-blue-400 text-xs font-bold uppercase tracking-wider mb-3">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    {{ $videoSection->badge }}
                </span>
            @endif
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">
                {{ $videoSection->title }}
            </h2>
            @if(!empty($videoSection->subtitle))
                <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base mt-3 leading-relaxed">
                    {{ $videoSection->subtitle }}
                </p>
            @endif
        </div>

        <!-- Two Column Layout: Video Player + Interactive Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center relative z-10">
            
            <!-- Left: Video Player -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-md mx-auto group">
                    <!-- Glow behind video frame -->
                    <div class="absolute -inset-1.5 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-[28px] opacity-30 dark:opacity-40 blur-lg group-hover:opacity-75 transition duration-500"></div>
                    
                    <div class="relative rounded-3xl bg-slate-100 dark:bg-slate-950 p-2 sm:p-2.5 border border-slate-200 dark:border-slate-800/80 shadow-2xl overflow-hidden transition-colors">
                        <!-- Top status pill -->
                        <div class="absolute top-4 left-4 z-20 flex items-center gap-2 px-3 py-1 rounded-full bg-white/80 dark:bg-slate-950/80 backdrop-blur-md border border-slate-200 dark:border-slate-700/60 text-[11px] font-bold text-slate-800 dark:text-slate-200 shadow-md">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                            <span>Interactive Video</span>
                        </div>

                        <div class="relative rounded-2xl overflow-hidden bg-slate-900 aspect-[9/16] sm:aspect-[4/5] md:aspect-[3/4] max-h-[500px] flex items-center justify-center">
                            @if($videoSection->video_path)
                                <video controls autoplay loop muted playsinline preload="auto" class="w-full h-full object-cover">
                                    <source src="{{ asset('storage/' . $videoSection->video_path) }}?v={{ $videoSection->updated_at?->timestamp }}" type="video/mp4">
                                    <source src="{{ asset('storage/' . $videoSection->video_path) }}?v={{ $videoSection->updated_at?->timestamp }}" type="video/webm">
                                    Your browser does not support HTML5 video.
                                </video>
                            @else
                                <div class="text-slate-400 text-center p-6">
                                    <i class="fa-solid fa-video text-4xl mb-2 block"></i>
                                    <span class="text-xs">No video assigned</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Interactive Content Cards -->
            <div class="lg:col-span-7 space-y-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                        Featured Profiles & Direct Channels
                    </h3>
                    <span class="text-xs text-blue-600 dark:text-blue-400 font-medium">Click to connect</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    @forelse($videoSection->items as $item)
                        @php
                            $isLink = !empty($item->url);
                            $tag = $isLink ? 'a' : 'div';
                        @endphp

                        <{{ $tag }}
                            @if($isLink)
                                href="{{ $item->url }}"
                                target="{{ str_starts_with($item->url, '#') ? '_self' : '_blank' }}"
                                rel="noopener noreferrer"
                            @endif
                            class="group relative flex flex-col justify-between p-4 sm:p-5 rounded-2xl bg-slate-50 dark:bg-slate-950/70 hover:bg-white dark:hover:bg-slate-900 border border-slate-200 dark:border-slate-800/80 hover:border-blue-500/50 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-blue-500/10 {{ $isLink ? 'cursor-pointer' : '' }}">
                            
                            <!-- Card Header: Icon + Badge + External Arrow -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-11 h-11 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-600 dark:text-blue-400 flex items-center justify-center text-lg group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition duration-300 shadow-sm">
                                    <i class="{{ $item->icon ?: 'fa-solid fa-link' }}"></i>
                                </div>

                                <div class="flex items-center gap-2">
                                    @if(!empty($item->badge))
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-300 dark:border-slate-700 group-hover:border-blue-500/30 group-hover:text-blue-600 dark:group-hover:text-blue-300 transition">
                                            {{ $item->badge }}
                                        </span>
                                    @endif

                                    @if($isLink)
                                        <div class="w-7 h-7 rounded-lg bg-slate-200 dark:bg-slate-900 border border-slate-300 dark:border-slate-800 flex items-center justify-center text-slate-500 dark:text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 group-hover:border-blue-500/40 transition">
                                            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                                    {{ $item->title }}
                                </h4>
                                @if(!empty($item->value))
                                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 break-all font-mono leading-relaxed group-hover:text-slate-900 dark:group-hover:text-slate-300 transition">
                                        {{ $item->value }}
                                    </p>
                                @endif
                            </div>
                        </{{ $tag }}>
                    @empty
                        <div class="col-span-2 p-6 rounded-2xl bg-slate-50 dark:bg-slate-950/50 border border-slate-200 dark:border-slate-800/60 text-center text-slate-500 text-xs">
                            No content items configured yet.
                        </div>
                    @endforelse
                </div>

                <!-- Bottom Helper / Action -->
                <div class="pt-3 flex flex-wrap items-center justify-between gap-3 text-xs text-slate-500 dark:text-slate-400 border-t border-slate-200 dark:border-slate-800/60">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-500 dark:text-emerald-400"></i>
                        <span>Verified and active channels</span>
                    </span>
                    <a href="#contact" class="inline-flex items-center gap-1.5 text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 font-semibold transition">
                        <span>Send a direct message</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endif
