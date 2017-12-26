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

@if(Session::get('rol') == "trainer")
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
	<li><a href={{ route('entrenadorPerfil')}}><i class="material-icons">account_circle</i>Perfil</a></li>
	<li><a href={{ route('entrenadorUsuarios') }}><i class="material-icons">supervisor_account</i>Clientes</a></li>
	<!--<li><a href=""><i class="material-icons">directions_run</i>Rutinas</a></li>-->
@endsection

@section('user_type')
	Entrenador
@endsection

@section('profile_options')
	<div class="col s4">
		<a class="btn-floating btn-large waves-effect waves-light orange darken-4 center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Editar" onclick="editar()"><i class="material-icons">mode_edit</i></a>
	</div>
@endsection

@section('profile_data')
	{!!Form::open(['method'=>'POST', 'id'=>'envia']) !!}
		<div class="input-field col s12 m6 l6">
			<input disabled id="firstname" pattern="[a-zA-Z]+" value="{{$usuario->nombre}}" name="firstname" type="text" class="validate" autocomplete="off">
			<label for="firstname" data-error="Solo letras" >Nombre</label>
		</div>		
		<div class="input-field col s12 m6 l6">
			<input disabled id="lastname" pattern="[a-zA-Z]+" value="{{$usuario->apellido}}" name="lastname" type="text" class="validate" autocomplete="off">
			<label for="lastname" data-error="Solo letras" >Apellido</label>	
		</div>
		<div class="input-field col s12 m6 l6">
		    <select id="tipodocumento" name="tipodocumento" disabled>
		    	<option value="" disabled selected>Seleccione un tipo de documento...</option>
		    	<option value="TI">TI</option>
		    	<option value="CC">CC</option>
		    </select>
		    <label>Tipo de documento</label>
		</div>
		<div class="input-field col s12 m6 l6">
			<input disabled id="numerodocumento" pattern="[\d]+" value="{{$usuario->numerodocumento}}" name="numerodocumento" type="text" class="validate" autocomplete="off">
			<label data-error="Solo números" for="numerodocumento">Número de documento</label>	
		</div>
		<div class="input-field col s12 m6 l6">
		    <select id="genero" name="genero" disabled>
		    	<option value="" disabled selected>Seleccione un genero...</option>
		    	<option value="masculino">Masculino</option>
		    	<option value="femenino">Femenino</option>
		    </select>
		    <label>Género</label>
		</div>
		<div class="input-field col s12 m6 l6">
			<input id="birthdate" type="date" class="datepicker" value="{{$usuario->fechanacimiento}}" autocomplete="off" name="fechanacimiento" disabled>
			<label for="birthdate">Fecha de nacimiento</label>		
		</div>
		<div class="input-field col s12 m6 l6">
			<input disabled id="phone" pattern="[\d]+" value="{{$usuario->telefono}}" name="phone" type="text" class="validate" autocomplete="off">
			<label data-error="Solo números" for="phone">Teléfono</label>
		</div>
		<div class="input-field col s12 m6 l6">
			<input disabled id="address" value="{{$usuario->direccion}}" name="address" type="text" class="validate" autocomplete="off">
			<label for="address">Dirección</label>		
		</div>
		<div class="input-field col s12 m6 l6">
		    <select disabled name="ciudad" disabled>
		    	<option value="Pereira" disabled selected>Pereira</option>
		    	<!--option value="1">Medellin</option>
		    	<option value="1">Pereira</option>
		    	<option value="2">Cartago</option>
		    	<option value="2">Cali</option-->
		    </select>
		    <label>Ciudad</label>
		</div>
		<div class="input-field col s12 m6 l6">
		    <select disabled name="pais" disabled>
		    	<option value="Colombia" disabled selected>Colombia</option>
		    	<!--option value="1">Colombia</option>
		    	<option value="1">Estados Unidos</option>
		    	<option value="2">Mexico</option>
		    	<option value="2">Venezuela</option-->
		    </select>
		    <label>País</label>
		</div>
		<div class="input-field col s12 m6 l6">
			<input disabled id="email" value="{{$usuario->correo}}" name="email" type="email" class="validate" autocomplete="off" >
			<label for="email">Correo electrónico</label>		
		</div>
		<div class="input-field col s12 m6 l6"  name="ver" id="ver" style='visibility:hidden;'>
			<input id="password" name="password" type="password" class="validate" autocomplete="off" required="">
			<label for="password">Contraseña</label>
		</div>
	{!!Form::close() !!}
	<div class="row" name="manejo" id="manejo" style='visibility:hidden;'>
		<div class="col s6">
			<a href="{{ route('entrenadorPerfil')}}" class="btn-floating btn-large waves-effect waves-light blue center"><i class="material-icons">clear</i></a>
		</div>
		<div class="col s6">
			<a class="btn-floating btn-large waves-effect waves-light red darken-4 center" onclick = "enviar();"><i class="material-icons">save</i></a>
		</div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('archivos/js/dashboard_elements.js')}}"></script>
	<script type="text/javascript" src="{{asset('archivos/js/profile_init.js')}}"></script>
	
	<script type="application/javascript">
	
	var sexo='<?php echo $usuario->genero;?>';
	var documento = '<?php echo $usuario->tipodocumento;?>';
	
	$("#genero option[value="+ sexo +"]").attr("selected",true);
    $("#tipodocumento option[value="+ documento +"]").attr("selected",true);
    
    function editar()
    {
        $(":input").removeAttr('disabled');
        $('select').material_select();
        document.getElementById('ver').style.visibility='visible';
        document.getElementById('manejo').style.visibility='visible';
        document.getElementById('alerta').style.visibility='hidden';
    }
    
    function enviar()
    {
    	var numerodocumento = document.getElementById('numerodocumento');
    	var telefono = document.getElementById('phone');
    	var nombre = document.getElementById('firstname');
    	var apellido = document.getElementById('lastname');
    	var direccion = document.getElementById('address');
    	var correo = document.getElementById('email');
    	var expresionnumerodocumento = /^\d+$/;
    	var expresionletra = /^[a-zA-Z]+$/;
    	
    	if(expresionnumerodocumento.test(numerodocumento.value) && expresionnumerodocumento.test(telefono.value) && nombre.value.match(expresionletra) && apellido.value.match(expresionletra) && direccion.value.length >= 4 && correo.value.length >= 4)
    	{
    		document.getElementById('envia').submit();
    	}
    }
	
	</script>
@endsection