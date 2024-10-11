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
            $table->string('ordre')->nullable();
            $table->date('date_enregistrement')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('genre')->nullable();
            $table->string('service')->nullable();
            $table->string('no_matricule')->nullable();
            $table->string('code_carte')->nullable();
            $table->string('telephone')->nullable();
            $table->string('charge')->nullable();
            $table->string('mensualite')->nullable();
            $table->string('adhesion')->nullable();
            $table->string('photo')->nullable(); 
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
