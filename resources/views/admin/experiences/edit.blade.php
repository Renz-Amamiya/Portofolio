<x-admin.layout title="{{ isset($experience->id) ? 'Edit experience' : 'New experience' }}">
    <form method="POST" action="{{ isset($experience->id) ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}" class="space-y-8 max-w-3xl">
        @csrf
        @if (isset($experience->id)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-admin.input label="Position" name="position" :value="old('position', $experience->position ?? '')" required />
            <x-admin.input label="Organization" name="company" :value="old('company', $experience->company ?? '')" required />
            <x-admin.input label="Location" name="location" :value="old('location', $experience->location ?? '')" />
            <x-admin.select label="Type" name="type" :value="old('type', $experience->type ?? 'work')" :options="\App\Models\Experience::TYPES" required />
            <x-admin.input label="Start date" name="start_date" type="date" :value="old('start_date', isset($experience->start_date) ? $experience->start_date->format('Y-m-d') : '')" required />
            <x-admin.input label="End date" name="end_date" type="date" :value="old('end_date', $experience->end_date?->format('Y-m-d'))" />
            <div class="md:col-span-2">
                <x-admin.textarea label="Description" name="description" rows="4">{{ old('description', $experience->description ?? '') }}</x-admin.textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">Technologies</label>
                <p class="text-xs text-muted mb-3">Comma separated</p>
                <input type="text" name="technologies" value="{{ old('technologies', isset($experience->technologies) ? implode(', ', $experience->technologies ?? []) : '') }}"
                       class="w-full bg-transparent border rule px-4 py-3 focus:border-accent focus:outline-none transition-colors">
            </div>
        </div>

        <div class="pt-4 border-t rule">
            <x-admin.toggle label="I currently work here" name="current" @checked(old('current', $experience->current ?? false)) />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-accent text-[var(--color-paper)] px-8 py-3.5 font-mono text-sm uppercase tracking-wider hover:opacity-90 transition-opacity">
                {{ isset($experience->id) ? 'Save experience' : 'Create experience' }}
            </button>
            <a href="{{ route('admin.experiences.index') }}" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">Cancel</a>
        </div>
    </form>
</x-admin.layout>