<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ejercicio extends Model
{
    protected $table = "ejercicios";
    
    protected $fillable = ['idejercicio','nombre','descripcion','dificultad','idgrupomusculo'];
    
    //----------------------------------------------//
    public function gruposmusculos()
    {
        return $this->belongsTo('APP\grupomusculo');
    }
    
    public function pivoteejercicio()
    {
        return $this->hasmany('APP\pivoteejercicio');
    }
    
}
