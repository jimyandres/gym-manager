<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class enfermedad extends Model
{
    protected $table = "enfermedades";
    
    protected $fillable = ['idenfermedad','nombreenfermedad','nivelriesgo','idtipoenfermedad'];
    
    //-------------------------------------------//
    
    public function tipoenfermedad()
    {
        return $this->belongsTo('App\tipoenfermedad');
    }
    
    //-----------------------------------------//
    
    public function listadosenfermedades()
    {
        return $this->hasmany('APP\listadoenfermedad');
    }
}
