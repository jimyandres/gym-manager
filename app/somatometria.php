<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class somatometria extends Model
{
    protected $table = "somatometrias";
    
    protected $fillable = ['idsomatometria','fecha','brazoalturabicep','brazoflexionado',
    'brazotension','antebrazos','cintura','gluteo','pantorrilla','pectoral','cuadriceps',
    'idcliente', 'peso', 'talla'];
    
    //--------------------------------------------------//
    public function cliente()
    {
        return $this->belongsTo('App\cliente');
    }
}
