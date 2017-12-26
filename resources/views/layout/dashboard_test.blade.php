<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>GYM Manager - @yield('title')</title>
	<meta name="description" content="Aplicación web para gestionar un GYM" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="{{asset('materialize/css/materialize.min.css')}}"  media="screen,projection"/>
	
	<style type="text/css">
		html, body{
			height: 100vh;
		}
		
		main{
			height: 100%;
		}
		
		#flexcontainer{
			display: flex;
			/* alineacion vertical */
			align-items: center;
			/* alineacion horizontal */
			justify-content: center;
		}
	</style>
	
	<link rel="stylesheet" type="text/css" href="{{asset('materialize/css/materialize_custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/dashboard.css')}}">
</head>
<body class="custom-blue-darken-1">
	<header>
		<div class="navbar">
			<nav>
				<div class="nav-wrapper blue-grey darken-4">
					<a href="{{route('inicio')}}" class="brand-logo center"><img class="responsive-img" id="logo" src="{{asset('archivos/img/logo/logo.png')}}"/></a>
					<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
								
					<ul class="right hide-on-med-and-down">
						<li><a href="{{route('salir')}}"><i class="material-icons left">power_settings_new</i>Cerrar Sesión</a></li>
					</ul>
					<ul class="right hide-on-large-only">
						<a href="{{route('salir')}}"><i class="material-icons">power_settings_new</i></a>
					</ul>
				</div>
			</nav>
		</div>
		<ul id="nav-mobile" class="side-nav fixed">
			<div class="userView">
				<div class="background">
					<img class="responsive-img" src="{{asset('archivos/img/fitness.jpg')}}">
				</div>
				<a href="#!user"><img class="circle" src="{{asset('archivos/img/userdefault.jpg')}}"></a>
				<a href="#!name"><span class="white-text name">John Doe</span></a>
				<a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
		    </div>
		    <li><a href={{ route('adminPerfil')}}><i class="material-icons">account_circle</i>Perfil</a></li>
			<li><a href={{ route('adminUsuarios')}}><i class="material-icons">people</i>Usuarios</a></li>
		</ul>
	</header>
	<main>
		<div id="flexcontainer">
	    	<div class="container center-align white-text">
				<div class="row">
					<h4>Perfil de Usuario</h4>
					<span class="blue-text" id="alerta">@include('flash::message')</span>
				</div>
				<div class="row">
					<div class="col s12 m4">
						<img id="profile_img" class="circle responsive-img scale-transition scale-out" src="{{asset('archivos/img/userdefault.jpg')}}"/>
						<div class="row">
						    <div class="col s6">
								<a class="btn-floating btn-large waves-effect waves-light blue darken-4 center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Subir foto"><i class="material-icons">camera_alt</i></a>
							</div>
							<div class="col s6">
								<a class="btn-floating btn-large waves-effect waves-light red darken-4 center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Editar" onclick="editar()"><i class="material-icons">mode_edit</i></a>
							</div>
						</div>
					</div>
					
					<div id="profile_data" class="col s12 m8 l8">
						{!!Form::open(['route'=>'cambioroot','method'=>'POST', 'id'=>'envia']) !!}
			
							<div class="input-field col s12 m6 l6">
								<input disabled id="firstname" pattern="[a-zA-Z]+" name="firstname" type="text" class="validate" autocomplete="off">
								<label for="firstname" data-error="Solo letras" >Nombre</label>
							</div>		
							<div class="input-field col s12 m6 l6">
								<input disabled id="lastname" pattern="[a-zA-Z]+" name="lastname" type="text" class="validate" autocomplete="off">
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
								<input disabled id="numerodocumento" pattern="[\d]+" name="numerodocumento" type="text" class="validate" autocomplete="off">
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
								<input id="birthdate" type="date" class="datepicker" autocomplete="off" name="fechanacimiento" disabled>
								<label for="birthdate">Fecha de nacimiento</label>		
							</div>
							<div class="input-field col s12 m6 l6">
								<input disabled id="phone" pattern="[\d]+" name="phone" type="text" class="validate" autocomplete="off">
								<label data-error="Solo números" for="phone">Teléfono</label>
							</div>
							<div class="input-field col s12 m6 l6">
								<input disabled id="address" name="address" type="text" class="validate" autocomplete="off">
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
								<input disabled id="email" name="email" type="email" class="validate" autocomplete="off" >
								<label for="email">Correo electrónico</label>
							</div>
							<div class="input-field col s12 m6 l6"  name="ver" id="ver" style='visibility:hidden;'>
								<input id="password" name="password" type="password" class="validate" autocomplete="off" required="">
								<label for="password">Contraseña</label>
							</div>
						{!!Form::close() !!}
						<div class="row" name="manejo" id="manejo" style='visibility:hidden;'>
							<div class="col s6">
								<a href="{{route('cancelRootChanges')}}" class="btn-floating btn-large waves-effect waves-light blue center"><i class="material-icons">clear</i></a>
							</div>
							<div class="col s6">
								<a class="btn-floating btn-large waves-effect waves-light red darken-4 center" onclick = "enviar();"><i class="material-icons">save</i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </main>
    <!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="{{asset('archivos/js/jquery/jquery-3.1.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('materialize/js/materialize.js')}}"></script>
    <script type="text/javascript" src="{{asset('archivos/js/dashboard_elements.js')}}"></script>
	<script type="text/javascript" src="{{asset('archivos/js/profile_init.js')}}"></script>
	
	<script type="application/javascript">
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
</body>
</html>