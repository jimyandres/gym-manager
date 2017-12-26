@extends('layout.dashboard_layout')

@if(Session::get('id'))
@else
<script type="text/javascript">
window.location="{{route('login')}}";
</script>
@endif
<?php
if((Session::get('id')))
{}
else
{dd(Session::get('id'));}
?>

@if(Session::get('rol') == "cliente")
@else
<script type="text/javascript">
window.location="{{route('inicio')}}";
</script>
@endif

<?php
use App\datopersonal;
use App\tipousuario;
use App\clasificacionusuario;

$correo=Session::get('correo');

$usuario = datopersonal::where('correo',$correo)->first();
$clasificadousuario = clasificacionusuario::where('iddatopersonal',$usuario->iddatopersonal)->first();
$tipousuario = tipousuario::where('idtipousuario',$clasificadousuario->idtipousuario)->first();

?>

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{asset('materialize/css/materialize_custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/dashboard.css')}}">

@endsection

@section('sidebar_user')
	<a href="#!user"><img class="circle" src="{{asset('archivos/img/userdefault.jpg')}}"></a>
	<a href="#!name"><span class="white-text name">{{$usuario->nombre}} {{$usuario->apellido}}</span></a>
	<a href="#!email"><span class="white-text email">{{$usuario->correo}}</span></a>
@endsection

@section('sidebar_options')
	<li><a href={{ route('clientePerfil')}}><i class="material-icons">account_circle</i>Perfil</a></li>
	<li><a href="{{ route('routine::show', Session::get('id')) }}"><i class="material-icons">event_note</i>Mi Rutina</a></li>
	<li><a href={{ route('progress::progreso_cliente', ['id' => Crypt::encrypt(Session::get('id')) ] ) }}><i class="material-icons">supervisor_account</i>Mi Progreso</a></li>
	<!--<p>{{ Session::get('id') }}</p>-->
@endsection

@section('title', 'Mi Progreso')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{asset('materialize/css/materialize_custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/dashboard.css')}}">
@endsection


@section('content')

	<div class="row center-align white-text">
    	<h4>Mi Progreso</h4>
    </div>
	<div class="row">
		<div class="col s12 center-align white-text">
			<h5>Usted no tiene registro de su Progreso.</h2>
			<h6>Por favor comuníquese con un Entrenador para Iniciar el Proceso.</h6>
		</div>
	</div>
	
		
@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('archivos/js/dashboard_elements.js')}}"></script>
	<script type="text/javascript" src="{{asset('archivos/js/profile_init.js')}}"></script>
@endsection