<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\somatometria;
use App\clasificacionusuario;
use App\listadoenfermedad;
use App\datopersonal;
use App\cliente;
use App\listadolesion;
use App\rutinasemanal;
use App\rutinadia;
use App\ejercicio;
use App\grupomusculo;
use App\tipousuario;
use App\tipoenfermedad;
use App\enfermedad;
use App\tipolesion;
use App\lesion;
use App\pivoteejercicio;
use App\Http\Requests\FormularioMedicoRequest;
use App\Http\Requests\FormularioSomatometriaRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Auth;
use Carbon\Carbon;

class ControllerRutina extends Controller
{
    public function indexStep1($id)
    {
        if(!empty($this->getRoutine($id))) {
            return redirect(route('entrenadorUsuarios'))->with('Error', "El cliente ya cuenta con una rutina activa, por favor modifique esta o bien cancele la actual rutina y vuelva a intentarlo");
        }
        return view('crud.create_routine_step1', compact('id'));
    }
    
    public function indexStep2($id)
    {
        if(!empty($this->getRoutine($id))) {
            return redirect(route('entrenadorUsuarios'))->with('Error', "El cliente ya cuenta con una rutina activa, por favor modifique esta o bien cancele la actual rutina y vuelva a intentarlo");
        }
        $rutina = $this->getRoutine($id);
        return view('crud.create_routine_step2', compact('id'));
    }
    
    public function indexStep3($id)
    {
        if(!empty($this->getRoutine($id))) {
            return redirect(route('entrenadorUsuarios'))->with('Error', "El cliente ya cuenta con una rutina activa, por favor modifique esta o bien cancele la actual rutina y vuelva a intentarlo");
        }
        return view('crud.create_routine_step3', compact('id'));
    }
    
    private function validateMedicalForm(array $data)
    {
        if(array_key_exists('confirmation', $data)) {
            return false;
        } else {
            foreach($data as $pregunta => $respuesta) {
                if(($pregunta != "pregunta6" && $pregunta != "pregunta7") && $respuesta == "yes") {
                    return true;
                }
            }
            return false;
        }
    }
    
    public function storeMedicalForm(FormularioMedicoRequest $request, $id)
    {
        if($this->validateMedicalForm($request->except(['_token', 'tipo_enfermedad', 'enfermedad', 'tipo_traumatismo', 'grupo_muscular']))) {
            flash('Se desaconseja el ejercicio físico y la practica deportiva. Si desea continuar por favor dar clic en "Acepto"');
            return back()->withInput()->with('confirm', 'Por favor confirmar que entiende los riesgos y desea continuar');
        } else {
            $client = cliente::where('idclasificacionusuario', $id)->get()->first();
            $listadoenfermedad = null;
            $listadolesion = null;
        
            if(!empty($request['tipo_enfermedad'])) {
                $listadoenfermedad = new listadoenfermedad([
                    'idcliente' => $client->idcliente,
                    'idenfermedad' => $request['enfermedad']
                ]);
                $listadoenfermedad->save();
            }
            if(!empty($request['tipo_traumatismo'])) {
                $listadolesion = new listadolesion([
                    'idcliente' => $client->idcliente,
                    'idlesion' => $request['grupo_muscular']
                ]);
                $listadolesion->save();
            }
            //dd($listadoenfermedad, $listadolesion);
            return redirect(route('routine::asignarRutina2', $id));//'entrenadorUsuarios/'.$id.'/asignarRutina/2');
        }
    }
    
    public function storeSomatometricForm(FormularioSomatometriaRequest $request, $id)
    {
        
        $date = Carbon::now();
        $request['fecha'] = $date->toDateString();
        $client = cliente::where('idclasificacionusuario', $id)->get()->first();
        $request['idcliente'] = $client->idcliente;
        $somatometria = somatometria::create($request->all());
        //dd($request->all(), $somatometria);
        // dd($request->all());
        
        return redirect(route('routine::asignarRutina3', $id));//'entrenadorUsuarios/'.$id.'/asignarRutina/3');
    }
    
