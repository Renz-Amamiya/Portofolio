<x-layouts.site>
    <section class="border-b rule">
        <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-20 md:py-28">
            <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted mb-6">Work</p>
            <h1 class="font-display text-[clamp(2.5rem,7vw,5rem)] leading-[0.95] tracking-tight">
                All projects
            </h1>
        </div>
    </section>

    <section>
        <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-16">
            {{-- Tech filter --}}
            @if ($technologies->isNotEmpty())
            <div class="flex flex-wrap items-center gap-3 mb-12 pb-6 border-b rule">
                <a href="{{ route('projects.index') }}"
                   class="font-mono text-xs uppercase tracking-wider px-4 py-2 border {{ $activeTech === '' ? 'border-accent text-accent' : 'rule text-muted hover:text-[var(--fg)]' }} transition-colors">
                    All
                </a>
                @foreach ($technologies as $tech)
                    <a href="{{ route('projects.index', ['tech' => $tech]) }}"
                       class="font-mono text-xs uppercase tracking-wider px-4 py-2 border {{ $activeTech === $tech ? 'border-accent text-accent' : 'rule text-muted hover:text-[var(--fg)]' }} transition-colors">
                        {{ $tech }}
                    </a>
                @endforeach
            </div>
            @endif

            @if ($projects->isNotEmpty())
            <div class="border-t rule">
                @foreach ($projects as $project)
                    <a href="{{ route('projects.show', $project->slug) }}"
                       class="project-row group grid grid-cols-12 gap-4 items-center border-b rule py-8 transition-colors hover:bg-[color-mix(in_srgb,var(--color-accent)_5%,transparent)]">
                        <div class="col-span-12 md:col-span-7 min-w-0">
                            <h3 class="font-display text-2xl md:text-4xl tracking-tight transition-transform duration-500 group-hover:translate-x-2">
                                {{ $project->title }}
                            </h3>
                            <p class="mt-2 text-sm text-muted line-clamp-2">{{ $project->description }}</p>
                        </div>
                        <div class="col-span-7 md:col-span-3 flex flex-wrap gap-2">
                            @foreach (array_slice($project->technologies ?? [], 0, 3) as $tech)
                                <span class="font-mono text-[10px] uppercase tracking-wider text-muted border rule px-2 py-1">{{ $tech }}</span>
                            @endforeach
                        </div>
                        <div class="col-span-5 md:col-span-2 text-right">
                            <span class="font-mono text-xs text-muted">{{ $project->year }}</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $projects->links() }}
            </div>
            @else
            <div class="border-t rule py-16">
                <p class="font-mono text-sm text-muted">
                    @if ($activeTech)
                        No projects found for "{{ $activeTech }}". Try another filter.
                    @else
                        No published projects yet.
                    @endif
                </p>
                @if ($activeTech)
                    <a href="{{ route('projects.index') }}" class="mt-4 inline-block font-mono text-sm text-accent hover:underline">
                        Clear filter
                    </a>
                @endif
            </div>
            @endif
        </div>
    </section>
</x-layouts.site>