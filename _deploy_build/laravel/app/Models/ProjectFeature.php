<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFeature extends Model
{
    use HasBilingualFields;

    protected $fillable = [
        'project_id',
        'description',
        'description_ar',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function getDescriptionAttribute($value): ?string
    {
        return $this->getBilingualValue('description', $value);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
