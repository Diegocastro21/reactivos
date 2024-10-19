<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Database\Factories\ReactivoFactory;
use App\Models\Reactivos;
use App\Models\Posicion;

class ReactivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        // Obtener todas las posiciones disponibles (sin reactivo asignado)
        $posiciones_disponibles = Posicion::whereNull('reactivos_id')->get();

        // Crear reactivos y asignarlos a posiciones disponibles
        Reactivos::factory()->count(30)->make()->each(function ($reactivo) use (&$posiciones_disponibles) {
            if ($posiciones_disponibles->isNotEmpty()) {
                // Tomar una posición aleatoria disponible
                $posicion = $posiciones_disponibles->random();
                
                // Asignar el estante al reactivo
                $reactivo->estante_id = $posicion->estante_id;
                $reactivo->save();

                // Asignar el reactivo a la posición
                $posicion->reactivos_id = $reactivo->id;
                $posicion->save();

                // Remover la posición utilizada de las disponibles
                $posiciones_disponibles = $posiciones_disponibles->where('id', '!=', $posicion->id);

                logger()->info("Reactivo {$reactivo->id} asignado a la posición {$posicion->id} en el estante {$posicion->estante_id}");
            } else {
                logger()->warning("No hay posiciones disponibles para el reactivo {$reactivo->id}");
            }
        });

        //
        // Reactivos::factory()->count(30)->create();

        // Puedes agregar algunos registros específicos si lo deseas
        // Reactivos::factory()->create([
        //     'codigo' => 'ESP001',
        //     'nombre' => 'Ácido Sulfúrico',
        //     'disponibilidad' => 'total',
        //     'unidad_medida' => 'l',
        //     'cantidad_disponible' => 5.00,
        // ]);

        // Reactivos::factory()->create([
        //     'codigo' => 'ESP002',
        //     'nombre' => 'Hidróxido de Sodio',
        //     'disponibilidad' => 'media',
        //     'unidad_medida' => 'g',
        //     'cantidad_disponible' => 500.00,
        // ]);
    }
}
