<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'role' => $this->role,
            'tagline' => $this->tagline,
            'title' => $this->title,
            'bio' => $this->bio,
            'email' => $this->email,
            'phone' => $this->phone,
            'location' => $this->location,
            'avatar' => $this->avatar_url,
            'cv_file' => $this->cv_url,
            'github_url' => $this->github_url,
            'linkedin_url' => $this->linkedin_url,
            'twitter_url' => $this->twitter_url,
            'whatsapp' => $this->whatsapp,
            'is_active' => (bool) $this->is_active,
        ];
    }
}
