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
            $table->id();
            $table->uuid('inscription_id'); // UUID ici
            $table->foreign('inscription_id')->references('id')->on('inscriptions')->onDelete('cascade'); // Clé étrangère
            $table->string('prenom', 255);
            $table->string('nom', 255);
            $table->string('poste', 255);
            $table->string('courrielContact', 255);
            $table->string('numContact', 255)->nullable();;
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
