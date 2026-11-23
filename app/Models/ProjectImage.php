<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProjectImage extends Model
{
    protected $fillable = ['project_id', 'image_path', 'sort_order'];

    protected $casts = ['sort_order' => 'integer'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function getImageUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->image_path);
    }

    protected static function booted(): void
    {
        static::deleting(function (ProjectImage $image) {
            Storage::disk('public')->delete($image->image_path);
        });
    }
}
