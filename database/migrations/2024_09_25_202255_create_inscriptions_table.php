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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('entreprise', 255)->unique();
            $table->string('neq', 255)->unique();
            $table->string('courrielConnexion', 255);
            $table->string('password', 255);

            $table->string('services', 255);
            $table->string('adresse', 255);
            $table->string('bureau', 255);
            $table->string('ville', 255);
            $table->string('province', 255);
            $table->string('codePostal', 255);
            $table->string('pays', 255);
            $table->string('site', 255);
            $table->string('numTel', 255);
            
            $table->string('rbq', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }

};
