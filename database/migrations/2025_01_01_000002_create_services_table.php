<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->foreignId('direction_id')->constrained('directions')->onDelete('cascade');
            $table->unsignedBigInteger('chef_service_id')->nullable();
            $table->enum('statut', ['actif', 'inactif'])->default('actif');
            $table->integer('ordre')->default(0);
            $table->timestamps();

            $table->foreign('chef_service_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};