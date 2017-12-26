<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListadosenfermedadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listadosenfermedades', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('idlistadoenfermedad');
            $table->timestamps();
            
            $table->integer('idcliente')->unsigned()->nullable();
            $table->foreign('idcliente')->references('idcliente')->on('clientes');
            
            $table->integer('idenfermedad')->unsigned()->nullable();
            $table->foreign('idenfermedad')->references('idenfermedad')->on('enfermedades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('listadosenfermedades');
    }
}
