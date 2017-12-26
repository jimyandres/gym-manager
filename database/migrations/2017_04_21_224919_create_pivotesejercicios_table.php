<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotesejerciciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivotesejercicios', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('idpivoteejercicio');
            $table->timestamps();
            
            $table->integer('idejercicio')->unsigned()->nullable();
            $table->foreign('idejercicio')->references('idejercicio')->on('ejercicios');
            
            $table->integer('idrutinadia')->unsigned()->nullable();
            $table->foreign('idrutinadia')->references('idrutinadia')->on('rutinasdias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pivotesejercicios');
    }
}
