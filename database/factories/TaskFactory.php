<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true), // Generates a 3-word string for the name
            'detail' => fake()->paragraph(2), // Generates a paragraph for detail
            'price' => fake()->randomFloat(2, 10, 1000), // Generates a price between 10 and 1000 with 2 decimal places
            'bookStatus' => fake()->numberBetween(0, 2), // Generates a random integer between 0 and 2
            'image' => fake()->imageUrl(640, 480, 'books', true, 'Faker'), // Generates a fake image URL
        ];
    }
}
