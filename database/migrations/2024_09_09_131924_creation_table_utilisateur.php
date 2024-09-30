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
            $table->string('neq', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('nomFournisseur', 255);
            $table->string('adresse', 255);
            $table->string('noTelephone', 255);
            $table->string('personneRessource', 255);
            $table->string('emailPersonneRessource', 255);
            $table->string('licenceRBQ', 255);
            $table->string('posteOccupeEntreprise', 255);
            $table->string('siteWeb', 255);
            $table->string('produitOuService', 255);
            $table->string('statut', 255);
            $table->rememberToken();
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
