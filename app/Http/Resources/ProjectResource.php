<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'projectName' => $this->name, // Flutter compatibility
            'slug' => $this->slug,
            'description' => $this->description,
            'projectDescription' => $this->description, // Flutter compatibility
            'short_description' => $this->short_description,
            'cover_image' => $this->cover_image_url,
            'projectImage' => $this->cover_image_url, // Flutter compatibility
            'github_url' => $this->github_url,
            'githupLink' => $this->github_url, // Flutter compatibility
            'app_url' => $this->app_url,
            'applink' => $this->app_url, // Flutter compatibility
            'is_featured' => (bool) $this->is_featured,
            'sort_order' => $this->sort_order,
            'technologies' => $this->technologies->pluck('name'),
            'features' => $this->features->pluck('description'),
            'images' => $this->images->pluck('image_url'),
            'smImages' => $this->images->pluck('image_url'), // Flutter compatibility
            'published_at' => $this->published_at?->toIso8601String(),
        ];
    }
}
