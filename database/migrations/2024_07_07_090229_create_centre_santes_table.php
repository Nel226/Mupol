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
        Schema::create('centre_santes', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->string('nom'); 
            $table->string('type'); 
            $table->string('adresse'); 
            $table->string('telephone'); 
            $table->string('email');
            $table->string('region');
            $table->string('province');
            $table->date('date_affiliation')->nullable();
            $table->string('photo')->nullable(); 
            $table->string('password'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centre_santes');
    }
};
