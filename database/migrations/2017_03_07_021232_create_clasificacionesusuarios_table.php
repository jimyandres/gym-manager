<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClasificacionesusuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasificacionesusuarios', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('idclasificacionusuario');
            $table->timestamps();
            
            $table->integer('idtipousuario')->unsigned()->nullable();
            $table->foreign('idtipousuario')->references('idtipousuario')->on('tiposusuarios');
            
            $table->integer('iddatopersonal')->unsigned()->nullable();
            $table->foreign('iddatopersonal')->references('iddatopersonal')->on('datospersonales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clasificacionesusuarios');
    }
}
