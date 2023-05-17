<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Migrante;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegistroConducta>
 */
class RegistroConductaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'migrante' => Migrante::inRandomOrder()->first()->id,
            'observaciones' => $this->faker->paragraphs(5, true),
            'usuario' => User::inRandomOrder()->first()->id,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
