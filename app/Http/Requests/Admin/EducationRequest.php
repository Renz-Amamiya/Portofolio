<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'current' => $this->boolean('current'),
            'end_date' => $this->filled('end_date') ? $this->end_date : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'degree' => ['required', 'string', 'max:255'],
            'institution' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'current' => ['boolean'],
            'description' => ['nullable', 'string'],
            'grade' => ['nullable', 'string', 'max:50'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
