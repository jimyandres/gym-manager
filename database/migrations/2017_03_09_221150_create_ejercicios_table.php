<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEjerciciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicios', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('idejercicio');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('dificultad');
            $table->timestamps();
            
            $table->integer('idgrupomusculo')->unsigned()->nullable();
            $table->foreign('idgrupomusculo')->references('idgrupomusculo')->on('gruposmusculos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ejercicios');
    }
}
