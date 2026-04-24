<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class CleaningJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'property_id',
        'cleaner_id',
        'scheduled_start',
        'scheduled_end',
        'status',
        'priority',
        'manual_override',
        'completed_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'manual_override' => 'boolean',
            'scheduled_start' => 'datetime',
            'scheduled_end' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function cleaner(): BelongsTo
    {
        return $this->belongsTo(Cleaner::class);
    }

    public function supplies(): HasMany
    {
        return $this->hasMany(JobSupply::class);
    }
}
