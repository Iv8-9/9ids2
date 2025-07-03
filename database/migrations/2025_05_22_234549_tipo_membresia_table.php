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
        Schema::create('tipo_membresia', function (Blueprint $table) {
            $table->id();
            $table->text('nombre_membresia')->nullable();
            $table->integer('precio')->nullable();
            $table->text('duracion')->nullable();
            $table->integer('no_clases')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_membresia');
    }
};