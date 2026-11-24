<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasBilingualFields;

    protected $fillable = [
        'title',
        'title_ar',
        'organization',
        'organization_ar',
        'location',
        'location_ar',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'description_ar',
        'type',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getTitleAttribute($value): ?string
    {
        return $this->getBilingualValue('title', $value);
    }

    public function getOrganizationAttribute($value): ?string
    {
        return $this->getBilingualValue('organization', $value);
    }

    public function getLocationAttribute($value): ?string
    {
        return $this->getBilingualValue('location', $value);
    }

    public function getDescriptionAttribute($value): ?string
    {
        return $this->getBilingualValue('description', $value);
    }

    public function scopeWork($query)
    {
        return $query->where('type', 'work');
    }

    public function scopeEducation($query)
    {
        return $query->where('type', 'education');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getDateRangeAttribute(): string
    {
        $start = $this->start_date?->format('M Y') ?? '';
        $end = $this->is_current ? 'Present' : ($this->end_date?->format('M Y') ?? '');

        return $start && $end ? "{$start} – {$end}" : $start;
    }
}
