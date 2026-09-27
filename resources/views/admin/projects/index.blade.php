<x-admin.layout title="Projects">
    <div class="flex items-center justify-between mb-8">
        <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted">{{ $projects->total() }} total</p>
        <a href="{{ route('admin.projects.create') }}" class="bg-accent text-[var(--color-paper)] px-6 py-3 font-mono text-xs uppercase tracking-wider hover:opacity-90 transition-opacity">
            New project
        </a>
    </div>

    @if ($projects->isNotEmpty())
        <form id="reorder-form" method="POST" action="{{ route('admin.projects.reorder') }}">
            @csrf
            <input type="hidden" name="ids" id="reorder-ids">
        </form>

        <div class="border-t rule" id="sortable-projects" data-reorder-endpoint>
            @foreach ($projects as $project)
                <div class="sortable-row flex flex-col md:flex-row md:items-center gap-4 border-b rule py-5 px-2 hover:bg-[color-mix(in_srgb,var(--color-accent)_4%,transparent)] transition-colors" data-id="{{ $project->id }}">
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <span class="cursor-move text-muted hidden md:block" title="Drag to reorder">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M9 5h.01M9 12h.01M9 19h.01M15 5h.01M15 12h.01M15 19h.01"/></svg>
                        </span>
                        @if ($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="" class="w-14 h-14 object-cover border rule shrink-0">
                        @else
                            <div class="w-14 h-14 border rule shrink-0 flex items-center justify-center">
                                <span class="font-mono text-[10px] text-muted">N/A</span>
                            </div>
                        @endif
                        <div class="min-w-0">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="font-display text-xl hover:text-accent transition-colors truncate">
                                    {{ $project->title }}
                                </a>
                                @if ($project->featured)
                                    <span class="font-mono text-[9px] uppercase tracking-wider text-accent border border-accent px-1.5 py-0.5">Featured</span>
                                @endif
                            </div>
                            <p class="text-sm text-muted truncate mt-0.5">{{ $project->description }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 md:gap-5 shrink-0">
                        <span class="font-mono text-xs text-muted">{{ $project->year }}</span>

                        {{-- Toggle publish without reload --}}
                        <div x-data="publishToggle('{{ route('admin.projects.toggle', $project) }}', {{ $project->published ? 'true' : 'false' }})">
                            <button type="button" @click="submit()"
                                    class="font-mono text-[10px] uppercase tracking-wider px-3 py-2 border transition-colors"
                                    :class="on ? 'border-accent text-accent' : 'rule text-muted'"
                                    :disabled="loading">
                                <span x-text="on ? 'Published' : 'Draft'"></span>
                            </button>
                        </div>

                        <a href="{{ route('admin.projects.edit', $project) }}" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Delete this project?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $projects->links() }}
        </div>
    @else
        <div class="border-t rule py-16">
            <p class="font-mono text-sm text-muted">No projects yet.</p>
            <a href="{{ route('admin.projects.create') }}" class="mt-4 inline-block font-mono text-sm text-accent hover:underline">
                Create your first project
            </a>
        </div>
    @endif
</x-admin.layout>