<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter+Tight:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex items-center justify-center bg-[var(--color-paper)] text-[var(--color-ink)] p-5">
    <div class="w-full max-w-md">
        <a href="{{ route('home') }}" class="font-display text-2xl tracking-tight">← Back to site</a>

        <div class="mt-10 border-t rule pt-10">
            <h1 class="font-display text-4xl tracking-tight">Log in</h1>
            <p class="mt-3 font-mono text-xs uppercase tracking-wider text-muted">Admin access only</p>

            @if ($errors->any())
                <div class="mt-6 border border-accent p-4">
                    <ul class="font-mono text-xs text-accent space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <p class="mt-6 font-mono text-xs text-accent" role="status">{{ session('status') }}</p>
            @endif

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf

                <div>
                    <label for="email" class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="w-full bg-transparent border rule px-4 py-3.5 focus:border-accent focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="password" class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                           class="w-full bg-transparent border rule px-4 py-3.5 focus:border-accent focus:outline-none transition-colors">
                </div>

                <label class="flex items-center gap-3 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 accent-[var(--color-accent)]">
                    <span class="font-mono text-xs uppercase tracking-wider text-muted">Remember me</span>
                </label>

                <button type="submit"
                        class="w-full bg-accent text-[var(--color-paper)] px-8 py-4 font-mono text-sm uppercase tracking-wider hover:opacity-90 transition-opacity">
                    Log in
                </button>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="block text-center font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">
                        Forgot your password?
                    </a>
                @endif
            </form>
        </div>
    </div>
</body>
</html>