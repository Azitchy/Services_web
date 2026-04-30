<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutItem extends Model
{
    protected $fillable = [
        'type',
        'title',
        'content',
        'image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
