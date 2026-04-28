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

    public function getHeroImageUrlAttribute()
    {
        if (! isset($this->attributes['hero_image_url']) || ! $this->attributes['hero_image_url']) {
            return null;
        }

        if (filter_var($this->attributes['hero_image_url'], FILTER_VALIDATE_URL)) {
            return $this->attributes['hero_image_url'];
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->attributes['hero_image_url']);
    }
}
