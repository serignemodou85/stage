<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('adresse');
            $table->string('email')->unique();
            $table->string('telephone')->unique();
            $table->string('nom_entreprise');
            $table->string('immatriculation')->unique();
            $table->boolean('actif')->default(true);
            $table->string('token', 255)->nullable();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }

};
