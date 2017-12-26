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
<?php
$nombre = Session::get('nombre');
$apellido = Session::get('apellido');
$correo = Session::get('correo');
?>

@section('title')
    Registrar Usuario
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('materialize/css/materialize_custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/dashboard.css')}}">
@endsection

@section('sidebar_user')
    <a href="#!user"><img class="circle" src="{{asset('archivos/img/userdefault.jpg')}}"></a>
	<a href="#!name"><span class="white-text name"><?php echo $nombre." ".$apellido;?></span></a>
	<a href="#!email"><span class="white-text email"><?php echo $correo;?></span></a>
@endsection

@section('sidebar_options')
	<li><a href={{ route('adminPerfil')}}><i class="material-icons">account_circle</i>Perfil</a></li>
	<li><a href={{ route('adminUsuarios')}}><i class="material-icons">people</i>Usuarios</a></li>
@endsection

@section('content')
	<meta name="_token" content="{!! csrf_token() !!}"/>
    <div class="container white-text">
    	<div class="row center-align">
			<h4>Registrar usuario</h4>
		</div>
		<div class="row">
				<div id="profileData" class="row">
					<div class="input-field col s12 m6">
						<input id="firstname" class="validate" type="text" pattern="[a-zA-Z ]+" autocomplete="off" maxlength="20" required/>
						<label for="firstname" data-error="Solo letras">Nombre</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="lastname" class="validate" type="text" pattern="[a-zA-Z ]+" autocomplete="off" maxlength="20" required/>
						<label for="lastname" data-error="Solo letras">Apellido</label>
					</div>
					<div class="input-field col s12 m6">
					    <select id="tipodocumento" required>
					    	<option value="" selected>Seleccione un tipo de documento...</option>
					    	<option value="TI">TI</option>
					    	<option value="CC">CC</option>
					    </select>
					    <label>Tipo de documento</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="docnum" class="validate" type="text" pattern="[\d]+" autocomplete="off" maxlength="15" required/>
						<label for="docnum" data-error="Solo Números">Número de documento</label>
					</div>
					<div class="input-field col s12 m6">
					    <select id="gender" required>
					    	<option value="" selected>Seleccione un genero...</option>
					    	<option value="masculino">Masculino</option>
					    	<option value="femenino">Femenino</option>
					    </select>
					    <label>Género</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="address" class="validate" type="text" autocomplete="off" maxlength="20" required/>
						<label for="address">Dirección</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="phone" class="validate" type="text" pattern="[\d]+" autocomplete="off" name="phone" maxlength="12" required>
						<label for="phone" data-error="Solo Números">Teléfono</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="email" class="validate" type="email" pattern= "[\w|.|-]*@\w*\.[\w|.]*" autocomplete="off" maxlength="32" required>
						<label for="email" data-error="Correo Electronico">Correo electrónico</label>		
					</div>
					<div class="input-field col s12 m6">
						<input id="password" class="validate" type="password" autocomplete="off" maxlength="32" required>
						<label for="password">Contraseña</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="secretword" class="validate" type="password" pattern="[a-zA-Z]+" autocomplete="off" maxlength="32" required>
						<label for="secretword" data-error="Solo letras">Palabra Secreta</label>
					</div>
					<div class="input-field col s12 m6">
					    <select id="tipousuario" required>
					    	<option value="" selected>Seleccione un tipo de usuario...</option>
					    	<option value="trainer">Entrenador</option>
					    	<option value="cliente">Cliente</option>
					    </select>
					    <label for="tipousuario">Tipo de usuario</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="birthdate" class="datepicker" type="date" autocomplete="off" name="fechanacimiento" required>
						<label for="birthdate">Fecha de nacimiento</label>
					</div>
					<div class="input-field col s12 m6">
						<select id="ciudad" name="ciudad" required>
    						<option value="Pereira" selected>Pereira</option>
    					</select>
    					<label for="ciudad">Ciudad</label>
					</div>
				</div>
			<div class="row">
				<div class="col s6">
					<a class="btn-large waves-effect waves-light red darken-4 center" onclick="sendForm();"><i class="material-icons left">save</i>Registrar</a>
				</div>
			</div>
		</div>
    </div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('archivos/js/dashboard_elements.js')}}"></script>
	<script type="text/javascript" src="{{asset('archivos/js/profile_init.js')}}"></script>
	
	<script type="text/javascript">
	
		function sendForm()
	    {
	    	var nombre = document.getElementById('firstname');
	    	var apellido = document.getElementById('lastname');
	    	var direccion = document.getElementById('address');
	    	var correo = document.getElementById('email');
	    	var genero = document.getElementById('gender');
	    	var ciudad = document.getElementById('ciudad');
	    	var fechanacimiento = document.getElementById('birthdate');
	    	var numerodocumento = document.getElementById('docnum');
	    	var tipodocumento = document.getElementById('tipodocumento');
	    	var password = document.getElementById('password');
	    	var telefono = document.getElementById('phone');
	    	var tipousuario = document.getElementById('tipousuario');
	    	var secretword = document.getElementById('secretword');
	    	
	    	var regexpNumber = /^\d+$/;
	    	var regexpLetter = /^[a-zA-Z]+$/;
	    	var regexpEmail = /^[\w|.|-]*@\w*\.[\w|.]*$/;
	    	var regexpCompleteName = /^[a-zA-Z ]+$/;
	    	
	    	
	    	if((correo.value.match(regexpEmail)&&correo.required) && (nombre.value.match(regexpCompleteName)&&nombre.required) && 
	    	(apellido.value.match(regexpCompleteName)&&apellido.required) && direccion.required && (secretword.value.match(regexpLetter)&&secretword.required) &&
	    	genero.required && ciudad.required && fechanacimiento.required && (numerodocumento.value.match(regexpNumber)&&numerodocumento.required) && 
	    	tipodocumento.required && password.required && (telefono.value.match(regexpNumber)&&telefono.required) && tipousuario.required)
	    	{
	    		$.ajaxSetup({
				   headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
	    		
	    		$.ajax({
					url : '{{URL::to("createUserAdminModule")}}',
					type : 'post',
					data : {
						'nombre':nombre.value , 'apellido':apellido.value , 'direccion':direccion.value , 
						'correo':correo.value , 'genero':genero.value , 'ciudad':ciudad.value , 
						'fechanacimiento':fechanacimiento.value , 'numerodocumento':numerodocumento.value , 'tipodocumento':tipodocumento.value , 
						'password':password.value , 'telefono':telefono.value, 'tipousuario':tipousuario.value, 'palabrasecreta':secretword.value
					},
					dataType : 'json',
					success : function (data) {
						$('#profileData').find('input').val("");
						Materialize.updateTextFields();
						Materialize.toast("Usuario Registrado!", 5000, 'green');
					},
					error : function () {
						Materialize.toast("Transaccion Fallida!", 5000, 'red');
					}
				});
	    	} else {
	    		Materialize.toast("Todos los campos son requeridos!!!", 5000, 'red');
	    	}
	    }
	    
	</script>
@endsection