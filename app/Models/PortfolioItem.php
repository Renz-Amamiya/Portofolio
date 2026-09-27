<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'technologies' => 'array',
        'gallery' => 'array',
        'project_date' => 'date',
        'featured' => 'boolean',
        'published' => 'boolean',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderByDesc('project_date');
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%")
                ->orWhere('technologies', 'like', "%{$term}%");
        });
    }

    public function scopeFilterByTech(Builder $query, ?string $tech): Builder
    {
        return $tech ? $query->where('technologies', 'like', "%{$tech}%") : $query;
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getGalleryUrlsAttribute(): array
    {
        return array_map(fn (string $path) => asset('storage/' . $path), $this->gallery ?? []);
    }

    public function adjacent(bool $forward): ?self
    {
        return self::query()
            ->published()
            ->ordered()
            ->when(
                $forward,
                fn (Builder $q) => $q->where('order', '>', $this->order),
                fn (Builder $q) => $q->where('order', '<', $this->order)->orderByDesc('order')
            )
            ->first();
    }
}