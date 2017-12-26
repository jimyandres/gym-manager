<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRutinasdiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutinasdias', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('idrutinadia');
            $table->integer('repeticiones');
            $table->integer('sets');
            $table->string('nivelesfuerzo');
            $table->string('dia');
            $table->timestamps();
            
            $table->integer('idrutinasemanal')->unsigned()->nullable();
            $table->foreign('idrutinasemanal')->references('idrutinasemanal')->on('rutinassemanales');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rutinasdias');
    }
}
