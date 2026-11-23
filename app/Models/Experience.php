<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'title',
        'organization',
        'location',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'type',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'sort_order' => 'integer',
    ];

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
