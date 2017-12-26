<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>GYM Manager - @yield('title')</title>
	<meta name="description" content="Aplicación web para gestionar un GYM" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!--Import Google Icon Font-->
	<link rel="shortcut icon" type="image/x-icon" href="{{('archivos/img/logo/gymmanager_favicon.ico')}}">
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="{{asset('materialize/css/materialize.min.css')}}"  media="screen,projection"/>
	@yield('styles')
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
				@yield('sidebar_user')
		    </div>
		    @yield('sidebar_options')
		</ul>
	</header>
	<main>
    	@yield('content')
    </main>
    <!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="{{asset('archivos/js/jquery/jquery-3.1.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('materialize/js/materialize.js')}}"></script>
    @yield('scripts')
</body>
</html>