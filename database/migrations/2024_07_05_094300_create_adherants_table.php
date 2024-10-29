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
        Schema::create('adherants', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->nullable();
            $table->string('nip')->nullable();
            $table->string('cnib')->nullable();
            $table->date('delivree')->nullable();
            $table->date('expire')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('genre')->nullable();
            $table->string('departement')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->string('nom_pere')->nullable();
            $table->string('nom_mere')->nullable();
            $table->string('situation_matrimoniale')->nullable();
            $table->string('nom_prenom_personne_besoin')->nullable();
            $table->string('lieu_residence')->nullable();
            $table->string('telephone_personne_prevenir')->nullable();
            $table->string('photo')->nullable();
            $table->integer('nombreAyantsDroits')->nullable();
            $table->json('ayantsDroits')->nullable(); 
            $table->string('categorie')->nullable();
            $table->string('statut')->nullable();
            $table->string('grade')->nullable();
            $table->date('departARetraite')->nullable();
            $table->string('numeroCARFO')->nullable();
            $table->date('dateIntegration')->nullable();
            $table->date('dateDepartARetraite')->nullable();
            $table->string('direction')->nullable();
            $table->string('service')->nullable();
            $table->string('ordre')->nullable();
            $table->date('date_enregistrement')->nullable();
            $table->string('code_carte')->nullable();
            $table->string('charge')->nullable();
            $table->string('mensualite')->nullable();
            $table->string('adhesion')->nullable();
            $table->string('password'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adherants');
    }
};
