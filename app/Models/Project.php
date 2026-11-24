<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasBilingualFields;

    protected $fillable = [
        'name',
        'name_ar',
        'slug',
        'description',
        'description_ar',
        'short_description',
        'short_description_ar',
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

    public function getNameAttribute($value): ?string
    {
        return $this->getBilingualValue('name', $value);
    }

    public function getShortDescriptionAttribute($value): ?string
    {
        return $this->getBilingualValue('short_description', $value);
    }

    public function getDescriptionAttribute($value): ?string
    {
        return $this->getBilingualValue('description', $value);
    }

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
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    // ─── Accessors ────────────────────────────────────────────────────────────

    public function getCoverImageUrlAttribute(): ?string
    {
        return $this->cover_image ? Storage::disk('public')->url($this->cover_image) : null;
    }
}
