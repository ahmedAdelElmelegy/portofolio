<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Portfolio CMS</title>
    
    <!-- Theme Script (Prevent FOUC) -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        urbanist: ['Urbanist', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Urbanist', sans-serif; }</style>
</head>
<body class="h-full flex items-center justify-center p-6 bg-gradient-to-br from-slate-100 via-white to-blue-50/50 dark:from-slate-950 dark:via-slate-900 dark:to-blue-950/40 text-slate-800 dark:text-slate-100 transition-colors duration-200"
      x-data="{ 
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

    <!-- Top Theme Toggle -->
    <div class="fixed top-6 right-6">
        <button @click="toggleTheme()" type="button" aria-label="Toggle theme" title="Toggle Light / Dark mode"
                class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow transition">
            <i class="fa-solid fa-sun text-amber-500 text-base" x-show="!darkMode"></i>
            <i class="fa-solid fa-moon text-blue-400 text-base" x-show="darkMode" x-cloak></i>
        </button>
    </div>

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-600 text-white flex items-center justify-center text-2xl font-bold shadow-xl shadow-blue-500/30 mb-4">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">Admin Portal</h1>
            <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">Sign in to manage your portfolio content</p>
        </div>

        <div class="bg-white dark:bg-slate-900/90 border border-slate-200 dark:border-slate-800 rounded-2xl p-8 shadow-xl dark:shadow-2xl backdrop-blur-xl transition-colors">
            @if(isset($errors) && $errors->any())
                <div class="mb-5 p-3 rounded-lg bg-red-500/10 border border-red-500/30 text-red-600 dark:text-red-400 text-xs">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Email Address</label>
                    <div class="relative">
                        <i class="fa-regular fa-envelope absolute left-3.5 top-3.5 text-slate-400 dark:text-slate-500"></i>
                        <input type="email" name="email" value="{{ old('email', 'admin@portfolio.test') }}" required autofocus
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700/80 rounded-xl text-slate-900 dark:text-white text-sm placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Password</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3.5 top-3.5 text-slate-400 dark:text-slate-500"></i>
                        <input type="password" name="password" value="password" required
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700/80 rounded-xl text-slate-900 dark:text-white text-sm placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-300">
                        <input type="checkbox" name="remember" class="rounded bg-slate-100 dark:bg-slate-950 border-slate-300 dark:border-slate-700 text-blue-600 focus:ring-0">
                        <span>Remember me</span>
                    </label>
                    <span class="text-slate-500">Default: password</span>
                </div>

                <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl text-sm transition shadow-lg shadow-blue-600/30">
                    Sign In to Dashboard
                </button>
            </form>
        </div>

        <div class="text-center mt-6 text-xs text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Back to Public Portfolio
            </a>
        </div>
    </div>
</body>
</html>
