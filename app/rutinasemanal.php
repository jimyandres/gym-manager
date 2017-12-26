<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rutinasemanal extends Model
{
    protected $table = "rutinassemanales";
    
    protected $fillable = ['idrutinasemanal','descripcionobjetivo','fechainicio','fechafinal','identificadorentrenador','idcliente'];
    
   // protected $attributes = ['id','idrutinasemanal','descripcionobjetivo','fechainicio','fechafinal','identificadorentrenador','idcliente','updated_at','created_at'];
    
    //----------------------------------------------//
    
    public function cliente()
    {
        return $this->belongsTo('App\cliente');
    }
    
    //---------------------------------------------//
    
    public function rutinasdias()
    {
        return $this->hasmany('APP\rutinadia');
    }
}
