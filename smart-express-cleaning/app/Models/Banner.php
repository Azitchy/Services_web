<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'image_url',
        'media_type',
        'button_text',
        'button_link',
        'sort_order',
        'is_active',
    ];

    public function isVideo(): bool
    {
        return $this->media_type === 'video';
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getImageUrlAttribute()
    {
        if (! isset($this->attributes['image_url']) || ! $this->attributes['image_url']) {
            return null;
        }

        if (filter_var($this->attributes['image_url'], FILTER_VALIDATE_URL)) {
            return $this->attributes['image_url'];
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->attributes['image_url']);
    }
}
