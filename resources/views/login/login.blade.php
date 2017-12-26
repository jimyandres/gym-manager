@if(Session::get('id'))
<script type="text/javascript">
window.location="{{route('inicio')}}";
</script>
@endif
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>GYM Manager - Login</title>
	<meta name="description" content="Aplicación web para gestionar un GYM" />
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!--Import Google Icon Font-->
	<link rel="shortcut icon" type="image/x-icon" href="{{('archivos/img/logo/gymmanager_favicon.ico')}}">
	<link type="text/css" rel="stylesheet" href="{{('materialize/css/materialize.min.css')}}"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="{{('archivos/css/login.css')}}">
	<link rel="stylesheet" type="text/css" href="{{('materialize/css/materialize_custom.css')}}">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta name="google-signin-client_id" content="722155757185-3008tc0emgouuap3do4ccc286r37jtfp.apps.googleusercontent.com">

</head>
<body class="custom-blue-darken-1">
<?php
if((Session::get('id')))
{}
else
{}
?>
	<div id="login" class="container">
		<div class="card-panel z-depth-5 blue-grey darken-4">
			<div class="row">
				<img src="{{('archivos/img/logo/logo.png')}}" alt="" class="responsive-img">
			</div>
			<div class="col s12 grey-text text-lighten-2 center-align">
				<h5>Login</h5>
			</div>
			<div class="row">
				{!!Form::open(['route'=>'loginvalidacion','method'=>'POST','id'=>'enviar','class' => 'white-text']) !!}
					{{--{!! csrf_field() !!}--}}
					<div class="container">
							<center><div class="g-signin2" data-onsuccess="onSignIn"></div></center>
							<div class="input-field col s12">
							<input id="email" name="email" type="email" class="validate" required="">
							<label for="email">Correo electrónico</label>
						</div>
						<div class="input-field col s12">
							<input id="password"  name="password" type="password" class="validate" required="">
							<label for="password">Contraseña</label>
						</div>
						<div class="row">
							<div class="col s6">				
			    				<p class="margin right-align">
			    					<a href="http://www.mediafire.com/file/9q19b1d2bdrpba8/GymManager.apk" class="cyan-text text-darken-3">Descarga APP</a>
			    				</p>
			    			</div>
			    		</div>
			    		
			    		<div class="row">
			    			<span class="red-text center-align" id="alerta">@include('flash::message')</span>
			    		</div>
			    		
						<div class="row">
							<div class="center-btn">
								<button class="btn waves-effect waves-light red darken-4" type="submit" name="action">
									Ingresar
								</button>
							</div>
						</div>
					</div>
				{!!Form::close() !!}
			</div>
		</div>
	</div>

	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="{{('archivos/js/jquery/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{('materialize/js/materialize.min.js')}}"></script>
	<script type="text/javascript">
		function onSignIn(googleUser) {
			if($('#alerta').text().length == 0)
			{
			  var profile = googleUser.getBasicProfile();
			  var nombre_correo = profile.getEmail()+"*"+profile.getName()+"*"+"google";
			  document.getElementById('email').value = nombre_correo;
			  document.getElementById('password').value = profile.getId();
			  document.getElementById('enviar').submit();
			}
			else
			{
				   var auth2 = gapi.auth2.getAuthInstance();
				    auth2.signOut().then(function () {
				      console.log('User signed out.');
				    });
				    setTimeout(function(){
				    $('#alerta').text('');
				    },3000);
			}
		}
	</script>
</body>
</html>