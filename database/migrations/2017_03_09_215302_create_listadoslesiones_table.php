<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListadoslesionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listadoslesiones', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('idlistadolesion');
            $table->timestamps();
            
            $table->integer('idcliente')->unsigned()->nullable();
            $table->foreign('idcliente')->references('idcliente')->on('clientes');
            
            $table->integer('idlesion')->unsigned()->nullable();
            $table->foreign('idlesion')->references('idlesion')->on('lesiones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('listadoslesiones');
    }
}
