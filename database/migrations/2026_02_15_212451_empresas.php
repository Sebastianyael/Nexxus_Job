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
        Schema::create("empresas", function(Blueprint $table){
            $table->id();
            $table->string("giro" , length : 100);
            $table->string("telefono" , length: 100);
            $table->string("nombre" , length: 100);
            $table->string("email" , length : 100);
            $table->string("contraseña" , length : 100);
            $table->string("calle" , length : 100);
            $table->foreignId('ubicacion_id')->constrained('ubicaciones');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists();
    }
};
