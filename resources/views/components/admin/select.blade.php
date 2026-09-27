@props(['label' => null, 'id' => null, 'options' => [], 'required' => false])

<div>
    @if ($label)
        <label for="{{ $id ?? 'select-' . str()->slug($label) }}" class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">
            {{ $label }}@if ($required) <span class="text-accent">*</span>@endif
        </label>
    @endif
    <select
        id="{{ $id ?? 'select-' . str()->slug($label) }}"
        {{ $attributes->merge(['class' => 'w-full bg-transparent border rule px-4 py-3 focus:border-accent focus:outline-none transition-colors']) }}
        @if ($required) required @endif
    >
        @foreach ($options as $value => $labelText)
            <option value="{{ $value }}" @selected(old($attributes->get('name'), $attributes->get('value')) == $value)>{{ $labelText }}</option>
        @endforeach
    </select>
    @error(str_replace('[]', '', $attributes->get('name'))) <p class="mt-2 font-mono text-xs text-accent">{{ $message }}</p> @enderror
</div>