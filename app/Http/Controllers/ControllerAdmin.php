<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\datopersonal;
use App\clasificacionusuario;
use App\tipousuario;
use App\cliente;
use App\factura;
use App\Http\Requests;
use App\Http\Requests\LoguinRequest;
use Auth;
use Session;
use Redirect;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Hash;
use DB;

class ControllerAdmin extends Controller
{
    public function adminProfile()
    {
        $cliente = clasificacionusuario::where('iddatopersonal',Session::get('id'))->where('idtipousuario',2)->first();
        if($cliente != null)
        {
            Session::put('rol', 'admin');
            return view('admin.admin_profile');
        }
        else
        return view('admin.admin_profile');
    }
    
    public function adminUsers()
    {
        return view('admin.admin_users');
    }
    
    public function UsersRegistration()
    {
        return view('crud.create_user');
    }
    
    public function changeProfileData(Request $request)
    {
        switch(true){
            case($request->id != $request->numerodocumento && $request->email != $request->oldEmail):
                if(datopersonal::where('numerodocumento', $request->numerodocumento)->orWhere('correo', $request->email)->exists())
                {
                } else {
                    $id = $request->id;
                    if($request->password == null)
                    {
                        datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                    }
                    else
                    {
                       $password = Hash::make($request->password);
                       datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                    }
                    Session::put('correo', strtolower($request->email));
                    Session::put('nombre', $request->firstname);
                    Session::put('apellido', $request->lastname);
                    return $request->all();
                }
                break;
            case($request->id == $request->numerodocumento && $request->email != $request->oldEmail):
                if(datopersonal::where('correo', $request->email)->exists())
                {
                } else {
                    $id = $request->id;
                    if($request->password == null)
                    {
                        datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                    }
                    else
                    {
                       $password = Hash::make($request->password);
                       datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                    }
                    Session::put('correo', strtolower($request->email));
                    Session::put('nombre', $request->firstname);
                    Session::put('apellido', $request->lastname);
                    return $request->all();
                }
                break;
            case($request->id != $request->numerodocumento && $request->email == $request->oldEmail):
                if(datopersonal::where('numerodocumento', $request->numerodocumento)->exists())
                {
                } else {
                    $id = $request->id;
                    if($request->password == null)
                    {
                        datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                    }
                    else
                    {
                       $password = Hash::make($request->password);
                       datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                    }
                    Session::put('correo', strtolower($request->email));
                    Session::put('nombre', $request->firstname);
                    Session::put('apellido', $request->lastname);
                    return $request->all();
                }
                break;
            case($request->id == $request->numerodocumento && $request->email == $request->oldEmail):
                $id = $request->id;
                if($request->password == null)
                {
                    datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                }
                else
                {
                   $password = Hash::make($request->password);
                   datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                }
                Session::put('correo', strtolower($request->email));
                Session::put('nombre', $request->firstname);
                Session::put('apellido', $request->lastname);
                return $request->all();
                break;
            default: return;
        }
    }
    
    public function liveSearch(Request $request)
    {
        if($request->search != null)
        {
            $users = DB::table('clasificacionesusuarios')->join('tiposusuarios', function ($join) {
                                                                $join->on('clasificacionesusuarios.idtipousuario', '=', 'tiposusuarios.idtipousuario')
                                                                ->whereIn('tiposusuarios.tipousuario', ['cliente', 'trainer']);
                                                        })
                                                        ->join('datospersonales', 'clasificacionesusuarios.iddatopersonal', '=', 'datospersonales.iddatopersonal')
                                                        ->select('datospersonales.nombre','datospersonales.numerodocumento', 'datospersonales.apellido')
                                                        ->where('datospersonales.nombre','LIKE','%'.$request->search.'%')
                                                        ->orWhere('datospersonales.apellido','LIKE','%'.$request->search.'%')
                                                        ->orWhere('datospersonales.numerodocumento','LIKE','%'.$request->search.'%')->get();
            return $users;
        }
    }
    
    public function getSelectedUser(Request $request)
    {
        $user = DB::table('clasificacionesusuarios')->join('datospersonales', 'clasificacionesusuarios.iddatopersonal', '=', 'datospersonales.iddatopersonal')
                                                    ->join('tiposusuarios', 'clasificacionesusuarios.idtipousuario', '=', 'tiposusuarios.idtipousuario')
                                                    ->select('datospersonales.*', 'tiposusuarios.tipousuario', 'clasificacionesusuarios.idclasificacionusuario')
                                                    ->where('datospersonales.numerodocumento', $request->id)->get();
        return $user;
    }
    
