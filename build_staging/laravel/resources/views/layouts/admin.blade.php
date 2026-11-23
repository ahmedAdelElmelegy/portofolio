<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-900 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Portfolio Manager</title>
    <!-- Tailwind Play CDN for immediate responsive styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Urbanist', sans-serif; }
    </style>
</head>
<body class="h-full antialiased" x-data="{ sidebarOpen: false }">
    <div class="min-h-full flex">
        <!-- Sidebar for Desktop & Mobile -->
        <div class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-950 border-r border-slate-800 flex flex-col transition-transform duration-300 md:translate-x-0"
             :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
            
            <!-- Logo / Brand -->
            <div class="h-16 flex items-center justify-between px-6 border-b border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-blue-500/30">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <div>
                        <span class="font-extrabold text-base tracking-wide text-white block">Portfolio CMS</span>
                        <span class="text-xs text-blue-400 font-medium">Laravel 12 Dashboard</span>
                    </div>
                </a>
                <button class="md:hidden text-slate-400 hover:text-white" @click="sidebarOpen = false">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-5 space-y-1.5 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-chart-pie w-5"></i>
                    <span>Dashboard</span>
                </a>

                <div class="pt-3 pb-1.5 px-3 text-xs font-bold uppercase tracking-wider text-slate-500">Portfolio Modules</div>

                <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.profile.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-user w-5"></i>
                    <span>Profile Info</span>
                </a>

                <a href="{{ route('admin.skills.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.skills.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-bolt w-5"></i>
                    <span>Skills</span>
                </a>

                <a href="{{ route('admin.experiences.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.experiences.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-briefcase w-5"></i>
                    <span>Experience & Edu</span>
                </a>

                <a href="{{ route('admin.work-processes.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.work-processes.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-list-check w-5"></i>
                    <span>Work Process</span>
                </a>

                <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.projects.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-folder-open w-5"></i>
                    <span>Projects</span>
                </a>

                <a href="{{ route('admin.video-section.edit') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.video-section.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-circle-play w-5"></i>
                    <span>Video Showcase</span>
                </a>

                <div class="pt-3 pb-1.5 px-3 text-xs font-bold uppercase tracking-wider text-slate-500">Inbox & Site</div>

                <a href="{{ route('admin.contact-messages.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.contact-messages.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-envelope w-5"></i>
                        <span>Messages</span>
                    </div>
                    @php $unreadCount = \App\Models\ContactMessage::unread()->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="px-2 py-0.5 text-xs font-bold bg-amber-500 text-slate-950 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.settings.edit') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-gear w-5"></i>
                    <span>Settings</span>
                </a>

                <div class="pt-4 mt-4 border-t border-slate-800/80">
                    <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold text-emerald-400 hover:bg-emerald-500/10 transition">
                        <i class="fa-solid fa-arrow-up-right-from-square w-5"></i>
                        <span>View Public Portfolio</span>
                    </a>
                </div>
            </nav>

            <!-- User footer profile -->
            <div class="p-4 border-t border-slate-800 bg-slate-950/80 flex items-center justify-between">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-9 h-9 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center font-bold">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="truncate">
                        <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email ?? '' }}</p>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Logout" class="p-2 text-slate-400 hover:text-red-400 transition rounded-lg hover:bg-slate-900">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main content area -->
        <div class="flex-1 md:pl-64 flex flex-col min-w-0">
            <!-- Topbar on mobile -->
            <div class="md:hidden h-16 bg-slate-950 border-b border-slate-800 flex items-center justify-between px-4 sticky top-0 z-30">
                <button @click="sidebarOpen = true" class="text-slate-400 hover:text-white p-2">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <span class="font-bold text-white text-base">Portfolio Admin</span>
                <a href="{{ route('home') }}" target="_blank" class="text-emerald-400 text-sm font-medium">
                    <i class="fa-solid fa-globe"></i>
                </a>
            </div>

            <!-- Main container -->
            <main class="flex-1 p-6 md:p-8 max-w-7xl w-full mx-auto">
                <!-- Flash messages -->
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" class="mb-6 flex items-center justify-between bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-4 py-3 rounded-xl shadow-lg">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-circle-check text-emerald-400"></i>
                            <span class="font-medium text-sm">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-emerald-400/60 hover:text-emerald-400">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endif

                @if(isset($errors) && $errors->any())
                    <div class="mb-6 bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl">
                        <div class="font-semibold text-sm mb-1">Please fix the following errors:</div>
                        <ul class="list-disc list-inside text-xs space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>

