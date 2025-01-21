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
            $table->text('contenu'); 
            $table->string('image_principal'); 
            // $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
            $table->timestamp('date_publication')->nullable();
            
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
