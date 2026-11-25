<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings['site_name'] ?? 'Ahmed Adel — Flutter Developer')</title>
    <meta name="description" content="@yield('meta_description', $settings['seo_description'] ?? 'Portfolio of Ahmed Adel, Flutter Developer.')">
    
    <!-- Favicon & App Icon (Using Cover / Profile Avatar) -->
    @php
        $appIconUrl = $profile?->avatar_url ?? asset('storage/avatars/avatar.png');
    @endphp
    <link rel="icon" type="image/png" href="{{ $appIconUrl }}">
    <link rel="apple-touch-icon" href="{{ $appIconUrl }}">
    
    <!-- Theme Script (Prevent FOUC) -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Tailwind Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1E40AF',
                        accent: '#F59E0B',
                        accentDark: '#D97706',
                    },
                    fontFamily: {
                        sans: [{!! app()->getLocale() === 'ar' ? "'Cairo', 'Urbanist', 'sans-serif'" : "'Urbanist', 'Cairo', 'sans-serif'" !!}],
                        urbanist: ['Urbanist', 'sans-serif'],
                        cairo: ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts: Cairo & Urbanist -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Urbanist:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">
    <style>
        html, body, input, textarea, select, button {
            font-family: {{ app()->getLocale() === 'ar' ? "'Cairo', 'Urbanist', sans-serif" : "'Urbanist', 'Cairo', sans-serif" }};
        }
        [dir="rtl"], [lang="ar"], .font-cairo {
            font-family: 'Cairo', sans-serif !important;
        }
        [x-cloak] { display: none !important; }
        @if(app()->getLocale() === 'ar')
            h1, h2, h3, h4 { line-height: 1.35 !important; }
        @endif

        /* Smooth Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 4.5s ease-in-out infinite;
        }

        /* Micro-bounce on hover */
        .hover-bounce:hover i {
            transform: scale(1.15) rotate(-3deg);
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* Scroll Reveal System */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(22px);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal-on-scroll.is-revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stagger Delays */
        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }
        .delay-400 { transition-delay: 400ms; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 antialiased selection:bg-blue-600 selection:text-white transition-colors duration-200"
      x-data="{ 
          mobileMenu: false, 
          scrolled: window.scrollY > 20,
          activeSection: '{{ request()->routeIs('projects.*') ? 'projects' : 'hero' }}',
          clickLockUntil: 0,
          darkMode: document.documentElement.classList.contains('dark'),
          toggleTheme() {
              this.darkMode = !this.darkMode;
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
                  localStorage.theme = 'dark';
              } else {
                  document.documentElement.classList.remove('dark');
                  localStorage.theme = 'light';
              }
          },
          selectSection(id) {
              this.activeSection = id;
              this.clickLockUntil = Date.now() + 900;
              this.mobileMenu = false;
          },
          updateScrollState() {
              this.scrolled = window.scrollY > 20;
              if (Date.now() < this.clickLockUntil) return;
              const ids = ['hero', 'video-showcase', 'about', 'skills', 'work-process', 'projects', 'contact'];
              const scrollPos = window.scrollY + 180;
              let current = null;
              for (const id of ids) {
                  const el = document.getElementById(id);
                  if (el && el.offsetTop <= scrollPos) {
                      current = id;
                  }
              }
              if ((window.innerHeight + window.scrollY) >= document.documentElement.scrollHeight - 40 && document.getElementById('contact')) {
                  current = 'contact';
              }
              if (current) this.activeSection = current;
          }
      }"
      @scroll.window.passive="updateScrollState()">

    <!-- Top Reading / Scroll Progress Bar -->
    <div id="scroll-progress-bar" class="fixed top-0 inset-x-0 h-[2.5px] bg-gradient-to-r from-blue-600 via-cyan-400 to-amber-500 z-[100] transition-all duration-75 pointer-events-none" style="width: 0%"></div>

    @php
        $isHome = request()->routeIs('home');
        $navItems = [
            ['id' => 'hero', 'label' => __('Home'), 'icon' => 'fa-solid fa-house'],
            ['id' => 'video-showcase', 'label' => __('Showcase'), 'icon' => 'fa-solid fa-circle-play'],
            ['id' => 'about', 'label' => __('About'), 'icon' => 'fa-solid fa-user'],
            ['id' => 'skills', 'label' => __('Skills'), 'icon' => 'fa-solid fa-bolt'],
            ['id' => 'work-process', 'label' => __('Process'), 'icon' => 'fa-solid fa-diagram-project'],
            ['id' => 'projects', 'label' => __('Projects'), 'icon' => 'fa-solid fa-folder-open'],
            ['id' => 'contact', 'label' => __('Contact'), 'icon' => 'fa-solid fa-envelope'],
        ];
    @endphp

    <!-- Sticky Navigation Bar -->
    <header :class="scrolled ? 'bg-white/95 dark:bg-slate-950/95 shadow-lg shadow-slate-900/5 dark:shadow-black/30 border-slate-200/90 dark:border-slate-800/90' : 'bg-white/75 dark:bg-slate-950/75 border-slate-200/50 dark:border-slate-800/50'"
            class="sticky top-0 z-50 backdrop-blur-xl border-b transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-20 flex items-center justify-between gap-4">
            <!-- Logo with Cover / Profile Avatar Icon -->
            <a href="{{ route('home') }}" @click="selectSection('hero')" class="flex items-center gap-3 group shrink-0">
                <div class="w-11 h-11 rounded-2xl overflow-hidden shadow-lg shadow-blue-500/25 group-hover:scale-105 transition border-2 border-blue-500/30 p-0.5 bg-gradient-to-tr from-blue-600 to-cyan-400 shrink-0">
                    @if($profile && $profile->avatar_url)
                        <img src="{{ $profile->avatar_url }}" alt="{{ $profile->full_name }}" class="w-full h-full object-cover rounded-[13px]">
                    @else
                        <div class="w-full h-full bg-blue-600 text-white font-extrabold text-lg flex items-center justify-center rounded-[13px]">
                            {{ strtoupper(substr($profile?->full_name ?? 'A', 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="leading-tight">
                    <span class="text-base sm:text-lg font-black text-slate-900 dark:text-white tracking-wide block">{{ $profile?->full_name ?? 'Ahmed Adel' }}</span>
                    <span class="text-[11px] font-semibold text-blue-600 dark:text-blue-400">{{ $profile?->role ?? 'Flutter Developer' }}</span>
                </div>
            </a>

            <!-- Desktop Web Navigation Links (Typography-first, Active Underline Indicator) -->
            <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                @foreach($navItems as $item)
                    <a href="{{ $isHome ? '#' . $item['id'] : route('home') . '#' . $item['id'] }}"
                       @click="selectSection('{{ $item['id'] }}')"
                       :class="activeSection === '{{ $item['id'] }}'
                           ? 'text-blue-600 dark:text-blue-400 bg-blue-500/10 dark:bg-blue-500/15'
                           : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100/70 dark:hover:bg-slate-900/70'"
                       class="relative px-3.5 py-2 rounded-lg text-sm font-semibold transition-all duration-200 whitespace-nowrap">
                        <span>{{ $item['label'] }}</span>
                        <span x-show="activeSection === '{{ $item['id'] }}'"
                              x-transition:enter="transition ease-out duration-200"
                              x-transition:enter-start="opacity-0 scale-x-0"
                              x-transition:enter-end="opacity-100 scale-x-100"
                              class="absolute bottom-0.5 inset-x-3 h-[2px] rounded-full bg-blue-600 dark:bg-blue-400"></span>
                    </a>
                @endforeach
            </nav>

            <!-- Language Switcher, Theme Toggle & CTA -->
            <div class="hidden lg:flex items-center gap-2.5 shrink-0">
                <!-- Language Switcher -->
                <a href="{{ route('locale.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                   title="{{ app()->getLocale() === 'ar' ? 'Switch to English' : 'التحويل للعربية' }}"
                   class="px-3 py-2 rounded-lg flex items-center gap-1.5 text-xs font-bold text-slate-700 dark:text-slate-200 bg-slate-100/80 hover:bg-slate-200/80 dark:bg-slate-900/80 dark:hover:bg-slate-800 border border-slate-200/80 dark:border-slate-800 transition">
                    <i class="fa-solid fa-globe text-blue-500"></i>
                    <span>{{ app()->getLocale() === 'ar' ? 'English' : 'عربي' }}</span>
                </a>

                <!-- Theme Toggle Button -->
                <button @click="toggleTheme()" type="button" aria-label="Toggle theme" title="Toggle Light / Dark mode"
                        class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white bg-slate-100/80 hover:bg-slate-200/80 dark:bg-slate-900/80 dark:hover:bg-slate-800 border border-slate-200/80 dark:border-slate-800 transition">
                    <i class="fa-solid fa-sun text-amber-500 text-sm" x-show="!darkMode"></i>
                    <i class="fa-solid fa-moon text-blue-400 text-sm" x-show="darkMode" x-cloak></i>
                </button>

                <a href="{{ $isHome ? '#contact' : route('home') . '#contact' }}" @click="selectSection('contact')"
                   class="px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold tracking-wide shadow-md shadow-blue-500/20 hover:shadow-blue-500/35 transition">
                    {{ __('Get in Touch') }}
                </a>
            </div>

            <!-- Mobile Actions (Locale + Theme + Hamburger) -->
            <div class="flex lg:hidden items-center gap-2">
                <a href="{{ route('locale.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                   class="px-2.5 py-1.5 rounded-lg flex items-center gap-1 text-[11px] font-bold text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
                    <i class="fa-solid fa-globe text-blue-500"></i>
                    <span>{{ app()->getLocale() === 'ar' ? 'EN' : 'عربي' }}</span>
                </a>
                <button @click="toggleTheme()" type="button" aria-label="Toggle theme"
                        class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
                    <i class="fa-solid fa-sun text-amber-500 text-sm" x-show="!darkMode"></i>
                    <i class="fa-solid fa-moon text-blue-400 text-sm" x-show="darkMode" x-cloak></i>
                </button>
                <button @click="mobileMenu = !mobileMenu" aria-label="Toggle menu"
                        class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 transition">
                    <i class="fa-solid fa-bars text-base" x-show="!mobileMenu"></i>
                    <i class="fa-solid fa-xmark text-base" x-show="mobileMenu" x-cloak></i>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileMenu" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden border-t border-slate-200 dark:border-slate-800 bg-white/95 dark:bg-slate-950/95 backdrop-blur-xl px-4 py-4 space-y-1.5 shadow-xl">
            @foreach($navItems as $item)
                <a href="{{ $isHome ? '#' . $item['id'] : route('home') . '#' . $item['id'] }}"
                   @click="selectSection('{{ $item['id'] }}')"
                   :class="activeSection === '{{ $item['id'] }}'
                       ? 'bg-blue-50 dark:bg-blue-600/15 text-blue-600 dark:text-blue-400 border-s-4 border-blue-600 dark:border-blue-400 ps-3'
                       : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-900/70 ps-4'"
                   class="flex items-center gap-3 py-2.5 pe-4 rounded-xl text-sm font-bold transition-all">
                    <i class="{{ $item['icon'] }} w-4 text-center text-xs"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </div>
    </header>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-white dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800 py-12 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-6 space-y-4">
            <div class="flex items-center justify-center gap-6 text-lg text-slate-500 dark:text-slate-400">
                @if($profile?->github_url)
                    <a href="{{ $profile->github_url }}" target="_blank" class="hover:text-slate-900 dark:hover:text-white transition" title="GitHub"><i class="fa-brands fa-github"></i></a>
                @endif
                @if($profile?->linkedin_url)
                    <a href="{{ $profile->linkedin_url }}" target="_blank" class="hover:text-blue-600 dark:hover:text-blue-400 transition" title="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                @endif
                @if($profile?->email)
                    <a href="mailto:{{ $profile->email }}" class="hover:text-amber-500 dark:hover:text-amber-400 transition" title="Email"><i class="fa-solid fa-envelope"></i></a>
                @endif
                @if($profile?->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->whatsapp) }}" target="_blank" class="hover:text-emerald-500 dark:hover:text-emerald-400 transition" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                @endif
                @if($profile?->phone)
                    <button type="button" @click="$dispatch('open-modal', 'quick-contact-modal')" class="hover:text-cyan-500 dark:hover:text-cyan-400 transition" title="{{ __('Contact') }} {{ $profile->phone }}"><i class="fa-solid fa-phone"></i></button>
                @endif
            </div>
            <p>© {{ $settings['copyright_year'] ?? date('Y') }} {{ $profile?->full_name ?? 'Ahmed Adel' }}. {{ __('All rights reserved.') }}</p>
            <p><a href="{{ route('admin.login') }}" class="hover:text-slate-700 dark:hover:text-slate-400 transition">{{ __('Admin Login') }}</a></p>
        </div>
    </footer>

    <!-- Global Quick Contact Modal & Snackbars -->
    <x-ui.quick-contact-dialog :profile="$profile" />
    <x-ui.snackbar />

    <!-- Motion Observer & Scroll Progress Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const progressBar = document.getElementById('scroll-progress-bar');
            window.addEventListener('scroll', () => {
                const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                if (height > 0 && progressBar) {
                    progressBar.style.width = ((winScroll / height) * 100) + '%';
                }
            }, { passive: true });

            const reveals = document.querySelectorAll('.reveal-on-scroll');
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });
                reveals.forEach(el => observer.observe(el));
            } else {
                reveals.forEach(el => el.classList.add('is-revealed'));
            }
        });
    </script>
</body>
</html>

