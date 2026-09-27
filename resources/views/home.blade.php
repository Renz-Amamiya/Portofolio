<x-layouts.site>
    {{-- HERO: Designer / Coder Split Layout --}}
    <section class="relative min-h-[85vh] flex items-center justify-center overflow-hidden bg-[var(--color-paper)] border-b rule" id="hero-section">
        
        <div class="mx-auto max-w-[1200px] px-5 md:px-8 w-full relative h-full flex flex-col md:flex-row items-center justify-between z-10 py-32">
            
            {{-- Left Side: First Name --}}
            <div class="w-full md:w-[35%] text-center md:text-left z-20 mb-12 md:mb-0" data-hero-left>
                <h1 class="font-display text-[3.5rem] md:text-[5rem] lg:text-[6rem] leading-none tracking-tight font-bold text-[var(--color-ink)]">
                    {{ explode(' ', $profile->name)[0] }}
                </h1>
                <p class="mt-4 text-base md:text-lg text-muted max-w-sm mx-auto md:mx-0 font-light">
                    {{ $profile->headline }}
                </p>
            </div>

            {{-- Right Side: Last Name --}}
            <div class="w-full md:w-[35%] text-center md:text-right z-20 mt-12 md:mt-0 md:ml-auto" data-hero-right>
                <h1 class="font-display text-[3.5rem] md:text-[5rem] lg:text-[6rem] leading-none tracking-tight font-bold text-[var(--color-ink)]">
                    {{ count(explode(' ', $profile->name)) > 1 ? last(explode(' ', $profile->name)) : '<coder>' }}.
                </h1>
                <p class="mt-4 text-base md:text-lg text-muted max-w-sm mx-auto md:ml-auto md:mr-0 font-light">
                    {{ Str::before($profile->short_bio, '.') }}.
                </p>
                <div class="mt-6 font-mono text-xs text-muted opacity-50 hidden md:block" data-hero-code>
                    &lt;?php<br>
                    &nbsp;&nbsp;echo "{{ $profile->nickname }}";<br>
                    ?&gt;
                </div>
            </div>
            
        </div>

        {{-- Center: Large Photo Overlay --}}
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[90%] max-w-[550px] z-30 pointer-events-none" data-hero-center>
            @if ($profile->photo)
                {{-- Dramatic Ghost Silhouette Effect (Mirrored) --}}
                <img src="{{ asset('storage/' . $profile->photo) }}" alt="" 
                     class="absolute bottom-4 -left-4 md:-left-16 w-[110%] max-w-none h-auto object-contain object-bottom opacity-10 blur-sm grayscale -z-10 -scale-x-100" 
                     data-hero-ghost>
                
                {{-- Main Photo --}}
                <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}" 
                     class="relative w-full h-auto object-contain object-bottom drop-shadow-2xl z-10">
            @else
                <div class="w-full aspect-[3/4] bg-gray-100 flex flex-col items-center justify-center text-muted border-t border-x rule rounded-t-3xl shadow-xl">
                    <svg class="w-16 h-16 mb-4 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <p class="font-mono text-sm uppercase tracking-widest opacity-50 text-center px-4">Upload your<br>cutout photo</p>
                </div>
            @endif
        </div>
        
    </section>

    {{-- ABOUT: text-led, no cards --}}
    {{-- ABOUT: split layout, massive index --}}
    <section id="about" class="border-b rule bg-[var(--color-ink)] text-[var(--color-paper)]">
        <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-24 md:py-40">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 md:gap-6">
                <div class="md:col-span-5 flex flex-col justify-between">
                    <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-[var(--color-paper)] opacity-50">01 / The Persona</p>
                    <h2 class="font-display text-6xl md:text-8xl tracking-tight mt-12 md:mt-0 italic">Who am I?</h2>
                </div>
                <div class="md:col-span-6 md:col-start-7" data-reveal>
                    @if ($profile->long_bio)
                        <div class="prose-editorial prose-invert max-w-none text-[var(--color-paper)] [&>p]:text-[var(--color-paper)] [&>p]:opacity-80 [&>h3]:text-[var(--color-paper)] [&>ul>li]:text-[var(--color-paper)] [&>ul>li]:opacity-80">
                            {!! \Illuminate\Support\Str::markdown($profile->long_bio) !!}
                        </div>
                    @else
                        <p class="text-xl md:text-2xl leading-relaxed opacity-80">{{ $profile->short_bio }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURED WORK: row list, not card grid --}}
    {{-- FEATURED WORK: ultra-minimal typography led --}}
    <section class="border-b rule">
        <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-24 md:py-40">
            <div class="flex items-end justify-between mb-20">
                <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-muted">02 / Selected Archives</p>
                <a href="{{ route('projects.index') }}" class="font-mono text-xs uppercase tracking-widest hover:text-accent transition-colors underline underline-offset-4">
                    Index of all works
                </a>
            </div>

            <div class="border-t rule flex flex-col">
                @foreach ($featuredProjects as $index => $project)
                    <a href="{{ route('projects.show', $project->slug) }}"
                       class="project-row group flex flex-col md:flex-row md:items-center gap-6 md:gap-12 border-b rule py-10 transition-colors hover:bg-[color-mix(in_srgb,var(--color-accent)_3%,transparent)]">
                        <span class="font-mono text-xs text-muted md:w-12 shrink-0">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        
                        <div class="flex-1 min-w-0">
                            <h3 class="font-display text-4xl md:text-6xl tracking-tight transition-all duration-500 group-hover:italic group-hover:text-accent group-hover:translate-x-4">
                                {{ $project->title }}
                            </h3>
                            <div class="flex flex-wrap gap-3 mt-4 md:translate-x-0 transition-transform duration-500 group-hover:translate-x-4">
                                @foreach (array_slice($project->technologies, 0, 3) as $tech)
                                    <span class="font-mono text-[10px] uppercase tracking-wider text-muted border rule px-2 py-1">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between md:justify-end gap-8 shrink-0 mt-4 md:mt-0">
                            <span class="font-mono text-sm">{{ $project->year }}</span>
                            <span class="w-10 h-10 rounded-full border rule flex items-center justify-center group-hover:bg-accent group-hover:border-accent group-hover:text-[var(--color-paper)] transition-all duration-300">
                                <svg class="w-4 h-4 transform -rotate-45 group-hover:rotate-0 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            @if ($featuredProjects->isEmpty())
                <p class="font-mono text-sm text-muted py-12">No published projects yet.</p>
            @endif
        </div>
    </section>

    {{-- EXPERIENCE: timeline --}}
    <section class="border-b rule">
        <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-20 md:py-32">
            <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted mb-12">03 / Experience</p>

            <div class="grid grid-cols-12 gap-6">
                @foreach ($experiences as $experience)
                    <div class="col-span-12 md:col-span-6" data-reveal>
                        <div class="border-t rule pt-5">
                            <p class="font-mono text-xs text-accent">{{ $experience->period }}</p>
                            <h3 class="mt-2 font-display text-2xl tracking-tight">{{ $experience->position }}</h3>
                            <p class="mt-1 text-sm text-muted">
                                {{ $experience->company }} · {{ \App\Models\Experience::TYPES[$experience->type] ?? $experience->type }}
                            </p>
                            @if ($experience->description)
                                <p class="mt-3 text-sm leading-relaxed text-muted">{{ $experience->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($experiences->isEmpty())
                <p class="font-mono text-sm text-muted">No experience added yet.</p>
            @endif
        </div>
    </section>

    {{-- SKILLS: colorful logos and marquee --}}
    <section class="border-b rule bg-transparent">
        <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-20 md:py-32 overflow-hidden relative">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[rgba(234,88,12,0.03)] to-transparent pointer-events-none"></div>
            <p class="font-mono text-sm uppercase tracking-[0.3em] text-muted mb-16 text-center">Tools of the Trade</p>

            @php 
                $grouped = $skills->groupBy('category');
                
                // Helper to map skill names to Devicon classes
                $getIcon = function($name) {
                    $map = [
                        'HTML' => 'html5-plain colored',
                        'CSS' => 'css3-plain colored',
                        'JavaScript' => 'javascript-plain colored',
                        'PHP' => 'php-plain colored',
                        'Laravel' => 'laravel-original colored',
                        'Next.js' => 'nextjs-plain',
                        'React' => 'react-original colored',
                        'Tailwind CSS' => 'tailwindcss-original colored',
                        'Bootstrap' => 'bootstrap-plain colored',
                        'Supabase' => 'supabase-plain colored',
                        'Figma' => 'figma-plain colored',
                        'Linux' => 'linux-plain',
                        'MySQL' => 'mysql-plain colored',
                        'Git' => 'git-plain colored'
                    ];
                    return $map[$name] ?? 'code-plain';
                };
            @endphp
            
            <div class="space-y-16">
                @foreach ($grouped as $category => $items)
                    <div data-reveal>
                        <h3 class="font-mono text-xs uppercase tracking-widest text-accent mb-8 text-center">{{ $category }}</h3>
                        <div class="flex flex-wrap justify-center gap-6 md:gap-10">
                            @foreach ($items as $skill)
                                <div class="group flex flex-col items-center gap-3 p-4 hover:-translate-y-2 transition-transform duration-300">
                                    <i class="devicon-{{ $getIcon($skill->name) }} text-5xl md:text-6xl drop-shadow-sm group-hover:drop-shadow-md transition-all"></i>
                                    <span class="font-mono text-[10px] uppercase tracking-wider text-muted group-hover:text-[var(--fg)] transition-colors">
                                        {{ $skill->name }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($skills->isEmpty())
                <p class="font-mono text-sm text-muted text-center">No skills added yet.</p>
            @endif
        </div>
    </section>

    {{-- CERTIFICATES --}}
    @if ($certificates->isNotEmpty())
    <section class="border-b rule">
        <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-20 md:py-32">
            <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted mb-12">05 / Certificates</p>

            <div class="border-t rule">
                @foreach ($certificates as $certificate)
                    <div class="flex items-center justify-between gap-6 border-b rule py-5">
                        <div class="min-w-0">
                            <h3 class="font-display text-xl md:text-2xl tracking-tight">{{ $certificate->title }}</h3>
                            <p class="mt-1 text-sm text-muted">{{ $certificate->issuer }}</p>
                        </div>
                        <div class="flex shrink-0 items-center gap-6">
                            <span class="font-mono text-xs text-muted">{{ $certificate->issue_date->format('M Y') }}</span>
                            @if ($certificate->url)
                                <a href="{{ $certificate->url }}" target="_blank" rel="noopener noreferrer"
                                   class="font-mono text-xs uppercase tracking-wider hover:text-accent transition-colors">View</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CONTACT --}}
    <section id="contact">
        <div class="mx-auto max-w-[1200px] px-5 md:px-8 py-20 md:py-32">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 md:col-span-5">
                    <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted mb-6">06 / Contact</p>
                    <h2 class="font-display text-[clamp(2rem,5vw,3.5rem)] leading-[0.95] tracking-tight">
                        Let's build something.
                    </h2>
                    <p class="mt-6 text-muted leading-relaxed">
                        Available for freelance work and internships. Send a message and I will reply within a few days.
                    </p>
                    @if ($profile->email)
                        <a href="mailto:{{ $profile->email }}" class="mt-6 inline-block font-mono text-sm hover:text-accent transition-colors">
                            {{ $profile->email }}
                        </a>
                    @endif
                </div>

                <div class="col-span-12 md:col-span-6 md:col-start-7">
                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                        @csrf
                        {{-- Honeypot: hidden from humans, bots fill it --}}
                        <div class="hidden" aria-hidden="true">
                            <label>Website (leave empty)
                                <input type="text" name="website" tabindex="-1" autocomplete="off">
                            </label>
                        </div>

                        <div>
                            <label for="name" class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">Name</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full bg-transparent border-b rule py-3 focus:border-accent focus:outline-none transition-colors"
                                   value="{{ old('name') }}">
                            @error('name') <p class="mt-2 font-mono text-xs text-accent">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full bg-transparent border-b rule py-3 focus:border-accent focus:outline-none transition-colors"
                                   value="{{ old('email') }}">
                            @error('email') <p class="mt-2 font-mono text-xs text-accent">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="subject" class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" required
                                   class="w-full bg-transparent border-b rule py-3 focus:border-accent focus:outline-none transition-colors"
                                   value="{{ old('subject') }}">
                            @error('subject') <p class="mt-2 font-mono text-xs text-accent">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="message" class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">Message</label>
                            <textarea id="message" name="message" rows="5" required
                                      class="w-full bg-transparent border-b rule py-3 focus:border-accent focus:outline-none transition-colors resize-none">{{ old('message') }}</textarea>
                            @error('message') <p class="mt-2 font-mono text-xs text-accent">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center bg-accent text-[var(--color-paper)] px-8 py-4 font-mono text-sm uppercase tracking-wider hover:opacity-90 transition-opacity">
                            Send message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.site>