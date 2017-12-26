@extends('layout.profile_layout')

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

@section('sidebar_options')
	<li><a href={{ route('clientePerfil')}}><i class="material-icons">account_circle</i>Perfil</a></li>
	<li><a href="{{ route('routine::show', Session::get('id')) }}"><i class="material-icons">event_note</i>Mi Rutina</a></li>
	<li><a href={{ route('progress::progreso_cliente', ['id' => Crypt::encrypt(Session::get('id')) ] ) }}><i class="material-icons">supervisor_account</i>Mi Progreso</a></li>
@endsection

@section('user_type')
	Cliente
@endsection

@section('profile_options')
@endsection

@section('profile_data')
	<span class="red-text center-align" id="mensaje">@include('flash::message')</span>
	<div class="col s12 m6 l6">
		<label class="title-form">Nombre</label>
		<p>{{$usuario->nombre}}</p>
	</div>		
	<div class="col s12 m6 l6">
		<label class="title-form">Apellido</label>
		<p>{{$usuario->apellido}}</p>	
	</div>
	<div class="col s12 m6 l6">
	    <label class="title-form">Tipo de documento</label>
		<p>{{$usuario->tipodocumento}}</p>
	</div>
	<div class="col s12 m6 l6">
	    <label class="title-form">Número de documento</label>
		<p>{{$usuario->numerodocumento}}</p>	
	</div>
	<div class="col s12 m6 l6">
	    <label class="title-form">Género</label>
		<p>{{$usuario->genero}}</p>
	</div>
	<div class="col s12 m6 l6">
		<label class="title-form">Fecha de nacimiento</label>
		<p>{{$usuario->fechanacimiento}}</p>		
	</div>
	<div class="col s12 m6 l6">
		<label class="title-form">Teléfono</label>
		<p>{{$usuario->telefono}}</p>
	</div>
	<div class="col s12 m6 l6">
		<label class="title-form">Dirección</label>
		<p>{{$usuario->direccion}}</p>		
	</div>
	<div class="col s12 m6 l6">
	    <label class="title-form">Ciudad</label>
		<p>{{$usuario->ciudad}}</p>
	</div>
	<div class="col s12 m6 l6">
	    <label class="title-form">País</label>
		<p>Colombia</p>
	</div>
	<div class="col s12 m6 l6">
		<label class="title-form">Correo electrónico</label>
		<p>{{$usuario->correo}}</p>	
	</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('archivos/js/dashboard_elements.js')}}"></script>
	<script type="text/javascript" src="{{asset('archivos/js/profile_init.js')}}"></script>
	<script type="text/javascript">
	var mensaje = document.getElementById("mensaje");
		if(mensaje.innerHTML != 0)
		{
			Materialize.toast(mensaje, 4000);
		}
	</script>
@endsection