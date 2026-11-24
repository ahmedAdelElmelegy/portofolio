<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoContentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_section_id',
        'title',
        'value',
        'url',
        'icon',
        'badge',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function videoSection(): BelongsTo
    {
        return $this->belongsTo(VideoSection::class);
    }
}
