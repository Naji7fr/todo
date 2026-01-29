<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Todo App') — {{ config('app.name') }}</title>
    {{-- Vite in dev/build; Tailwind CDN fallback --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="min-h-screen bg-slate-100 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased">
    <header id="navbar" class="sticky top-0 z-50 gradient-header shadow-lg">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <nav class="flex items-center gap-2">
                @auth
                    <a href="{{ route('tasks.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/90 hover:text-white hover:bg-white/10 font-medium text-sm transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        Taken
                    </a>
                @endauth
            </nav>
            <a href="{{ auth()->check() ? route('tasks.index') : route('login') }}" class="absolute left-1/2 -translate-x-1/2 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center text-white font-bold text-lg shadow-lg">L</div>
                <span class="font-bold text-white text-lg tracking-tight hidden sm:block">Todo App</span>
            </a>
            <nav class="flex items-center gap-2">
                @auth
                    <a href="{{ route('tasks.create') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white text-indigo-600 font-semibold text-sm hover:bg-white/95 shadow-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Nieuwe taak
                    </a>
                    <div class="relative" id="profile-dropdown-wrap">
                        <button type="button" id="profile-dropdown-btn" class="flex items-center gap-2 px-2 py-1.5 rounded-xl text-white/90 hover:bg-white/10 font-medium text-sm" aria-expanded="false" aria-haspopup="true">
                            @if(Auth::user()->avatar)
                                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="" class="w-8 h-8 rounded-full object-cover border-2 border-white/50">
                            @else
                                <span class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-sm font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            @endif
                            <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                            <svg id="profile-dropdown-chevron" class="w-4 h-4 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </button>
                        <div id="profile-dropdown-menu" class="absolute right-0 mt-1 w-48 rounded-xl bg-white dark:bg-slate-800 shadow-lg border border-slate-200 dark:border-slate-700 py-1 z-50 hidden" role="menu">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-t-xl">Mijn profiel</a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-b-xl">Uitloggen</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 rounded-xl text-white/90 hover:bg-white/10 font-medium text-sm">Inloggen</a>
                    <a href="{{ route('register') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white text-indigo-600 font-semibold text-sm hover:bg-white/95 shadow-lg transition-all">
                        Registreren
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 py-8">
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-sm shadow-sm">
                <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if (session('status') === 'profile-updated')
            <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-sm shadow-sm">
                {{ __('Profiel opgeslagen.') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-6 flex items-start gap-3 px-4 py-3 rounded-xl bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 text-sm shadow-sm">
                <svg class="w-5 h-5 shrink-0 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <ul class="list-none space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    @auth
    <script>
        (function() {
            var wrap = document.getElementById('profile-dropdown-wrap');
            var btn = document.getElementById('profile-dropdown-btn');
            var menu = document.getElementById('profile-dropdown-menu');
            var chevron = document.getElementById('profile-dropdown-chevron');
            if (!wrap || !btn || !menu) return;
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                var isOpen = !menu.classList.contains('hidden');
                menu.classList.toggle('hidden', isOpen);
                btn.setAttribute('aria-expanded', !isOpen);
                if (chevron) chevron.classList.toggle('rotate-180', !isOpen);
            });
            document.addEventListener('click', function() {
                menu.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
                if (chevron) chevron.classList.remove('rotate-180');
            });
            menu.addEventListener('click', function(e) { e.stopPropagation(); });
        })();
    </script>
    @endauth

</body>
</html>
