<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'category',
        'level',
        'icon',
        'sort_order',
        'is_featured',
    ];

    protected $casts = [
        'level' => 'integer',
        'sort_order' => 'integer',
        'is_featured' => 'boolean',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
