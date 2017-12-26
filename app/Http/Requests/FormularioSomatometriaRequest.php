<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FormularioSomatometriaRequest extends Request
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'peso' => 'required',
            'talla' => 'required',
            'brazotension' => 'required',
            'brazoalturabicep' => 'required',
            'brazoflexionado' => 'required',
            'antebrazos' => 'required',
            'cintura' => 'required',
            'gluteo' => 'required',
            'pantorrilla' => 'required',
            'cuadriceps' => 'required',
            'pectoral' => 'required',
            // 'fecha' => 'required',
            // 'idcliente' => 'required'
        ];
    }
}
