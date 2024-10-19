<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorias;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $categorias = [
            ['nombre' => 'Ácidos', 'nivel' => '1'], // Básico
            ['nombre' => 'Ácidos', 'nivel' => '2'], // Intermedio
            ['nombre' => 'Ácidos', 'nivel' => '3'], // Avanzado

            ['nombre' => 'Bases', 'nivel' => '1'], // Básico
            ['nombre' => 'Bases', 'nivel' => '2'], // Intermedio
            ['nombre' => 'Bases', 'nivel' => '3'], // Avanzado

            ['nombre' => 'Sales', 'nivel' => '1'], // Básico
            ['nombre' => 'Sales', 'nivel' => '2'], // Intermedio
            ['nombre' => 'Sales', 'nivel' => '3'], // Avanzado

            ['nombre' => 'Oxidantes', 'nivel' => '2'], // Intermedio
            ['nombre' => 'Oxidantes', 'nivel' => '3'], // Avanzado

            ['nombre' => 'Reductores', 'nivel' => '2'], // Intermedio
            ['nombre' => 'Reductores', 'nivel' => '3'], // Avanzado

            ['nombre' => 'Disolventes', 'nivel' => '1'], // Básico
            ['nombre' => 'Disolventes', 'nivel' => '2'], // Intermedio

            ['nombre' => 'Reagentes de síntesis', 'nivel' => '2'], // Intermedio
            ['nombre' => 'Reagentes de síntesis', 'nivel' => '3'], // Avanzado

            ['nombre' => 'Catalizadores', 'nivel' => '2'], // Intermedio
            ['nombre' => 'Catalizadores', 'nivel' => '3'], // Avanzado

            ['nombre' => 'Compuestos orgánicos', 'nivel' => '1'], // Básico
            ['nombre' => 'Compuestos orgánicos', 'nivel' => '2'], // Intermedio
            ['nombre' => 'Compuestos orgánicos', 'nivel' => '3'], // Avanzado

            ['nombre' => 'Compuestos inorgánicos', 'nivel' => '1'], // Básico
            ['nombre' => 'Compuestos inorgánicos', 'nivel' => '2'], // Intermedio
            ['nombre' => 'Compuestos inorgánicos', 'nivel' => '3'], // Avanzado
        ];

        foreach ($categorias as $categoria) {
            Categorias::create($categoria);
        }
    }
}
