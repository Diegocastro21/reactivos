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
        Schema::create('posiciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estante_id')->constrained('estante'); // Relacionado con el estante
            $table->integer('fila');    // Fila dentro del estante
            $table->integer('columna'); // Columna dentro del estante
            $table->foreignId('reactivos_id')->nullable()->constrained('reactivos'); // Posición puede estar vacía (nullable)
            $table->timestamps();

            // Asegurar que no se duplique una posición (combinación de estante, fila y columna)
            $table->unique(['estante_id', 'fila', 'columna']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posiciones');
    }
};
