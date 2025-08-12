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
        Schema::create('ayant_droits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe');
            $table->date('date_naissance');
            $table->string('relation');
            $table->string('code');
            $table->string('photo')->nullable();
            $table->string('cnib')->nullable();
            $table->string('extrait')->nullable();
            $table->unsignedInteger('position')->nullable();

            $table->uuid('adherent_id');
            $table->foreign('adherent_id')->references('id')->on('adherents')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayant_droits');
    }
};
