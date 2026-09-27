@props(['label' => null, 'accept' => 'image/*', 'preview' => true])

<div x-data="{
    preview: null,
    onFile(event) {
        const file = event.target.files[0];
        if (!file) { this.preview = null; return; }
        this.preview = URL.createObjectURL(file);
    }
}">
    @if ($label)
        <label for="{{ 'file-' . str()->slug($label) }}" class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">
            {{ $label }}
        </label>
    @endif

    <div class="flex items-center gap-4">
        <input
            type="file"
            id="{{ 'file-' . str()->slug($label) }}"
            accept="{{ $accept }}"
            {{ $attributes->merge(['class' => 'block w-full text-sm text-muted file:mr-4 file:py-2.5 file:px-4 file:border-0 file:bg-accent file:text-[var(--color-paper)] file:font-mono file:text-xs file:uppercase file:tracking-wider file:cursor-pointer']) }}
            @change="onFile($event)"
        >
    </div>

    @if ($preview && isset($current) && $current)
        <div class="mt-4">
            <p class="font-mono text-[10px] uppercase tracking-wider text-muted mb-2">Current</p>
            <img src="{{ asset('storage/' . $current) }}" alt="Current {{ $label }}" class="h-32 w-auto object-cover border rule">
        </div>
    @endif

    @if ($preview)
        <template x-if="preview">
            <img :src="preview" alt="Preview" class="mt-4 h-32 w-auto object-cover border rule">
        </template>
    @endif

    @error(str_replace('[]', '', $attributes->get('name'))) <p class="mt-2 font-mono text-xs text-accent">{{ $message }}</p> @enderror
</div>