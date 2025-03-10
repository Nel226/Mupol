<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('articlescat', function (Blueprint $table) {
        //     $table->id(); 
        //     $table->string('nom'); 
        //     $table->text('description')->nullable(); 
        //     $table->timestamps(); 
        // });

        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('titre'); 
            $table->longText('contenu'); 
            $table->string('image_principal'); 
            $table->string('resume'); 
            $table->string('categorie'); 
            $table->date('date');

            // $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
            
            $table->unsignedInteger('views')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
        // Schema::dropIfExists('articlescategories');

    }
};
