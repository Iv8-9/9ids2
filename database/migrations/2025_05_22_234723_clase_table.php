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
        Schema::create('clase', function (Blueprint $table) {
            $table->id();
            $table->integer('id_sucursal')->nullable();
            $table->integer('id_alumno')->nullable(); // Alumno o participante
            $table->integer('id_entrenador')->nullable(); // Entrenador
            $table->string('nivel')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->date('fecha')->nullable();
            $table->timestamps();
            // Llaves foráneas
            $table->foreign('id_sucursal')->references('id')->on('sucursal');
            $table->foreign('id_alumno')->references('id')->on('users');
            $table->foreign('id_entrenador')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clase');
    
    }
};
