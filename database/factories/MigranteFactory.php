<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Migrante>
 */
class MigranteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero' => $this->faker->randomDigit(),
            'nombre_apellido' => $this->faker->name(),
            'npi' => $this->faker->randomNumber(),
            'fecha_nacimiento' => $this->faker->date(),
            'edad' => $this->faker->randomDigit(),
            'genero' => $this->faker->randomElement($array = array('Masculino', 'Femenino', 'RID')),
            'nacionalidad' => $this->faker->country(),
            'estado' => $this->faker->randomElement($array = array('Dentro', 'Fuera')),
            'usuario' => $this->faker->randomElement(User::pluck('id')),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
