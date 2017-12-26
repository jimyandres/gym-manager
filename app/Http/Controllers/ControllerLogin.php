<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\datopersonal;
use App\cliente;
use App\clasificacionusuario;
use App\tipousuario;
use App\tipoenfermedad;
use App\tipolesion;
use App\enfermedad;
use App\lesion;
use App\grupomusculo;
use App\ejercicio;
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

class ControllerLogin extends Controller
{
 public function store(LoguinRequest $request)
 {  
  
   /*$tipocliente = new tipousuario();
   $tipocliente->idtipousuario=1;
   $tipocliente->tipousuario='root';
   $tipocliente->save();
   
   
   $tipocliente = new tipousuario();
   $tipocliente->idtipousuario=2;
   $tipocliente->tipousuario='admin';
   $tipocliente->save();
   
   
   $tipocliente = new tipousuario();
   $tipocliente->idtipousuario=3;
   $tipocliente->tipousuario='trainer';
   $tipocliente->save();
   
   
   $tipocliente = new tipousuario();
   $tipocliente->idtipousuario=4;
   $tipocliente->tipousuario='cliente';
   $tipocliente->save();
   
    $usuario = new datopersonal();
    $usuario->password=bcrypt(1234);
    $usuario->correo="j@gmail.com";
    $usuario->nombre='Juan';
    $usuario->apellido='Saldarriaga';
    $usuario->direccion='32879432789324';
    $usuario->genero='masculino';
    $usuario->ciudad='Pereira';
    $usuario->fechanacimiento='2016-11-17 12:10:45';
    $usuario->numerodocumento='1232112313';
    $usuario->tipodocumento='CC';
    $usuario->telefono='233131313';
    $usuario->palabrasecreta='jjhjhd';
    $usuario->save(); 
    
    $clasificacionusuario=new clasificacionusuario();
    $clasificacionusuario->idtipousuario=1;
    $clasificacionusuario->iddatopersonal=1;
    $clasificacionusuario->save();
    
    $usuario = new datopersonal();
    $usuario->password=bcrypt(5234);
    $usuario->correo="l@gmail.com";
    $usuario->nombre='Leo';
    $usuario->apellido='Vega';
    $usuario->direccion='32879432789324';
    $usuario->genero='masculino';
    $usuario->ciudad='Pereira';
    $usuario->fechanacimiento='2016-11-17 12:10:45';
    $usuario->numerodocumento='32432424';
    $usuario->tipodocumento='CC';
    $usuario->telefono='423243432';
    $usuario->palabrasecreta='rewwrerw';
    $usuario->save(); 
    
    $clasificacionusuario=new clasificacionusuario();
    $clasificacionusuario->idtipousuario=4;
    $clasificacionusuario->iddatopersonal=2;
    $clasificacionusuario->save();
    
    $usuario = new datopersonal();
    $usuario->password=bcrypt(5234);
    $usuario->correo="m@gmail.com";
    $usuario->nombre='Mauro';
    $usuario->apellido='Vel';
    $usuario->direccion='32879432789324';
    $usuario->genero='masculino';
    $usuario->ciudad='Pereira';
    $usuario->fechanacimiento='2016-11-17 12:10:45';
    $usuario->numerodocumento='132211313';
    $usuario->tipodocumento='CC';
    $usuario->telefono='213121131';
    $usuario->palabrasecreta='jjkdjksjdkskd';
    $usuario->save(); 
    
    $clasificacionusuario=new clasificacionusuario();
    $clasificacionusuario->idtipousuario=3;
    $clasificacionusuario->iddatopersonal=3;
    $clasificacionusuario->save();

    $clasificacionusuario=new clasificacionusuario();
    $clasificacionusuario->idtipousuario=2;
    $clasificacionusuario->iddatopersonal=3;
    $clasificacionusuario->save();
    
    $usuario = new datopersonal();
    $usuario->password=bcrypt(5234);
    $usuario->correo="i@gmail.com";
    $usuario->nombre='Imagin';
    $usuario->apellido='Holi';
    $usuario->direccion='32879432789324';
    $usuario->genero='masculino';
    $usuario->ciudad='Pereira';
    $usuario->fechanacimiento='2016-11-17 12:10:45';
    $usuario->numerodocumento='123123313';
    $usuario->tipodocumento='CC';
    $usuario->telefono='3424242323';
    $usuario->palabrasecreta='fsdssfs';
    $usuario->save(); 
    
    $clasificacionusuario=new clasificacionusuario();
    $clasificacionusuario->idtipousuario=2;
    $clasificacionusuario->iddatopersonal=4;
    $clasificacionusuario->save();

    $tipoenfermedad = new tipoenfermedad();
    $tipoenfermedad->idtipoenfermedad=1;
    $tipoenfermedad->tipoenfermedad='cardiovasculares';
    $tipoenfermedad->save();


    $tipoenfermedad = new tipoenfermedad();
    $tipoenfermedad->idtipoenfermedad=2;
    $tipoenfermedad->tipoenfermedad='respiratorios';
    $tipoenfermedad->save();


    $tipoenfermedad = new tipoenfermedad();
    $tipoenfermedad->idtipoenfermedad=3;
    $tipoenfermedad->tipoenfermedad='tipo_cuerpo';
    $tipoenfermedad->save();


    $tipoenfermedad = new tipoenfermedad();
    $tipoenfermedad->idtipoenfermedad=4;
    $tipoenfermedad->tipoenfermedad='carencia_extremidad';
    $tipoenfermedad->save();

    $tipolesion = new tipolesion();
    $tipolesion->idtipolesion=1;
    $tipolesion->tipolesion='muscular';
    $tipolesion->save();


    $tipolesion = new tipolesion();
    $tipolesion->idtipolesion=2;
    $tipolesion->tipolesion='fractura';
    $tipolesion->save();


    $tipolesion = new tipolesion();
    $tipolesion->idtipolesion=3;
    $tipolesion->tipolesion='articular';
    $tipolesion->save();


    $tipolesion = new tipolesion();
    $tipolesion->idtipolesion=4;
    $tipolesion->tipolesion='deformidad';
    $tipolesion->save();

    $enfermedad = new enfermedad();
    $enfermedad->idenfermedad=1;
    $enfermedad->nombreenfermedad='miocardiopatia';
    $enfermedad->nivelriesgo='4';
    $enfermedad->idtipoenfermedad=1;
    $enfermedad->save();


    $enfermedad = new enfermedad();
    $enfermedad->idenfermedad=2;
    $enfermedad->nombreenfermedad='displasia_arritmogenica';
    $enfermedad->nivelriesgo='4';
    $enfermedad->idtipoenfermedad=1;
    $enfermedad->save();


    $enfermedad = new enfermedad();
    $enfermedad->idenfermedad=3;
    $enfermedad->nombreenfermedad='arterias_coronarias';
    $enfermedad->nivelriesgo='4';
    $enfermedad->idtipoenfermedad=1;
    $enfermedad->save();


    $enfermedad = new enfermedad();
    $enfermedad->idenfermedad=4;
    $enfermedad->nombreenfermedad='general';
    $enfermedad->nivelriesgo='3';
    $enfermedad->idtipoenfermedad=1;
    $enfermedad->save();


    $enfermedad = new enfermedad();
    $enfermedad->idenfermedad=5;
    $enfermedad->nombreenfermedad='asma';
    $enfermedad->nivelriesgo='3';
    $enfermedad->idtipoenfermedad=2;
    $enfermedad->save();


    $enfermedad = new enfermedad();
    $enfermedad->idenfermedad=6;
    $enfermedad->nombreenfermedad='general';
    $enfermedad->nivelriesgo='2';
    $enfermedad->idtipoenfermedad=2;
    $enfermedad->save();


    $enfermedad = new enfermedad();
    $enfermedad->idenfermedad=7;
    $enfermedad->nombreenfermedad='obesidad';
    $enfermedad->nivelriesgo='1';
    $enfermedad->idtipoenfermedad=3;
    $enfermedad->save();


    $enfermedad = new enfermedad();
    $enfermedad->idenfermedad=8;
    $enfermedad->nombreenfermedad='carencia_extremidad';
    $enfermedad->nivelriesgo='5';
    $enfermedad->idtipoenfermedad=2;
    $enfermedad->save();

    $lesion = new lesion();
    $lesion->idlesion=1;
    $lesion->nombrelesion='esguince';
    $lesion->nivelriesgo='2';
    $lesion->idtipolesion=1;
    $lesion->save();


    $lesion = new lesion();
    $lesion->idlesion=2;
    $lesion->nombrelesion='tendinitis';
    $lesion->nivelriesgo='2';
    $lesion->idtipolesion=1;
    $lesion->save();


    $lesion = new lesion();
    $lesion->idlesion=3;
    $lesion->nombrelesion='molestia';
    $lesion->nivelriesgo='2';
    $lesion->idtipolesion=1;
    $lesion->save();


    $lesion = new lesion();
    $lesion->idlesion=4;
    $lesion->nombrelesion='fractura';
    $lesion->nivelriesgo='0';
    $lesion->idtipolesion=1;
    $lesion->save();


    $lesion = new lesion();
    $lesion->idlesion=5;
    $lesion->nombrelesion='fractura';
    $lesion->nivelriesgo='0';
    $lesion->idtipolesion=1;
    $lesion->save();


    $lesion = new lesion();
    $lesion->idlesion=7;
    $lesion->nombrelesion='ruptura';
    $lesion->nivelriesgo='0';
    $lesion->idtipolesion=2;
    $lesion->save();


    $lesion = new lesion();
    $lesion->idlesion=8;
    $lesion->nombrelesion='ruptura';
    $lesion->nivelriesgo='1';
    $lesion->idtipolesion=2;
    $lesion->save();


    $lesion = new lesion();
    $lesion->idlesion=9;
    $lesion->nombrelesion='ruptura';
    $lesion->nivelriesgo='3';
    $lesion->idtipolesion=2;
    $lesion->save();


    $lesion = new lesion();
    $lesion->idlesion=10;
    $lesion->nombrelesion='ruptura_articular';
    $lesion->nivelriesgo='4';
    $lesion->idtipolesion=2;
    $lesion->save();


    $lesion = new lesion();
    $lesion->idlesion=11;
    $lesion->nombrelesion='dolor_articular';
    $lesion->nivelriesgo='3';
    $lesion->idtipolesion=3;
    $lesion->save();


    $lesion = new lesion();
    $lesion->idlesion=12;
    $lesion->nombrelesion='dislocacion';
    $lesion->nivelriesgo='4';
    $lesion->idtipolesion=3;
    $lesion->save();

    $grupomusculo = new grupomusculo();
    $grupomusculo->idgrupomusculo=1;
    $grupomusculo->musculo='trapecio';
    $grupomusculo->save();


    $grupomusculo = new grupomusculo();
    $grupomusculo->idgrupomusculo=2;
    $grupomusculo->musculo='deltoides';
    $grupomusculo->save();


    $grupomusculo = new grupomusculo();
    $grupomusculo->idgrupomusculo=3;
    $grupomusculo->musculo='biceps';
    $grupomusculo->save();


    $grupomusculo = new grupomusculo();
    $grupomusculo->idgrupomusculo=4;
    $grupomusculo->musculo='triceps';
    $grupomusculo->save();


    $grupomusculo = new grupomusculo();
    $grupomusculo->idgrupomusculo=5;
    $grupomusculo->musculo='antebrazo';
    $grupomusculo->save();


    $grupomusculo = new grupomusculo();
    $grupomusculo->idgrupomusculo=6;
    $grupomusculo->musculo='pectoral';
    $grupomusculo->save();


    $grupomusculo = new grupomusculo();
    $grupomusculo->idgrupomusculo=7;
    $grupomusculo->musculo='abdomen';
    $grupomusculo->save();


    $grupomusculo = new grupomusculo();
    $grupomusculo->idgrupomusculo=8;
    $grupomusculo->musculo='espalda';
    $grupomusculo->save();


    $grupomusculo = new grupomusculo();
    $grupomusculo->idgrupomusculo=9;
    $grupomusculo->musculo='cuadriceps';
    $grupomusculo->save();


    $grupomusculo = new grupomusculo();
    $grupomusculo->idgrupomusculo=10;
    $grupomusculo->musculo='femoral';
    $grupomusculo->save();


    $grupomusculo = new grupomusculo();
    $grupomusculo->idgrupomusculo=11;
    $grupomusculo->musculo='gemelos';
    $grupomusculo->save();

    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=1;
    $ejercicio->nombre='encogimiento con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=1;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=2;
    $ejercicio->nombre='encogimiento con mancuerna';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=1;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=3;
    $ejercicio->nombre='encogimiento con polea';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=1;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=4;
    $ejercicio->nombre='encogimiento tras nuca con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=1;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=5;
    $ejercicio->nombre='remo al menton con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=1;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=6;
    $ejercicio->nombre='remo al menton con polea';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=1;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=7;
    $ejercicio->nombre='elevacion lateral';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=2;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=8;
    $ejercicio->nombre='elevacion lateral tumbado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=2;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=9;
    $ejercicio->nombre='elevacion frontal con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=2;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=10;
    $ejercicio->nombre='elevacion frontal con mancuerna';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=2;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=11;
    $ejercicio->nombre='elevacion frontal con banco inclinado a una mano';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=2;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=12;
    $ejercicio->nombre='elevacion fontral con polea';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=2;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=13;
    $ejercicio->nombre='elevacion lateral con polea';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=2;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=14;
    $ejercicio->nombre='press militar con mancuerna';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=2;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=15;
    $ejercicio->nombre='press militar con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=2;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=16;
    $ejercicio->nombre='pajaros';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=2;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=17;
    $ejercicio->nombre='press hombro con maquina';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=2;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=18;
    $ejercicio->nombre='remo al menton agarre abierto';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=2;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=19;
    $ejercicio->nombre='curl con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=20;
    $ejercicio->nombre='curl con barra agarre cerrado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=21;
    $ejercicio->nombre='curl con barra agarre ancho';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=22;
    $ejercicio->nombre='curl con barra agarre invertido';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=23;
    $ejercicio->nombre='curl con barra z';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=24;
    $ejercicio->nombre='curl con barra z agarre cerrado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=25;
    $ejercicio->nombre='curl con barra z en banco predicador';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=26;
    $ejercicio->nombre='curl con barra z concentrado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=27;
    $ejercicio->nombre='curl con mancuerna alterno';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=28;
    $ejercicio->nombre='curl con mancuernas agarre martillo';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=29;
    $ejercicio->nombre='curl con mancuernas agarre martillo cruzado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=30;
    $ejercicio->nombre='curl con mancuerna supinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=31;
    $ejercicio->nombre='curl con mancuerna agarre martillo en predicador';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=32;
    $ejercicio->nombre='curl con mancuerna a una mano banco predicador';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=33;
    $ejercicio->nombre='curl con mancuerna concentrado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=34;
    $ejercicio->nombre='curl con mancuerna concentrado banca inclinada';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=35;
    $ejercicio->nombre='curl polea alta';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=36;
    $ejercicio->nombre='curl polea tumbado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=37;
    $ejercicio->nombre='curl polea a una mano';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=38;
    $ejercicio->nombre='curl en maquina';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=3;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=39;
    $ejercicio->nombre='flexiones con banos juntas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=40;
    $ejercicio->nombre='fondos';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=41;
    $ejercicio->nombre='patadas de triceps con mancuerna';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=42;
    $ejercicio->nombre='press banca agarre cerrado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=43;
    $ejercicio->nombre='press banca agarre cerrado e inverso';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=44;
    $ejercicio->nombre='press frances';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=45;
    $ejercicio->nombre='extension con barra encima de la cabeza';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=46;
    $ejercicio->nombre='extension con barra z en banco declinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=47;
    $ejercicio->nombre='extension con barra z en banco inclinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=48;
    $ejercicio->nombre='extension con mancuerna a un brazo encima de la cabeza';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=49;
    $ejercicio->nombre='extension con mancuerna acostado al pecho';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=50;
    $ejercicio->nombre='extension con polea a un brazo';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=51;
    $ejercicio->nombre='extension con polea barra v';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=52;
    $ejercicio->nombre='extension con polea tras nuca barra recta';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=53;
    $ejercicio->nombre='extension con polea barra recta';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=54;
    $ejercicio->nombre='extension con polea agarre inverso';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=55;
    $ejercicio->nombre='extension con cuerda';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=56;
    $ejercicio->nombre='patadas de triceps con polea';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=4;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=57;
    $ejercicio->nombre='curl de muñeca con mancuerna palmas abajo';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=5;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=58;
    $ejercicio->nombre='curl de muñeca con mancuerna palmas arriba';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=5;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=59;
    $ejercicio->nombre='curl de muñecas a dos manos con palmas abajo';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=5;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=60;
    $ejercicio->nombre='curl de muñecas a dos manos con palmas arriba';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=5;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=61;
    $ejercicio->nombre='curl de muñeca con barra palmas arriba';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=5;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=62;
    $ejercicio->nombre='curl de muñeca con barra por detrás de la espalda';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=5;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=63;
    $ejercicio->nombre='curl de muñecas con barra palmas abajo';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=5;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=64;
    $ejercicio->nombre='curl invertido con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=5;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=65;
    $ejercicio->nombre='curl de muñecas en polea baja sentado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=5;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=66;
    $ejercicio->nombre='curl invertido en polea';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=5;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=67;
    $ejercicio->nombre='aperturas con mancuerna en banco inclinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=68;
    $ejercicio->nombre='aperturas en poleas en banco inclinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=69;
    $ejercicio->nombre='press con barra en banco inclinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=70;
    $ejercicio->nombre='press con mancuernas en banco inclinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=71;
    $ejercicio->nombre='press con mancuernas en banco inclinado agarre neutro';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=72;
    $ejercicio->nombre='press de banca al cuello';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=73;
    $ejercicio->nombre='press de banca con barra y agarre cerrado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=74;
    $ejercicio->nombre='press inclinado en máquina de discos';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=75;
    $ejercicio->nombre='aperturas circulares';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=76;
    $ejercicio->nombre='aperturas con mancuerna a una mano';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=77;
    $ejercicio->nombre='aperturas con mancuernas en banco plano';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=78;
    $ejercicio->nombre='aperturas con polea en banco plano';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=79;
    $ejercicio->nombre='aperturas de pecho en máquina';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=80;
    $ejercicio->nombre='aperturas en Peck-deck';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=81;
    $ejercicio->nombre='cruces en polea alta';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=82;
    $ejercicio->nombre='cruces en polea baja';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=83;
    $ejercicio->nombre='flexiones';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=84;
    $ejercicio->nombre='flexiones a manos juntas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=85;
    $ejercicio->nombre='flexiones con pies elevados';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=86;
    $ejercicio->nombre='fondos en máquina';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=87;
    $ejercicio->nombre='fondos en paralelas para pecho';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=88;
    $ejercicio->nombre='press de banca con bandas elasticas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=89;
    $ejercicio->nombre='press de banca con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=90;
    $ejercicio->nombre='press de banca con barra agarre ancho';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=91;
    $ejercicio->nombre='press de banca en multipower';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=92;
    $ejercicio->nombre='press de pecho en máquina horizontal';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=93;
    $ejercicio->nombre='press de pecho en máquina vertical';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=94;
    $ejercicio->nombre='press en banco plano con mancuernas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=95;
    $ejercicio->nombre='pullover con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=96;
    $ejercicio->nombre='pullover con mancuerna';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=97;
    $ejercicio->nombre='aperturas con mancuernas en banco declinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=98;
    $ejercicio->nombre='fondos entre bancos';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=99;
    $ejercicio->nombre='press con barra en banco declinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=100;
    $ejercicio->nombre='press con mancuernas en banco declinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=101;
    $ejercicio->nombre='press de banca declinado con barra agarre ancho';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=6;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=102;
    $ejercicio->nombre='elevaciones de cadera con rodillas dobladas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=103;
    $ejercicio->nombre='elevaciones de piernas colgado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=104;
    $ejercicio->nombre='elevaciones de piernas colgado piernas estiradas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=105;
    $ejercicio->nombre='elevaciones de piernas con balón medicinal';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=106;
    $ejercicio->nombre='elevaciones de piernas en banco plano';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=107;
    $ejercicio->nombre='elevaciones de piernas en paralelas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=108;
    $ejercicio->nombre='elevaciones de rodillas a la cabeza';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=109;
    $ejercicio->nombre='encogimientos en UVE';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=110;
    $ejercicio->nombre='encogimientos invertidos';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=111;
    $ejercicio->nombre='encogimientos invertidos en banco declinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=112;
    $ejercicio->nombre='pull-in con balón de ejercicio';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=113;
    $ejercicio->nombre='pull-in en banco plano';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=114;
    $ejercicio->nombre='tijeras de piernas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=115;
    $ejercicio->nombre='elevaciones de glúteos para abdomen';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=116;
    $ejercicio->nombre='encogimientos abdominales en suelo';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=117;
    $ejercicio->nombre='encogimientos con barra y press';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=118;
    $ejercicio->nombre='encogimientos con manos por encima de la cabeza';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=119;
    $ejercicio->nombre='encogimientos con piernas en balón de ejercicio';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=120;
    $ejercicio->nombre='encogimientos en balón de ejercicio';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=121;
    $ejercicio->nombre='encogimientos en banco declinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=122;
    $ejercicio->nombre='encogimientos en máquina';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=123;
    $ejercicio->nombre='encogimientos en polea';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=124;
    $ejercicio->nombre='encogimientos tocando dedos de los pies';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=125;
    $ejercicio->nombre='rodar con la barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=126;
    $ejercicio->nombre='bicicleta para oblicuos';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=127;
    $ejercicio->nombre='elevaciones de piernas para oblicuos tumbado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=128;
    $ejercicio->nombre='elevaciones de rodillas para oblicuos colgado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=129;
    $ejercicio->nombre='encogimiento lateral con barra de pie';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=130;
    $ejercicio->nombre='encogimiento lateral con mancuerna de pie';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=131;
    $ejercicio->nombre='encogimientos con codo a rodilla contraria';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=132;
    $ejercicio->nombre='encogimientos laterales dedos a los tobillos';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=133;
    $ejercicio->nombre='encogimientos para oblicuos';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=134;
    $ejercicio->nombre='encogimientos para oblicuos en banco declinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=135;
    $ejercicio->nombre='encogimientos para oblicuos en polea';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=136;
    $ejercicio->nombre='encogimientos para oblicuos tumbado de lado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=137;
    $ejercicio->nombre='giros con barra para oblicuos sentado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=138;
    $ejercicio->nombre='giros con disco para oblicuos';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=139;
    $ejercicio->nombre='giros para oblicuos';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=140;
    $ejercicio->nombre='inclinación lateral en polea';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=7;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=141;
    $ejercicio->nombre='dominadas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=142;
    $ejercicio->nombre='dominadas agarre ancho';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=143;
    $ejercicio->nombre='dominadas agarre cerrado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=144;
    $ejercicio->nombre='dominadas asistidas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=145;
    $ejercicio->nombre='dominadas con peso en multipower';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=146;
    $ejercicio->nombre='dominadas tras nuca';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=147;
    $ejercicio->nombre='jalones agarre cerrado (o jalón al pecho)';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=148;
    $ejercicio->nombre='jalones agarre V';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=149;
    $ejercicio->nombre='jalones en máquina';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=150;
    $ejercicio->nombre='jalones frontales';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=151;
    $ejercicio->nombre='jalones frontales con brazos rectos';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=152;
    $ejercicio->nombre='jalones tras nuca';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=153;
    $ejercicio->nombre='remo con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=154;
    $ejercicio->nombre='remo con barra a una mano';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=155;
    $ejercicio->nombre='remo con barra agarre invertido';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=156;
    $ejercicio->nombre='remo con mancuernas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=157;
    $ejercicio->nombre='remo con mancuernas en banco inclinado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=158;
    $ejercicio->nombre='remo en barra T';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=159;
    $ejercicio->nombre='remo en máquina';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=160;
    $ejercicio->nombre='remo en máquina tumbado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=161;
    $ejercicio->nombre='remo en multipower';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=162;
    $ejercicio->nombre='remo en polea sentado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=163;
    $ejercicio->nombre='remo invertido';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=164;
    $ejercicio->nombre='remo mancuerna a una mano';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=165;
    $ejercicio->nombre='buenos días con barra de pie';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=166;
    $ejercicio->nombre='buenos días con barra sentado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=167;
    $ejercicio->nombre='hiperextensiones de espalda';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=168;
    $ejercicio->nombre='peso Muerto';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=169;
    $ejercicio->nombre='peso Muerto estilo Sumo';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=170;
    $ejercicio->nombre='peso muerto piernas rígidas con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=171;
    $ejercicio->nombre='peso muerto piernas rígidas con mancuernas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=172;
    $ejercicio->nombre='peso muerto piernas rígidas en multipower';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=173;
    $ejercicio->nombre='peso Muerto con mancuernas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=174;
    $ejercicio->nombre='jalón en polea (agarre abierto)';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=175;
    $ejercicio->nombre='jalón en polea (agarre neutro)';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=8;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=176;
    $ejercicio->nombre='extensiones en máquina';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=177;
    $ejercicio->nombre='extensiones en máquina a una pierna';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=178;
    $ejercicio->nombre='peso Muerto';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=179;
    $ejercicio->nombre='power Cleans';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=180;
    $ejercicio->nombre='prensa Horizontal';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=181;
    $ejercicio->nombre='prensa Inclinada';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=182;
    $ejercicio->nombre='prensa Inclinada a una pierna';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=183;
    $ejercicio->nombre='prensa Vertical';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=184;
    $ejercicio->nombre='sentadilla Búlgara';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=185;
    $ejercicio->nombre='sentadilla con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=186;
    $ejercicio->nombre='sentadilla con barra con piernas abiertas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=187;
    $ejercicio->nombre='sentadilla con barra por encima de la cabeza';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='None';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=188;
    $ejercicio->nombre='sentadilla con caja, cuestión de altura';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=189;
    $ejercicio->nombre='sentadilla en multipower';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=190;
    $ejercicio->nombre='sentadilla frontal con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=191;
    $ejercicio->nombre='sentadilla Hack';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=192;
    $ejercicio->nombre='sentadilla Hack con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=193;
    $ejercicio->nombre='sentadilla Profunda';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=194;
    $ejercicio->nombre='sentadilla Sissy';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=195;
    $ejercicio->nombre='sentadillas con mancuerna (Estilo sumo)';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=196;
    $ejercicio->nombre='subir escalón con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=197;
    $ejercicio->nombre='subir escalón con mancuernas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=198;
    $ejercicio->nombre='zancadas con barra (En el sitio)';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=199;
    $ejercicio->nombre='zancadas con mancuernas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=200;
    $ejercicio->nombre='zancadas hacia atrás con mancuernas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=201;
    $ejercicio->nombre='zancadas laterales con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=9;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=202;
    $ejercicio->nombre='abductores en máquina';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=203;
    $ejercicio->nombre='aductores en máquina';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=204;
    $ejercicio->nombre='aductores en polea';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=205;
    $ejercicio->nombre='curl femoral en balón de ejercicio';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=206;
    $ejercicio->nombre='elevaciones de gluteos en balón de ejercicio';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=207;
    $ejercicio->nombre='extensiones de gluteos con cintas elásticas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=208;
    $ejercicio->nombre='extensiones de gluteos en polea';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=209;
    $ejercicio->nombre='femoral en máquina de pie';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=210;
    $ejercicio->nombre='femoral en máquina sentado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=211;
    $ejercicio->nombre='femoral en máquina tumbado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=212;
    $ejercicio->nombre='flexión femoral acostado con mancuerna';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=213;
    $ejercicio->nombre='patadas para gluteos';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=214;
    $ejercicio->nombre='peso muerto piernas rígidas con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=215;
    $ejercicio->nombre='peso muerto piernas rígidas con mancuernas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=216;
    $ejercicio->nombre='peso muerto rumano';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=217;
    $ejercicio->nombre='peso muerto rumano con mancuernas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=218;
    $ejercicio->nombre='puentes en suelo para gluteos';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='alta';
    $ejercicio->idgrupomusculo=10;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=219;
    $ejercicio->nombre='curl de Tibiales';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='media';
    $ejercicio->idgrupomusculo=11;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=220;
    $ejercicio->nombre='elevación de gemelo a un pie';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=11;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=221;
    $ejercicio->nombre='elevación de gemelo en máquina sentado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=11;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=222;
    $ejercicio->nombre='elevación de gemelos con barra sentado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=11;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=223;
    $ejercicio->nombre='elevación de gemelos con mancuernas sentado';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=11;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=224;
    $ejercicio->nombre='elevación de gemelos de pie con barra';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=11;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=225;
    $ejercicio->nombre='elevación de gemelos de pie con mancuernas';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=11;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=226;
    $ejercicio->nombre='elevación de gemelos en máquina hack';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=11;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=227;
    $ejercicio->nombre='elevaciones de gemelo tipo burro';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=11;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=228;
    $ejercicio->nombre='gemelo en máquina de pie';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=11;
    $ejercicio->save();


    $ejercicio = new ejercicio();
    $ejercicio->idejercicio=229;
    $ejercicio->nombre='gemelo en prensa';
    $ejercicio->descripcion='1';
    $ejercicio->dificultad='baja';
    $ejercicio->idgrupomusculo=11;
    $ejercicio->save();
    
    $cliente = new cliente();
    $cliente->fechapago = "2017-05-14 9:59:00";
    $cliente->estadoplataforma = "activo";
    $cliente->idclasificacionusuario = 2;
    $cliente->save();
    */
     //$user = datopersonal::where('correo', $request->email)->first();
     $informacion = explode("*", $request->email);
     $correonormal=$informacion[0];
     $correominuscula= strtolower($correonormal);
     $usuario = datopersonal::where('correo',$correominuscula)->first();
     $cantidad = null;
     $cliente = null;
     if($usuario != null)
     {
      $cantidad = clasificacionusuario::where('iddatopersonal',$usuario->iddatopersonal)->get();
      $cliente = clasificacionusuario::where('iddatopersonal',$usuario->iddatopersonal)->where('idtipousuario',4)->first();
     }
     if($cliente != null && count($cantidad) == 1)
     {
       $clienteestado = cliente::where('idclasificacionusuario',$cliente->idclasificacionusuario)->first();
       if($clienteestado->estadoplataforma == "inactivo")
       {
        flash("Usuario Inactivo");
        return Redirect::route('login');
       }
     }
     if($usuario == null && count($informacion) > 1)
     {
       $usuario_google = new datopersonal();
       $usuario_google->password=bcrypt($request->password);
       $usuario_google->correo=$informacion[0];
       $usuario_google->nombre=$informacion[1];
       $usuario_google->apellido=' ';
       $usuario_google->direccion=' ';
       $usuario_google->genero=' ';
       $usuario_google->ciudad='Pereira';
       $usuario_google->fechanacimiento=' ';
       $usuario_google->numerodocumento=' ';
       $usuario_google->tipodocumento=' ';
       $usuario_google->telefono=' ';
       $usuario_google->palabrasecreta=' ';
       $usuario_google->save();
       
       $usuario_nuevo = datopersonal::where('correo',$correominuscula)->first();
       
       $clasificacionusuario=new clasificacionusuario();
       $clasificacionusuario->idtipousuario=4;
       $clasificacionusuario->iddatopersonal=$usuario_nuevo->iddatopersonal;
       $clasificacionusuario->save();
       
       $clasificacion_nuevo = clasificacionusuario::where('iddatopersonal',$usuario_nuevo->iddatopersonal)->first();
       
       $cliente_nuevo = new cliente();
       $cliente_nuevo->fechapago = "2017-05-14 9:59:00";
       $cliente_nuevo->estadoplataforma = "inactivo";
       $cliente_nuevo->idclasificacionusuario = $clasificacion_nuevo->idclasificacionusuario;
       $cliente_nuevo->save();
       
     }
    
     if (Auth::attempt(['correo' => $correominuscula, 'password' =>  $request->password],"true")) 
        {
         
         $user_data = Auth::user();
         Session::put('id', $user_data->iddatopersonal);    
         Session::put('correo', $user_data->correo);
         Session::put('nombre', $user_data->nombre);
         Session::put('apellido', $user_data->apellido);
         Session::put('contrasena', $request->password);
         return Redirect::route('inicio');
        }
        else
        {
         flash("*Cuenta o contraseña invalida");
         return Redirect::route('login');
        }
 }
 
