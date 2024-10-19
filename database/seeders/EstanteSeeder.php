<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estante;
use App\Models\Laboratorio;
use App\Models\Posicion;


class EstanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Estante::factory()
            ->count(20)
            ->create()
            ->each(function ($estante) {
                
                for ($fila = 1; $fila <= $estante->filas; $fila++) {
                    for ($columna = 1; $columna <= $estante->columnas; $columna++) {
                        Posicion::create([
                            'estante_id' => $estante->id,
                            'fila' => $fila,
                            'columna' => $columna,
                            'reactivos_id' => null, // Inicialmente sin reactivo
                        ]);
                    }
                }
                
                logger()->info('Posiciones creadas para el estante ID: ' . $estante->id);
            });

    }
}
