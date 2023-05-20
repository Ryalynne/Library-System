<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\booklist>
 */
class booklistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->lastName(),
            'author' => fake()->firstNameMale(), 
            'copyright' => fake()->date(),
            'accession' => fake()->numberBetween(100, 100),
            // 'copies' => fake()->numberBetween(1, 100),
        ];
    }
}
