<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Estante;
use App\Models\Posicion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posicion>
 */
class PosicionFactory extends Factory
{

    protected $model = Posicion::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estante_id' => Estante::factory(),
            'fila' => $this->faker->numberBetween(1, 5),
            'columna' => $this->faker->numberBetween(1, 5),
            'reactivos_id' => null, // Inicialmente sin reactivo
        ];
    }
}
