<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grupomusculo extends Model
{
    protected $table = "gruposmusculos";
    
    protected $fillable = ['idgrupomusculo','musculo'];
    
    //--------------------------------------//
    
    public function ejercicio()
    {
        return $this->hasmany('App\ejercicio');
    }
}
