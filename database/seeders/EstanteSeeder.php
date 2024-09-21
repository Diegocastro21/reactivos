<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estante;
use App\Models\Laboratorio;


class EstanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Crear 20 estantes aleatorios
        Estante::factory()->count(20)->create();

        // Crear algunos estantes específicos
        $laboratorio = Laboratorio::first();
        
        Estante::factory()->create([
            'no_estante' => 'A-01',
            'descripcion' => 'Estante para reactivos orgánicos',
            'laboratorio_id' => $laboratorio->id,
        ]);

        Estante::factory()->create([
            'no_estante' => 'B-02',
            'descripcion' => 'Estante para ácidos',
            'laboratorio_id' => $laboratorio->id,
        ]);
    }
}