 public function salir()
  {
        Auth::logout();
        Session::flush();
        flash("Cerraste Sesion");
        return Redirect::back();
         //route('login');
  }
  
  public function entrenadorPerfil()
  {
   $trainer = clasificacionusuario::where('iddatopersonal',Session::get('id'))->where('idtipousuario',3)->first();
   if($trainer != null)
   {
    Session::put('rol', 'trainer');
    return view('trainer.trainer_profile');
   }
   else
    return view('trainer.trainer_profile');
  }
  
  public function clientePerfil()
  {
   $cantidad = clasificacionusuario::where('iddatopersonal',Session::get('id'))->get();
   $cliente = clasificacionusuario::where('iddatopersonal',Session::get('id'))->where('idtipousuario',4)->first();
   $count = count($cantidad);
   if($cliente != null)
   {
    Session::put('rol', 'cliente');
    $clienteestado = cliente::where('idclasificacionusuario',$cliente->idclasificacionusuario)->first();
    if($clienteestado->estadoplataforma == "activo")
    {
     return view('client.client_profile');
    }
    else if($count > 1 && $clienteestado->estadoplataforma == "inactivo")
    {
     flash("Usuario Inactivo");
     return Redirect::route('inicio');
    }
    else
     return Redirect::route('salir');
   }
   else
   return view('client.client_profile');
  }
  
  public function rootPerfil()
  {
   $root = clasificacionusuario::where('iddatopersonal',Session::get('id'))->where('idtipousuario',1)->first();
   if($root != null)
   {
    Session::put('rol', 'root');
    return view('root.root_profile');
   }
   else
   return view('root.root_profile');
  }
}