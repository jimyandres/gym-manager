<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatospersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datospersonales', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->increments('iddatopersonal');
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('direccion')->nullable();
            $table->string('correo');
            $table->string('genero')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('fechanacimiento')->nullable();
            $table->string('numerodocumento')->nullable();
            $table->string('tipodocumento')->nullable();
            $table->string('password');
            $table->string('telefono')->nullable();
            $table->string('palabrasecreta')->nullable();
            $table->timestamps();
            $table->rememberToken();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('datospersonales');
    }
}
