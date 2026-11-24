<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Model;

class WorkProcess extends Model
{
    use HasBilingualFields;

    protected $fillable = [
        'title',
        'title_ar',
        'description',
        'description_ar',
        'icon',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function getTitleAttribute($value): ?string
    {
        return $this->getBilingualValue('title', $value);
    }

    public function getDescriptionAttribute($value): ?string
    {
        return $this->getBilingualValue('description', $value);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
