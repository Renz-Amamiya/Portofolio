<x-admin.layout title="Profile">
    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-8 max-w-3xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-admin.input label="Name" name="name" :value="old('name', $profile->name)" required />
            <x-admin.input label="Nickname" name="nickname" :value="old('nickname', $profile->nickname)" />
            <div class="md:col-span-2">
                <x-admin.input label="Headline" name="headline" :value="old('headline', $profile->headline)" />
            </div>
            <div class="md:col-span-2">
                <x-admin.textarea label="Short bio" name="short_bio" rows="3">{{ old('short_bio', $profile->short_bio) }}</x-admin.textarea>
            </div>
            <x-admin.input label="Location" name="location" :value="old('location', $profile->location)" />
            <x-admin.input label="Email" name="email" type="email" :value="old('email', $profile->email)" />
        </div>

        <div>
            <x-admin.markdown-editor label="Long bio (markdown)" name="long_bio">{{ old('long_bio', $profile->long_bio) }}</x-admin.markdown-editor>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-admin.file label="Photo" name="photo" :current="$profile->photo" />
            <x-admin.file label="CV (PDF)" name="cv" accept="application/pdf" :preview="false" :current="$profile->cv_path" />
        </div>

        <div>
            <x-admin.toggle label="Open to work" name="open_to_work" @checked(old('open_to_work', $profile->open_to_work)) />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t rule">
            <button type="submit" class="bg-accent text-[var(--color-paper)] px-8 py-3.5 font-mono text-sm uppercase tracking-wider hover:opacity-90 transition-opacity">
                Save profile
            </button>
            @if ($profile->cv_path)
                <a href="{{ $profile->cv_url }}" target="_blank" rel="noopener noreferrer"
                   class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">
                    View current CV ↗
                </a>
            @endif
        </div>
    </form>
</x-admin.layout>