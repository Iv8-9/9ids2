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

        Schema::create('membresia', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tipo_membresia')->nullable();
            $table->integer('id_persona')->nullable();
            $table->text('rfc')->nullable();
            $table->string('tipo_pago', 100)->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->text('estatus')->nullable();
            $table->integer('clases_disponibles')->nullable();
            $table->timestamps();
            $table->foreign('id_tipo_membresia')->references('id')->on('tipo_membresia');
            $table->foreign('id_persona')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membresia');
    }
};
