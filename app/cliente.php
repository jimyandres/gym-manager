<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $table = "clientes";
    
    protected $fillable = ['idcliente','estadoplataforma','fechapago','idclasificacionusuario'];
    
    //-----------------------------------------------//
    
    public function clasificacionusuario()
    {
        return $this->belongsTo('App\clasificacionusuario'); //'idclasificacionusuario'
    }
    
    
    //-----------------------------------------------//
    
    public function rutinasemanal()
    {
        return $this->hasOne('APP\rutinasemanal', 'idcliente', 'idcliente');
    }
    
    //-----------------------------------------------//
    
    public function facturas()
    {
        return $this->hasmany('APP\factura');
    }
    
    public function listadosenfermedades()
    {
        return $this->hasmany('APP\listadoenfermedad');
    }
    
    public function listadoslesiones()
    {
        return $this->hasmany('APP\listadolesion');
    }
    
    public function somatometrias()
    {
        return $this->hasmany('APP\somatometrias');
    }
    
}
