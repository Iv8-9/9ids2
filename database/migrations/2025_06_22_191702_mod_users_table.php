<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nombre', 50)->nullable();
            $table->string('app', 50)->nullable();
            $table->string('apm', 50)->nullable();
            $table->integer('edad')->nullable();
            $table->string('direccion', 50)->nullable();
            $table->string('rol', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nombre');
            $table->dropColumn('app');
            $table->dropColumn('apm');
            $table->dropColumn('edad');
            $table->dropColumn('direccion');
            $table->dropColumn('rol');
        });
    }
};
