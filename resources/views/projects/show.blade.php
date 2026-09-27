<x-layouts.site>
    <article>
        {{-- Header --}}
        <section class="border-b rule">
            <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-16 md:py-24">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 md:col-span-2">
                        <a href="{{ route('projects.index') }}" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">
                            ← Back
                        </a>
                    </div>
                    <div class="col-span-12 md:col-span-9">
                        <p class="font-mono text-xs uppercase tracking-[0.2em] text-accent mb-4">
                            {{ $project->category }} · {{ $project->year }}
                        </p>
                        <h1 class="font-display text-[clamp(2.25rem,6vw,4.5rem)] leading-[0.95] tracking-tight">
                            {{ $project->title }}
                        </h1>
                        <p class="mt-6 max-w-2xl text-lg leading-relaxed text-muted">{{ $project->description }}</p>

                        <div class="mt-10 flex flex-wrap gap-2">
                            @foreach ($project->technologies ?? [] as $tech)
                                <span class="font-mono text-[10px] uppercase tracking-wider text-muted border rule px-3 py-1.5">{{ $tech }}</span>
                            @endforeach
                        </div>

                        <div class="mt-10 flex flex-col sm:flex-row gap-4">
                            @if ($project->project_url)
                                <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center justify-center gap-3 bg-accent text-[var(--color-paper)] px-7 py-4 font-mono text-sm uppercase tracking-wider hover:opacity-90 transition-opacity">
                                    Live demo
                                </a>
                            @endif
                            @if ($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center justify-center gap-3 border rule px-7 py-4 font-mono text-sm uppercase tracking-wider hover:border-[var(--fg)] transition-colors">
                                    Source code
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Thumbnail --}}
        @if ($project->image)
        <section class="border-b rule">
            <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-12">
                <div class="parallax overflow-hidden border rule">
                    <img src="{{ $project->image_url }}" alt="{{ $project->title }} thumbnail"
                         class="w-full h-[280px] md:h-[480px] object-cover" loading="lazy"
                         width="1200" height="480">
                </div>
            </div>
        </section>
        @endif

        {{-- Content --}}
        <section class="border-b rule">
            <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-16 md:py-24">
                <div class="grid grid-cols-12 gap-6">
                    @if ($project->role)
                    <div class="col-span-12 md:col-span-3">
                        <p class="font-mono text-xs uppercase tracking-wider text-muted">Role</p>
                        <p class="mt-2 font-display text-xl">{{ $project->role }}</p>
                    </div>
                    @endif
                    <div class="col-span-12 @if ($project->role) md:col-span-8 md:col-start-5 @else md:col-span-9 md:col-start-4 @endif">
                        @if ($project->content)
                            <div class="prose-editorial max-w-2xl">
                                {!! \Illuminate\Support\Str::markdown($project->content) !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- Gallery --}}
        @if (!empty($project->gallery))
        <section class="border-b rule">
            <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-16 md:py-24">
                <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted mb-8">Gallery</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($project->gallery_urls as $image)
                        <div class="parallax overflow-hidden border rule">
                            <img src="{{ $image }}" alt="{{ $project->title }} gallery image {{ $loop->iteration }}"
                                 class="w-full h-64 md:h-80 object-cover" loading="lazy"
                                 width="800" height="640">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- Prev / Next --}}
        <section>
            <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-16">
                <div class="grid grid-cols-2 gap-6 border-t rule pt-8">
                    @if ($previous)
                        <a href="{{ route('projects.show', $previous->slug) }}" class="group block min-w-0">
                            <p class="font-mono text-xs uppercase tracking-wider text-muted">Previous</p>
                            <p class="mt-2 font-display text-xl md:text-2xl truncate group-hover:text-accent transition-colors">
                                {{ $previous->title }}
                            </p>
                        </a>
                    @else
                        <div></div>
                    @endif

                    @if ($next)
                        <a href="{{ route('projects.show', $next->slug) }}" class="group block text-right min-w-0">
                            <p class="font-mono text-xs uppercase tracking-wider text-muted">Next</p>
                            <p class="mt-2 font-display text-xl md:text-2xl truncate group-hover:text-accent transition-colors">
                                {{ $next->title }}
                            </p>
                        </a>
                    @else
                        <div></div>
                    @endif
                </div>
            </div>
        </section>
    </article>
</x-layouts.site>