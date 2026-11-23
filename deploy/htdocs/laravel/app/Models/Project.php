<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'cover_image',
        'github_url',
        'app_url',
        'is_featured',
        'sort_order',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'published_at' => 'datetime',
    ];

    // ─── Relationships ───────────────────────────────────────────────────────

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function technologies(): HasMany
    {
        return $this->hasMany(ProjectTechnology::class)->orderBy('sort_order');
    }

    public function features(): HasMany
    {
        return $this->hasMany(ProjectFeature::class)->orderBy('sort_order');
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    // ─── Accessors ───────────────────────────────────────────────────────────

    public function getCoverImageUrlAttribute(): ?string
    {
        return $this->cover_image
            ? Storage::disk('public')->url($this->cover_image)
            : null;
    }

    // ─── Lifecycle ───────────────────────────────────────────────────────────

    protected static function booted(): void
    {
        static::deleting(function (Project $project) {
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            foreach ($project->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }
        });
    }
}
