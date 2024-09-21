<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reactivos;
use App\Models\Estante;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReactivoFactory extends Factory
{

    protected $model = Reactivos::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'nombre' => $this->faker->word,
            'disponibilidad' => $this->faker->randomElement(['total', 'media', 'poca', 'no hay']),
            'unidad_medida' => $this->faker->randomElement(['g', 'mg', 'ml', 'l']),
            'cantidad_disponible' => $this->faker->randomFloat(2, 0, 1000),
            'codigo_indicacion_peligro' => $this->faker->regexify('H[0-9]{3}'),
            'lote' => $this->faker->bothify('??##??'),
            'marca_fabricante' => $this->faker->company,
            'url_ficha_seguridad' => $this->faker->url,
            'fecha_vencimiento' => $this->faker->dateTimeBetween('+1 year', '+5 years'),
            'nivel_reactivo' => $this->faker->numberBetween(1, 5),
            'columna_estante' => $this->faker->randomLetter,
            'estante_id' => Estante::factory(),
        ];
    }
}
