<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasBilingualFields;

    protected $fillable = [
        'name',
        'category',
        'category_ar',
        'level',
        'icon',
        'sort_order',
        'is_featured',
    ];

    protected $casts = [
        'level' => 'integer',
        'sort_order' => 'integer',
        'is_featured' => 'boolean',
    ];

    public function getCategoryAttribute($value): ?string
    {
        return $this->getBilingualValue('category', $value);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getFaIconClassAttribute(): string
    {
        $icon = strtolower(trim($this->icon ?? ''));
        $name = strtolower(trim($this->name ?? ''));

        $iconMap = [
            'flutter' => 'fa-brands fa-flutter text-cyan-500',
            'dart' => 'fa-brands fa-dart-lang text-blue-500',
            'laravel' => 'fa-brands fa-laravel text-red-500',
            'php' => 'fa-brands fa-php text-indigo-400',
            'layers' => 'fa-solid fa-layer-group text-blue-500',
            'architecture' => 'fa-solid fa-sitemap text-indigo-500',
            'diagram-project' => 'fa-solid fa-diagram-project text-purple-500',
            'mobile-screen-button' => 'fa-solid fa-mobile-screen-button text-sky-500',
            'mobile' => 'fa-solid fa-mobile-screen text-sky-500',
            'cubes' => 'fa-solid fa-cubes text-emerald-500',
            'cube' => 'fa-solid fa-cube text-emerald-400',
            'bolt' => 'fa-solid fa-bolt text-amber-500',
            'share-nodes' => 'fa-solid fa-share-nodes text-cyan-400',
            'network-wired' => 'fa-solid fa-network-wired text-blue-400',
            'api' => 'fa-solid fa-globe text-blue-400',
            'fire' => 'fa-solid fa-fire text-amber-500',
            'firebase' => 'fa-solid fa-fire text-amber-500',
            'database' => 'fa-solid fa-database text-blue-500',
            'hard-drive' => 'fa-solid fa-hard-drive text-emerald-500',
            'storage' => 'fa-solid fa-box-archive text-emerald-500',
            'paper-plane' => 'fa-solid fa-paper-plane text-orange-500',
            'postman' => 'fa-solid fa-paper-plane text-orange-500',
            'map-location-dot' => 'fa-solid fa-map-location-dot text-rose-500',
            'map' => 'fa-solid fa-location-dot text-rose-500',
            'git' => 'fa-brands fa-git-alt text-orange-500',
            'github' => 'fa-brands fa-github text-slate-700 dark:text-slate-300',
            'code' => 'fa-solid fa-code text-blue-500',
            'server' => 'fa-solid fa-server text-indigo-500',
            'shield' => 'fa-solid fa-shield-halved text-emerald-500',
            'bell' => 'fa-solid fa-bell text-amber-500',
            'credit-card' => 'fa-solid fa-credit-card text-emerald-500',
            'cart' => 'fa-solid fa-cart-shopping text-cyan-500',
        ];

        if (isset($iconMap[$icon])) {
            return $iconMap[$icon];
        }

        foreach ($iconMap as $key => $class) {
            if (str_contains($name, $key)) {
                return $class;
            }
        }

        return 'fa-solid fa-code text-blue-500';
    }
}
