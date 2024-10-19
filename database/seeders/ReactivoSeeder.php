<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Database\Factories\ReactivoFactory;
use App\Models\Reactivos;
use App\Models\Posicion;
use App\Models\Proveedor;
use App\Models\Pictogramas;
use App\Models\Categorias;

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


            // Asignar pictogramas aleatorios al reactivo
            $pictogramas = Pictogramas::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $reactivo->pictogramas()->attach($pictogramas);

            $proveedores = Proveedor::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $reactivo->proveedores()->attach($proveedores);

            $categorias = Categorias::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $reactivo->categorias()->attach($categorias);

        });

    }
}
