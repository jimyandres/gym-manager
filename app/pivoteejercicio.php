<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pivoteejercicio extends Model
{
    protected $table = "pivotesejercicios";
    
    protected $fillable = ['idpivoteejercicio','idejercicio','idrutinadia'];
    
    public function ejercicio()
    {
        return $this->belongsTo('App\ejercicio');
    }
    
    public function rutinadia()
    {
        return $this->belongsTo('App\rutinadia');
    }
}
