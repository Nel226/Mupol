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
        Schema::create('acte_medicals', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->string('code')->unique(); 
            $table->string('designation'); 
            $table->decimal('cout', 10, 2); 
            $table->decimal('plafond', 10, 2); 
            $table->date('date_creation'); 
            $table->date('date_invalidite')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acte_medicals');
    }
};