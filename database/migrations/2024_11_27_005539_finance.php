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
        Schema::create('finances', function (Blueprint $table) {
            $table->id()->primary();
            $table->uuid('utilisateur_id');
            $table->foreign('utilisateur_id')->references('id')->on('utilisateur')->onDelete('cascade');
            $table->string('numeroTPS', 255);
            $table->string('numeroTVQ', 255);
            $table->string('conditionPaiement', 255);
            $table->string('devise', 255);
            $table->string('modeCommunication', 255);
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance');
    }
};
