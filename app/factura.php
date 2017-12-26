<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    protected $table = "facturas";
    
    protected $fillable = ['idfactura','fechafactura','nombrecompleto','documentoidentificacion','descripcion','iva','costo','resolucion','ciudad','direccion','correo','idcliente'];
    
    //------------------------------------------//
    
    public function cliente()
    {
        return $this->belongsTo('App\cliente');
    }
}
