<?php

namespace Database\Factories;

use App\Models\Estante;
use App\Models\Laboratorio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estante>
 */
class EstanteFactory extends Factory
{

    protected $model = Estante::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_estante' => $this->faker->unique()->numberBetween(1, 100),
            'descripcion' => $this->faker->sentence(),
            'laboratorio_id' => Laboratorio::factory(),
        ];
    }
}
