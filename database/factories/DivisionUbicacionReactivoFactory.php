<?php

namespace Database\Factories;

use App\Models\DivisionUbicacionReactivo;
use App\Models\Estante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DivisionUbicacionReactivo>
 */
class DivisionUbicacionReactivoFactory extends Factory
{

    protected $model = DivisionUbicacionReactivo::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'columna' => $this->faker->randomLetter,
            'nivel' => $this->faker->numberBetween(1, 5),
            'estante_id' => Estante::factory(),
        ];
    }
}
