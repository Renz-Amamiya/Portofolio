<x-admin.layout title="Messages">
    <div class="mb-8">
        <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted">{{ $unread = $contacts->where('read', false)->count() }} unread of {{ $contacts->total() }}</p>
    </div>

    @if ($contacts->isNotEmpty())
        <div class="border-t rule">
            @foreach ($contacts as $contact)
                <a href="{{ route('admin.contacts.show', $contact) }}"
                   class="flex items-center justify-between gap-4 border-b rule py-5 px-2 hover:bg-[color-mix(in_srgb,var(--color-accent)_4%,transparent)] transition-colors">
                    <div class="flex items-center gap-4 min-w-0">
                        @if (! $contact->read)
                            <span class="w-2 h-2 bg-accent rounded-full shrink-0" title="Unread"></span>
                        @else
                            <span class="w-2 h-2 shrink-0"></span>
                        @endif
                        <div class="min-w-0">
                            <p class="font-medium truncate {{ $contact->read ? 'text-muted' : '' }}">{{ $contact->name }}</p>
                            <p class="text-sm truncate {{ $contact->read ? 'text-muted' : 'text-[var(--fg)]' }}">{{ $contact->subject }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 shrink-0">
                        <span class="font-mono text-[10px] text-muted hidden sm:block">{{ $contact->email }}</span>
                        <span class="font-mono text-[10px] text-muted">{{ $contact->created_at->format('M d, Y') }}</span>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">{{ $contacts->links() }}</div>
    @else
        <div class="border-t rule py-16">
            <p class="font-mono text-sm text-muted">No messages yet. Messages from the public contact form appear here.</p>
        </div>
    @endif
</x-admin.layout>