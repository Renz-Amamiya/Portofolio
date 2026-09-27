<x-layouts.site>
    <section class="flex items-center">
        <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-24 md:py-40 w-full">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 md:col-span-2">
                    <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted">Error 404</p>
                </div>
                <div class="col-span-12 md:col-span-9">
                    <h1 class="font-display text-[clamp(3rem,10vw,8rem)] leading-[0.9] tracking-tight">
                        Not found.
                    </h1>
                    <p class="mt-8 max-w-md text-lg leading-relaxed text-muted">
                        The page you are looking for does not exist or has been moved.
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('home') }}"
                           class="inline-flex items-center justify-center bg-accent text-[var(--color-paper)] px-7 py-4 font-mono text-sm uppercase tracking-wider hover:opacity-90 transition-opacity">
                            Back to home
                        </a>
                        <a href="{{ route('projects.index') }}"
                           class="inline-flex items-center justify-center border rule px-7 py-4 font-mono text-sm uppercase tracking-wider hover:border-[var(--fg)] transition-colors">
                            Browse projects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.site>