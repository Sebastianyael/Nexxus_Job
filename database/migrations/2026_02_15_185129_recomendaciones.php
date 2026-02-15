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
            $table->foreignId('instructor_id')->constrained('instructores');
            $table->foreignId('alumnos_id')->constrained('alumnos');
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
        Schema::deleteIfExists('recomendaciones');
    }
};
