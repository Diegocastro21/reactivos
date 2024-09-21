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
        Schema::create('registro_historico', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->date('fecha');
            $table->decimal('cantidad', total: 8, places: 2);
            $table->enum('disponibilidad', ['salida', 'entrada', 'de baja', 'donacion', 'prestamo']);
            $table->foreignId('user_id');
            $table->foreignId('reactivos_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_historico');
    }
};
