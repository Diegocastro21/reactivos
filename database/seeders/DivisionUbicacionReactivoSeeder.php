<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DivisionUbicacionReactivo;
use App\Models\Estante;


class DivisionUbicacionReactivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Crear 50 divisiones de ubicación aleatorias
        DivisionUbicacionReactivo::factory()->count(50)->create();

        // Crear algunas divisiones de ubicación específicas
        $estante = Estante::first();
        
        DivisionUbicacionReactivo::factory()->create([
            'columna' => 'A',
            'nivel' => '1',
            'estante_id' => '1',
        ]);

        DivisionUbicacionReactivo::factory()->create([
            'columna' => 'B',
            'nivel' => '2',
            'estante_id' => '2',
        ]);
    }
}
