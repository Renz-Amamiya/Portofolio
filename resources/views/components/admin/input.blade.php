@props(['label' => null, 'id' => null, 'type' => 'text', 'required' => false])

<div>
    @if ($label)
        <label for="{{ $id ?? 'input-' . str()->slug($label) }}" class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">
            {{ $label }}@if ($required) <span class="text-accent">*</span>@endif
        </label>
    @endif
    <input
        type="{{ $type }}"
        id="{{ $id ?? 'input-' . str()->slug($label) }}"
        {{ $attributes->merge(['class' => 'w-full bg-transparent border rule px-4 py-3 focus:border-accent focus:outline-none transition-colors']) }}
        @if ($required) required @endif
    >
    @error(str_replace('[]', '', $attributes->get('name'))) <p class="mt-2 font-mono text-xs text-accent">{{ $message }}</p> @enderror
</div>