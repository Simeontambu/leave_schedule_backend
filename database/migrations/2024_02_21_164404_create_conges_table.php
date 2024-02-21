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
        Schema::create('conges', function (Blueprint $table) {
            $table->increments('code_conge');
            $table->unsignedInteger('matricule_agent')->notNullable();
            $table->foreign('matricule_agent')->references('matricule_agent')->on('agents');
            $table->unsignedInteger('code_durer')->notNullable();
            $table->foreign('code_durer')->references('code_durer')->on('durers');
            $table->unsignedInteger('code_motif')->notNullable();
            $table->foreign('code_motif')->references('code_motif')->on('motifs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conge');
    }
};
