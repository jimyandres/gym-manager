<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class listadoenfermedad extends Model
{
    protected $table = "listadosenfermedades";
    
    protected $fillable = ['idlistadoenfermedad','idcliente','idenfermedad'];
    
    //-------------------------------------//
    
    public function cliente()
    {
        return $this->belongsTo('App\cliente');
    }
    
    public function enfermedad()
    {
        return $this->belongsTo('App\enfermedad');
    }
    
}