    public function storeRoutine(Request $request, $id)
    {
        
        //dd(Session::get('id'));
        $data = $request->all();
        if(empty($data)) {
            return ["status" => false, "msg" => "Por favor ingrese datos."];
        }
        if(!empty($this->getRoutine($id))) {
            return redirect(route('entrenadorUsuarios'))->with('Error', "El cliente ya cuenta con una rutina activa, por favor modifique esta o bien cancele la actual rutina y vuelva a intentarlo");
        }
        //dd($request->user());
        $date = Carbon::now();
        $client = cliente::where('idclasificacionusuario', $id)->get()->first();
        $rutina_semanal = rutinasemanal::create([
            'descripcionobjetivo' => "",
            'fechainicio' => $date->toDateString(),
            'fechafinal' => $date->addMonths(2)->toDateString(),
            'identificadorentrenador' => Session::get('id'),
            'idcliente' => $client->idcliente
        ]);
        //dd($rutina_semanal);
        $rutina_semanal = $rutina_semanal->get()->last();//->get()->sortByDesc('created_at')->first();
        //dd($rutina_semanal->select('idrutinasemanal')->get());
        //$rutina_semanal->save();
        // echo "<pre>";
        // var_dump($rutina_semanal);
        // echo "</pre>";
        /*$rutina_semanal = $client->rutinasemanal()->create([
            'descripcionobjetivo' => " ",
            'fechainicio' => $date->toDateString(),
            'fechafinal' => $date->addMonths(2)->toDateString(),
            'identificadorentrenador' => $request->user()->iddatopersonal
        ]);*/
        //echo "Entrenador: ". $request->user()."<br>";
        foreach($data as $day => $data) {
            //echo $day."<br>";
            foreach($data as $phase => $exercises) {
                // switch($phase) {
                //     case 0:
                //         echo "Heating";
                //         break;
                //     case 1:
                //         echo "Trainning";
                //         break;
                //     case 2:
                //         echo "Stretching";
                //         break;
                // }
                foreach($exercises as $exercise) {
                    $rutina_dia = rutinadia::create([
                        'repeticiones' => $exercise["reps"],
                        'sets' => $exercise["sets"],
                        'nivelesfuerzo' => $phase,
                        'dia' => $day,
                        'idrutinasemanal' => $rutina_semanal->idrutinasemanal
                    ]);
                    //$rutina_dia = $rutina_dia->get()->sortByDesc('created_at')->first();
                    $rutina_dia = $rutina_dia->get()->last();
                    //var_dump($rutina_dia);
                    //$rutina_dia->save();
                    // $exer = ejercicio::find($exercise["exercise"]);
                    $day_has_exercise = pivoteejercicio::create([
                       'idejercicio' => $exercise["exercise"],
                       'idrutinadia' => $rutina_dia->idrutinadia
                    ]);
                    //$day_has_exercise->save();
                    
                    //$rutina_dia->pivoteejercicio()->save($day_has_exercise);
                    
                    // echo "<pre>";
                    //echo count($data);
                    //dd($rutina_semanal, $rutina_dia, $day_has_exercise);
                    // var_dump($rutina_dia);
                    // var_dump($day_has_exercise);
                    // echo "</pre>";
                }
            }
        }
        $request->session()->flash('Success', 'Rutina creada staisfactoriamente');
        return ["status" => true, "redirect" => route('entrenadorUsuarios')];
    }
    
