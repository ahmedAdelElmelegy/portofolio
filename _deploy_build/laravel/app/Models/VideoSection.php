<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VideoSection extends Model
{
    use HasFactory, HasBilingualFields;

    protected $fillable = [
        'badge',
        'badge_ar',
        'title',
        'title_ar',
        'subtitle',
        'subtitle_ar',
        'video_path',
        'cover_image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getBadgeAttribute($value): ?string
    {
        return $this->getBilingualValue('badge', $value);
    }

    public function getTitleAttribute($value): ?string
    {
        return $this->getBilingualValue('title', $value);
    }

    public function getSubtitleAttribute($value): ?string
    {
        return $this->getBilingualValue('subtitle', $value);
    }

    public function items(): HasMany
    {
        return $this->hasMany(VideoContentItem::class)->orderBy('sort_order', 'asc');
    }
}
