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
        Schema::table('factures', function (Blueprint $table) {
            $table->boolean('regle')->default(false); // Indique si la facture est en règle ou non
            $table->date('date_limite')->nullable(); // Date limite de paiement
        });
    }

    public function down()
    {
        Schema::table('facture', function (Blueprint $table) {
            $table->dropColumn(['regle', 'date_limite']);
        });
    }
};