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
            // Vérifie si la colonne 'ip_address' n'existe pas déjà
            if (!Schema::hasColumn('sessions', 'ip_address')) {
                $table->string('ip_address', 45)->nullable(); // Ajoute la colonne ip_address uniquement si elle n'existe pas
            }
        });
    }

    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Vérifie si la colonne 'ip_address' existe avant de la supprimer
            if (Schema::hasColumn('sessions', 'ip_address')) {
                $table->dropColumn('ip_address'); // Supprime la colonne ip_address si vous revenez en arrière
            }
        });
    }
};

