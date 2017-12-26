<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\FormularioSomatometriaRequest;
use App\Http\Controllers\Controller;
use App\somatometria;
use App\cliente;
use App\clasificacionusuario;
use Illuminate\Support\Facades\Redirect;
use Carbon\carbon;
use Crypt;

class ControllerProgreso extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormularioSomatometriaRequest $request, $id)
    {
        $date = Carbon::now();
        $request['fecha'] = $date->toDateString();
        $cliente = cliente::where('idclasificacionusuario', '=', $id)->get();
        $request['idcliente'] = $cliente[0]['idcliente'];
        // dd($request->all());
        somatometria::create($request->all());
        
        return Redirect::route('progress::progreso_entrenador', $id);
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTrainer($id)
    {
        $cliente = cliente::where('idclasificacionusuario', '=', $id)->get();
        $data = somatometria::where('idcliente', '=', $cliente[0]['idcliente'])->first();
        if (is_null($data)){  
            return Redirect::route('progress::noRecords', $id);
        }
        
        return view('trainer.trainer_view_progress', $this->getProgress($cliente[0]['idcliente'], $id)/*[
            // 'brazo'=>$brazo, 
            // 'pierna'=>$pierna, 
            // 'torso'=>$torso, 
            // 'otro'=>$otro]*/
            );
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return route to client progress
     */
    public function showClient($id)
    {
        $id = Crypt::decrypt($id);
        $clasif = clasificacionusuario::where('iddatopersonal', '=', $id, 'AND', 'idtipousuario', '=', 4)->get();
        // dd($clasif);
        $cliente = cliente::where('idclasificacionusuario', '=', $clasif[0]['idclasificacionusuario'])->get();
        // dd($cliente[0]['idcliente']);
        $data = somatometria::where('idcliente', '=', ($cliente[0]['idcliente']))->first();
        if (is_null($data)){  
            return view('client.client_noProgress');
        }
        
        return view('client.client_progress', $this->getProgress($cliente[0]['idcliente'], $id));
    }
    
    public function getProgress($id, $id_dp)
    {
        $brazo = somatometria::select(
            'fecha', 
            'brazoalturabicep as b1', 
            'brazotension as b2', 
            'brazoflexionado as b3',
            'antebrazos as b4')
            ->where('idcliente', '=', $id)
            ->get();
            
        $estado['brazo'] = 'Brazos';
        
        // dd($brazo->all());   
        $pierna = somatometria::select(
            'fecha', 
            'gluteo as p1', 
            'pantorrilla as p2', 
            'cuadriceps as p3')
            ->where('idcliente', '=', $id)
            ->get();
            
        $estado['pierna'] = 'Piernas';
            
        $torso = somatometria::select(
            'fecha', 
            'cintura as t1', 
            'pectoral as t2')
            ->where('idcliente', '=', $id)
            ->get();
            
        $estado['torso'] = 'Torso';
            
        $otro = somatometria::select(
            'fecha', 
            'peso as o1',
            'talla as o2') 
            ->where('idcliente', '=', $id)
            ->get();
            
        $estado['otro'] = 'Peso del Cliente';

        $estado['imc'] = 'IMC';
        
        // $imc = end($otro);
        // dd($otro);
        
        return [
            'brazo'=>$brazo, 
            'pierna'=>$pierna, 
            'torso'=>$torso, 
            'otro'=>$otro,
            'estado'=>$estado,
            'id'=>$id_dp
            ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    // Retorna la vista en la que se especifica que no se tienen registros 
    // de progreso y se pregunta si se desea iniciar el proceso.
    public function noRecords($id)
    {
        // return view('noProgress');
        return view('trainer.trainer_register_progress', ['id'=>$id]);
        // abort(404, '***WIP***');
    }
    
    public function newRecord($id)
    {
        return view('trainer.trainer_register_progress', ['id'=>$id]);
    }
}
