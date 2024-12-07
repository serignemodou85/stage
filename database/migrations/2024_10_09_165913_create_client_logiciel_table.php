<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientLogicielTable extends Migration
{
    public function up()
    {
        Schema::create('client_logiciel', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->unsignedBigInteger('id_logiciel');
            $table->foreign('id_logiciel')->references('id_logiciel')->on('logiciel')->onDelete('NO ACTION'); // Utilisation de NO ACTION

            // Add timestamps if needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_logiciel');
    }
}
