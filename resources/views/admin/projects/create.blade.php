<x-admin.layout title="New project">
    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="space-y-8 max-w-4xl">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-admin.input label="Title" name="title" :value="old('title')" required />
            <x-admin.input label="Slug" name="slug" :value="old('slug', str()->slug(old('title')))" required />
            <div class="md:col-span-2">
                <x-admin.textarea label="Short description" name="description" rows="2" required>{{ old('description') }}</x-admin.textarea>
            </div>
            <x-admin.input label="Role" name="role" :value="old('role')" placeholder="e.g. Frontend Developer" />
            <x-admin.input label="Category" name="category" :value="old('category')" placeholder="e.g. Web Application" />
            <x-admin.input label="Year" name="year" :value="old('year')" placeholder="2025" />
            <x-admin.input label="Project date" name="project_date" type="date" :value="old('project_date')" />
            <x-admin.input label="Live URL" name="project_url" type="url" :value="old('project_url')" />
            <x-admin.input label="GitHub URL" name="github_url" type="url" :value="old('github_url')" />
            <x-admin.input label="Order" name="order" type="number" :value="old('order')" />
        </div>

        <div>
            <x-admin.markdown-editor label="Content (markdown)" name="content" required>{{ old('content') }}</x-admin.markdown-editor>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-admin.file label="Thumbnail" name="image" :current="old('image')" />
            <div>
                <label class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">Tech stack</label>
                <p class="text-xs text-muted mb-3">Comma separated, e.g. Next.js, Laravel, MySQL</p>
                <input type="text" name="technologies" value="{{ old('technologies') }}"
                       class="w-full bg-transparent border rule px-4 py-3 focus:border-accent focus:outline-none transition-colors">
                @error('technologies') <p class="mt-2 font-mono text-xs text-accent">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <x-admin.file label="Gallery images" name="gallery[]" accept="image/*" :preview="false" />
        </div>

        <div class="flex flex-wrap items-center gap-6 pt-4 border-t rule">
            <x-admin.toggle label="Featured" name="featured" @checked(old('featured')) />
            <x-admin.toggle label="Published" name="published" @checked(old('published', true)) />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-accent text-[var(--color-paper)] px-8 py-3.5 font-mono text-sm uppercase tracking-wider hover:opacity-90 transition-opacity">
                Create project
            </button>
            <a href="{{ route('admin.projects.index') }}" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">
                Cancel
            </a>
        </div>
    </form>
</x-admin.layout>