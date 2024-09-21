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
        Schema::create('division_ubicacion_reactivos', function (Blueprint $table) {
            $table->id();
            $table->string('columna');
            $table->string('nivel');
            $table->foreignId('estante_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_ubicacion_reactivos');
    }
};
