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
        Schema::create('recomendaciones' , function(Blueprint $table){
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos');
            $table->foreignId('instructor_id')->constrained('instructores');
            $table->boolean('recomendado')->default(true);
            $table->text('comentario');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recomendaciones');
    }
};
