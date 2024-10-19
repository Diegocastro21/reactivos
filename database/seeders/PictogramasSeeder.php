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

        $pictogramas = [
            ['nombre' => 'Comburente', 'imagen' => 'images/pictogramas/comburente.jpg'],
            ['nombre' => 'Corrosivo', 'imagen' => 'images/pictogramas/corrosivo.jpg'],
            ['nombre' => 'Explosion', 'imagen' => 'images/pictogramas/explosion.jpg'],
            ['nombre' => 'Gas A Presion', 'imagen' => 'images/pictogramas/gas-a-presion.jpg'],
            ['nombre' => 'Inflamable', 'imagen' => 'images/pictogramas/inflamable.jpg'],
            ['nombre' => 'Peligro Grave para la salud', 'imagen' => 'images/pictogramas/peligro-grave-para-la-salud.jpg'],
            ['nombre' => 'Peligro Medio Ambiente', 'imagen' => 'images/pictogramas/peligro-medio-ambiente.jpg'],
            ['nombre' => 'Peligro Salud', 'imagen' => 'images/pictogramas/peligro-salud.jpg'],
            ['nombre' => 'Toxicidad Aguda', 'imagen' => 'images/pictogramas/toxicidad-aguda.jpg'],
        ];

        foreach ($pictogramas as $pictograma) {
            Pictogramas::create($pictograma);
        }
    }
}
