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
$nombre = Session::get('nombre');
$apellido = Session::get('apellido');
$correo = Session::get('correo');
?>

@if(Session::get('rol') == "admin")
@else
<script type="text/javascript">
window.location="{{route('inicio')}}";
</script>
@endif

@section('title')
	Usuarios
@endsection

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{asset('materialize/css/materialize_custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/dashboard.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/profile.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/awesomplete.css')}}">
	<style type="text/css">
		.col.s12 > .btn-full {
		   width: 100%;
		}
	</style>
@endsection

@section('sidebar_user')
	<a href="#!user"><img class="circle" src="{{asset('archivos/img/userdefault.jpg')}}"></a>
	<a href="#!name"><span class="white-text name"><?php echo $nombre." ".$apellido;?></span></a>
	<a href="#!email"><span class="white-text email"><?php echo $correo;?></span></a>
@endsection

@section('sidebar_options')
	<li><a href={{ route('adminPerfil') }}><i class="material-icons">account_circle</i>Perfil</a></li>
	<li><a href={{ route('adminUsuarios') }}><i class="material-icons">people</i>Usuarios</a></li>
@endsection

@section('content')
	<meta name="_token" content="{!! csrf_token() !!}"/>
	<div class="container center-align white-text">
		<div class="row">
			<h4>Gestion de usuarios</h4>
		</div>
		<div class="section">
			<div class="row">
				<div class="input-field col s8  black-text">
			        <input id="search" class="autocomplete" type="search" placeholder="ID, Nombre, Apellido">
			       	<label class="label-icon" for="search"><i class="material-icons">search</i></label>
				</div>
				<div class="input-field col s4">
					<a href= {{ route('adminUsuarios/registrarUsuario') }} class="btn-floating btn-large waves-effect waves-light green darken-2 center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Registrar usuario">
						<i class="material-icons">person_add</i>
					</a>
				</div>
			</div>
		</div>
		
		<div class="section">
			<div class="row">
				<div id="profile_options" class="col s12 m4" style='visibility:hidden;'>
					<img id="profile_img" class="circle responsive-img scale-transition scale-out center" src="{{asset('archivos/img/userdefault.jpg')}}"/>
					<div class="row">
						<div class="btn-container col s3 m6 l6">
							<a class="btn-floating btn-large waves-effect waves-light orange darken-4 center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Editar" onclick="edit();">
								<i class="material-icons">mode_edit</i>
							</a>
						</div>
						<div id= "deleteClientButton" class="btn-container col s3 m6 l6" style='visibility:hidden;'>
							<a class="btn-floating btn-large waves-effect waves-light red darken-4 center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Eliminar" onclick="deleteUser();">
								<i class="material-icons">delete</i>
							</a>
						</div>
						<div id='paymentButton' class="col s12" style='visibility:hidden;'>
							<a class="btn-full btn-large waves-effect waves-light red darken-4 center" onclick="makePayment();">
								Registrar Pago<i class="material-icons right">credit_card</i>
							</a>
						</div>
					</div>
				</div>
				
				<div id="profile_data" class="col s12 m8 l8" style='visibility:hidden;'>
					<div class="section">
						<div class="white-text">
							<div class="input-field col s12 m6 l4">
								<input disabled id="firstname" name="firstname" pattern="[a-zA-Z ]+" type="text" class="validate" autocomplete="off" maxlength="20" required>
								<label for="firstname" data-error="Solo letras" >Nombre</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="lastname" name="lastname" pattern="[a-zA-Z ]+" type="text" class="validate" autocomplete="off" maxlength="20" required>
								<label for="lastname" data-error="Solo letras" >Apellido</label>	
							</div>
							<div class="input-field col s12 m6 l4">
		    					<select disabled id="tipodocumento" name="tipodocumento" required>
		    						<option disabled value="">Seleccione un tipo de documento...</option>
		    						<option value="TI">TI</option>
		    						<option value="CC">CC</option>
		    					</select>
		    					<label for="tipodocumento">Tipo de documento</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="numerodocumento" name="numerodocumento" pattern="[\d]+" type="text" class="validate" autocomplete="off" maxlength="15" required>
								<a id="hiddenNumeroDocumento"></a>
								<label for="numerodocumento" data-error="Solo números">Número de documento</label>	
							</div>
							<div class="input-field col s12 m6 l4">
		    					<select disabled id="genero" name="genero" required>
		    						<option disabled value="">Seleccione un genero...</option>
		    						<option value="masculino">Masculino</option>
		    						<option value="femenino">Femenino</option>
		    					</select>
		    					<label for="genero">Género</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="birthdate" name="fechanacimiento" type="date" class="datepicker" autocomplete="off" required>
								<label for="birthdate">Fecha de nacimiento</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="phone" name="phone" pattern="[\d]+" type="text" class="validate" autocomplete="off" maxlength="12" required>
								<label for="phone" data-error="Solo números">Teléfono</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="address" name="address" type="text" class="validate" autocomplete="off" maxlength="20" required>
								<label for="address">Dirección</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<select disabled id="ciudad" name="ciudad" required>
		    						<option value="Pereira" selected>Pereira</option>
		    					</select>
		    					<label for="ciudad">Ciudad</label>
							</div>
							<div class="input-field col s12 m6 l4">
		    					<select disabled id="pais" name="pais" required>
		    						<option value="Colombia" selected>Colombia</option>
		    					</select>
		    					<label for="pais">País</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="email" name="email" pattern= "[\w|.|-]*@\w*\.[\w|.]*" type="email" class="validate" autocomplete="off" maxlength="32" required>
								<a id="hiddenEmail"></a>
								<label for="email" data-error="Correo Electronico">Correo electrónico</label>
							</div>
							<div id="passwordInput" name="passwordInput" class="input-field col s12 m6 l4" maxlength="32" style='visibility:hidden;'>
								<input id="password" name="password" type="password" class="validate" autocomplete="off">
								<label for="password">Contraseña</label>
							</div>
							
							<div class="row" id="editDataOptions" name="editDataOptions" style='visibility:hidden;'>
								<div class="col s6">
									<a class="btn-floating btn-large waves-effect waves-light blue center" onclick="disableUserDataModification('Transaccion Cancelada!', 'red');"><i class="material-icons">clear</i></a>
								</div>
								<div class="col s6">
									<a class="btn-floating btn-large waves-effect waves-light red darken-4 center" onclick="sendModifiedData();"><i class="material-icons">save</i></a>
								</div>
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
	<script type="text/javascript" src="{{asset('archivos/js/awesomplete.js')}}"></script>
	
	<script type="text/javascript">
		
		function showElements (data) {
			$("#firstname").val(data.nombre);
			$("#lastname").val(data.apellido);
			$("#tipodocumento").val(data.tipodocumento);
			$("#numerodocumento").val(data.numerodocumento);
			$("#hiddenNumeroDocumento").val(data.numerodocumento);
			$("#hiddenEmail").val(data.correo);
			$("#genero").val(data.genero);
			$("#birthdate").val(data.fechanacimiento);
			$("#phone").val(data.telefono);
			$("#address").val(data.direccion);
			$("#ciudad").val(data.ciudad);
			$("#pais").val('Colombia');
			$("#email").val(data.correo);
			Materialize.updateTextFields();
			document.getElementById('profile_data').style.visibility='visible';
			document.getElementById('profile_options').style.visibility='visible';
		}
		
		function makePayment () {
			var oldNumeroDocumento = document.getElementById('hiddenNumeroDocumento');
			
			$.ajaxSetup({
				   headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
	    		
    		$.ajax({
				url : '{{URL::to("makePaymentAdminModule")}}',
				type : 'post',
				data : {'numerodocumento':oldNumeroDocumento.value},
				dataType : 'json',
				success : function (data) {
					Materialize.toast('Pago Realizado!!', 5000, 'green');
				},
				error : function () {
					Materialize.toast('Transaccion Fallida!', 5000, 'red');
				}
			});
		}
		
		function clientOptions (data) {
			if(data.tipousuario == 'cliente')
			{
				document.getElementById('paymentButton').style.visibility='visible';
				document.getElementById('deleteClientButton').style.visibility='visible';
				
			$.ajax({
				url : '{{URL::to("activeUser")}}',
				type : 'get',
				data : {'idclasificacionusuario':data.idclasificacionusuario},
				dataType : 'json',
				success : function (data) {
					if(data[0].estadoplataforma == 'inactivo')
					{
						Materialize.toast('Usuario '+data[0].estadoplataforma+'!!', 9999999999,'red');
					} else {
						Materialize.toast('Usuario '+data[0].estadoplataforma+'!!', 5000, 'green');
					}
				},
				error : function (data) {
					Materialize.toast('Transaccion Fallida!', 5000, 'red');
				}
			});	
				
			} else {
				document.getElementById('paymentButton').style.visibility='hidden';
				document.getElementById('deleteClientButton').style.visibility='hidden';
			}
		}
		
		function deleteUser () {
			var oldNumeroDocumento = document.getElementById('hiddenNumeroDocumento');
			
			$.ajaxSetup({
				   headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
	    		
    		$.ajax({
				url : '{{URL::to("deleteUserAdminModule")}}',
				type : 'post',
				data : {'numerodocumento':oldNumeroDocumento.value},
				dataType : 'json',
				success : function (data) {
					Materialize.toast('Usuario desactivado!', 5000, 'green');
				},
				error : function (data) {
					Materialize.toast('Transaccion Fallida!', 5000, 'red');
				}
			});
		}
		
		function edit () {
			$(":input").removeAttr('disabled');
	        $('select').material_select();
	        document.getElementById('passwordInput').style.visibility='visible';
	        document.getElementById('editDataOptions').style.visibility='visible';
		}
		
		function disableUserDataModification (message, color) {
			$(":input").attr('disabled', true);
			$("#search").attr('disabled', false);
			document.getElementById('passwordInput').style.visibility='hidden';
	        document.getElementById('editDataOptions').style.visibility='hidden';
	        Materialize.updateTextFields();
			Materialize.toast(message, 5000, color);
		}
		
		function sendModifiedData () {
			
			var numerodocumento = document.getElementById('numerodocumento');
			var oldNumeroDocumento = document.getElementById('hiddenNumeroDocumento');
	    	var telefono = document.getElementById('phone');
	    	var nombre = document.getElementById('firstname');
	    	var apellido = document.getElementById('lastname');
	    	var direccion = document.getElementById('address');
	    	var correo = document.getElementById('email');
	    	var oldEmail = document.getElementById('hiddenEmail');
	    	var tipodocumento = document.getElementById('tipodocumento');
	    	var genero = document.getElementById('genero');
	    	var fechanacimiento = document.getElementById('birthdate');
	    	var contraseña = document.getElementById('password');
	    	
	    	var regexpNumber = /^\d+$/;
	    	var regexpLetter = /^[a-zA-Z]+$/;
	    	var regexpEmail = /^[\w|.|-]*@\w*\.[\w|.]*$/;
	    	var regexpCompleteName = /^[a-zA-Z ]+$/;
	    	
	    	if((numerodocumento.value.match(regexpNumber)&&numerodocumento.required) && (telefono.value.match(regexpNumber)&&telefono.required) && (nombre.value.match(regexpCompleteName)&&nombre.required) &&
	    		(apellido.value.match(regexpCompleteName)&&apellido.required) && direccion.required && (correo.value.match(regexpEmail)&&correo.required) && tipodocumento.required && genero.required && fechanacimiento.required)
	    	{
	    		$.ajaxSetup({
				   headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
	    		
	    		$.ajax({
					url : '{{URL::to("changeUsersDataAdminModule")}}',
					type : 'post',
					data : {'id':oldNumeroDocumento.value, 'oldEmail':oldEmail.value, 'numerodocumento':numerodocumento.value, 'phone':telefono.value, 'firstname':nombre.value, 'lastname':apellido.value, 'address':direccion.value, 'email':correo.value, 'genero':genero.value, 'fechanacimiento':fechanacimiento.value, 'tipodocumento':tipodocumento.value, 'password':contraseña.value },
					dataType : 'json',
					success : function (data) {
						//$("#hiddenNumeroDocumento").val(data.numerodocumento);
						//$("#hiddenEmail").val(data.email);
						console.log(data);
						disableUserDataModification ('Cambios Realizados!', 'green');
					},
					error : function (data) {
						console.log(data);
						disableUserDataModification ('Transaccion Fallida!', 'red');
					}
				});
	    	} else {
	    		Materialize.toast("Todos los campos son requeridos!!", 5000, 'red');
	    	}
		}
	
		$(document).ready(function(){
			
			var input = document.getElementById("search");
			var awesomplete = new Awesomplete(input, {
			  minChars: 1,
			  autoFirst: true
			});
			
			$("input").on("keyup", function(){
				$.ajax({
					url: '{{URL::to("liveSearchAdminModule")}}',
		    		type: 'GET',
		    		data : {'search': $('#search').val()},
		    		dataType: 'json',
		    		success : function(data){
		    			var list = [];
			    		$.each(data, function(key, value) {
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
					url : '{{URL::to("getSelectedUserAdminModule")}}',
					type : 'GET',
					data : {'id' : id},
					dataType : 'json',
					success : function (data) {
						$(":input").attr('disabled', true);
						$("#search").attr('disabled', false);
						document.getElementById('passwordInput').style.visibility='hidden';
				        document.getElementById('editDataOptions').style.visibility='hidden';
						showElements(data[0]);
						clientOptions(data[0]);
					}
				});
			}, false );
			
		});
		
	</script>
@endsection