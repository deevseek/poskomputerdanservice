<!DOCTYPE html>
<html lang="id" class="h-full" x-data="{}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Aplikasi'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        accent: '#06B6D4',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        glow: '0 10px 60px -15px rgba(79, 70, 229, 0.45)',
                    },
                },
            },
            darkMode: 'class',
        };
        const storedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const initialTheme = storedTheme ? storedTheme : (prefersDark ? 'dark' : 'light');
        if (initialTheme === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
    <style>
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card-animate { animation: fade-in-up 0.8s ease forwards; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-cyan-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-900 text-slate-800 dark:text-slate-100 relative overflow-hidden">
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -left-32 -top-32 h-72 w-72 rounded-full bg-primary/30 blur-3xl"></div>
        <div class="absolute -right-24 top-10 h-64 w-64 rounded-full bg-accent/25 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/2 h-60 w-60 -translate-x-1/2 rounded-full bg-indigo-200/40 dark:bg-indigo-500/20 blur-3xl"></div>
    </div>

    <div class="relative z-10 flex min-h-screen items-center justify-center px-4 py-10">
        <button id="theme-toggle" type="button" class="absolute right-6 top-6 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/70 px-4 py-2 text-sm font-semibold text-slate-700 shadow-lg shadow-indigo-500/10 backdrop-blur-md transition hover:-translate-y-0.5 hover:shadow-glow dark:border-slate-700/70 dark:bg-slate-900/80 dark:text-slate-100 dark:hover:shadow-indigo-900/40" aria-label="Mode gelap/terang">
            <span class="sr-only">Toggle mode</span>
            <svg id="icon-sun" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364 6.364-1.414-1.414M7.05 7.05 5.636 5.636m12.728 0-1.414 1.414M7.05 16.95l-1.414 1.414M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/></svg>
            <svg id="icon-moon" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M20.354 15.354A9 9 0 0 1 8.646 3.646 7 7 0 1 0 20.354 15.354Z"/></svg>
            <span id="theme-label">Mode Gelap</span>
        </button>

        <div class="w-full max-w-md">
            <div class="relative overflow-hidden rounded-2xl bg-white/80 p-8 shadow-2xl shadow-indigo-500/10 backdrop-blur-xl ring-1 ring-slate-200/70 dark:bg-slate-900/70 dark:ring-slate-800 card-animate">
                <div class="absolute inset-0 bg-gradient-to-br from-white/10 via-primary/5 to-accent/10 opacity-70 dark:from-white/5 dark:via-primary/10 dark:to-accent/5"></div>
                <div class="relative z-10">
                    <div class="mb-6 flex flex-col items-center gap-3 text-center">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-primary to-accent text-white shadow-lg shadow-primary/30">
                            <span class="text-lg font-bold">{{ substr(config('app.name', 'POS'), 0, 1) }}</span>
                        </div>
                        <div>
                            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">@yield('title', 'Autentikasi')</h1>
                            @hasSection('subtitle')
                                <p class="mt-2 text-sm text-slate-500 dark:text-slate-300">@yield('subtitle')</p>
                            @endif
                        </div>
                    </div>

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const sunIcon = document.getElementById('icon-sun');
        const moonIcon = document.getElementById('icon-moon');
        const themeLabel = document.getElementById('theme-label');

        function setTheme(mode) {
            const isDark = mode === 'dark';
            document.documentElement.classList.toggle('dark', isDark);
            localStorage.setItem('theme', mode);
            sunIcon.classList.toggle('hidden', isDark);
            moonIcon.classList.toggle('hidden', !isDark);
            themeLabel.textContent = isDark ? 'Mode Terang' : 'Mode Gelap';
        }

        setTheme(document.documentElement.classList.contains('dark') ? 'dark' : 'light');

        themeToggle?.addEventListener('click', () => {
            const isCurrentlyDark = document.documentElement.classList.contains('dark');
            setTheme(isCurrentlyDark ? 'light' : 'dark');
        });
    </script>
</body>
</html>
