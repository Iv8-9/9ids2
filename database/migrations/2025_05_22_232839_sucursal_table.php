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
        Schema::create('sucursal', function (Blueprint $table) {
            $table->id();
            $table->text('nombre_sucursal')->nullable();
            $table->text('direccion')->nullable();
            $table->text('telefono')->nullable();
            $table->text('email')->nullable();
            $table->text('horario')->nullable();
            $table->text('tipo_piscina')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('sucursal');
    }
};
