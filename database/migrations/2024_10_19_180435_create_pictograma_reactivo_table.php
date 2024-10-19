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
        Schema::create('pictograma_reactivo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reactivos_id')->constrained()->onDelete('cascade');
            $table->foreignId('pictogramas_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pictogramas_reactivos');
    }
};
