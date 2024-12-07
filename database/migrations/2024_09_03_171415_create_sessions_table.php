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
        Schema::table('sessions', function (Blueprint $table) {
            // Ajouter la colonne seulement si elle n'existe pas déjà
            if (!Schema::hasColumn('sessions', 'user_id')) {
                $table->string('user_id')->nullable(); 
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Supprimer la colonne seulement si elle existe
            if (Schema::hasColumn('sessions', 'user_id')) {
                $table->dropColumn('user_id'); 
            }
        });
    }
};
