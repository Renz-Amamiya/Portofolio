<x-admin.layout title="{{ isset($certificate->id) ? 'Edit certificate' : 'New certificate' }}">
    <form method="POST" action="{{ isset($certificate->id) ? route('admin.certificates.update', $certificate) : route('admin.certificates.store') }}" enctype="multipart/form-data" class="space-y-8 max-w-3xl">
        @csrf
        @if (isset($certificate->id)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-admin.input label="Title" name="title" :value="old('title', $certificate->title ?? '')" required />
            <x-admin.input label="Issuer" name="issuer" :value="old('issuer', $certificate->issuer ?? '')" required />
            <x-admin.input label="Issue date" name="issue_date" type="date" :value="old('issue_date', isset($certificate->issue_date) ? $certificate->issue_date->format('Y-m-d') : '')" required />
            <x-admin.input label="Credential URL" name="url" type="url" :value="old('url', $certificate->url ?? '')" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-admin.file label="Image" name="image" :current="$certificate->image ?? null" />
            <x-admin.file label="PDF file" name="file" accept="application/pdf" :preview="false" :current="$certificate->file_path ?? null" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t rule">
            <button type="submit" class="bg-accent text-[var(--color-paper)] px-8 py-3.5 font-mono text-sm uppercase tracking-wider hover:opacity-90 transition-opacity">
                {{ isset($certificate->id) ? 'Save certificate' : 'Create certificate' }}
            </button>
            <a href="{{ route('admin.certificates.index') }}" class="font-mono text-xs uppercase tracking-wider text-muted hover:text-accent transition-colors">Cancel</a>
        </div>
    </form>
</x-admin.layout>