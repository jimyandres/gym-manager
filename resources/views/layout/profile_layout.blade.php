@extends('layout.dashboard_layout')

<?php
use App\datopersonal;
$correo=Session::get('correo');
$usuario = datopersonal::where('correo',$correo)->first();
?>
@section('title')
	Perfil
@endsection

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{asset('materialize/css/materialize_custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/dashboard.css')}}">
@endsection

@section('sidebar_user')
	<a href="#!user"><img class="circle" src="{{asset('archivos/img/userdefault.jpg')}}"></a>
	<a href="#!name"><span class="white-text name">{{$usuario->nombre}} {{$usuario->apellido}}</span></a>
	<a href="#!email"><span class="white-text email">{{$usuario->correo}}</span></a>
@endsection

@section('content')
	<div class="container center-align white-text main-container">
		<div class="row">
			<h4>Perfil de @yield('user_type')</h4>
			<span class="blue-text" id="alerta">@include('flash::message')</span>
		</div>
		<div class="row">
			<div class="col s12 m4">
				<img id="profile_img" class="circle responsive-img scale-transition scale-out" src="{{asset('archivos/img/userdefault.jpg')}}"/>
				<div class="row">
				    @yield('profile_options')
				</div>
			</div>
			
			<div id="profile_data" class="col s12 m8 l8">
				@yield('profile_data')
			</div>
		</div>
	</div>
@endsection