    public function chageUsersData(Request $request)
    {
        switch(true){
            case($request->id != $request->numerodocumento && $request->email != $request->oldEmail):
                if(datopersonal::where('numerodocumento', $request->numerodocumento)->orWhere('correo', $request->email)->exists())
                {
                } else {
                    $id = $request->id;
                    if($request->password == null)
                    {
                        datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                    }
                    else
                    {
                       $password = Hash::make($request->password);
                       datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                    }
                    return $request->all();
                }
                break;
            case($request->id == $request->numerodocumento && $request->email != $request->oldEmail):
                if(datopersonal::where('correo', $request->email)->exists())
                {
                } else {
                    $id = $request->id;
                    if($request->password == null)
                    {
                        datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                    }
                    else
                    {
                       $password = Hash::make($request->password);
                       datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                    }
                    return $request->all();
                }
                break;
            case($request->id != $request->numerodocumento && $request->email == $request->oldEmail):
                if(datopersonal::where('numerodocumento', $request->numerodocumento)->exists())
                {
                } else {
                    $id = $request->id;
                    if($request->password == null)
                    {
                        datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                    }
                    else
                    {
                       $password = Hash::make($request->password);
                       datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                    }
                    return $request->all();
                }
                break;
            case($request->id == $request->numerodocumento && $request->email == $request->oldEmail):
                $id = $request->id;
                if($request->password == null)
                {
                    datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                }
                else
                {
                   $password = Hash::make($request->password);
                   datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>strtolower($request->email),'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                }
                return $request->all();
                break;
            default: return;
        }
    }
    
    public function deleteUser(Request $request)
    {
        $idcliente = DB::table('clasificacionesusuarios')->join('datospersonales', 'clasificacionesusuarios.iddatopersonal', '=', 'datospersonales.iddatopersonal')
                                                        ->join('clientes', 'clasificacionesusuarios.idclasificacionusuario', '=', 'clientes.idclasificacionusuario')
                                                        ->select('clientes.idcliente')->where('datospersonales.numerodocumento', $request->numerodocumento)->get();
        cliente::where('idcliente', intval($idcliente))->update(['estadoplataforma'=>"inactivo"]);
        return $idcliente;
    }
    
    public function createUser(Request $request)
    {
        if(datopersonal::where('numerodocumento', $request->numerodocumento)->orWhere('correo', $request->correo)->exists())
        {
        } else { 
            $password = Hash::make($request->password);
            $secretword = Hash::make($request->palabrasecreta);
            
            datopersonal::create(['nombre'=>$request->nombre, 'apellido'=>$request->apellido, 'direccion'=>$request->direccion, 'correo'=>strtolower($request->correo), 
                                'genero'=>$request->genero, 'ciudad'=>$request->ciudad, 'fechanacimiento'=>$request->fechanacimiento, 'numerodocumento'=>$request->numerodocumento, 
                                'tipodocumento'=>$request->tipodocumento, 'password'=>$password, 'telefono'=>$request->telefono, 'palabrasecreta'=>$secretword]);
            $idtipousuario = tipousuario::where('tipousuario', $request->tipousuario)->select('idtipousuario')->get();
            $iddatopersonal = datopersonal::where('numerodocumento', $request->numerodocumento)->select('iddatopersonal')->get();
            $idtipousuario->transform(function ($item, $key) {
                return intval($item->idtipousuario);
            });
            $iddatopersonal->transform(function ($item, $key) {
                return intval($item->iddatopersonal);
            });
            clasificacionusuario::create(['idtipousuario'=>$idtipousuario[0], 'iddatopersonal'=>$iddatopersonal[0]]);
            if ($request->tipousuario == "cliente") {
                $idclasificacionusuario = clasificacionusuario::where('iddatopersonal', $iddatopersonal[0])->select('idclasificacionusuario')->get();
                $idclasificacionusuario->transform(function ($item, $key) {
                    return intval($item->idclasificacionusuario);
                });
                cliente::create(['idclasificacionusuario'=>$idclasificacionusuario[0], 'estadoplataforma'=>"inactivo", 'fechapago'=>date("Y-m-d")]);
            }
            return $request->all();
        }
    }
    
    public function makePayment(Request $request)
    {
        $user = DB::table('clasificacionesusuarios')->join('datospersonales', 'clasificacionesusuarios.iddatopersonal', '=', 'datospersonales.iddatopersonal')
                                                    ->join('clientes', 'clasificacionesusuarios.idclasificacionusuario', '=', 'clientes.idclasificacionusuario')
                                                    ->select('datospersonales.nombre', 'datospersonales.numerodocumento', 'datospersonales.ciudad', 
                                                            'datospersonales.direccion', 'datospersonales.correo', 'clientes.idcliente')
                                                    ->where('datospersonales.numerodocumento', $request->numerodocumento)->get();
        $userdata = array();
        foreach($user as $key => $value)
        {
            $userdata[] = ['nombre'=>$value->nombre, 'docnum'=>$value->numerodocumento, 'ciudad'=>$value->ciudad, 
                            'direccion'=>$value->direccion, 'correo'=>strtolower($value->correo), 'idcliente'=>intval($value->idcliente)];
        }
        factura::create(['fechafactura'=>date("Y-m-d"), 'nombrecompleto'=>$userdata[0]['nombre'], 'documentoidentificacion'=>$userdata[0]['docnum'], 
                                        'descripcion'=>'Mensualidad', 'iva'=>16, 'costo'=>70000, 'resolucion'=>0, 'ciudad'=>$userdata[0]['ciudad'], 
                                        'direccion'=>$userdata[0]['direccion'], 'correo'=>$userdata[0]['correo'], 'idcliente'=>$userdata[0]['idcliente']]);
        $clientPaymentUpdateDate = cliente::where('idcliente', $userdata[0]['idcliente'])->select('fechapago')->get();
        $paymentDate = array();
        foreach($clientPaymentUpdateDate as $key => $value)
        {
            $paymentDate[] = ['date'=>$value->fechapago];
        }
        $newPaymentDate = strtotime ( '+1 month' , strtotime ( $paymentDate[0]['date'] ) );
        $newPaymentDate = date ( 'Y-m-d' , $newPaymentDate );
        cliente::where('idcliente', $userdata[0]['idcliente'])->update(['estadoplataforma'=>"activo", 'fechapago'=>$newPaymentDate]);
        return $request->all();
    }
    
    public function isActive(Request $request) {
        $activeUser = cliente::where('idclasificacionusuario', $request->idclasificacionusuario)->get();
        return $activeUser;
    }
}
