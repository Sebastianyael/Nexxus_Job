<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('instructores', function(Blueprint $table) {
            $table->id();
            $table->string('nombre' , length:100);
            $table->string('apellido_p' , length:100);
            $table->string('apellido_m' , length:100);
            $table->integer('no_empleado');
            $table->integer('telefono');
            $table->string('email')->unique();
            $table->string('contraseña', length:100);
            $table->string('cargo' , length:100);
            $table->date('fecha_nacimiento');
            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructores');
    }
};
