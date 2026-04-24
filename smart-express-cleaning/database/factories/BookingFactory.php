<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkIn = fake()->dateTimeBetween('-5 days', '+20 days');
        $checkOut = (clone $checkIn)->modify('+'.fake()->numberBetween(1, 7).' days');

        return [
            'property_id' => Property::factory(),
            'source' => fake()->randomElement(['airbnb', 'pms', 'manual']),
            'external_booking_id' => 'BKG-'.strtoupper(fake()->bothify('??####??')),
            'guest_name' => fake()->name(),
            'guest_count' => fake()->numberBetween(1, 8),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'booking_status' => fake()->randomElement(['confirmed', 'cancelled', 'completed']),
            'synced_at' => fake()->dateTimeBetween('-2 days', 'now'),
        ];
    }
}
