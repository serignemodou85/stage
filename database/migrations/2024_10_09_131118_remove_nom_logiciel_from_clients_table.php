<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveNomLogicielFromClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Supprimer la colonne nom_logiciel
            $table->dropColumn('nom_logiciel_DS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Ajouter à nouveau la colonne si besoin
            $table->string('nom_logiciel_DS')->after('immatriculation');
        });
    }
}

