<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'role',
        'tagline',
        'title',
        'bio',
        'email',
        'phone',
        'location',
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

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar
            ? Storage::disk('public')->url($this->avatar)
            : null;
    }

    public function getCvUrlAttribute(): ?string
    {
        return $this->cv_file
            ? Storage::disk('public')->url($this->cv_file)
            : null;
    }
}
