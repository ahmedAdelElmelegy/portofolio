<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VideoSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge',
        'title',
        'subtitle',
        'video_path',
        'cover_image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(VideoContentItem::class)->orderBy('sort_order', 'asc');
    }
}
