<x-admin.layout title="Education">
    <div class="flex items-center justify-between mb-8">
        <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted">{{ $educations->total() }} total</p>
        <a href="{{ route('admin.educations.create') }}" class="bg-accent text-[var(--color-paper)] px-6 py-3 font-mono text-xs uppercase tracking-wider hover:opacity-90 transition-opacity">
            New education
        </a>
    </div>

    @if ($educations->isNotEmpty())
        <form id="reorder-form" method="POST" action="{{ route('admin.educations.reorder') }}">
            @csrf
            <input type="hidden" name="ids" id="reorder-ids">
        </form>

        <div class="border-t rule" id="sortable-educations" data-reorder-endpoint>
            @foreach ($educations as $education)
                <div class="sortable-row flex flex-col md:flex-row md:items-center gap-4 border-b rule py-5 px-2 hover:bg-[color-mix(in_srgb,var(--color-accent)_4%,transparent)] transition-colors" data-id="{{ $education->id }}">
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <span class="cursor-move text-muted hidden md:block" title="Drag to reorder">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M9 5h.01M9 12h.01M9 19h.01M15 5h.01M15 12h.01M15 19h.01"/></svg>
                        </span>
                        <div class="min-w-0">
                            <a href="{{ route('admin.educations.edit', $education) }}" class="font-display text-xl hover:text-accent transition-colors">
                                {{ $education->degree }}
                            </a>
                            <p class="text-sm text-muted mt-0.5">
                                {{ $education->institution }}@if ($education->location) · {{ $education->location }}@endif
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-5 shrink-0">
                        <span class="font-mono text-xs text-muted">{{ $education->period }}</span>
                        <a href="{{ route('admin.educations.edit', $education) }}" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">Edit</a>
                        <form method="POST" action="{{ route('admin.educations.destroy', $education) }}" onsubmit="return confirm('Delete this education entry?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">{{ $educations->links() }}</div>
    @else
        <div class="border-t rule py-16">
            <p class="font-mono text-sm text-muted">No education yet.</p>
            <a href="{{ route('admin.educations.create') }}" class="mt-4 inline-block font-mono text-sm text-accent hover:underline">Add your first education</a>
        </div>
    @endif
</x-admin.layout>
