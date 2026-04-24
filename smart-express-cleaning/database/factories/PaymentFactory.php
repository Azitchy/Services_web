<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['pending', 'paid', 'failed', 'refunded']);
        $due = fake()->dateTimeBetween('-7 days', '+30 days');

        return [
            'user_id' => User::factory()->state(['role' => 'host']),
            'invoice_number' => 'INV-'.fake()->unique()->numberBetween(10000, 99999),
            'amount' => fake()->randomFloat(2, 80, 1200),
            'currency' => 'USD',
            'payment_status' => $status,
            'stripe_payment_intent_id' => 'pi_'.fake()->unique()->bothify('??######??######'),
            'due_date' => $due,
            'paid_at' => $status === 'paid' ? fake()->dateTimeBetween('-30 days', 'now') : null,
        ];
    }
}
