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
        Schema::create('plannings', function (Blueprint $table) {
            $table->increments('numero_planning');
            $table->unsignedInteger('code_conge')->notNullable();
            $table->unsignedInteger('matricule_agent')->notNullable();
            $table->date('date_depart')->nullable();
            $table->date('date_retour')->nullable();
            $table->foreign('code_conge')->references('code_conge')->on('conges');
            $table->foreign('matricule_agent')->references('matricule_agent')->on('agents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plannings');
    }
};
