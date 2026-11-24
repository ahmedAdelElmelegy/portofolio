<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasBilingualFields;

    protected $fillable = [
        'user_id',
        'full_name',
        'full_name_ar',
        'role',
        'role_ar',
        'tagline',
        'tagline_ar',
        'title',
        'title_ar',
        'bio',
        'bio_ar',
        'email',
        'phone',
        'location',
        'location_ar',
        'avatar',
        'cv_file',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'whatsapp',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute($value): ?string
    {
        return $this->getBilingualValue('full_name', $value);
    }

    public function getRoleAttribute($value): ?string
    {
        return $this->getBilingualValue('role', $value);
    }

    public function getTaglineAttribute($value): ?string
    {
        return $this->getBilingualValue('tagline', $value);
    }

    public function getBioAttribute($value): ?string
    {
        return $this->getBilingualValue('bio', $value);
    }

    public function getLocationAttribute($value): ?string
    {
        return $this->getBilingualValue('location', $value);
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar
            ? Storage::disk('public')->url($this->avatar)
            : null;
    }

    public function getCvUrlAttribute(): ?string
    {
        if (!$this->cv_file) {
            return 'https://drive.google.com/drive/u/0/mobile/folders/1Du__WLyTM0zhOU2ZfzEAYIz5cjqcjS0Q?hl=ar&sort=13&direction=a';
        }

        if (str_starts_with($this->cv_file, 'http://') || str_starts_with($this->cv_file, 'https://')) {
            return $this->cv_file;
        }

        return Storage::disk('public')->url($this->cv_file);
    }
}
