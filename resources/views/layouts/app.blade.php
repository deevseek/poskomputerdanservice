<!DOCTYPE html>
<html lang="id" class="h-full" x-data="{ sidebarOpen: false, darkMode: localStorage.getItem('theme') === 'dark' }" x-bind:class="{ 'dark': darkMode }" x-init="if(darkMode){document.documentElement.classList.add('dark')}" xmlns:x="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Komputer &amp; Servis</title>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui'] },
                    colors: {
                        primary: '#4F46E5',
                        accent: '#06B6D4'
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full bg-slate-50 text-slate-800 dark:bg-slate-900 dark:text-slate-100">
<div class="flex h-screen" x-data="{ navOpen: false }">
    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'
        " class="fixed z-30 h-full w-72 transform border-r border-slate-200 bg-white/90 px-4 py-6 shadow-lg backdrop-blur transition duration-300 ease-in-out dark:border-slate-800 dark:bg-slate-900/80 lg:static lg:translate-x-0" x-bind:class="{ '-translate-x-full': !sidebarOpen }">
        <div class="flex items-center justify-between px-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </span>
                <div>
                    <p class="text-lg font-semibold text-primary">POS Komputer</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">dan Service</p>
                </div>
            </div>
            <button class="lg:hidden" @click="sidebarOpen = false">
                <svg class="h-6 w-6 text-slate-600 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="mt-8 space-y-1">
            @php
                $menus = [
                    ['label' => 'Dashboard', 'icon' => 'home', 'route' => url('/')],
                    ['label' => 'POS (Kasir)', 'icon' => 'calculator', 'route' => url('/kasir')],
                    ['label' => 'Produk', 'icon' => 'cube', 'route' => url('/produk')],
                    ['label' => 'Stok', 'icon' => 'archive-box', 'route' => url('/stok')],
                    ['label' => 'Pelanggan', 'icon' => 'users', 'route' => url('/pelanggan')],
                    ['label' => 'Servis', 'icon' => 'wrench-screwdriver', 'route' => url('/servis')],
                    ['label' => 'Garansi', 'icon' => 'shield-check', 'route' => url('/garansi')],
                    ['label' => 'Keuangan', 'icon' => 'banknotes', 'route' => url('/keuangan')],
                    ['label' => 'Pengaturan', 'icon' => 'cog-6-tooth', 'route' => url('/pengaturan')],
                    ['label' => 'Manajemen Role', 'icon' => 'key', 'route' => url('/role')],
                ];
                function iconSvg($name){
                    $icons = [
                        'home' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10.5 12 3l9 7.5v9.75a.75.75 0 0 1-.75.75H3.75A.75.75 0 0 1 3 20.25z" />',
                        'calculator' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 4.5h10.5A2.25 2.25 0 0 1 19.5 6.75v10.5A2.25 2.25 0 0 1 17.25 19.5H6.75A2.25 2.25 0 0 1 4.5 17.25V6.75A2.25 2.25 0 0 1 6.75 4.5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 8.25h7.5m-7.5 3h7.5m-7.5 3h3" />',
                        'cube' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21 7.5-9-4.5-9 4.5 9 4.5 9-4.5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7.5v9l9 4.5m9-13.5v9l-9 4.5m0-9v9" />',
                        'archive-box' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.375 7.5h17.25M9.75 12h4.5m-10.125 8.625h15.75A1.125 1.125 0 0 0 21 19.5v-12a1.125 1.125 0 0 0-1.125-1.125h-15.75A1.125 1.125 0 0 0 3 7.5v12a1.125 1.125 0 0 0 1.125 1.125z" />',
                        'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.5 8.25a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5zM3 19.5a4.5 4.5 0 0 1 9 0m7.5-6.75a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5zM15 19.5a4.5 4.5 0 0 1 7.5 0" />',
                        'wrench-screwdriver' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.814 15.75 7.5 18.064 3.436 14a1.876 1.876 0 1 1 2.653-2.653L9.814 15.75zm0 0 1.06 1.06a1.876 1.876 0 0 0 2.652-2.652l-1.06-1.06m-2.652 2.652 4.88-4.88m2.651-5.901a3.752 3.752 0 0 1-5.304 5.304L12.75 9l-2.94-.735-.735-2.94 1.506-1.506a3.752 3.752 0 0 1 5.304 0z" />',
                        'shield-check' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75 11.25 15 15 9.75M12 3 3.75 6v6c0 4.421 3.134 8.462 7.5 9 4.366-.538 7.5-4.579 7.5-9V6z" />',
                        'banknotes' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12m-8.25-3.75h16.5m-16.5-4.5h16.5M4.5 9a3 3 0 0 0 3-3h9a3 3 0 0 0 3 3v6a3 3 0 0 0-3 3h-9a3 3 0 0 0-3-3z" />',
                        'cog-6-tooth' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.594 3.94c.9-1.56 3.14-1.56 4.04 0l.35.61c.16.28.46.45.78.45h.7c1.8 0 2.55 2.31 1.1 3.32l-.57.41c-.26.19-.37.52-.3.83l.14.66c.42 1.9-1.39 3.43-3.12 2.57l-.62-.31a1.01 1.01 0 0 0-.9 0l-.62.31c-1.73.86-3.54-.67-3.12-2.57l.14-.66a.97.97 0 0 0-.3-.83l-.57-.41c-1.45-1.01-.7-3.32 1.1-3.32h.7c.32 0 .62-.17.78-.45l.35-.61z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />',
                        'key' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 5.25a3.75 3.75 0 1 1-4.5 4.5l-5.14 5.14a2.12 2.12 0 0 1-1.5.62H3v-1.61c0-.4.16-.78.43-1.06l5.32-5.31a3.75 3.75 0 0 1 6.99-2.28z" />'
                    ];
                    return $icons[$name] ?? '';
                }
            @endphp
            @foreach($menus as $menu)
                <a href="{{ $menu['route'] }}" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-primary/10 hover:text-primary dark:text-slate-300 dark:hover:bg-slate-800">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-primary transition group-hover:bg-primary group-hover:text-white dark:bg-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-5 w-5">
                            {!! iconSvg($menu['icon']) !!}
                        </svg>
                    </span>
                    <span>{{ $menu['label'] }}</span>
                    @if($menu['label'] === 'POS (Kasir)')
                        <span class="ml-auto rounded-full bg-red-500 px-2 text-xs font-semibold text-white shadow">●</span>
                    @endif
                </a>
            @endforeach
        </div>
        <div class="mt-auto hidden pt-6 lg:block">
            <div class="rounded-2xl bg-gradient-to-r from-primary to-accent p-4 text-white shadow-lg">
                <p class="text-sm opacity-80">Kasir siap digunakan</p>
                <p class="text-lg font-semibold">Selamat datang!</p>
            </div>
        </div>
    </aside>

    <!-- Overlay mobile -->
    <div class="fixed inset-0 z-20 bg-slate-900/50 backdrop-blur-sm transition lg:hidden" x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak></div>

    <!-- Main content -->
    <div class="flex min-h-screen flex-1 flex-col lg:ml-0">
        <header class="sticky top-0 z-10 border-b border-slate-200 bg-white/80 backdrop-blur dark:border-slate-800 dark:bg-slate-900/80">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-3">
                    <button class="lg:hidden rounded-lg border border-slate-200 p-2 text-slate-600 shadow-sm dark:border-slate-700 dark:text-slate-200" @click="sidebarOpen = true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <div class="relative">
                        <input type="text" placeholder="Cari fitur cepat..." class="w-60 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm shadow-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-800" />
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <button class="relative rounded-full bg-white p-2 shadow-sm ring-1 ring-slate-200 transition hover:ring-primary dark:bg-slate-800 dark:ring-slate-700">
                        <svg class="h-5 w-5 text-slate-600 dark:text-slate-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.857 17.657a6 6 0 1 0-5.714 0" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                        </svg>
                        <span class="absolute -right-1 -top-1 h-3 w-3 rounded-full bg-red-500 ring-2 ring-white"></span>
                    </button>
                    <button class="rounded-full bg-white p-2 shadow-sm ring-1 ring-slate-200 transition hover:ring-primary dark:bg-slate-800 dark:ring-slate-700" @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light'); document.documentElement.classList.toggle('dark');">
                        <template x-if="!darkMode">
                            <svg class="h-5 w-5 text-slate-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 21v-2.25m-6.364-.386 1.591-1.591M3 12h2.25m.386-6.364 1.591 1.591M9 12a3 3 0 1 0 6 0 3 3 0 0 0-6 0z" />
                            </svg>
                        </template>
                        <template x-if="darkMode">
                            <svg class="h-5 w-5 text-yellow-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.752 15.002A9.718 9.718 0 0 1 18 15.75 9.75 9.75 0 0 1 8.25 6c0-1.33.266-2.597.748-3.75A9.753 9.753 0 0 0 3 11.25C3 16.634 7.366 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998z" />
                            </svg>
                        </template>
                    </button>
                    <div class="relative" x-data="{ open:false }">
                        <button @click="open = !open" class="flex items-center gap-3 rounded-full bg-white px-3 py-2 text-left shadow-sm ring-1 ring-slate-200 transition hover:ring-primary dark:bg-slate-800 dark:ring-slate-700">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary font-semibold">AK</span>
                            <div>
                                <p class="text-sm font-semibold">Admin Kasir</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Superuser</p>
                            </div>
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m6 9 6 6 6-6" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open=false" class="absolute right-0 mt-2 w-52 rounded-2xl border border-slate-200 bg-white p-2 shadow-xl dark:border-slate-700 dark:bg-slate-800" x-cloak>
                            <a href="#" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm text-slate-700 transition hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-700">Profil</a>
                            <a href="#" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm text-slate-700 transition hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-700">Pengaturan Akun</a>
                            <div class="h-px bg-slate-100 dark:bg-slate-700"></div>
                            <form method="POST" action="#">
                                <button class="flex w-full items-center gap-2 rounded-xl px-3 py-2 text-sm text-red-500 transition hover:bg-red-50 dark:hover:bg-red-500/10">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto px-6 py-8">
            @yield('content')
        </main>

        <footer class="border-t border-slate-200 bg-white/70 px-6 py-4 text-sm text-slate-500 dark:border-slate-800 dark:bg-slate-900/70">
            <div class="flex flex-wrap items-center justify-between gap-2">
                <p>&copy; {{ date('Y') }} POS Komputer &amp; Servis</p>
                <div class="flex items-center gap-2 text-xs">
                    <span class="rounded-full bg-primary/10 px-3 py-1 text-primary">Versi UI</span>
                    <span class="rounded-full bg-accent/10 px-3 py-1 text-accent">Tailwind</span>
                </div>
            </div>
        </footer>
    </div>
</div>
@stack('scripts')
</body>
</html>