    private function getRoutine($id)
    {
        $client = cliente::where('idclasificacionusuario', $id)->get()->first();
        $rutina_semanal = rutinasemanal::where('idcliente', $client->idcliente)->get()->first();
        //dd($rutina_semanal);
        if(is_null($rutina_semanal)) {
            return [];
        }
        $rutina_dia = rutinadia::where('idrutinasemanal', $rutina_semanal->idrutinasemanal)->get()->groupBy('dia');
        //$dias_rutinas = rutinadia::where('idrutinasemanal', $rutina_semanal->idrutinasemanal)->get(['idrutinadia']);
        //dd($dias_rutinas);
        //$ejercicios_dias = pivoteejercicio::whereIn('idrutinadia', $dias_rutinas)->get();
        
        $rutina = array();
        //dd($rutina_dia);
        foreach($rutina_dia as $day => $data) {
            $data;//->groupBy('nivelesfuerzo');
            //dd($data);
            /*if($data instanceof 'Illuminate\Database\Eloquent\Collection') {
                dd("Es collection");
            } else {
                dd("No es collection");
            }*/
            $rutina[$day] = [
                // "0" => array(),
                // "1" => array(),
                // "2" => array()
            ];
            // $rutina[$day][0] = [];
            // $rutina[$day][1] = [];
            // $rutina[$day][2] = [];
            //return $rutina;
            foreach($data as $exercise) {
                //dd($exercise);
                $pivote = pivoteejercicio::where('idrutinadia', $exercise->idrutinadia)->get()->first();
                //dd($pivote);
                $tmpExercise = ejercicio::where('idejercicio', $pivote->idejercicio)->get()->first();
                $grupo_musculo = grupomusculo::where('idgrupomusculo', $tmpExercise->idgrupomusculo)->get()->first();
                
                $tmp = [
                    'excercise' => $pivote->idejercicio,
                    'muscularGroup' => $grupo_musculo->idgrupomusculo,
                    "reps" => $exercise->repeticiones,
                    "sets" => $exercise->sets
                ];
                
                /*if(isset($rutina[$day][$exercise->nivelesfuerzo])) {
                    $rutina[$day][$exercise->nivelesfuerzo][] = $tmp;
                } else {
                    $rutina[$day][$exercise->nivelesfuerzo][] = $tmp;
                }*/
                //$rutina[$day][$exercise->nivelesfuerzo][] = $tmp;
                //dd(["$exercise->nivelesfuerzo" => $tmp]);
                $rutina[$day][$exercise->nivelesfuerzo][] = $tmp;
                //dd($tmp);
                // $rutina[$day][$exercise->nivelesfuerzo] = array_merge($rutina[$day][$exercise->nivelesfuerzo], $tmp);
                //dd($rutina[$day][$exercise->nivelesfuerzo]);
            }
        }
        return $rutina;
    }
    
    public function showRoutine($id)
    {
        //dd($id);
        $cliente = clasificacionusuario::where('iddatopersonal', $id)->get()->first();
        $client = cliente::where('idclasificacionusuario', $cliente->idclasificacionusuario)->get()->first();
        $rutina = $this->getRoutine($cliente->idclasificacionusuario);
        
        $rutina_semanal = rutinasemanal::where('idcliente', '=', $client->idcliente)->value('idrutinasemanal');
        $dias = rutinadia::where('idrutinasemanal', $rutina_semanal)->get(['idrutinadia'])->toArray();
        $pivotes = pivoteejercicio::whereIn('idrutinadia', $dias)->distinct()->get(['idejercicio'])->toArray();
        $ejercicios = ejercicio::whereIn('idejercicio', $pivotes)->get(['idgrupomusculo'])->toArray();
        $grupos_musculares = grupomusculo::whereIn('idgrupomusculo', $ejercicios)->lists('musculo', 'idgrupomusculo'
        );
        $lista_ejercicios = ejercicio::whereIn('idejercicio', $pivotes)->lists('nombre', 'idejercicio');
        //dd($grupos_musculares);
        //dd($client->idcliente, $rutina_semanal, $dias, $pivotes, $lista_ejercicios, $grupos_musculares);
        
        /**
         * 
         * Si no tiene rutina, se redirige a la vista sin la variable $rutina, en la vista se debe verificar si esta variable existe
         * Si no existe se debe mostrar mensaje como el de noProgress.
         * Si la variable existe es que el cliente si tiene rutina y se debe mostrar la rutina.
         * 
         * Como recorrer la variable rutina en la vista con php (blade):
         * foreach($rutina as $day => $data) {
                //dd($day, $data);
                foreach($data as $phase => $exercises) {
                    // dd($phase, $exercises, count($exercise));
                    foreach($exercises as $exercise) {
                        dd($exercise);
                    }
                }
            }
            
         * Como obtener y recorrer la rutina en javascript:
            <script type="text/javascript">
        		$(document).ready(function() {
        			var rutina = {!! json_encode($rutina) !!};
        			//console.log(rutina);
        			for (var day in rutina) {
        				console.log(day);
        				for(phase in rutina[day]) {
        					console.log("Excercises per phase");
        					console.log(phase);
        					//console.log(rutina[day][phase]);
        					var count = rutina[day][phase].length;
        					//console.log(count);
        					for(i=0; i<count; i++) {
        						console.log(rutina[day][phase][i]);
        						// console.log(rutina[day][phase][i].excercise);
        						// console.log(rutina[day][phase][i].muscularGroup);
        						// console.log(rutina[day][phase][i].reps);
        						// console.log(rutina[day][phase][i].sets);
        					}
        				}
        			}
        		});
        	</script>
         *
         * 
         * Descomentar lo siguiente una vez este hecha la vista, fijarse en que la ubicacion de la vista si sea la correcta.
         */
        // if(empty($rutina)) {
        //     //dd("No tiene rutina");
        //     return view('client.client_routine');
        // }
        return view('client.client_routine', compact('rutina', 'lista_ejercicios', 'grupos_musculares'));
        //return response()->json($rutina);
       
    }
    
