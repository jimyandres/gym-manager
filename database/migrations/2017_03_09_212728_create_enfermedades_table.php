<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnfermedadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfermedades', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('idenfermedad');
            $table->string('nombreenfermedad');
            $table->string('nivelriesgo');
            $table->timestamps();
            
            $table->integer('idtipoenfermedad')->unsigned()->nullable();
            $table->foreign('idtipoenfermedad')->references('idtipoenfermedad')->on('tiposenfermedades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('enfermedades');
    }
}
