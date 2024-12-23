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
            $table->string('nip');
            $table->string('cnib');
            $table->date('delivree');
            $table->date('expire');
            $table->string('adresse');
            $table->string('telephone');
            $table->string( 'email');

            $table->string('nom');
            $table->string('prenom');
            $table->string('genre');
            $table->string('departement');
            $table->string('ville');
            $table->string('pays')->nullable();
            $table->string('nom_pere');
            $table->string('nom_mere');
            $table->string('situation_matrimoniale');
            $table->string('photo')->nullable();

            $table->string('nom_prenom_personne_besoin');
            $table->string('lieu_residence');
            $table->string('telephone_personne_prevenir');
            $table->integer('nombreAyantsDroits')->default(0);
            $table->integer('categorie')->default(1);

            $table->json('ayantsDroits');
            $table->string('statut');
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
