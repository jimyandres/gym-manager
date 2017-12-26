<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lesion extends Model
{
    protected $table = "lesiones";
    
    protected $fillable = ['idlesion','nombrelesion','nivelriesgo','idtipolesion'];
    
    //----------------------------------------//
    
    public function tipolesion()
    {
        return $this->belongsTo('App\tipolesion');
    }
    
    //----------------------------------------//
    
    public function listadoslesiones()
    {
        return $this->hasmany('APP\listadolesion');
    }
    
}
