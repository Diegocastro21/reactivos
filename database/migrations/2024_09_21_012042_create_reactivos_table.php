<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reactivos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->string('disponibilidad');
            $table->string('unidad_medida');
            $table->double('cantidad_disponible');
            $table->string('codigo_indicacion_peligro');
            $table->string('lote');
            $table->string('marca_fabricante');
            $table->string('url_ficha_seguridad');
            $table->date('fecha_vencimiento');
            $table->string('columna_reactivo');
            $table->string('columna_estante');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactivos');
    }
};
