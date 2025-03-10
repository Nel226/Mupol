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
        Schema::create('adherents', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->string('matricule')->nullable(false);
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
            $table->longText('signature')->nullable();

            $table->string('statut')->nullable();
            $table->string('grade')->nullable();
            $table->date('departARetraite')->nullable();
            $table->string('numeroCARFO')->nullable();
            $table->date('dateIntegration')->nullable();
            $table->date('dateDepartARetraite')->nullable();
            $table->string('direction')->nullable();
            $table->string('service')->nullable();
            $table->string('region')->nullable();
            $table->string('province')->nullable();
            $table->string('localite')->nullable();

            $table->date('date_enregistrement')->nullable();
            $table->string('code_carte')->nullable();
            $table->integer('charge')->nullable();
            $table->string('mensualite')->nullable();
            $table->string('adhesion')->default(10000);
            $table->string('password')->nullable();
            $table->boolean('must_change_password')->default(true);
            $table->boolean('is_adherent')->default(false);
            $table->boolean('is_new');
            $table->uuid('demande_id')->nullable();
            $table->foreign('demande_id')->references('id')->on('demande_adhesions');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adherents');
    }
};
