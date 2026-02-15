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
        Schema::create('usuarios' , function(Blueprint $table){
            $table->id();
            $table->string('nombre' , length:100);
            $table->string('apellido_p' , length:100);
            $table->string('apellido_m' , length:100);
            $table->string('email')->unique();
            $table->integer('telefono');
            $table->string('contraseña', length:100);
            $table->date('fecha_nacimiento');
            $table->string('genero');
            $table->string('tipo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
