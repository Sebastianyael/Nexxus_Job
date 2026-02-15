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
        Schema::create('vacantes' , function(Blueprint $table){
            $table->id();
            $table->text("requisitos");
            $table->date("fecha_de_publicacion");
            $table->date("fecha_de_expiracion");
            $table->text("descripcion");
            $table->string("titulo" , length : 100);
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
        Schema::dropIfExsist();
    }
};
