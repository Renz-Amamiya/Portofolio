<x-admin.layout title="Dashboard">
    <div class="space-y-12">
        {{-- Stats: real numbers only --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-px bg-[var(--color-rule)] border rule">
            <div class="bg-[var(--bg)] p-6">
                <p class="font-mono text-[10px] uppercase tracking-wider text-muted">Projects</p>
                <p class="mt-3 font-display text-4xl">{{ $projects }}</p>
                <p class="mt-1 font-mono text-[10px] text-muted">{{ $publishedProjects }} published</p>
            </div>
            <div class="bg-[var(--bg)] p-6">
                <p class="font-mono text-[10px] uppercase tracking-wider text-muted">Skills</p>
                <p class="mt-3 font-display text-4xl">{{ $skills }}</p>
            </div>
            <div class="bg-[var(--bg)] p-6">
                <p class="font-mono text-[10px] uppercase tracking-wider text-muted">Unread</p>
                <p class="mt-3 font-display text-4xl {{ $unreadMessages > 0 ? 'text-accent' : '' }}">{{ $unreadMessages }}</p>
            </div>
            <div class="bg-[var(--bg)] p-6">
                <p class="font-mono text-[10px] uppercase tracking-wider text-muted">Profile</p>
                <p class="mt-3 font-display text-4xl">{{ \App\Models\Profile::current()->open_to_work ? 'Open' : 'Closed' }}</p>
                <p class="mt-1 font-mono text-[10px] text-muted">to work</p>
            </div>
        </div>

        {{-- Quick links --}}
        <div>
            <h2 class="font-mono text-xs uppercase tracking-[0.2em] text-muted mb-4">Quick actions</h2>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.projects.create') }}" class="border rule px-5 py-3 font-mono text-xs uppercase tracking-wider hover:border-accent hover:text-accent transition-colors">
                    New project
                </a>
                <a href="{{ route('admin.profile.edit') }}" class="border rule px-5 py-3 font-mono text-xs uppercase tracking-wider hover:border-accent hover:text-accent transition-colors">
                    Edit profile
                </a>
                <a href="{{ route('admin.settings.edit') }}" class="border rule px-5 py-3 font-mono text-xs uppercase tracking-wider hover:border-accent hover:text-accent transition-colors">
                    SEO settings
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="border rule px-5 py-3 font-mono text-xs uppercase tracking-wider hover:border-accent hover:text-accent transition-colors">
                    Messages ({{ $unreadMessages }})
                </a>
            </div>
        </div>

        {{-- Recent messages --}}
        <div>
            <h2 class="font-mono text-xs uppercase tracking-[0.2em] text-muted mb-4">Recent messages</h2>
            @if ($messages->isNotEmpty())
                <div class="border-t rule">
                    @foreach ($messages as $message)
                        <a href="{{ route('admin.contacts.show', $message) }}"
                           class="flex items-center justify-between gap-4 border-b rule py-4 hover:bg-[color-mix(in_srgb,var(--color-accent)_5%,transparent)] transition-colors">
                            <div class="min-w-0">
                                <p class="font-medium truncate">{{ $message->name }}</p>
                                <p class="text-sm text-muted truncate">{{ $message->subject }}</p>
                            </div>
                            <div class="flex items-center gap-3 shrink-0">
                                @if (! $message->read)
                                    <span class="w-2 h-2 bg-accent rounded-full" title="Unread"></span>
                                @endif
                                <span class="font-mono text-[10px] text-muted">{{ $message->created_at->format('M d') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="font-mono text-sm text-muted py-8 border-t rule">No messages yet.</p>
            @endif
        </div>
    </div>
</x-admin.layout>