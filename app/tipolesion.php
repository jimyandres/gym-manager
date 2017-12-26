<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipolesion extends Model
{
    protected $table = "tiposlesiones";
    
    protected $fillable = ['idtipolesion','tipolesion'];
    
    //------------------------------------------//
    
    public function lesiones()
    {
        return $this->hasmany('APP\lesion');
    }
}
