<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Developers>
 */
class DevelopersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'speciality' => fake()->randomElement(["C#", "Python", "Deno", "PHP", "Java", "JavaScript", "nextjs", "Rust", "Ruby", "Golang", "C", "F#"]),
            'price' => fake()->integer(),
            'available' => fake()->randomElement(["avaliable", "unavaliable"]),
        ];
    }

}
