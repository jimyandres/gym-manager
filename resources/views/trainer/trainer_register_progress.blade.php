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

@section('title')
	Registrar progreso
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

@section('sidebar_options')
	<li><a href={{ route('entrenadorPerfil')}}><i class="material-icons">account_circle</i>Perfil</a></li>
	<li><a href={{ route('entrenadorUsuarios') }}><i class="material-icons">supervisor_account</i>Clientes</a></li>
@endsection

@section('content')
<div>
	<div class="row center-align white-text">
		<h4>Registro de progreso</h4>
	</div>
	<form role="form" method="POST" action="{{ route('progress::store', $id) }}">
	<div class="row">
    	<div class="col s12">
	        <div class="card">
	        	<div class="card-content">
	        		<span class="card-title">Somatometría</span>
	        		<div class="row">
	        			{!! csrf_field() !!}
		        		<div class="input-field col s12 m6">
	                        <p class="range-field">
	                        	Peso
						      	<input type="range" name="peso" id="weightRange" min="30" max="200" />
						    </p>
		                </div>
		                 <div class="input-field col s12 m6">
	                        <p class="range-field">
	                        	Talla
						      	<input type="range" name="talla" id="heightRange" min="100" max="250" />
						    </p>
		                </div>
		                <div class="input-field col s12 m6">
	                        <p class="range-field">
	                        	Bíceps (Tensionado)
						      	<input type="range" name="brazotension" id="stressedArmRange" min="15" max="70" />
						    </p>
		                </div>
		                <div class="input-field col s12 m6">
	                        <p class="range-field">
	                        	Bíceps (relajado)
						      	<input type="range" name="brazoalturabicep" id="relaxedArmRange" min="15" max="70" />
						    </p>
		                </div>
		                <div class="input-field col s12 m6">
	                        <p class="range-field">
	                        	Bíceps (flexionado)
						      	<input type="range" name="brazoflexionado" id="flexedArmRange" min="15" max="70" />
						    </p>
		                </div>
		                <div class="input-field col s12 m6">
	                        <p class="range-field">
	                        	Antebrazos
						      	<input type="range" name="antebrazos" id="forearmsRange" min="10" max="50" />
						    </p>
		                </div>
		                <div class="input-field col s12 m6">
	                        <p class="range-field">
	                        	Cintura (mínimo)
						      	<input type="range" name="cintura" id="waistRange" min="50" max="180" />
						    </p>
		                </div>
		                <div class="input-field col s12 m6">
	                        <p class="range-field">
	                        	Gluteos-cadera (máximo)
						      	<input type="range" name="gluteo" id="buttocksRange" min="50" max="180" />
						    </p>
		                </div>
		                <div class="input-field col s12 m6">
	                        <p class="range-field">
	                            Pantorrilla
						      	<input type="range" name="pantorrilla" id="calfRange" min="15" max="70" />
						    </p>
		                </div>
		                <div class="input-field col s12 m6">
	                        <p class="range-field">
	                            Cuádriceps
						      	<input type="range" name="cuadriceps" id="quadricepsRange" min="30" max="100" />
						    </p>
		                </div>
		                <div class="input-field col s12 m6">
	                        <p class="range-field">
	                            Pectoral
						      	<input type="range" name="pectoral" id="pectoralRange" min="50" max="160" />
						    </p>
		                </div>
		    			<!--<div class="input-field col s12 m6">-->
						<!--	<input id="progressDate" type="date" class="datepicker" autocomplete="off">-->
						<!--	<label class="black-text" for="progressDate">Fecha</label>-->
						<!--</div>-->
		            </div>
		            <div class="divider"></div>
		            <div class="row">
		                <div class="input-field col s12 center-align">
							<button  class="waves-effect waves-light btn-large red darken-3"><i class="material-icons right">send</i>Enviar</button>
				    		<!--<a href="" class="waves-effect waves-light btn-large red darken-3"><i class="material-icons right">send</i>Enviar</a>-->
				    	</div>
		            </div>
	        	</div>
	        </div>
	    </div>
    </div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('archivos/js/dashboard_elements.js')}}"></script>
	<script type="text/javascript" src="{{asset('archivos/js/profile_init.js')}}"></script>
	
@endsection