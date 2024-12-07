<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropUnique('clients_password_unique'); // Supprimer l'index unique
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('clients', function (Blueprint $table) {
            $table->unique('password'); // Réappliquer l'index unique si besoin
        });
    }
};
