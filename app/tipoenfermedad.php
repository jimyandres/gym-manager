<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipoenfermedad extends Model
{
    protected $table = "tiposenfermedades";
    
    protected $fillable = ['idtipoenfermedad','tipoenfermedad'];
    
    //----------------------------------------//
    
    public function enfermedades()
    {
        return $this->hasmany('APP\enfermedad');
    }
    
}
