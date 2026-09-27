@props(['label' => null])

<label class="flex items-center gap-3 cursor-pointer select-none">
    <input type="checkbox" {{ $attributes->merge(['class' => 'sr-only peer']) }}>
    <span class="relative w-11 h-6 bg-[var(--color-rule)] peer-checked:bg-accent transition-colors rounded-full shrink-0">
        <span class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></span>
    </span>
    @if ($label)
        <span class="font-mono text-xs uppercase tracking-wider text-muted">{{ $label }}</span>
    @endif
</label>