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
        Schema::create('demande_adhesions', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->string('matricule');
            $table->string('nip')->nullable();
            $table->string('cnib')->nullable();
            $table->date('delivree')->nullable();
            $table->date('expire')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone');
            $table->string( 'email');

            $table->string('nom');
            $table->string('prenom');
            $table->string('genre')->nullable();
            $table->string('departement')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->string('nom_pere')->nullable();
            $table->string('nom_mere')->nullable();
            $table->string('situation_matrimoniale')->nullable();
            $table->string('photo')->nullable();

            $table->string('nom_prenom_personne_besoin')->nullable();
            $table->string('lieu_residence')->nullable();
            $table->string('telephone_personne_prevenir')->nullable();
            $table->integer('nombreAyantsDroits')->nullable();
            $table->integer('categorie')->nullable();

            $table->json('ayantsDroits')->nullable();
            $table->string('statut')->nullable();
            $table->string('grade')->nullable();
            $table->date('departARetraite')->nullable();
            $table->string('numeroCARFO')->nullable();
            $table->date('dateIntegration')->nullable();
            $table->date('dateDepartARetraite')->nullable();
            $table->string('direction')->nullable();
            $table->string('service')->nullable();
            $table->longText('signature')->nullable();

            $table->string('code_carte')->nullable();


            $table->string('region')->nullable();
            $table->string('province')->nullable();
            $table->string('localite')->nullable();
            $table->boolean('etat')->default(false);
            $table->boolean('is_new')->default(true);

            
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_adhesions');
    }
};
