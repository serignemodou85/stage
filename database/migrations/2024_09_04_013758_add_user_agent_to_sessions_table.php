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
            // Vérifie si la colonne 'user_agent' n'existe pas déjà
            if (!Schema::hasColumn('sessions', 'user_agent')) {
                $table->text('user_agent')->nullable(); // Ajoute la colonne user_agent uniquement si elle n'existe pas
            }
        });
    }

    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Vérifie si la colonne 'user_agent' existe avant de la supprimer
            if (Schema::hasColumn('sessions', 'user_agent')) {
                $table->dropColumn('user_agent'); // Supprime la colonne user_agent si vous revenez en arrière
            }
        });
    }
};
