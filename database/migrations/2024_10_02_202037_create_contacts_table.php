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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id()->primary();
            $table->uuid('utilisateur_id');
            $table->foreign('utilisateur_id')->references('id')->on('utilisateur')->onDelete('cascade'); // Clé étrangère
            $table->string('prenom', 255);
            $table->string('nom', 255);
            $table->string('poste', 255);
            $table->string('email_contact', 255);
            $table->string('num_contact', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
