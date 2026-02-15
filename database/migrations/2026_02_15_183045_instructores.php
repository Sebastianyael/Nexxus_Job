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
        Schema::create('instructores' , function(Blueprint $table){
            $table->id();
            $table->integer('no_empleado');
            $table->foreignId('id_puesto')->constrained('puestos');
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::deleteIfExists('Instructores');
    }
};
