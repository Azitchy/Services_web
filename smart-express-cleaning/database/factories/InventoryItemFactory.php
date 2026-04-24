<?php

namespace Database\Factories;

use App\Models\InventoryItem;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InventoryItem>
 */
class InventoryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::factory(),
            'name' => fake()->randomElement([
                'Microfiber Cloth',
                'Disinfectant Spray',
                'Toilet Cleaner',
                'Paper Towels',
                'Hand Soap Refill',
                'Glass Cleaner',
            ]),
            'sku' => 'SKU-'.strtoupper(fake()->unique()->bothify('??###??')),
            'unit' => fake()->randomElement(['piece', 'bottle', 'pack', 'liter']),
            'quantity' => fake()->randomFloat(2, 3, 80),
            'low_stock_threshold' => fake()->randomFloat(2, 2, 15),
            'is_active' => fake()->boolean(95),
        ];
    }
}
