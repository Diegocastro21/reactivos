<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Laboratorio;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laboratorio>
 */
class LaboratorioFactory extends Factory
{

    protected $model = Laboratorio::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->company,
            'ubicacion' => $this->faker->address,
            'coordinador' => $this->faker->name,
            'telefono_coordinador' => $this->faker->phoneNumber,
            'correo_coordinador' => $this->faker->unique()->safeEmail,
            'ciudad' => $this->faker->city,
        ];
    }
}
