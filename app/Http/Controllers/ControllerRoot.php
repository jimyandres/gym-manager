<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\datopersonal;
use App\clasificacionusuario;
use App\tipousuario;
use App\cliente;
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

class ControllerRoot extends Controller
{
    
    public function rootPerfil()
    {
        return view('root.root_profile');
    }
    
    public function search(Request $request)
    {
        $users = datopersonal::select('nombre','numerodocumento', 'apellido')
                                ->where('nombre','LIKE','%'.$request->search.'%')
                                ->orWhere('apellido','LIKE','%'.$request->search.'%')
                                ->orWhere('numerodocumento','LIKE','%'.$request->search.'%')->get();
        return $users;
    }
    
    public function changeProfileData(Request $request){
        switch(true){
            case($request->id != $request->numerodocumento && $request->email != $request->oldEmail):
                if(datopersonal::where('numerodocumento', $request->numerodocumento)->orWhere('correo', $request->email)->exists())
                {
                } else {
                    $id = $request->id;
                    if($request->password == null)
                    {
                        datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                    }
                    else
                    {
                       $password = Hash::make($request->password);
                       datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                    }
                    Session::put('correo', $request->email);
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
                        datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                    }
                    else
                    {
                       $password = Hash::make($request->password);
                       datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                    }
                    Session::put('correo', $request->email);
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
                        datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                    }
                    else
                    {
                       $password = Hash::make($request->password);
                       datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                    }
                    Session::put('correo', $request->email);
                    Session::put('nombre', $request->firstname);
                    Session::put('apellido', $request->lastname);
                    return $request->all();
                }
                break;
            case($request->id == $request->numerodocumento && $request->email == $request->oldEmail):
                $id = $request->id;
                if($request->password == null)
                {
                    datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                }
                else
                {
                   $password = Hash::make($request->password);
                   datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                }
                Session::put('correo', $request->email);
                Session::put('nombre', $request->firstname);
                Session::put('apellido', $request->lastname);
                return $request->all();
                break;
            default: return;
        }
    }
    
    public function getSelectedUser(Request $request)
    {
        $user = datopersonal::where('numerodocumento', $request->id)->get();
        return $user;
    }
    
    public function liveSearch(Request $request)
    {
        if($request->search != null)
        {
            $tipoclientes = tipousuario::where('tipousuario' , "trainer")
                                        ->orWhere('tipousuario', "admin")
                                        ->get(['idtipousuario']);
                                        
            $users = DB::table('clasificacionesusuarios')
                                        ->join('datospersonales',  function($join) use ($tipoclientes) {
                                            $join->on('clasificacionesusuarios.iddatopersonal', '=', 'datospersonales.iddatopersonal')
                                                ->whereIn('clasificacionesusuarios.idtipousuario', $tipoclientes->toArray());
                                         })
                                        ->select('datospersonales.nombre', 'datospersonales.numerodocumento', 'datospersonales.apellido')
                                        ->where('datospersonales.nombre','LIKE','%'.$request->search.'%')
                                        ->orWhere('datospersonales.apellido','LIKE','%'.$request->search.'%')
                                        ->orWhere('datospersonales.numerodocumento','LIKE','%'.$request->search.'%')
                                        ->get();
            return $users;
        }
    }
    
    public function typeUser(Request $request){
        $user = datopersonal::where('numerodocumento', $request->numerodocumento);
        $clasf = clasificacionusuario::where('iddatopersonal',$user->value('iddatopersonal'));
        $type = tipousuario::where('idtipousuario',$clasf->value('idtipousuario'))
        ->get();
        return $type->all();
    }
    
    public function changeUsers(Request $request)
    {
        switch(true){
            case($request->id != $request->numerodocumento && $request->email != $request->oldEmail):
                if(datopersonal::where('numerodocumento', $request->numerodocumento)->orWhere('correo', $request->email)->exists())
                {
                } else {
                    $id = $request->id;
                    if($request->password == null)
                    {
                        datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                    }
                    else
                    {
                       $password = Hash::make($request->password);
                       datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
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
                        datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                    }
                    else
                    {
                       $password = Hash::make($request->password);
                       datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
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
                        datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                    }
                    else
                    {
                       $password = Hash::make($request->password);
                       datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                    }
                    return $request->all();
                }
                break;
            case($request->id == $request->numerodocumento && $request->email == $request->oldEmail):
                $id = $request->id;
                if($request->password == null)
                {
                    datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone]);
                }
                else
                {
                   $password = Hash::make($request->password);
                   datopersonal::where('numerodocumento', $id)->update(['nombre'=>$request->firstname,'apellido'=>$request->lastname,'direccion'=>$request->address,'correo'=>$request->email,'genero'=>$request->genero,'fechanacimiento'=>$request->fechanacimiento,'numerodocumento'=>$request->numerodocumento,'tipodocumento'=>$request->tipodocumento,'telefono'=>$request->phone,'password'=>$password]); 
                }
                return $request->all();
                break;
            default: return;
        }
    }
    
    public function deleteUser(Request $request)
    {
        $user = datopersonal::where('numerodocumento', $request->numerodocumento);
        $clasf = clasificacionusuario::where('iddatopersonal',$user->value('iddatopersonal'));
        //cliente::where('idclasificacionusuario',$clasf->value('idclasificacionusuario'))->delete();
        $clasf->delete();
        $user->delete();
        return $request->all();
    }
    
    public function createUser(Request $request){
        if(datopersonal::where('numerodocumento', $request->numerodocumento)->orWhere('correo', $request->correo)->exists()){
            
        } else {
            $password = Hash::make($request->password);
            $secretword = Hash::make($request->palabrasecreta);
            
            datopersonal::create([
                'nombre'=>$request->nombre,
                'apellido'=>$request->apellido, 
                'direccion'=>$request->direccion, 
                'correo'=>$request->correo, 
                'genero'=>$request->genero, 
                'ciudad'=>$request->ciudad, 
                'fechanacimiento'=>$request->fechanacimiento, 
                'numerodocumento'=>$request->numerodocumento, 
                'tipodocumento'=>$request->tipodocumento, 
                'password'=>$password, 
                'telefono'=>$request->telefono, 
                'palabrasecreta'=>$secretword]);
                
            $idtipousuario = tipousuario::where('tipousuario', $request->tipousuario)->select('idtipousuario')->get();
            $iddatopersonal = datopersonal::where('numerodocumento', $request->numerodocumento)->select('iddatopersonal')->get();
            $idtipousuario->transform(function ($item, $key) {
                return intval($item->idtipousuario);
            });
            
            $iddatopersonal->transform(function ($item, $key) {
                return intval($item->iddatopersonal);
            });
            
            clasificacionusuario::create([
                'idtipousuario'=>$idtipousuario[0], 
                'iddatopersonal'=>$iddatopersonal[0]]
                );
                
            if ($request->tipousuario == "trainer" or $request->tipousuario == "admin") {
                
                $idclasificacionusuario = clasificacionusuario::where('iddatopersonal', $iddatopersonal[0])->select('idclasificacionusuario')->get();
                $idclasificacionusuario->transform(function ($item, $key) {
                    return intval($item->idclasificacionusuario);
                });
            }
            return $request->all();
        }
    }
    
}