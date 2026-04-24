<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Cleaner;
use App\Models\CleaningJob;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CleaningJob>
 */
class CleaningJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-2 days', '+20 days');
        $duration = fake()->numberBetween(90, 240);
        $end = (clone $start)->modify("+{$duration} minutes");

        return [
            'booking_id' => Booking::factory(),
            'property_id' => Property::factory(),
            'cleaner_id' => Cleaner::factory(),
            'scheduled_start' => $start,
            'scheduled_end' => $end,
            'status' => fake()->randomElement(['pending', 'assigned', 'in_progress', 'completed', 'missed', 'cancelled']),
            'priority' => fake()->numberBetween(1, 5),
            'manual_override' => fake()->boolean(30),
            'completed_at' => fake()->optional(0.5)->dateTimeBetween('-14 days', 'now'),
            'notes' => fake()->sentence(16),
        ];
    }
}
