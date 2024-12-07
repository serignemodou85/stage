<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('nom_base_DS')->nullable()->after('immatriculation'); // Ajout du champ code base DS
            $table->string('nom_logiciel_DS')->nullable()->after('nom_base_DS'); // Ajout du champ code logiciel DS
            $table->boolean('isDelete')->default(false)->after('actif'); // Ajout pour soft delete
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['nom_base_DS', 'nom_logiciel_DS', 'isDelete']);
        });
    }
};
