<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSomatometriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('somatometrias', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('idsomatometria');
            $table->date('fecha');
            $table->string('brazoalturabicep');
            $table->string('brazoflexionado');
            $table->string('brazotension');
            $table->string('antebrazos');
            $table->string('cintura');
            $table->string('gluteo');
            $table->string('pantorrilla');
            $table->string('pectoral');
            $table->string('cuadriceps');
            $table->string('peso');
            $table->string('talla');
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
        Schema::drop('somatometrias');
    }
}
