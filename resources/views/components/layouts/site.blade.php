@php
    $dark = session('theme') === 'dark' || (session('theme') === null && true);
@endphp

<!DOCTYPE html>
<html lang="en" class="js-active">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->meta_title ?? ($profile->name . ' · ' . $profile->headline) }}</title>
    <meta name="description" content="{{ $setting->meta_description ?? $profile->short_bio }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $setting->meta_title ?? $profile->name }}">
    <meta property="og:description" content="{{ $setting->meta_description ?? $profile->short_bio }}">
    @if ($setting->og_image)
        <meta property="og:image" content="{{ asset('storage/' . $setting->og_image) }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter+Tight:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Devicon for colorful tech logos -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Theme before paint to avoid flash
        (function () {
            const stored = localStorage.getItem('theme');
            const dark = stored ? stored === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (dark) document.documentElement.classList.add('dark');
        })();
    </script>

    @stack('head')
</head>
<body class="min-h-screen flex flex-col">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-50 focus:bg-[var(--color-accent)] focus:text-[var(--color-paper)] focus:px-4 focus:py-2">
        Skip to content
    </a>

    <header class="sticky top-0 z-40 border-b rule" style="background: color-mix(in srgb, var(--bg) 88%, transparent)"
            x-data="{ open: false }">
        <nav class="mx-auto max-w-[1200px] px-5 md:px-8 h-16 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="font-display text-xl tracking-tight hover:text-accent transition-colors">
                {{ $profile->nickname ?? $profile->name }}
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-[var(--fg)] transition-colors">Index</a>
                <a href="{{ route('projects.index') }}" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-[var(--fg)] transition-colors">Work</a>
                <a href="{{ route('home') }}#about" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-[var(--fg)] transition-colors">About</a>
                <a href="{{ route('home') }}#contact" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-[var(--fg)] transition-colors">Contact</a>
            </div>

            <div class="flex items-center gap-2">
                <button
                    type="button"
                    x-data="themeToggle"
                    @click="toggle()"
                    class="w-11 h-11 inline-flex items-center justify-center text-muted hover:text-[var(--fg)] transition-colors"
                    aria-label="Toggle dark mode"
                >
                    <svg x-show="!isDark" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
                    <svg x-show="isDark" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                </button>

                <button
                    type="button"
                    @click="open = !open"
                    class="md:hidden w-11 h-11 inline-flex items-center justify-center text-[var(--fg)]"
                    aria-label="Toggle menu"
                    :aria-expanded="open"
                >
                    <svg x-show="!open" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
                    <svg x-show="open" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
        </nav>

        <div
            x-show="open"
            x-transition.opacity
            class="md:hidden border-t rule"
            style="display: none"
        >
            <div class="px-5 py-4 space-y-1">
                <a href="{{ route('home') }}" class="block py-3 font-mono text-sm uppercase tracking-wider">Index</a>
                <a href="{{ route('projects.index') }}" class="block py-3 font-mono text-sm uppercase tracking-wider">Work</a>
                <a href="{{ route('home') }}#about" class="block py-3 font-mono text-sm uppercase tracking-wider">About</a>
                <a href="{{ route('home') }}#contact" class="block py-3 font-mono text-sm uppercase tracking-wider">Contact</a>
            </div>
        </div>
    </header>

    <main id="main" class="flex-1">
        {{ $slot }}
    </main>

    <footer class="border-t rule mt-24">
        <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <p class="font-mono text-xs text-muted">
                © {{ date('Y') }} {{ $profile->name }}. All rights reserved.
            </p>
            <div class="flex items-center gap-6">
                @foreach ($socials as $social)
                    <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer"
                       class="font-mono text-xs uppercase tracking-wider text-muted hover:text-[var(--fg)] transition-colors">
                        {{ $social->platform }}
                    </a>
                @endforeach
            </div>
        </div>
    </footer>

    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition.opacity
            x-init="setTimeout(() => show = false, 4000)"
            class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 bg-[var(--color-ink)] text-[var(--color-paper)] px-5 py-3 font-mono text-sm shadow-lg"
            role="status"
        >
            {{ session('success') }}
        </div>
    @endif

    <script>
        document.documentElement.classList.add('js-active');
    </script>
</body>
</html>