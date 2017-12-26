<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('idcliente');
            $table->string('estadoplataforma');
            $table->timestamp('fechapago');
            $table->timestamps();
            
            $table->integer('idclasificacionusuario')->unsigned()->nullable();
            $table->foreign('idclasificacionusuario')->references('idclasificacionusuario')->on('clasificacionesusuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clientes');
    }
}
