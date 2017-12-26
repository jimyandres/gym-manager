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

@extends('layout.dashboard_layout')

<?php
use App\datopersonal;
$correo=Session::get('correo');
$usuario = datopersonal::where('correo',$correo)->first();
?>

@section('title')
    Usuarios
@endsection

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{asset('materialize/css/materialize_custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/dashboard.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/profile.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/awesomplete.css')}}">
@endsection

@section('sidebar_user')
	<a href="#!user"><img class="circle" src="{{asset('archivos/img/userdefault.jpg')}}"></a>
	<a href="#!name"><span class="white-text name">{{$usuario->nombre}} {{$usuario->apellido}}</span></a>
	<a href="#!email"><span class="white-text email">{{$usuario->correo}}</span></a>
@endsection

@section('sidebar_options')
	<li><a href={{ route('entrenadorPerfil')}}><i class="material-icons">account_circle</i>Perfil</a></li>
	<li><a href={{ route('entrenadorUsuarios') }}><i class="material-icons">supervisor_account</i>Clientes</a></li>
	<!--<li><a href=""><i class="material-icons">directions_run</i>Rutinas</a></li>-->
@endsection

@section('content')
    <div class="container center-align white-text">
		<div class="row">
			<h4>Gestion de clientes</h4>
		</div>
		<div class="section">
			<div class="row">
				<div class="input-field col s12  black-text">
			        <input id="search" class="autocomplete" type="search">
			       	<label class="label-icon" for="search"><i class="material-icons">search</i></label>
				</div>
			</div>
		</div>
		<div class="section">
			<div class="row">
				<div class="col s12 m4">
					<img id="profile_img" class="circle responsive-img scale-transition scale-out center" src="{{asset('archivos/img/userdefault.jpg')}}"/>
					<div class="row">
						<div class="btn-container col s4">
							<a id="asignarRutinaBtn" class="btn-floating btn-large waves-effect waves-light green darken-4 center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Asignar rutina">
								<i class="material-icons">insert_invitation</i>
							</a>
						</div>
						<div class="btn-container col s4">
							<a id="eliminarRutinaBtn" class="btn-floating btn-large waves-effect waves-light red darken-4 center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Eliminar rutina">
								<i class="material-icons">event_busy</i>
							</a>
						</div>
						<div class="btn-container col s4">
							<a id="verProgreso" class="btn-floating btn-large waves-effect waves-light blue darken-4 center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Progresos">
								<i class="material-icons">directions_run</i>
							</a>
						</div>
					</div>
				</div>
				
				<div id="profile_data" class="col s12 m8 l8">
					<div class="section">
						<div class="white-text">
							
							
							<div class="input-field col s12 m6 l4">
								<input disabled id="firstname" name="firstname" pattern="[a-zA-Z]+" type="text" class="validate" autocomplete="off">
								<label for="firstname" class="title-form" data-error="Solo letras" >Nombre</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="lastname" name="lastname" pattern="[a-zA-Z]+" type="text" class="validate" autocomplete="off">
								<label for="lastname" data-error="Solo letras" >Apellido</label>	
							</div>
							<div class="input-field col s12 m6 l4">
		    					<select disabled id="tipodocumento" name="tipodocumento">
		    						<option value="" selected>Seleccione un tipo de documento...</option>
		    						<option value="TI">TI</option>
		    						<option value="CC">CC</option>
		    					</select>
		    					<label for="tipodocumento">Tipo de documento</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="numerodocumento" name="numerodocumento" pattern="[\d]+" type="text" class="validate" autocomplete="off">
								<a id="hiddenNumeroDocumento"></a>
								<label for="numerodocumento" data-error="Solo números">Número de documento</label>	
							</div>
							<div class="input-field col s12 m6 l4">
		    					<select disabled id="genero" name="genero">
		    						<option value="" selected>Seleccione un genero...</option>
		    						<option value="masculino">Masculino</option>
		    						<option value="femenino">Femenino</option>
		    					</select>
		    					<label for="genero">Género</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="birthdate" name="fechanacimiento" type="date" class="datepicker" autocomplete="off">
								<label for="birthdate">Fecha de nacimiento</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="phone" name="phone" pattern="[\d]+" type="text" class="validate" autocomplete="off">
								<label for="phone" data-error="Solo números">Teléfono</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="address" name="address" type="text" class="validate" autocomplete="off">
								<label for="address">Dirección</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<select disabled id="ciudad" name="ciudad">
		    						<option disabled value="Pereira" selected>Pereira</option>
		    					</select>
		    					<label for="ciudad">Ciudad</label>
							</div>
							<div class="input-field col s12 m6 l4">
		    					<select disabled id="pais" name="pais">
		    						<option value="Colombia" selected>Colombia</option>
		    					</select>
		    					<label for="pais">País</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="email" name="email" type="email" class="validate" autocomplete="off" >
								<label for="email">Correo electrónico</label>
							</div>
							
							<!--
							<div class="col s12 m6 l4">
								<label class="title-form">Nombre</label>
								<p>Juan Diego</p>
							</div>
							<div class="col s12 m6 l4">
								<label class="title-form">Apellido</label>
								<p>Saldarriaga Risitas</p>
							</div>
							<div class="col s12 m6 l4">
								<label class="title-form">Tipo de documento</label>
								<p>TI</p>
							</div>
							<div class="col s12 m6 l4">
								<label class="title-form">Número de documento</label>
								<p>1113654789</p>
							</div>
							<div class="col s12 m6 l4">
								<label class="title-form">Género</label>
								<p>Femenino</p>
							</div>
							<div class="col s12 m6 l4">
								<label class="title-form">Fecha de nacimiento</label>
								<p>31 de Octubre, 1995</p>
							</div>
							<div class="col s12 m6 l4">
								<label class="title-form">Teléfono</label>
								<p>3205564782</p>
							</div>
							<div class="col s12 m6 l4">
								<label class="title-form">Dirección</label>
								<p>Cra 5 #22-77</p>
							</div>
							<div class="col s12 m6 l4">
								<label class="title-form">Ciudad</label>
								<p>Pereira</p>
							</div>
							<div class="col s12 m6 l4">
								<label class="title-form">País</label>
								<p>Colombia</p>
							</div>
							<div class="col s12 m6 l4">
								<label class="title-form">Correo electrónico</label>
								<p>risitas@utp.edu.co</p>
							</div>
							-->
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('archivos/js/dashboard_elements.js')}}"></script>
	<script type="text/javascript" src="{{asset('archivos/js/profile_init.js')}}"></script>
	<script type="text/javascript" src="{{asset('archivos/js/awesomplete.js')}}"></script>
	
	@if(session('Error'))
		<script type="text/javascript">
			Materialize.toast("{{ session('Error') }}", 7000, 'red');
		</script>
	@endif
	@if(session('Success'))
		<script type="text/javascript">
			Materialize.toast("{{ session('Success') }}", 5000, 'green');
		</script>
	@endif
	
	<script type="text/javascript">
	
		function showElements (data) {
			$("#firstname").val(data.nombre);
			$("#lastname").val(data.apellido);
			$("#tipodocumento").val(data.tipodocumento);
			$("#numerodocumento").val(data.numerodocumento);
			$("#hiddenNumeroDocumento").val(data.numerodocumento);
			$("#genero").val(data.genero);
			$("#birthdate").val(data.fechanacimiento);
			$("#phone").val(data.telefono);
			$("#address").val(data.direccion);
			$("#ciudad").val(data.ciudad);
			$("#pais").val('Colombia');
			$("#email").val(data.correo);
			$("#asignarRutinaBtn").attr("href", "{{ route('routine::asignarRutina1', ':ID')}}".replace(/:ID/g, data.idclasificacionusuario));
			$("#editarRutinaBtn").attr("href", "{{ route('routine::edit', ':ID')}}".replace(/:ID/g, data.idclasificacionusuario));
			$("#eliminarRutinaBtn").attr("href", "{{ route('routine::delete', ':ID')}}".replace(/:ID/g, data.idclasificacionusuario));
			$("#verProgreso").attr("href", "{{ route('progress::progreso_entrenador', ':ID') }}".replace(/:ID/g, data.idclasificacionusuario));
			Materialize.updateTextFields();
		}
	
		$(document).ready(function(){
			
			var input = document.getElementById("search");
			var awesomplete = new Awesomplete(input, {
			  minChars: 1,
			  autoFirst: true
			});
			
			$("input").on("keyup", function(){
				$.ajax({
					//url: '{{URL::to("liveSearchRoutineModule")}}',
					url: "{{route('routine::search')}}",
		    		type: 'GET',
		    		data : {'search': $('#search').val()},
		    		dataType: 'json',
		    		success : function(data){
		    			var list = [];
			    		$.each(data, function(key, value) {
			    			console.log(value);
			    			list.push("["+value.numerodocumento+"]"+" "+value.nombre+" "+value.apellido);
			    		});
			    		awesomplete.list = list;
			    		awesomplete.goto(-1);
		    		}
				});
				
			});
			
			window.addEventListener("awesomplete-selectcomplete", function (event) {
				var Selecteduser = event.text.value;
				var id = Selecteduser.substring(Selecteduser.indexOf("[") + 1, Selecteduser.indexOf("]"));
				
				$.ajax({
					//url : '{{URL::to("getSelectedUserRoutineModule")}}',
					url: "{{route('routine::select')}}",
					type : 'GET',
					data : {'id' : id},
					dataType : 'json',
					success : function (data) {
						showElements(data[0]);
					}
				});
			}, false );
			
		});
	</script>
@endsection