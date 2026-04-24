<?php

namespace Database\Factories;

use App\Models\CleaningJob;
use App\Models\InventoryItem;
use App\Models\JobSupply;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobSupply>
 */
class JobSupplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cleaning_job_id' => CleaningJob::factory(),
            'inventory_item_id' => InventoryItem::factory(),
            'quantity_used' => fake()->randomFloat(2, 0.5, 6),
            'notes' => fake()->sentence(10),
        ];
    }
}
