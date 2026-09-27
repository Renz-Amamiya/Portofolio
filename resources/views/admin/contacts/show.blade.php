<x-admin.layout title="Message">
    <div class="max-w-3xl">
        <div class="border-t rule pt-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="font-display text-3xl">{{ $contact->subject }}</h2>
                    <p class="mt-2 font-mono text-xs text-muted">
                        {{ $contact->name }} · <a href="mailto:{{ $contact->email }}" class="hover:text-accent transition-colors">{{ $contact->email }}</a>
                    </p>
                    <p class="mt-1 font-mono text-xs text-muted">{{ $contact->created_at->format('F d, Y \a\t H:i') }}</p>
                </div>
                @if (! $contact->read)
                    <span class="font-mono text-[10px] uppercase tracking-wider text-accent border border-accent px-2 py-1">New</span>
                @endif
            </div>

            <div class="mt-8 border-t rule pt-6">
                <p class="leading-relaxed whitespace-pre-line">{{ $contact->message }}</p>
            </div>

            <div class="mt-10 flex flex-wrap items-center gap-4 pt-6 border-t rule">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}"
                   class="bg-accent text-[var(--color-paper)] px-7 py-3 font-mono text-xs uppercase tracking-wider hover:opacity-90 transition-opacity">
                    Reply by email
                </a>
                @if (! $contact->read)
                    <form method="POST" action="{{ route('admin.contacts.read', $contact) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">
                            Mark as read
                        </button>
                    </form>
                @endif
                <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" onsubmit="return confirm('Delete this message?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">
                        Delete
                    </button>
                </form>
                <a href="{{ route('admin.contacts.index') }}" class="ml-auto font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">
                    Back to messages
                </a>
            </div>
        </div>
    </div>
</x-admin.layout>