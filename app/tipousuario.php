<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipousuario extends Model
{
    protected $table = "tiposusuarios";
    
    protected $fillable = ['idtipousuario','tipousuario'];
    
    //-------------------------------------//
    
    public function clasificacionesusuarios()
    {
        return $this->hasmany('APP\clasificacionusuario');
    }
    
}
