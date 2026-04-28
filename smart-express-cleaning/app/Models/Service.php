<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image_url',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
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
