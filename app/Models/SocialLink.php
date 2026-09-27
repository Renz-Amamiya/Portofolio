<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $guarded = [];

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order');
    }
}