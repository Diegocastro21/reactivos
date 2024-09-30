<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pictogramas;

class PictogramasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Pictogramas::factory()->create([
            [
                'nombre' => 'Comburente',
                'imagen' => 'images/pictogramas/comburente.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Corrosivo',
                'imagen' => 'images/pictogramas/corrosivo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Explosion',
                'imagen' => 'images/pictogramas/explosion.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Gas A Presion',
                'imagen' => 'images/pictogramas/gas-a-presion.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Inflamable',
                'imagen' => 'images/pictogramas/inflamable.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Peligro Grave para la salud',
                'imagen' => 'images/pictogramas/peligro-grave-para-la-salud.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Peligro Medio Ambiente',
                'imagen' => 'images/pictogramas/peligro-medio-ambiente.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Peligro Salud',
                'imagen' => 'images/pictogramas/peligro-salud.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Toxicidad Aguda',
                'imagen' => 'images/pictogramas/toxicidad-aguda.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Puedes agregar más registros aquí si lo necesitas
        ]);
    }
}
