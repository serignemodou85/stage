<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdLogicielToClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Ajouter la colonne id_logiciel avec nullable ou un défaut
            $table->unsignedBigInteger('id_logiciel')->nullable()->after('immatriculation');

            // Ajouter la clé étrangère qui fait référence à la table 'logiciel'
            $table->foreign('id_logiciel')->references('id_logiciel')->on('logiciel')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['id_logiciel']);
            $table->dropColumn('id_logiciel');
        });
    }
}
