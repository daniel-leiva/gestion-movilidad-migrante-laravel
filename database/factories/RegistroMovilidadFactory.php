<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RegistroMovilidad;
use App\Models\User;
use App\Models\Caravana;
use App\Models\Nucleo;
use App\Models\Migrante;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegistroMovilidad>
 */
class RegistroMovilidadFactory extends Factory
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
            'tipologia' => $this->faker->randomElement($array = array('En Tránsito', 'Solicitante de asilo', 'De retorno')),
            'plan_movilidad' => $this->faker->paragraphs(5, true),
            'fecha_ingreso' => $this->faker->date(),
            'fecha_salida' => $this->faker->date(),
            'locker' => $this->faker->randomElement($array = array('Masculino', 'Femenino', 'RID')),
            'bodega' => $this->faker->randomElement($array = array('Si', 'No')),
            'observaciones' => $this->faker->paragraphs(5, true),
            'caravana' => Caravana::inRandomOrder()->first()->id,
            'nucleo' => Nucleo::inRandomOrder()->first()->id,
            'usuario' => User::inRandomOrder()->first()->id,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
