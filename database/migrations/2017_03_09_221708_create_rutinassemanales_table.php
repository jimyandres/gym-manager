<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRutinassemanalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutinassemanales', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('idrutinasemanal');
            $table->string('descripcionobjetivo');
            $table->string('fechainicio');
            $table->string('fechafinal');
            $table->string('identificadorentrenador');
            $table->timestamps();
            
            $table->integer('idcliente')->unsigned()->nullable();
            $table->foreign('idcliente')->references('idcliente')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rutinassemanales');
    }
}
