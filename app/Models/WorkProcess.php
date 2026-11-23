<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkProcess extends Model
{
    protected $fillable = ['title', 'description', 'icon', 'sort_order'];

    protected $casts = ['sort_order' => 'integer'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
