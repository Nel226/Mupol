<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nom')->nullable()->after('name');
            $table->string('prenom')->nullable()->after('nom');
            $table->foreignId('direction_id')->nullable()->constrained('directions')->onDelete('set null')->after('email');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null')->after('direction_id');
            $table->enum('statut', ['actif', 'inactif'])->default('actif')->after('service_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['direction_id']);
            $table->dropForeign(['service_id']);
            $table->dropColumn(['nom', 'prenom', 'direction_id', 'service_id', 'statut']);
        });
    }
};