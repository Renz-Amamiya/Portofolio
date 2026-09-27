<x-admin.layout title="SEO settings">
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-8 max-w-3xl">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <x-admin.input label="Meta title" name="meta_title" :value="old('meta_title', $setting->meta_title)" placeholder="{{ \App\Models\Profile::current()->name . ' · ' . \App\Models\Profile::current()->headline }}" />
            <x-admin.textarea label="Meta description" name="meta_description" rows="3">{{ old('meta_description', $setting->meta_description) }}</x-admin.textarea>
            <x-admin.file label="Open Graph image" name="og_image" :current="$setting->og_image" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t rule">
            <button type="submit" class="bg-accent text-[var(--color-paper)] px-8 py-3.5 font-mono text-sm uppercase tracking-wider hover:opacity-90 transition-opacity">
                Save settings
            </button>
        </div>
    </form>
</x-admin.layout>