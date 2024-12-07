<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropRoleCheckConstraint extends Migration
{
    public function up()
    {
        // Supprimer la contrainte de vérification sur la colonne 'role'
        //DB::statement('ALTER TABLE users DROP CONSTRAINT chk_role');
    }

    public function down()
    {
        // Si nécessaire, vous pouvez recréer la contrainte ici
        // DB::statement('ALTER TABLE users ADD CONSTRAINT chk_role CHECK (role IN (''admin'', ''utilisateur''))');
    }
}
