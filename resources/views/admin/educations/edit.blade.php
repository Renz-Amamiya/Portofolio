<x-admin.layout title="Edit education">
    <form method="POST" action="{{ route('admin.educations.update', $education) }}" class="space-y-8 max-w-3xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-admin.input label="Degree" name="degree" :value="old('degree', $education->degree)" required />
            <x-admin.input label="Institution" name="institution" :value="old('institution', $education->institution)" required />
            <x-admin.input label="Location" name="location" :value="old('location', $education->location)" />
            <x-admin.input label="Grade / GPA" name="grade" :value="old('grade', $education->grade)" />
            <x-admin.input label="Start date" name="start_date" type="date" :value="old('start_date', $education->start_date->format('Y-m-d'))" required />
            <x-admin.input label="End date" name="end_date" type="date" :value="old('end_date', $education->end_date?->format('Y-m-d'))" />
            <div class="md:col-span-2">
                <x-admin.textarea label="Description" name="description" rows="4">{{ old('description', $education->description) }}</x-admin.textarea>
            </div>
        </div>

        <div class="pt-4 border-t rule">
            <x-admin.toggle label="I currently study here" name="current" @checked(old('current', $education->current)) />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-accent text-[var(--color-paper)] px-8 py-3.5 font-mono text-sm uppercase tracking-wider hover:opacity-90 transition-opacity">
                Save education
            </button>
            <a href="{{ route('admin.educations.index') }}" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">Cancel</a>
        </div>
    </form>
</x-admin.layout>
