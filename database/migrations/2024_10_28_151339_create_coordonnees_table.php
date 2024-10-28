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
            $table->string('adresse', 255);
            $table->string('bureau', 255);
            $table->string('ville', 255);
            $table->string('province', 255);
            $table->string('code_postal', 255);
            $table->string('pays', 255);
            $table->string('siteweb', 255);
            $table->string('num_telephone', 255);
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
