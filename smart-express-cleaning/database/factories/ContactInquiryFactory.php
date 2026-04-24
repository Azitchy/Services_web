<?php

namespace Database\Factories;

use App\Models\ContactInquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactInquiry>
 */
class ContactInquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['new', 'in_progress', 'resolved']);

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'company_name' => fake()->optional(0.7)->company(),
            'message' => fake()->paragraph(3),
            'status' => $status,
            'admin_notes' => $status === 'resolved' ? 'Handled and quote shared with client.' : null,
            'ip_address' => fake()->ipv4(),
            'submitted_from' => fake()->randomElement(['Mozilla/5.0 Chrome', 'Mozilla/5.0 Safari', 'Mozilla/5.0 Firefox']),
        ];
    }
}
