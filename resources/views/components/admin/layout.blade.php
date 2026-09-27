@props(['title' => null])

@php
    $nav = [
        ['route' => 'admin.dashboard', 'label' => 'Dashboard'],
        ['route' => 'admin.projects.index', 'label' => 'Projects'],
        ['route' => 'admin.experiences.index', 'label' => 'Experience'],
        ['route' => 'admin.skills.index', 'label' => 'Skills'],
        ['route' => 'admin.certificates.index', 'label' => 'Certificates'],
        ['route' => 'admin.socials.index', 'label' => 'Social Links'],
        ['route' => 'admin.contacts.index', 'label' => 'Messages', 'badge' => $unreadMessages ?? 0],
        ['route' => 'admin.profile.edit', 'label' => 'Profile'],
        ['route' => 'admin.settings.edit', 'label' => 'SEO'],
    ];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ? $title . ' · Admin' : 'Admin' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[var(--color-paper)] text-[var(--color-ink)]">
    <div class="flex min-h-screen" x-data="{ menuOpen: false }">
        {{-- Sidebar --}}
        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 border-r rule bg-[var(--bg)] transition-transform duration-300 md:translate-x-0"
            :class="menuOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="h-16 flex items-center px-6 border-b rule">
                <a href="{{ route('admin.dashboard') }}" class="font-mono text-sm font-medium tracking-wider uppercase">
                    Admin
                </a>
            </div>
            <nav class="p-4 space-y-1">
                @foreach ($nav as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center justify-between gap-2 px-3 py-2.5 text-sm {{ request()->routeIs($item['route']) ? 'bg-accent text-[var(--color-paper)]' : 'text-muted hover:text-[var(--fg)] hover:bg-[color-mix(in_srgb,var(--color-accent)_7%,transparent)]' }} transition-colors">
                        {{ $item['label'] }}
                        @if (($item['badge'] ?? 0) > 0)
                            <span class="font-mono text-[10px] {{ request()->routeIs($item['route']) ? 'text-[var(--color-paper)]' : 'text-accent' }}">{{ $item['badge'] }}</span>
                        @endif
                    </a>
                @endforeach
            </nav>
            <div class="absolute bottom-0 inset-x-0 p-4 border-t rule">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2.5 text-sm text-muted hover:text-accent transition-colors">
                        Log out
                    </button>
                </form>
            </div>
        </aside>

        {{-- Mobile menu button --}}
        <button
            type="button"
            @click="menuOpen = true"
            class="md:hidden fixed top-4 left-4 z-40 w-11 h-11 flex items-center justify-center border rule bg-[var(--bg)]"
            aria-label="Open sidebar"
        >
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
        </button>

        {{-- Mobile menu backdrop --}}
        <div
            x-show="menuOpen"
            x-transition.opacity
            @click="menuOpen = false"
            class="md:hidden fixed inset-0 z-40 bg-black/30"
            style="display: none"
        ></div>

        {{-- Main --}}
        <div class="flex-1 md:ml-64">
            <header class="h-16 border-b rule flex items-center px-6 md:px-10">
                <h1 class="font-display text-2xl tracking-tight">{{ $title }}</h1>
                <div class="ml-auto">
                    <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer"
                       class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">
                        View site ↗
                    </a>
                </div>
            </header>

            <main class="p-6 md:p-10">
                {{ $slot }}
            </main>
        </div>
    </div>

    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition.opacity
            x-init="setTimeout(() => show = false, 3500)"
            class="fixed bottom-6 right-6 z-50 bg-[var(--color-ink)] text-[var(--color-paper)] px-5 py-3.5 font-mono text-sm shadow-lg"
            role="status"
        >
            {{ session('success') }}
        </div>
    @endif
</body>
</html>