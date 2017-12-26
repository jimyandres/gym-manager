<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datopersonal extends Model
{
    protected $table = "datospersonales";
    
    protected $fillable = ['iddatopersonal','nombre','apellido','direccion','correo','genero','ciudad','fechanacimiento','numerodocumento','tipodocumento','password','telefono','palabrasecreta'];
    
    protected $hidden = ['password', 'remember_token'];
    
    //---------------------------------------------------//
    
    public function clasificacionusuario()
    {
        return $this->hasOne('APP\clasificacionusuario');
    }
    
}
