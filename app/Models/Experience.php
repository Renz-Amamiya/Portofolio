<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'technologies' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'current' => 'boolean',
    ];

    public const TYPES = [
        'work' => 'Work',
        'organization' => 'Organization',
        'assistant' => 'Assistant',
        'freelance' => 'Freelance',
    ];

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderByDesc('start_date');
    }

    public function getPeriodAttribute(): string
    {
        $end = $this->current ? 'Present' : ($this->end_date?->format('M Y') ?? 'Present');

        return $this->start_date->format('M Y') . ' to ' . $end;
    }
}