<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoContentItem extends Model
{
    use HasFactory, HasBilingualFields;

    protected $fillable = [
        'video_section_id',
        'title',
        'title_ar',
        'value',
        'value_ar',
        'url',
        'icon',
        'badge',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function getTitleAttribute($value): ?string
    {
        return $this->getBilingualValue('title', $value);
    }

    public function getValueAttribute($value): ?string
    {
        return $this->getBilingualValue('value', $value);
    }

    public function videoSection(): BelongsTo
    {
        return $this->belongsTo(VideoSection::class);
    }
}
