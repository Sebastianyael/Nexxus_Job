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
        Schema::create('empresas' , function(Blueprint $table){
            $table->id();
            $table->string('nombre' , length: 100);
            $table->string('giro', length: 100);
            $table->integer('telefono');
            $table->string('email')->unique();
            $table->string('calle' , length: 100);
            $table->string('colonia' , length:100);
            $table->string('municipio' , length:100);
            $table->integer('codigo_postal');
            $table->string('estado' , length:100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
