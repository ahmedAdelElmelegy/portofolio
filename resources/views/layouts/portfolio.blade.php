<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings['site_name'] ?? 'Ahmed Adel — Flutter Developer')</title>
    <meta name="description" content="@yield('meta_description', $settings['seo_description'] ?? 'Portfolio of Ahmed Adel, Flutter Developer.')">
    
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
                        urbanist: ['Urbanist', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts: Urbanist -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Urbanist', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 antialiased selection:bg-blue-600 selection:text-white transition-colors duration-200"
      x-data="{ 
          mobileMenu: false, 
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
          }
      }">

    <!-- Sticky Navigation Bar -->
    <header class="sticky top-0 z-50 bg-white/85 dark:bg-slate-950/85 backdrop-blur-md border-b border-slate-200/80 dark:border-slate-800/80 transition">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-blue-400 text-white font-extrabold text-lg flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:scale-105 transition">
                    {{ strtoupper(substr($profile?->full_name ?? 'A', 0, 1)) }}
                </div>
                <div class="leading-none">
                    <span class="text-lg font-black text-slate-900 dark:text-white tracking-wide block">{{ $profile?->full_name ?? 'Ahmed Adel' }}</span>
                    <span class="text-[11px] font-semibold text-blue-600 dark:text-blue-400">{{ $profile?->role ?? 'Flutter Developer' }}</span>
                </div>
            </a>

            <!-- Desktop Nav Items -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                <a href="#hero" class="text-slate-600 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 transition">Home</a>
                <a href="#video-showcase" class="text-slate-600 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 transition">Showcase</a>
                <a href="#about" class="text-slate-600 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 transition">About</a>
                <a href="#skills" class="text-slate-600 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 transition">Skills</a>
                <a href="#work-process" class="text-slate-600 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 transition">Process</a>
                <a href="#projects" class="text-slate-600 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 transition">Projects</a>
                <a href="#contact" class="text-slate-600 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 transition">Contact</a>
            </nav>

            <!-- Theme Toggle & CTA -->
            <div class="hidden md:flex items-center gap-3">
                <!-- Theme Toggle Button -->
                <button @click="toggleTheme()" type="button" aria-label="Toggle theme" title="Toggle Light / Dark mode"
                        class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white bg-slate-100 hover:bg-slate-200 dark:bg-slate-900 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800 transition">
                    <i class="fa-solid fa-sun text-amber-500 text-base" x-show="!darkMode"></i>
                    <i class="fa-solid fa-moon text-blue-400 text-base" x-show="darkMode" x-cloak></i>
                </button>

                <a href="#contact" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold tracking-wide uppercase shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 transition">
                    Get in Touch
                </a>
            </div>

            <!-- Mobile Actions (Toggle + Hamburger) -->
            <div class="flex md:hidden items-center gap-2">
                <button @click="toggleTheme()" type="button" aria-label="Toggle theme"
                        class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
                    <i class="fa-solid fa-sun text-amber-500 text-sm" x-show="!darkMode"></i>
                    <i class="fa-solid fa-moon text-blue-400 text-sm" x-show="darkMode" x-cloak></i>
                </button>
                <button @click="mobileMenu = !mobileMenu" class="text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white p-2">
                    <i class="fa-solid fa-bars text-xl" x-show="!mobileMenu"></i>
                    <i class="fa-solid fa-xmark text-xl" x-show="mobileMenu" x-cloak></i>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileMenu" x-cloak class="md:hidden border-t border-slate-200 dark:border-slate-800 bg-white/95 dark:bg-slate-950/95 px-6 py-4 space-y-3">
            <a href="#hero" @click="mobileMenu = false" class="block py-2 text-sm font-semibold text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400">Home</a>
            <a href="#video-showcase" @click="mobileMenu = false" class="block py-2 text-sm font-semibold text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400">Showcase</a>
            <a href="#about" @click="mobileMenu = false" class="block py-2 text-sm font-semibold text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400">About</a>
            <a href="#skills" @click="mobileMenu = false" class="block py-2 text-sm font-semibold text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400">Skills</a>
            <a href="#work-process" @click="mobileMenu = false" class="block py-2 text-sm font-semibold text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400">Work Process</a>
            <a href="#projects" @click="mobileMenu = false" class="block py-2 text-sm font-semibold text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400">Projects</a>
            <a href="#contact" @click="mobileMenu = false" class="block py-2 text-sm font-semibold text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400">Contact</a>
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
                    <a href="tel:{{ $profile->phone }}" class="hover:text-cyan-500 dark:hover:text-cyan-400 transition" title="Call {{ $profile->phone }}"><i class="fa-solid fa-phone"></i></a>
                @endif
            </div>
            <p>© {{ $settings['copyright_year'] ?? date('Y') }} {{ $profile?->full_name ?? 'Ahmed Adel' }}. All rights reserved.</p>
            <p><a href="{{ route('admin.login') }}" class="hover:text-slate-700 dark:hover:text-slate-400 transition">Admin Login</a></p>
        </div>
    </footer>
</body>
</html>

