<?php

namespace Database\Factories;

use App\Models\Cleaner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cleaner>
 */
class CleanerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => 'cleaner']),
            'employee_code' => 'CLN-'.strtoupper(fake()->bothify('##??')),
            'phone' => fake()->numerify('+9715########'),
            'hourly_rate' => fake()->randomFloat(2, 20, 70),
            'is_active' => fake()->boolean(95),
        ];
    }
}
