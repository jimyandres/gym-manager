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
	<li><a href={{ route('rootPerfil')}}><i class="material-icons">account_circle</i>Perfil</a></li>
	<li><a href={{ route('rootUsuarios')}}><i class="material-icons">people</i>Usuarios</a></li>
@endsection

@section('content')
	<meta name="_token" content="{!! csrf_token() !!}"/>
    <div class="container white-text">
    	<div class="row center-align">
			<h4>Registrar usuario</h4>
		</div>
		<div class="row">
				<div id = "profileData" class="row">
					<div class="input-field col s12 m6">
						<input id="firstname" name ='firstname' class="validate" type="text" onkeypress="return validarLetras(event, this.value);"  pattern="[a-zA-Z]+[a-zA-Z\s]+" autocomplete="off" required/>
						<label for="firstname" data-error="Solo letras">Nombre</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="lastname" name="lastname" class="validate" type="text" onkeypress="return validarLetras(event, this.value);" pattern="[a-zA-Z]+[a-zA-Z\s]+" autocomplete="off" required/>
						<label for="lastname" data-error="Solo letras">Apellido</label>
					</div>
					<div class="input-field col s12 m6">
					    <select id="tipodocumento" name ="tipodocumento" required>
					    	<option value="" selected>Seleccione un tipo de documento...</option>
					    	<option value="TI">TI</option>
					    	<option value="CC">CC</option>
					    </select>
					    <label>Tipo de documento</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="numerodocumento" name="numerodocumento" class="validate" type="text" onkeypress="return validarNumeros(event, this.value);" pattern="[\d]+" autocomplete="off" required/>
						<label for="numerodocumento" data-error="Solo Números">Número de documento</label>
					</div>
					<div class="input-field col s12 m6">
					    <select id="gender" name="gender" required>
					    	<option value="masculino" selected>Masculino</option>
					    	<option value="femenino">Femenino</option>
					    </select>
					    <label>Género</label>
					</div>
					<div class="input-field col s12 m6">
					    <select id="ciudad" name="ciudad" required>
					    	<option value="Pereira" selected>Pereira</option>
					    	<option value="Dosquebradas">Dosquebradas</option>
					    </select>
					    <label>Ciudad</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="password" name = "password" class="validate" type="password" autocomplete="off" required/>
						<label for="password">Contraseña</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="address" name = "address" onkeypress="return validarDireccion(event, this.value);" class="validate" type="text" autocomplete="off" required/>
						<label for="address">Dirección</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="phone" class="validate" type="text" onkeypress="return validarNumeros(event, this.value);" pattern="[\d]+" autocomplete="off" name="phone" required>
						<label for="phone" data-error="Solo Números">Teléfono</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="email" name = "email" class="validate" type="email" pattern= "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" autocomplete="off" required>
						<label for="email">Correo electrónico</label>		
					</div>
					<div class="input-field col s12 m6">
						<input id="secretword" name = "secretword" class="validate" onkeypress="return validarLetras(event, this.value);" type="password" pattern="[a-zA-Z]+" autocomplete="off" required>
						<label for="secretword">Palabra secreta</label>
					</div>
					<div class="input-field col s12 m6">
					    <select id="tipousuario" name="tipousuario" required>
					    	<option value="admin" selected>Administrador</option>
					    	<option value="trainer">Entrenador</option>
					    </select>
					    <label for="tipousuario">Tipo de usuario</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="birthdate" class="datepicker" type="date" onchange="checkDate(this.value);" autocomplete="off" name="birthdate" required>
						<label for="birthdate">Fecha de nacimiento</label>
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
	
		function validarLetras(e, contenido) {
			var aux  = true;
		    tecla = (document.all) ? e.keyCode : e.which;
		    if (tecla==8) return true;
		    patron =/[A-Za-z\s]/;
		    te = String.fromCharCode(tecla);
		    
		    if(contenido.length>=20){
		    	Materialize.toast("Ingresa máximo 20 caracteres ",5000,'red');
	            aux = false;
	    	}
		    return patron.test(te)&&aux;
		}
		
		function validarNumeros(e, contenido) {
			var aux  = true;
		    tecla = (document.all) ? e.keyCode : e.which;
		    if (tecla==8) return true;
		    patron =/^\d+$/;
		    te = String.fromCharCode(tecla);
		    
		    if(contenido.length>=20){
		    	Materialize.toast("Ingresa máximo 20 caracteres ",10000,'red');
	            aux = false;
	    	}  
		    return patron.test(te)&&aux;
		}
		
		function validarDireccion(e, contenido) {
			var aux  = true;
		    tecla = (document.all) ? e.keyCode : e.which;
		    if (tecla==8) return true;
		    patron =/^[A-Za-z0-9 _]*$/;
		    te = String.fromCharCode(tecla);
		    
		    if(contenido.length>=35){
		    	Materialize.toast("Ingresa máximo 35 caracteres ",10000,'red');
                aux = false;
		    }
                
		    return patron.test(te)&&aux;
		}
		
		function checkDate(data) {
			var today =new Date();
			var inputDate = new Date(data);
			if (inputDate.value == " "){
				Materialize.toast("ingresa alguna fecha",5000,'red');
			} else if (data < "1949-12-31" || data > "1999-12-31") {
				Materialize.toast("Ingresa una fecha entre los años 1950 y 2000 ",5000,'red');
				$('#birthdate').val("1993-06-24");
			}
        }
	
		function sendForm()
	    {
	    	var nombre = document.getElementById('firstname');
	    	var apellido = document.getElementById('lastname');
	    	var direccion = document.getElementById('address');
	    	var correo = document.getElementById('email');
	    	var genero = document.getElementById('gender');
	    	var ciudad = document.getElementById('ciudad');
	    	var fechanacimiento = document.getElementById('birthdate');
	    	var numerodocumento = document.getElementById('numerodocumento');
	    	var tipodocumento = document.getElementById('tipodocumento');
	    	var password = document.getElementById('password');
	    	var telefono = document.getElementById('phone');
	    	var tipousuario = document.getElementById('tipousuario');
	    	var secretword = document.getElementById('secretword');
	    	/*
	    	console.log(nombre.value);
	    	console.log(apellido.value);
	    	console.log(direccion.value);
	    	console.log(correo.value);
	    	console.log(genero.value);
	    	console.log(ciudad.value);
	    	console.log(fechanacimiento.value);
	    	console.log(numerodocumento.value);
	    	console.log(tipodocumento.value);
	    	console.log(telefono.value);
	    	console.log(password.value);
	    	console.log(tipousuario.value);
	    	console.log(secretword.value);*/
	    	
	    	var regexpEmail = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/
	    	
	    	if((regexpEmail.test(correo.value)&&correo.required) && nombre.required && 
	    	apellido.required && direccion.required && secretword.required && genero.required && 
	    	ciudad.required && fechanacimiento.required && numerodocumento.required && 
	    	tipodocumento.required && password.required && telefono.required && tipousuario.required
	    	){
	    		$.ajaxSetup({
				   headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
	    		
	    		$.ajax({
					url : '{{URL::to("createUserRootModule")}}',
					type : 'post',
					data : {
						'nombre':nombre.value , 'apellido':apellido.value , 'direccion':direccion.value , 
						'correo':correo.value , 'genero':genero.value , 'ciudad':ciudad.value , 'fechanacimiento':fechanacimiento.value ,
						'numerodocumento':numerodocumento.value , 'tipodocumento':tipodocumento.value , 'password':password.value ,
						'telefono':telefono.value, 'tipousuario':tipousuario.value, 'palabrasecreta':secretword.value
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
	    		Materialize.toast("Ingresa correctamente los datos!!!", 5000, 'red');
	    	}
	    }
	    
	</script>
@endsection