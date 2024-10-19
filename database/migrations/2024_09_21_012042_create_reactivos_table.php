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
            $table->enum('disponibilidad', ['total', 'media', 'poca', 'no hay']);
            $table->string('unidad_medida');
            $table->decimal('cantidad_disponible', total: 8, places: 2);
            $table->string('codigo_indicacion_peligro');
            $table->string('lote');
            $table->string('marca');
            $table->string('fabricante');
            $table->string('url_ficha_seguridad');
            $table->date('fecha_vencimiento');
            $table->foreignId('estante_id')->nullable(); // Puede estar relacionado con un estante
            $table->timestamps();
            // $table->string('columna_estante');
            // $table->string('nivel_reactivo');
            // $table->foreignId('estante_id');
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
