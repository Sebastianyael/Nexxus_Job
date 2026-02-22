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
        Schema::create('postulaciones' , function(Blueprint $table){
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos');
            $table->foreignId('vacante_id')->constrained('vacantes');
            $table->string('estatus' , length: 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExsist();
    }
};
