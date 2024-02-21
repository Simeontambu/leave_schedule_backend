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
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('matricule_agent');
            $table->integer('code_fonction')->unsigned()->notNullable();
            $table->foreign('code_fonction')->references('code_fonction')->on('fonctions');
            $table->integer('code_direction')->unsigned()->notNullable();
            $table->foreign('code_direction')->references('code_direction')->on('directions');
            $table->string('nom', 25);
            $table->string('postnom', 25);
            $table->string('prenom', 25);
            $table->string('adresse', 100);
            $table->integer('telephone')->unsigned()->nullable();
            $table->char('sexe', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents');
    }
};
