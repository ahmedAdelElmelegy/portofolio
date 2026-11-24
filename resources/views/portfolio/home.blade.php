@extends('layouts.portfolio')

@section('content')
<main class="space-y-28 md:space-y-36 pb-20">
    <!-- Hero Section -->
    <section id="hero" class="pt-12 md:pt-20 max-w-7xl mx-auto px-6">
        <div class="flex flex-col-reverse lg:flex-row items-center justify-between gap-12">
            <!-- Left Headline -->
            <div class="flex-1 space-y-6 text-center lg:text-left">
                <span class="inline-block px-4 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-600 dark:text-blue-400 text-xs font-bold tracking-wider uppercase">
                    {{ __('Hello, It\'s Me') }}
                </span>
                <h1 class="text-4xl sm:text-6xl font-black text-slate-900 dark:text-white tracking-tight leading-none">
                    {{ $profile->full_name ?? 'Ahmed Adel' }}
                </h1>
                
                <!-- Typing Text Simulation (Alpine.js) -->
                <div class="text-2xl sm:text-3xl font-bold text-slate-700 dark:text-slate-300"
                     x-data="{
                         roles: [
                             '{{ addslashes($profile?->role ?? "Flutter Developer") }}',
                             @if(!empty($profile?->tagline)) '{{ addslashes($profile->tagline) }}', @endif
                             '{{ app()->getLocale() === "ar" ? "مهندس تطبيقات الموبايل" : "Mobile App Engineer" }}',
                              '{{ app()->getLocale() === "ar" ? "شغوف بالـ Clean Architecture" : "Clean Architecture Enthusiast" }}',
                              '{{ app()->getLocale() === "ar" ? "خبير في بناء وتطوير الواجهات" : "UI/UX Implementer" }}'
                         ],
                         current: '',
                         rIdx: 0,
                         cIdx: 0,
                         isDeleting: false,
                         init() {
                             setInterval(() => {
                                 let full = this.roles[this.rIdx];
                                 if (!this.isDeleting) {
                                     this.current = full.substring(0, this.cIdx + 1);
                                     this.cIdx++;
                                     if (this.cIdx === full.length) {
                                         setTimeout(() => { this.isDeleting = true; }, 1500);
                                     }
                                 } else {
                                     this.current = full.substring(0, this.cIdx - 1);
                                     this.cIdx--;
                                     if (this.cIdx === 0) {
                                         this.isDeleting = false;
                                         this.rIdx = (this.rIdx + 1) % this.roles.length;
                                     }
                                 }
                             }, 100);
                         }
                     }">
                    <span>{{ __('And I\'m a') }} </span>
                    <span class="text-blue-600 dark:text-blue-500" x-text="current"></span>
                    <span class="inline-block w-1 h-7 bg-blue-600 dark:bg-blue-500 align-middle animate-pulse ml-0.5"></span>
                </div>

                <p class="text-base text-slate-600 dark:text-slate-400 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    {{ $profile->bio ?? 'A passionate Flutter Developer building scalable, responsive, and pixel-perfect mobile applications.' }}
                </p>

                <!-- Actions -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
                    <a href="#projects" class="px-8 py-3.5 bg-amber-500 hover:bg-amber-400 text-slate-950 font-extrabold text-sm rounded-xl transition shadow-xl shadow-amber-500/20 flex items-center gap-2">
                        <span>{{ __('View My Work') }}</span>
                        <i class="fa-solid fa-arrow-right rtl:rotate-180 text-xs"></i>
                    </a>
                    <a href="{{ $profile?->cv_url ?? 'https://drive.google.com/drive/u/0/mobile/folders/1Du__WLyTM0zhOU2ZfzEAYIz5cjqcjS0Q?hl=ar&sort=13&direction=a' }}" target="_blank" class="px-8 py-3.5 bg-white hover:bg-slate-100 dark:bg-slate-900 dark:hover:bg-slate-800 border border-slate-300 dark:border-slate-700/80 text-slate-800 dark:text-white font-bold text-sm rounded-xl transition shadow-sm flex items-center gap-2">
                        <i class="fa-solid fa-file-arrow-down text-blue-500"></i>
                        <span>{{ __('Download CV') }}</span>
                    </a>
                </div>

                <!-- Social links -->
                <div class="flex items-center justify-center lg:justify-start gap-3 pt-4 text-slate-500 dark:text-slate-400">
                    <span class="text-xs uppercase font-bold text-slate-400 dark:text-slate-600">{{ __('Connect:') }}</span>
                    @if($profile && $profile->github_url)
                        <a href="{{ $profile->github_url }}" target="_blank" class="w-9 h-9 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center hover:text-slate-900 dark:hover:text-white hover:border-slate-400 dark:hover:border-slate-700 shadow-sm transition" title="GitHub">
                            <i class="fa-brands fa-github text-sm"></i>
                        </a>
                    @endif
                    @if($profile && $profile->linkedin_url)
                        <a href="{{ $profile->linkedin_url }}" target="_blank" class="w-9 h-9 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center hover:text-blue-600 dark:hover:text-blue-400 hover:border-blue-400 dark:hover:border-blue-500/40 shadow-sm transition" title="LinkedIn">
                            <i class="fa-brands fa-linkedin text-sm"></i>
                        </a>
                    @endif
                    @if($profile && $profile->whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->whatsapp) }}" target="_blank" class="w-9 h-9 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center hover:text-emerald-600 dark:hover:text-emerald-400 hover:border-emerald-400 dark:hover:border-emerald-500/40 shadow-sm transition" title="WhatsApp">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                        </a>
                    @endif
                    @if($profile && $profile->phone)
                        <button type="button" @click="$dispatch('open-modal', 'quick-contact-modal')" class="w-9 h-9 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center hover:text-cyan-600 dark:hover:text-cyan-400 hover:border-cyan-400 dark:hover:border-cyan-500/40 shadow-sm transition" title="{{ $profile->phone }}">
                            <i class="fa-solid fa-phone text-sm"></i>
                        </button>
                    @endif
                </div>
            </div>

            <!-- Right Profile Shape -->
            <div class="flex-1 flex justify-center">
                <div class="relative w-72 h-72 sm:w-88 sm:h-88">
                    <!-- Glow background -->
                    <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-blue-600/30 to-amber-500/20 blur-2xl"></div>
                    <div class="relative w-full h-full rounded-3xl bg-gradient-to-b from-blue-600 to-blue-900 p-1.5 shadow-2xl overflow-hidden flex items-center justify-center">
                        @if($profile && $profile->avatar)
                            <img src="{{ $profile->avatar_url }}" alt="{{ $profile->full_name }}" class="w-full h-full object-cover rounded-2xl">
                        @else
                            <div class="w-full h-full bg-white dark:bg-slate-900 rounded-2xl flex flex-col items-center justify-center text-blue-600 dark:text-blue-400 p-6 text-center">
                                <i class="fa-solid fa-laptop-code text-6xl mb-3"></i>
                                <span class="font-bold text-slate-900 dark:text-white text-base">{{ $profile?->full_name ?? 'Ahmed Adel' }}</span>
                                <span class="text-xs text-slate-500 dark:text-slate-400">{{ $profile?->role ?? 'Flutter Developer' }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Showcase Section -->
    @include('portfolio.sections.video-showcase')

    <!-- About Section -->
    <section id="about" class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">{{ __('About Me') }}</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mt-2">{{ __('Background & Experience') }}</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Work Experience Timeline -->
            <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800/80 rounded-3xl p-8 shadow-sm transition-colors">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <span>{{ __('Work Experience') }}</span>
                </h3>
                <div class="space-y-8 border-l-2 border-slate-200 dark:border-slate-800 pl-6 ml-4">
                    @forelse($experiences['work'] ?? [] as $work)
                        <div class="relative group">
                            <span class="absolute -left-[31px] top-1.5 w-3 h-3 rounded-full bg-blue-500 ring-4 ring-white dark:ring-slate-950"></span>
                            <div class="flex items-center justify-between">
                                <h4 class="text-base font-bold text-slate-900 dark:text-white">{{ $work->title }}</h4>
                                <span class="text-xs font-mono text-slate-500">{{ $work->date_range }}</span>
                            </div>
                            <p class="text-xs text-blue-600 dark:text-blue-400 font-semibold mt-0.5">{{ $work->organization }} • {{ $work->location ?? 'Remote' }}</p>
                            @if($work->description)
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">{{ $work->description }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-xs text-slate-500">No work experience entries listed.</p>
                    @endforelse
                </div>
            </div>

            <!-- Education Timeline -->
            <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800/80 rounded-3xl p-8 shadow-sm transition-colors">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <span>{{ __('Education & Degrees') }}</span>
                </h3>
                <div class="space-y-8 border-l-2 border-slate-200 dark:border-slate-800 pl-6 ml-4">
                    @forelse($experiences['education'] ?? [] as $edu)
                        <div class="relative group">
                            <span class="absolute -left-[31px] top-1.5 w-3 h-3 rounded-full bg-purple-500 ring-4 ring-white dark:ring-slate-950"></span>
                            <div class="flex items-center justify-between">
                                <h4 class="text-base font-bold text-slate-900 dark:text-white">{{ $edu->title }}</h4>
                                <span class="text-xs font-mono text-slate-500">{{ $edu->date_range }}</span>
                            </div>
                            <p class="text-xs text-purple-600 dark:text-purple-400 font-semibold mt-0.5">{{ $edu->organization }} • {{ $edu->location ?? 'Egypt' }}</p>
                            @if($edu->description)
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">{{ $edu->description }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-xs text-slate-500">No education entries listed.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">{{ __('Skills & Tech Stack') }}</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mt-2">{{ __('Technologies I Excel At') }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($skills as $category => $skillGroup)
                <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800/80 rounded-3xl p-6 flex flex-col justify-between shadow-sm transition-colors">
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-5 flex items-center justify-between">
                            <span>{{ $category ?? 'Tools & Frameworks' }}</span>
                            <span class="text-xs text-blue-600 dark:text-blue-400 font-mono">{{ count($skillGroup) }} items</span>
                        </h3>
                        <div class="space-y-4">
                            @foreach($skillGroup as $s)
                                <div>
                                    <div class="flex justify-between text-xs font-semibold mb-1">
                                        <span class="text-slate-700 dark:text-slate-200 flex items-center gap-1.5">
                                            <span>{{ $s->name }}</span>
                                            @if($s->is_featured)
                                                <i class="fa-solid fa-star text-[10px] text-amber-500 dark:text-amber-400"></i>
                                            @endif
                                        </span>
                                        <span class="text-slate-400 dark:text-slate-500">{{ $s->level }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-100 dark:bg-slate-900 h-2 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-blue-600 to-blue-400 h-full rounded-full" style="width: {{ $s->level }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Work Process Section -->
    <section id="work-process" class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">{{ __('Development Methodology') }}</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mt-2">{{ __('My Work Process') }}</h2>
            <p class="text-slate-600 dark:text-slate-400 text-sm mt-2">{{ __('How I deliver robust, scalable, and user-centric mobile applications from concept to deployment.') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($processes as $p)
                <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800/80 rounded-3xl p-7 relative overflow-hidden group hover:border-blue-500/50 shadow-sm transition">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center text-lg font-black mb-5 group-hover:scale-110 transition">
                        0{{ $p->sort_order }}
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">{{ $p->title }}</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{{ $p->description }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">{{ __('Recent Projects') }}</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mt-2">{{ __('Featured Mobile Applications') }}</h2>
            <p class="text-slate-600 dark:text-slate-400 text-sm mt-2">{{ __('Browse through production apps developed with clean architecture and modern Flutter stacks.') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($projects as $proj)
                <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800/80 rounded-3xl overflow-hidden flex flex-col justify-between group hover:border-blue-500/50 shadow-sm hover:shadow-xl transition">
                    <div class="p-8">
                        <div class="flex items-center justify-between gap-4 mb-3">
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">{{ $proj->name }}</h3>
                            @if($proj->is_featured)
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 border border-amber-500/30">
                                    Featured
                                </span>
                            @endif
                        </div>

                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
                            {{ $proj->short_description ?? Str::limit($proj->description, 130) }}
                        </p>

                        <!-- Technologies Chips -->
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($proj->technologies as $t)
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300">
                                    {{ $t->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Footer / Links -->
                    <div class="px-8 py-4 bg-slate-50 dark:bg-slate-900/60 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs font-bold">
                        <div class="flex items-center gap-4">
                            @if($proj->github_url)
                                <a href="{{ $proj->github_url }}" target="_blank" class="text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white flex items-center gap-1.5 transition">
                                    <i class="fa-brands fa-github text-sm"></i>
                                    <span>{{ __('GitHub') }}</span>
                                </a>
                            @endif
                            @if($proj->app_url)
                                <a href="{{ $proj->app_url }}" target="_blank" class="text-slate-600 hover:text-amber-600 dark:text-slate-400 dark:hover:text-amber-400 flex items-center gap-1.5 transition">
                                    <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                    <span>{{ __('Demo / APK') }}</span>
                                </a>
                            @endif
                        </div>
                        <a href="{{ route('projects.show', $proj->slug) }}" class="text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1">
                            <span>{{ __('Project Details') }}</span>
                            <i class="fa-solid fa-chevron-right rtl:rotate-180 text-[10px]"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="contact" class="max-w-4xl mx-auto px-6">
        <div class="bg-white dark:bg-gradient-to-br dark:from-slate-950 dark:via-slate-900 dark:to-blue-950/40 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 md:p-12 shadow-xl dark:shadow-2xl transition-colors">
            <div class="text-center max-w-xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">{{ __('Get in Touch') }}</span>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ __('Let\'s Build Something Great') }}</h2>
                <p class="text-slate-600 dark:text-slate-400 text-xs mt-2">{{ __('Have a project in mind, need a mobile app, or looking to hire? Drop me a message.') }}</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 text-sm font-semibold text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-2">{{ __('Your Name *') }}</label>
                        <input type="text" name="name" required placeholder="John Doe"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none focus:bg-white dark:focus:bg-slate-950 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-2">{{ __('Email Address *') }}</label>
                        <input type="email" name="email" required placeholder="john@example.com"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none focus:bg-white dark:focus:bg-slate-950 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-2">{{ __('Subject') }}</label>
                    <input type="text" name="subject" placeholder="Project Inquiry / Job Opportunity"
                           class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none focus:bg-white dark:focus:bg-slate-950 transition">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-2">{{ __('Message *') }}</label>
                    <textarea name="message" rows="5" required placeholder="Tell me about your project or inquiry..."
                              class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none focus:bg-white dark:focus:bg-slate-950 transition"></textarea>
                </div>

                <div class="pt-2 text-center">
                    <button type="submit" class="px-10 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-sm rounded-xl transition shadow-xl shadow-blue-500/30">
                        {{ __('Send Message') }}
                    </button>
                </div>
            </form>

            <!-- Direct Contact Info Cards -->
            <div class="mt-10 pt-8 border-t border-slate-200 dark:border-slate-800/80 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-center">
                @if($profile?->email)
                    <div class="p-3 bg-slate-50 dark:bg-slate-950/80 rounded-xl border border-slate-200 dark:border-slate-800">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 block">{{ __('Email') }}</span>
                        <a href="mailto:{{ $profile->email }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-semibold truncate block mt-0.5">{{ $profile->email }}</a>
                    </div>
                @endif
                @if($profile?->phone)
                    <div class="p-3 bg-slate-50 dark:bg-slate-950/80 rounded-xl border border-slate-200 dark:border-slate-800">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 block">{{ __('Phone') }}</span>
                        <button type="button" @click="$dispatch('open-modal', 'quick-contact-modal')" class="text-xs text-emerald-600 dark:text-emerald-400 hover:underline font-semibold block mt-0.5 mx-auto">
                            {{ $profile->phone }}
                        </button>
                    </div>
                @endif
                @if($profile?->location)
                    <div class="p-3 bg-slate-50 dark:bg-slate-950/80 rounded-xl border border-slate-200 dark:border-slate-800">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 block">{{ __('Location') }}</span>
                        <span class="text-xs text-slate-700 dark:text-slate-300 font-semibold block mt-0.5">{{ $profile->location }}</span>
                    </div>
                @endif
                @if($profile?->whatsapp)
                    <div class="p-3 bg-slate-50 dark:bg-slate-950/80 rounded-xl border border-slate-200 dark:border-slate-800">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 block">{{ __('WhatsApp') }}</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->whatsapp) }}" target="_blank" class="text-xs text-green-600 dark:text-green-400 hover:underline font-semibold block mt-0.5">{{ __('Chat on WhatsApp') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</main>
@endsection
