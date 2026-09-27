@props(['label' => null, 'required' => false, 'rows' => 12])

<div
    x-data="markdownEditor('{{ route('admin.markdown.preview') }}')"
    x-init="init()"
>
    @if ($label)
        <label for="md-{{ str()->slug($label) }}" class="block font-mono text-xs uppercase tracking-wider text-muted mb-2">
            {{ $label }}@if ($required) <span class="text-accent">*</span>@endif
        </label>
    @endif

    <div class="border rule">
        {{-- Tab bar --}}
        <div class="flex border-b rule">
            <button type="button" @click="tab = 'write'"
                    class="px-4 py-2.5 font-mono text-xs uppercase tracking-wider transition-colors"
                    :class="tab === 'write' ? 'text-accent border-b border-accent' : 'text-muted'">
                Write
            </button>
            <button type="button" @click="preview()" @keydown="if($event.key === 'p') preview()"
                    class="px-4 py-2.5 font-mono text-xs uppercase tracking-wider transition-colors"
                    :class="tab === 'preview' ? 'text-accent border-b border-accent' : 'text-muted'">
                Preview
            </button>
        </div>

        <textarea
            id="md-{{ str()->slug($label) }}"
            name="{{ $attributes->get('name') }}"
            rows="{{ $rows }}"
            x-model="content"
            x-show="tab === 'write'"
            class="w-full bg-transparent px-4 py-3 focus:outline-none resize-y font-mono text-sm leading-relaxed"
            @if ($required) required @endif
        >{{ $slot }}</textarea>

        <div x-show="tab === 'preview'" x-cloak class="px-4 py-3 min-h-[200px]">
            <div x-html="rendered" class="prose-editorial max-w-2xl"></div>
        </div>
    </div>

    @error($attributes->get('name')) <p class="mt-2 font-mono text-xs text-accent">{{ $message }}</p> @enderror
</div>