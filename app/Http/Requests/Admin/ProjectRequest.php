<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'featured' => $this->boolean('featured'),
            'published' => $this->boolean('published'),
        ]);

        if ($this->filled('technologies') && is_string($this->technologies)) {
            $this->merge([
                'technologies' => array_values(array_filter(array_map('trim', explode(',', $this->technologies)))),
            ]);
        }
    }

    public function rules(): array
    {
        $projectId = $this->route('project')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('portfolio_items', 'slug')->ignore($projectId),
            ],
            'description' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'role' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'year' => ['nullable', 'string', 'max:4'],
            'project_date' => ['nullable', 'date'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'gallery.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'technologies' => ['nullable', 'array'],
            'technologies.*' => ['string', 'max:50'],
            'order' => ['nullable', 'integer', 'min:0'],
            'featured' => ['boolean'],
            'published' => ['boolean'],
        ];
    }
}