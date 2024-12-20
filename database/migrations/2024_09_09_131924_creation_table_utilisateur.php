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
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nom_entreprise', 255)->unique()->nullable();
            $table->string('neq', 255)->unique()->nullable();
            $table->string('email', 255)->unique()->nullable();
            $table->string('password', 255);
            //$table->string('role', 255);
            $table->enum('statut', ['Actif', 'Inactif', 'En attente', 'Refusé'])->default('En attente');
            $table->string('rbq', 255)->nullable();
            $table->rememberToken();
            $table->string('activation_token', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateur');
    }
};
