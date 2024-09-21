<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Laboratorio;

class LaboratorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // Crear 10 laboratorios aleatorios
        Laboratorio::factory()->count(10)->create();

        // Crear algunos laboratorios específicos
        Laboratorio::factory()->create([
            'nombre' => 'Laboratorio Central de Química',
            'ubicacion' => 'Edificio A, Piso 2',
            'coordinador' => 'Dr. Juan Pérez',
            'telefono_coordinador' => '(123) 456-7890',
            'correo_coordinador' => 'juan.perez@labcentral.com',
            'ciudad' => 'Ciudad Universitaria',
        ]);

        Laboratorio::factory()->create([
            'nombre' => 'Laboratorio de Investigación Avanzada',
            'ubicacion' => 'Campus Norte, Edificio C',
            'coordinador' => 'Dra. María Rodríguez',
            'telefono_coordinador' => '(987) 654-3210',
            'correo_coordinador' => 'maria.rodriguez@labinvestigacion.com',
            'ciudad' => 'Tecnópolis',
        ]);
    }
}
