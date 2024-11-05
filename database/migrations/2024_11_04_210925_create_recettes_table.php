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
        Schema::create('recettes', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->decimal('montant', 15, 2);
            $table->string('description')->nullable();
            $table->uuid('categorie_id');
            $table->date('date');
            // $table->uuid('user_id');
            $table->timestamps();

            $table->foreign('categorie_id')->references('uuid')->on('categories')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recettes');
    }
};
