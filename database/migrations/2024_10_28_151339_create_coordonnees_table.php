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
        Schema::create('coordonnees', function (Blueprint $table) {
            $table->id()->primary();
            $table->uuid('utilisateur_id');
            $table->foreign('utilisateur_id')->references('id')->on('utilisateur')->onDelete('cascade');
            
            $table->string('num_civique', 255);
            $table->string('rue', 255);
            $table->string('bureau', 255)->nullable();

            $table->string('ville', 255);
            $table->string('region_administrative', 255)->nullable();
            $table->string('code_region', 2)->nullable();
            $table->enum('province', 
            ['Québec', 'Ontario', 'Alberta', 'Colombie-Britannique', 'Manitoba', 'Nouveau-Brunswick', 
            'Terre-Neuve-et-Labrador', 'Nouvelle-Écosse', 'Île-du-Prince-Édouard', 'Saskatchewan', 
            'Territoires du Nord-Ouest', 'Nunavut', 'Yukon'])->default('Québec');
            $table->string('code_postal', 255);

            $table->string('num_telephone', 255);
            $table->string('poste', 255)->nullable();
            $table->enum('type_contact', ['Bureau', 'Télécopieur', 'Cellulaire']);

            $table->string('siteweb', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordonnees');
    }
};
