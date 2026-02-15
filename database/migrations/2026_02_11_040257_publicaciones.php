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
        Schema::create('publicaciones', function(Blueprint $table){
            $table->id();
            $table->string('titulo' , length:100);
            $table->text('descripcion');
            $table->string('requisitos' , length:100);
            $table->integer('telefono');
            $table->string('email' , length:100)->unique();
            $table->date('fecha_publicacion');
            $table->date('fecha_expiracion');
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicaciones');
    }
};
