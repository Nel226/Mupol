<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('nom');
            $table->enum('type', ['recette', 'depense']);
            $table->enum('sous_type', [
                'prets', 
                'recettes_propres', 
                'produits', 
                'autres',
            ])->nullable();
            $table->uuid('parent_id')->nullable();  
            $table->timestamps();
    
            $table->foreign('parent_id')->references('uuid')->on('categories')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
