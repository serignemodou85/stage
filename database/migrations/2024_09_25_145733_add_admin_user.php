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
        DB::table('users')->insert([
            'name' => 'Fall',
            'email' => 'tellofall@example.com',
            'password' => Hash::make('passer123'), // Hachage du mot de passe
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'Admin',
        ]);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
