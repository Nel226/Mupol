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
        Schema::create('estimationes', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->decimal('montant', 15, 2);
            $table->string('description')->nullable();
            $table->uuid('categorie_id');
            $table->uuid('sous_categorie_id')->nullable();
            $table->string('periode');  
            $table->year('annee');

            $table->foreign('categorie_id')->references('uuid')->on('categories')->onDelete('cascade');
            $table->foreign('sous_categorie_id')->references('uuid')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimationes');
    }
};
