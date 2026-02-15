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
        Schema::create("ubicaciones" , function(Blueprint $table){
            $table->id();
            $table->integer("cp");
            $table->string("colonia" , length : 100);
            $table->string("municipio" , length : 100);
            $table->string("estado" , length : 100);
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
