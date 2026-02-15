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
        Schema::create('alumnos' , function(Blueprint $table){
            $table->id();
            $table->integer("matricula");
            $table->string("curriculum" , length : 100);
            $table->foreignId('carrera_id')->constrained('carreras');
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::deleteIfExists('alumnos');
    }
};
