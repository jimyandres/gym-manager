<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clasificacionusuario extends Model
{
    protected $table = "clasificacionesusuarios";
    
    protected $fillable = ['idclasificacionusuario','idtipousuario','iddatopersonal'];
    
    //---------------------------------------------//
    
    public function tipousuario()
    {
        return $this->belongsTo('App\tipousuario');
    }
    
    public function datopersonal()
    {
        return $this->belongsTo('App\datopersonal');
    }
    
    //---------------------------------------------//
    
    public function cliente()
    {
        return $this->hasOne('APP\cliente');
    }
}
