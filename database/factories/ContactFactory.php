<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        return [
            'email' => fake()->safeEmail(), // Generates a valid email address
            'phoneNumber' => fake()->phoneNumber(), // Generates a valid phone number
            'message' => fake()->paragraph(2) // Generates a message with 2 paragraphs
        ];
    }
}
