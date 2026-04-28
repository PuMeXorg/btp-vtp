<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageBlock extends Model
{
    protected $fillable = [
        'type',
        'title',
        'subtitle',
        'content',
        'image',
        'button_text',
        'button_url',
        'settings',
        'is_active',
        'sort',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query
            ->where('is_active', true)
            ->orderBy('sort');
    }
}
