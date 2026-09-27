<x-admin.layout title="{{ isset($link->id) ? 'Edit social link' : 'New social link' }}">
    <form method="POST" action="{{ isset($link->id) ? route('admin.socials.update', $link) : route('admin.socials.store') }}" class="space-y-8 max-w-xl">
        @csrf
        @if (isset($link->id)) @method('PUT') @endif

        <div class="space-y-6">
            <x-admin.input label="Platform" name="platform" :value="old('platform', $link->platform ?? '')" placeholder="GitHub, LinkedIn, Instagram" required />
            <x-admin.input label="URL" name="url" type="url" :value="old('url', $link->url ?? '')" required />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t rule">
            <button type="submit" class="bg-accent text-[var(--color-paper)] px-8 py-3.5 font-mono text-sm uppercase tracking-wider hover:opacity-90 transition-opacity">
                {{ isset($link->id) ? 'Save link' : 'Create link' }}
            </button>
            <a href="{{ route('admin.socials.index') }}" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">Cancel</a>
        </div>
    </form>
</x-admin.layout>