    /*public function editRoutine($id)
    {
        $rutina = $this->getRoutine($id);
        //dd($rutina);
        if(empty($rutina)) {
            return redirect(route('entrenadorUsuarios'))->with('Error', 'El cliente no tiene rutina asignada.');
        } else {
            //return view('crud.update_routine', compact('rutina'));
            return response()->json($rutina);
        }
    }*/
    
    public function deleteRoutine($id)
    {
        $rutina = $this->getRoutine($id);
        //dd($rutina);
        if(empty($rutina)) {
            return redirect(route('entrenadorUsuarios'))->with('Error', 'El cliente no tiene rutina asignada.');
            //return ["status" => false, "msg" => "El cliente no tiene rutina asignada."];
        } else {
            $client = cliente::where('idclasificacionusuario', $id)->get()->first();
            $rutina_semanal = rutinasemanal::where('idcliente', $client->idcliente)->get()->first();
            //$rutina_dia = rutinadia::where('idrutinasemanal', $rutina_semanal->idrutinasemanal)->get()->groupBy('dia');
            $dias_rutinas = rutinadia::where('idrutinasemanal', $rutina_semanal->idrutinasemanal)->get(['idrutinadia']);
            //dd($dias_rutinas->toArray());
            //dd($dias_rutinas);
            $ejercicios_dias = pivoteejercicio::whereIn('idrutinadia', $dias_rutinas)->get();
            //dd($ejercicios_dias);
            foreach($ejercicios_dias as $ejercicio) {
                $idrutinadia = $ejercicio->idrutinadia;
                pivoteejercicio::where('idpivoteejercicio', $ejercicio->idpivoteejercicio)->delete();
                rutinadia::where('idrutinadia', $idrutinadia)->delete();
            }
            rutinasemanal::where('idrutinasemanal', $rutina_semanal->idrutinasemanal)->delete();
            //pivoteejercicio::destroy($ejercicios_dias->toArray());
            //$ejercicios_dias/* = pivoteejercicio::whereIn('idrutinadia', $dias_rutinas)-*/->delete();

            //dd($ejercicios_dias);
                
            return redirect(route('entrenadorUsuarios'))->with('Success', 'Rutina cancelada satisfactoriamente');
            //dd($rutina);
        }
    }
    
    public function getGruposMusculares(Request $request)
    {
        if($request->ajax()) {
            $grupos_musculares = grupomusculo::all();
            //$grupos_musculares = grupomusculo::join('musculos', 'gruposmusculos.idmusculo', '=', 'musculos.idmusculo')->get();
            return response()->json($grupos_musculares);
        }
    }
    
    public function getEjercicios(Request $request, $grupo_muscular)
    {
        if($request->ajax()) {
            $ejercicios = ejercicio::where('idgrupomusculo', $grupo_muscular)->get();
            /*$ejercicios = grupomusculo::join('ejercicios', 'gruposmusculos.idejercicio', '=', 'ejercicios.idejercicio')
                                    ->where('gruposmusculos.idgrupomusculo', '=', $grupo_muscular)
                                    ->get();*/
            return response()->json($ejercicios);
        }
    }
    
    public function getTiposEnfermedades(Request $request)
    {
        if($request->ajax()) {
            $tipos_enfermedades = tipoenfermedad::all();
            return response()->json($tipos_enfermedades);
        }
    }
    
