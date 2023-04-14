<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\booklist>
 */
class BookV2Factory extends Factory
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
            'publisher' => fake()->name(),
            'isbn' => fake()->number(),
            'genre' => fake()->name()
        ];
    }
}
