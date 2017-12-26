<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('idfactura');
            $table->string('fechafactura');
            $table->string('nombrecompleto');
            $table->string('documentoidentificacion');
            $table->string('descripcion');
            $table->integer('iva');
            $table->bigInteger('costo');
            $table->bigInteger('resolucion');
            $table->string('ciudad');
            $table->string('direccion');
            $table->string('correo');
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
        Schema::drop('facturas');
    }
}
