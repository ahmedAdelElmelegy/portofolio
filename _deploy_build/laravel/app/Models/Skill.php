<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasBilingualFields;

    protected $fillable = [
        'name',
        'category',
        'category_ar',
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

    public function getCategoryAttribute($value): ?string
    {
        return $this->getBilingualValue('category', $value);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
