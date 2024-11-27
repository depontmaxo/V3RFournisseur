<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();                // Clé primaire
            $table->string('nom_Modele'); // Nom du modèle
            $table->string('objet');    // Objet du courriel
            $table->text('message');      // Message du courriel
            $table->timestamps();         // Colonnes created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_templates');
    }
};
