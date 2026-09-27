<x-admin.layout title="Social links">
    <div class="flex items-center justify-between mb-8">
        <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted">{{ $links->total() }} total</p>
        <a href="{{ route('admin.socials.create') }}" class="bg-accent text-[var(--color-paper)] px-6 py-3 font-mono text-xs uppercase tracking-wider hover:opacity-90 transition-opacity">
            New link
        </a>
    </div>

    @if ($links->isNotEmpty())
        <form id="reorder-form" method="POST" action="{{ route('admin.socials.reorder') }}">
            @csrf
        </form>

        <div class="border-t rule" id="sortable-socials" data-reorder-endpoint>
            @foreach ($links as $link)
                <div class="sortable-row flex items-center gap-4 border-b rule py-4 px-2 hover:bg-[color-mix(in_srgb,var(--color-accent)_4%,transparent)] transition-colors" data-id="{{ $link->id }}">
                    <span class="cursor-move text-muted" title="Drag to reorder">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M9 5h.01M9 12h.01M9 19h.01M15 5h.01M15 12h.01M15 19h.01"/></svg>
                    </span>
                    <div class="flex-1 min-w-0">
                        <span class="font-display text-lg">{{ $link->platform }}</span>
                        <p class="text-sm text-muted truncate">{{ $link->url }}</p>
                    </div>
                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">Open ↗</a>
                    <a href="{{ route('admin.socials.edit', $link) }}" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">Edit</a>
                    <form method="POST" action="{{ route('admin.socials.destroy', $link) }}" onsubmit="return confirm('Delete this link?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-8">{{ $links->links() }}</div>
    @else
        <div class="border-t rule py-16">
            <p class="font-mono text-sm text-muted">No social links yet.</p>
            <a href="{{ route('admin.socials.create') }}" class="mt-4 inline-block font-mono text-sm text-accent hover:underline">Add your first link</a>
        </div>
    @endif
</x-admin.layout>