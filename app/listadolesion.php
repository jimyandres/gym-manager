<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class listadolesion extends Model
{
    protected $table = "listadoslesiones";
    
    protected $fillable = ['idlistadolesion','idcliente','idlesion'];
    
    //--------------------------------------------//
    
    public function cliente()
    {
        return $this->belongsTo('App\cliente');
    }
    
    public function lesion()
    {
        return $this->belongsTo('App\lesion');
    }
}
