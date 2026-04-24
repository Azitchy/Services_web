<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class JobSupply extends Model
{
    use HasFactory;

    protected $fillable = [
        'cleaning_job_id',
        'inventory_item_id',
        'quantity_used',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity_used' => 'decimal:2',
        ];
    }

    public function cleaningJob(): BelongsTo
    {
        return $this->belongsTo(CleaningJob::class);
    }

    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class);
    }
}
