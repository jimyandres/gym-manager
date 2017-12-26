<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLesionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesiones', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('idlesion');
            $table->string('nombrelesion');
            $table->string('nivelriesgo');
            $table->timestamps();
            
            $table->integer('idtipolesion')->unsigned()->nullable();
            $table->foreign('idtipolesion')->references('idtipolesion')->on('tiposlesiones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lesiones');
    }
}
