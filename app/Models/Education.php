<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education';
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'current' => 'boolean',
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