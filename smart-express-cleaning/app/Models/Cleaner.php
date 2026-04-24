<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Cleaner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_code',
        'phone',
        'hourly_rate',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cleaningJobs(): HasMany
    {
        return $this->hasMany(CleaningJob::class);
    }
}
