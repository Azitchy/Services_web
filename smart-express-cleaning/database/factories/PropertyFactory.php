<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'host_user_id' => User::factory()->state(['role' => 'host']),
            'name' => fake()->streetName().' Residence',
            'location' => fake()->address(),
            'property_type' => fake()->randomElement(['apartment', 'house', 'villa', 'studio', 'other']),
            'bedrooms' => fake()->numberBetween(1, 5),
            'bathrooms' => fake()->numberBetween(1, 4),
            'square_feet' => fake()->numberBetween(450, 3500),
            'listing_platform' => fake()->randomElement(['airbnb', 'pms', 'manual']),
            'external_listing_id' => 'LST-'.strtoupper(fake()->bothify('??###??')),
            'default_cleaning_minutes' => fake()->randomElement([90, 120, 150, 180]),
            'notes' => fake()->sentence(14),
            'is_active' => fake()->boolean(90),
        ];
    }
}