    public function getEnfermedades(Request $request, $tipo_enfermedad)
    {
        if($request->ajax()) {
            $enfermedades = enfermedad::where('idtipoenfermedad', $tipo_enfermedad)->get();
            return response()->json($enfermedades);
        }
    }
    
    public function getTipoLesiones(Request $request)
    {
        if($request->ajax()) {
            $tipos_lesiones = tipolesion::all();
            return response()->json($tipos_lesiones);
        }
    }
    
    public function getLesiones(Request $request, $tipo_lesion)
    {
        if($request->ajax()) {
            $lesiones = lesion::where('idtipolesion', $tipo_lesion)->get();
            return response()->json($lesiones);
        }
    }
    
    public function liveSearch(Request $request)
    {
        if($request->search != null)
        {
            /*$users = clasificacionusuario::join('tipousuario', 'clasificacionusuario.idtipousuario', '=', 'tipousuario.idtipousuario')
                                        ->join('datopersonal', 'clasificacionusuario.iddatopersonal', '=', 'datopersonal.iddatopersonal')
                                        ->select('tipousuario', 'nombre', 'numerodocumento', 'apellido')
                                        ->where('nombre','LIKE','%'.$request->search.'%')
                                        ->orWhere('apellido','LIKE','%'.$request->search.'%')
                                        ->orWhere('numerodocumento','LIKE','%'.$request->search.'%');*/
                                        
            $tipoclientes = tipousuario::where('tipousuario' , "cliente")->get()->first();
            //return $tipoclientes;
            $users = DB::table('clasificacionesusuarios')
                                        ->join('datospersonales',  function($join) use ($tipoclientes) {
                                            $join->on('clasificacionesusuarios.iddatopersonal', '=', 'datospersonales.iddatopersonal')
                                                ->where('clasificacionesusuarios.idtipousuario', '=', $tipoclientes->idtipousuario);
                                         })
                                         ->join('clientes', function($join) {
                                            $join->on('clientes.idclasificacionusuario', '=', 'clasificacionesusuarios.idclasificacionusuario')
                                                ->where('clientes.estadoplataforma', '=', 'activo');
                                         })
                                        ->select('datospersonales.nombre', 'datospersonales.numerodocumento', 'clasificacionesusuarios.idclasificacionusuario', 'datospersonales.apellido')
                                        ->where('datospersonales.nombre','LIKE','%'.$request->search.'%')
                                        ->orWhere('datospersonales.apellido','LIKE','%'.$request->search.'%')
                                        ->orWhere('datospersonales.numerodocumento','LIKE','%'.$request->search.'%')
                                        ->get();
            // select "datospersonales"."nombre", "clasificacionesusuarios"."idclasificacionusuario", "datospersonales"."apellido" 
            // from clasificacionesusuarios inner join datospersonales on "datospersonales"."iddatopersonal" = "clasificacionesusuarios"."iddatopersonal" 
            // where "clasificacionesusuarios"."idtipousuario" = 2; 
            
            
            // $users = datopersonal::select('nombre','numerodocumento', 'apellido')
            //                     ->where('nombre','LIKE','%'.$request->search.'%')
            //                     ->orWhere('apellido','LIKE','%'.$request->search.'%')
            //                     ->orWhere('numerodocumento','LIKE','%'.$request->search.'%')->get();
            return $users;
        }
        
    }
    
    public function getSelectedUser(Request $request)
    {
        $user = DB::table('clasificacionesusuarios')->join('datospersonales', function($join) use ($request) {
                                                        $join->on('clasificacionesusuarios.iddatopersonal', '=', 'datospersonales.iddatopersonal')
                                                        ->where('datospersonales.numerodocumento', '=', $request->id);
                                                        })
                                                    ->join('tiposusuarios', 'clasificacionesusuarios.idtipousuario', '=', 'tiposusuarios.idtipousuario')
                                                    ->select('datospersonales.*', 'tiposusuarios.tipousuario', 'clasificacionesusuarios.idclasificacionusuario')->get();
                                                    //->where('clasificacionesusuarios.idclasificacionusuario', $request->id)->get();
        return $user;
    }
}
