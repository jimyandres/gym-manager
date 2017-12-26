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
use App\datopersonal;
use App\tipousuario;
use App\clasificacionusuario;

$correo=Session::get('correo');

$usuario = datopersonal::where('correo',$correo)->first();
$clasificadousuario = clasificacionusuario::where('iddatopersonal',$usuario->iddatopersonal)->get();
$listatipo = $clasificadousuario;

$x1 = " ";
$x2 = " ";
$x3 = " ";
$x4 = " ";

if(count($listatipo) == 1)
{
	$x1 = $listatipo[0]->idtipousuario;
}

elseif(count($listatipo) == 2)
{
	$x1 = $listatipo[0]->idtipousuario;
	$x2 = $listatipo[1]->idtipousuario;
}
elseif(count($listatipo) == 3)
{
	$x1 = $listatipo[0]->idtipousuario;
	$x2 = $listatipo[1]->idtipousuario;
	$x3 = $listatipo[2]->idtipousuario;
}
elseif(count($listatipo) == 4)
{
	$x1 = $listatipo[0]->idtipousuario;
	$x2 = $listatipo[1]->idtipousuario;
	$x3 = $listatipo[2]->idtipousuario;
	$x4 = $listatipo[3]->idtipousuario;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>GYM Manager - Seleccion de Dashboard</title>
	<meta name="description" content="Aplicación web para gestionar un GYM" />
	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="shortcut icon" type="image/x-icon" href="{{('archivos/img/logo/gymmanager_favicon.ico')}}">
	<link type="text/css" rel="stylesheet" href="{{asset('materialize/css/materialize.min.css')}}"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="{{asset('materialize/css/materialize_custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/dashboard.css')}}">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
@if(count($listatipo) == 1 && $x1 == 1)
<script type="text/javascript">
window.location="{{route('rootPerfil')}}";
</script>
@elseif(count($listatipo) == 1 && $x1 == 2)
<script type="text/javascript">
window.location="{{route('adminPerfil')}}";
</script>
@elseif(count($listatipo) == 1 && $x1 == 3)
<script type="text/javascript">
window.location="{{route('entrenadorPerfil')}}";
</script>
@elseif(count($listatipo) == 1 && $x1 == 4)
<script type="text/javascript">
window.location="{{route('clientePerfil')}}";
</script>
@endif
<body class="custom-blue-darken-1">
	<div class="navbar">
		<nav>
			<div class="nav-wrapper blue-grey darken-4">
				<a class="brand-logo center"><img class="responsive-img" id="logo" src="{{asset('archivos/img/logo/logo.png')}}"/></a>
				<ul class="right hide-on-med-and-down">
					<li><a href="{{route('salir')}}"><i class="material-icons left">power_settings_new</i>Cerrar Sesión</a></li>
				</ul>
				<ul class="right hide-on-large-only">
					<a href="{{route('salir')}}"><i class="material-icons">power_settings_new</i></a>
				</ul>
			</div>
		</nav>
	</div>
	
	<div class="container main-container">
		<div class="row">
			<div class="col s12 grey-text text-lighten-2 center-align">
				<h4>Seleccione su espacio de trabajo</h4>
			</div>			
		</div>
		<div class="row">
			@if($x1 == 1 || $x2 == 1 || $x3 == 1 || $x4 == 1)
			<div id="rootCard" class="col s12 m6 ">
	        	<div class="card medium hoverable">
		            <div class="card-image">
		            	<img src="{{asset('archivos/img/root.jpg')}}">
		            	<span class="card-title">Root</span>
		            </div>
		            <div class="card-content">
		            	<p>Permite la creación de nuevos usuarios administradores.</p>
		            </div>
		            <div class="card-action center-align">
		            	<a href="{{route('rootPerfil')}}" class="btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">forward</i></a>
		            </div>
		        </div>
			</div>
			@endif
			@if($x1 == 2 || $x2 == 2 || $x3 == 2 || $x4 == 2)
	        <div id="adminCard" class="col s12 m6 ">
	        	<div class="card medium hoverable">
		            <div class="card-image">
		            	<img src="{{asset('archivos/img/manager.jpg')}}">
		            	<span class="card-title">Administrador</span>
		            </div>
		            <div class="card-content">
		            	<p>Permite la gestión de clientes y facturación del sistema.</p>
		            </div>
		            <div class="card-action center-align">
		            	<a href="{{route('adminPerfil')}}" class="btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">forward</i></a>
		            </div>
		        </div>
			</div>
			@endif
			@if($x1 == 3 || $x2 == 3 || $x3 == 3 || $x4 == 3)
			<div id="trainerCard" class="col s12 m6 ">
	        	<div class="card medium hoverable">
		            <div class="card-image">
		            	<img src="{{asset('archivos/img/trainer.jpg')}}">
		            	<span class="card-title">Entrenador</span>
		            </div>
		            <div class="card-content">
		            	<p>Permite la gestión de rutinas, formularios médicos y medición de progresos de los clientes.</p>
		            </div>
		            <div class="card-action center-align">
		            	<a href="{{route('entrenadorPerfil')}}" class="btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">forward</i></a>
		            </div>
		        </div>
			</div>
			@endif
			@if($x1 == 4 || $x2 == 4 || $x3 == 4 || $x4 == 4)
			<div id="clientCard" class="col s12 m6 ">
	        	<div class="card medium hoverable">
		            <div class="card-image">
		            	<img src="{{asset('archivos/img/trainingman.jpg')}}">
		            	<span class="card-title">Cliente</span>
		            </div>
		            <div class="card-content">
		            	<p>Permite visualizar las rutinas asignadas e informes de progresos. </p>
		            </div>
		            <div class="card-action center-align">
		            	<a href="{{route('clientePerfil')}}" class="btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">forward</i></a>
		            </div>
		        </div>
			</div>
			@endif
			<span class="white-text center-align" id="mensaje">@include('flash::message')</span>
		</div>
	</div>

	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="{{asset('archivos/js/jquery/jquery-3.1.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('materialize/js/materialize.min.js')}}"></script>
	
	<script type="text/javascript">
		
		var mensaje = document.getElementById("mensaje");
		if(mensaje.innerHTML != 0)
		{
			Materialize.toast(mensaje, 4000,'red');
		}
		
		var root = document.getElementById("rootCard");
		var admin = document.getElementById("adminCard");
		var trainer = document.getElementById("trainerCard");
		var client = document.getElementById("clientCard");
		
		//console.log(root,admin,trainer,client);
		
		function countOptions(){//Esta funcion retorna el numero de opciones disponibles y el primer elemento disponible.
			var count = 0;
			var first = null;
			var others = [];
			
			if(root != null){
				if(first == null){
					first = root;
				}else{
					others.push(root);
				}
				count+=1;
			}
			
			if(admin != null){
				if(first == null){
					first = admin;
				}else{
					others.push(admin);
				}
				count+=1;
			}
			
			if(trainer != null){
				if(first == null){
					first = trainer;
				}else{
					others.push(trainer);
				}
				count+=1;
			}
			
			if(client != null){
				if(first == null){
					first = client;
				}else{
					others.push(client);
				}
				count+=1;
			}
			
			return {count : count, first : first, others : others};
		}
		
		//console.log(countOptions());
		
		var options = countOptions();
		
		switch(options['count']) {//Dependiendo del numero de opciones que tenga
		    case 1:
		        options['first'].className += "l4 offset-l4 offset-m3";
		        break;
		    case 2:
		    	//Se le asigna el offset(desplazamiento) a la primera opcion
		        options['first'].className += "l3 offset-l3";
		        //Y se le asigna la otra clase a las demas opciones disponibles
		        for (i = 0; i < options['count']-1; i++) { 
				    options['others'][i].className += "l3";
				}
		        break;
		    case 3:
		        options['first'].className += "l4";
		        for (i = 0; i < options['count']-1; i++) {
				    options['others'][i].className += "l4";
				}
		        break;
		    case 4:
		        options['first'].className += "l3";
		        for (i = 0; i < options['count']-1; i++) {
				    options['others'][i].className += "l3";
				}
		        break;
		    default:
		        options['first'].className += "l3";
		        for (i = 0; i < options['count']-1; i++) {
				    options['others'][i].className += "l3";
				}
		}
		
	</script>
</body>
</html>