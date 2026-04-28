<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_image_url',
        'author_name',
        'read_time_minutes',
        'published_at',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    public function getCoverImageUrlAttribute()
    {
        if (! isset($this->attributes['cover_image_url']) || ! $this->attributes['cover_image_url']) {
            return null;
        }

        if (filter_var($this->attributes['cover_image_url'], FILTER_VALIDATE_URL)) {
            return $this->attributes['cover_image_url'];
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->attributes['cover_image_url']);
    }
}
