<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('utilisateur', function (Blueprint $table) {
            $table->string('activation_token', 255)->nullable()->after('email'); // Place la colonne après 'email'
        });
    }
    
    public function down()
    {
        Schema::table('utilisateur', function (Blueprint $table) {
            $table->dropColumn('activation_token');
        });
    }
};
