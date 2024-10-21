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
            $table->timestamp('fecha_movimiento');
            $table->decimal('cantidad', total: 8, places: 2);
            $table->enum('tipo_transaccion', ['salida', 'entrada', 'de baja', 'donacion', 'prestamo']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('reactivos_id')->constrained('reactivos')->onDelete('cascade');
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
