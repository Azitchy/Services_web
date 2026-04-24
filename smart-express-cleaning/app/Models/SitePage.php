<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_key',
        'name',
        'hero_kicker',
        'hero_title',
        'hero_subtitle',
        'hero_image_url',
        'section_title',
        'section_subtitle',
        'extra_content',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'extra_content' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
