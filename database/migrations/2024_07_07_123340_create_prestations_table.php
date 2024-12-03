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
        Schema::create('prestations', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->string('adherentCode');

            $table->string('adherentNom');
            $table->string('adherentPrenom');
            $table->string('adherentSexe');
            $table->string('beneficiaire');
            $table->string('idPrestation');
            $table->string('contactPrestation');

            $table->string('acte');
            $table->date('date');
            $table->string('centre');
            $table->string('type')->nullable();
            $table->string('sous_type')->nullable();
            $table->decimal('montant', 10, 2);
            $table->json('preuve')->nullable();
            $table->enum('validite', ['rejeté', 'accepté', 'en attente'])->default('en attente');
            $table->boolean('etat_paiement')->default(false)->nullable();
            $table->uuid('partenaire_id')->nullable(); 
            $table->timestamps();

            $table->foreign('partenaire_id')->references('id')->on('partenaires')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestations');
    }
};
