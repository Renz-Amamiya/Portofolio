@props(['label' => null, 'id' => null, 'required' => false, 'rows' => 4])

<div>
    @if ($label)
        <label for="{{ $id ?? 'textarea-' . str()->slug($label) }}" class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">
            {{ $label }}@if ($required) <span class="text-accent">*</span>@endif
        </label>
    @endif
    <textarea
        id="{{ $id ?? 'textarea-' . str()->slug($label) }}"
        rows="{{ $rows }}"
        {{ $attributes->merge(['class' => 'w-full bg-transparent border rule px-4 py-3 focus:border-accent focus:outline-none transition-colors resize-y']) }}
        @if ($required) required @endif
    >{{ $slot }}</textarea>
    @error(str_replace('[]', '', $attributes->get('name'))) <p class="mt-2 font-mono text-xs text-accent">{{ $message }}</p> @enderror
</div>