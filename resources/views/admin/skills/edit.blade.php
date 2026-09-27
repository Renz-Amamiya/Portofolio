<x-admin.layout title="{{ isset($skill->id) ? 'Edit skill' : 'New skill' }}">
    <form method="POST" action="{{ isset($skill->id) ? route('admin.skills.update', $skill) : route('admin.skills.store') }}" class="space-y-8 max-w-xl">
        @csrf
        @if (isset($skill->id)) @method('PUT') @endif

        <div class="space-y-6">
            <x-admin.input label="Name" name="name" :value="old('name', $skill->name ?? '')" required />
            <x-admin.input label="Category" name="category" :value="old('category', $skill->category ?? '')" placeholder="Frontend, Backend, Tools" required />
            <x-admin.input label="Order" name="order" type="number" :value="old('order', $skill->order ?? '')" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t rule">
            <button type="submit" class="bg-accent text-[var(--color-paper)] px-8 py-3.5 font-mono text-sm uppercase tracking-wider hover:opacity-90 transition-opacity">
                {{ isset($skill->id) ? 'Save skill' : 'Create skill' }}
            </button>
            <a href="{{ route('admin.skills.index') }}" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">Cancel</a>
        </div>
    </form>
</x-admin.layout>