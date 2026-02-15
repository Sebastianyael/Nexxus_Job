<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('alumnos' , function(Blueprint $table){
            $table->id();
            $table->integer('matricula');
            $table->string('nombre' , length: 100);
            $table->string('apellido_p' , length : 100);
            $table->string('apellido_m' , length : 100);
            $table->date('fecha_nacimiento');
            $table->string('telefono' , length : 10);
            $table->string('carrera' , length : 100);
            $table->string('email')->unique();
            $table->string('contraseña' , length : 100);
            $table->string('curriculumn' , length:200);
            $table->string('genero' , length : 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
