<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reactivos;
use Database\Factories\ReactivosFactory;

class ReactivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Reactivos::factory()->count(30)->create();

        // Puedes agregar algunos registros específicos si lo deseas
        Reactivos::factory()->create([
            'codigo' => 'ESP001',
            'nombre' => 'Ácido Sulfúrico',
            'disponibilidad' => 'total',
            'unidad_medida' => 'l',
            'cantidad_disponible' => 5.00,
        ]);

        Reactivos::factory()->create([
            'codigo' => 'ESP002',
            'nombre' => 'Hidróxido de Sodio',
            'disponibilidad' => 'media',
            'unidad_medida' => 'g',
            'cantidad_disponible' => 500.00,
        ]);
    }
}
