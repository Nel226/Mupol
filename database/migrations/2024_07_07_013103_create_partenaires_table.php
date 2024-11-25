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
        Schema::create('partenaires', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->string('nom'); 
            $table->string('type'); 
            $table->string('adresse'); 
            $table->string('geolocalisation'); 
            $table->string('telephone'); 
            $table->string('email');
            $table->string('region');
            $table->string('province');
            $table->string('photo')->nullable(); 
            $table->string('password');
            $table->boolean('must_change_password')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};
