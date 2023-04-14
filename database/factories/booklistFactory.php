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
            'booktitle' => fake()->lastName(),
            'author' => fake()->firstNameMale(), 
            'datepublish' => fake()->date(),
            'publisher' => fake()->address(),
            'isbn' => fake()->name(),
            'genre' => fake()->name()
        ];
    }
}
