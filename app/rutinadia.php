<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rutinadia extends Model
{
    protected $table = "rutinasdias";
    
    protected $fillable = ['idrutinadia','repeticiones','sets','nivelesfuerzo','dia','idrutinasemanal'];
    
    //------------------------------------------//
    
    public function rutinasemanal()
    {
        return $this->belongsTo('App\rutinasemanal', 'idrutinasemanal', 'idrutinasemanal');
    }
    
    public function pivoteejercicio()
    {
        return $this->hasmany('APP\pivoteejercicio', 'idrutinadia', 'idrutinadia');
    }
}
