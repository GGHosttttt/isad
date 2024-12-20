<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fieldId' => fake()->fieldId(),            // Generates a random sentence for the name
            'username' => fake()->userName(),        // Generates a random username
            'phoneNumber' => fake()->phoneNumber(), // Generates a random phone number
            'time' => fake()->time(),                // Generates a random time
            'date' => fake()->date(),                // Generates a random date
            'message' => fake()->paragraph(),        // Generates a random paragraph for the message
            'status' => fake()->status(),        // Generates a random paragraph for the message

        ];
    }
}
