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

@if(Session::get('rol') == "root")
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
	<div class="container center-align white-text">
		<div class="row">
			<h4>Gestion de usuarios</h4>
		</div>
		<div class="section">
			<div class="row">
				<div class="input-field col s8 black-text">
			        <input id="search" class="autocomplete" type="search" placeholder="ID, Nombre, Apellido"/>
			       	<label class="label-icon" for="search"><i class="material-icons">search</i></label>
				</div>
				<div class="input-field col s4">
					<a href= {{ route('rootUsuarios/registrarAdmin') }} class="btn-floating btn-large waves-effect waves-light green darken-2 center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Registrar usuario">
						<i class="material-icons">person_add</i>
					</a>
				</div>
			</div>
		</div>
		<div class="section">
			<div class="row">
				<div id = "profile_options" class="col s12 m4" style='visibility:hidden;'>
					<img id="profile_img" class="circle responsive-img scale-transition scale-out center" src="{{asset('archivos/img/userdefault.jpg')}}" />
					<div class="row">
						<div class="btn-container col s3 m6 l6" >
							<a class="btn-floating btn-large waves-effect waves-light orange darken-4 center tooltipped" id="edit" data-position="bottom" data-delay="50" data-tooltip="Editar" onclick=edit()>
								<i class="material-icons">mode_edit</i>
							</a>
						</div>
						<div class="btn-container col s3 m6 l6" >
							<a class="btn-floating btn-large waves-effect waves-light red darken-4 center tooltipped" id="delete" data-position="bottom" data-delay="50" data-tooltip="Eliminar" onclick=typeUser()>
								<i class="material-icons">delete</i>
							</a>
						</div>
					</div>
				</div>
				<div id="profile_data" class="col s12 m8 l8" style='visibility:hidden;'>
					<div class="section">
						<div class="white-text">
						{!!Form::open(['route'=>'changeUsersDataRootModule','method'=>'POST', 'id'=>'sendUser']) !!}
							<div class="input-field col s12 m6 l4" >
								<input disabled id="firstname" pattern="[a-zA-Z]+" value="" onkeypress="return validarLetras(event, this.value);" name="firstname" type="text" class="validate" autocomplete="off"required>
								<label class="title-form" for="firstname" data-error="Solo letras" >Nombre</label>
							</div>
							<div class="input-field col s12 m6 l4" >
								<input disabled id="lastname" pattern="[a-zA-Z]+" value="" onkeypress="return validarLetras(event, this.value);" name="lastname" type="text" class="validate" autocomplete="off" required>
								<label for="lastname" data-error="Solo letras" >Apellido</label>	
							</div>
							<div class="input-field col s12 m6 l4" >
		    					<select id="tipodocumento" name="tipodocumento" required disabled>
		    						<option value="TI">TI</option>
		    						<option value="CC" selected>CC</option>
		    					</select>
		    					<label for="tipodocumento">Tipo de documento</label>
							</div>
							<div class="input-field col s12 m6 l4" >
								<input disabled id="numerodocumento" pattern="[\d]+" value="" onkeypress="return validarNumeros(event, this.value);" name="numerodocumento" type="text" class="validate" autocomplete="off" required>
								<a id="hiddenNumeroDocumento" style="display: none;"></a>
								<label for="numerodocumento" data-error="Solo números" for="numerodocumento">Número de documento</label>	
							</div>
							<div class="input-field col s12 m6 l4">
		    					<select id="genero" name="genero" disabled required>
		    						<option value="masculino" selected>Masculino</option>
		    						<option value="femenino">Femenino</option>
		    					</select>
		    					<label for="genero" >Género</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input id="birthdate" type="date" class="datepicker" name="fechanacimiento"  onchange="checkDate(this.value);" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="" autocomplete="off" required disabled>
								<label for="birthdate">Fecha de nacimiento</label>
							</div>
							<div class="input-field col s12 m6 l4" >
								<input disabled id="phone" pattern="[\d]+" value="" onkeypress="return validarNumeros(event, this.value);" name="phone" type="text" class="validate" autocomplete="off" required>
								<label for = "phone" data-error="Solo números" for="phone">Teléfono</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="address" value="" onkeypress="return validarDireccion(event, this.value);" name="address" type="text" class="validate" autocomplete="off" required>
								<label for="address">Dirección</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<select id="ciudad" name="ciudad" disabled required>
		    						<option value="Pereira" selected>Pereira</option>
		    						<option value="Dosquebradas">Dosquebradas</option>
		    					</select>
		    					<label for="ciudad">Ciudad</label>
							</div>
							<div class="input-field col s12 m6 l4">
		    					<select id="pais" name="pais" disabled required>
		    						<option value="Colombia" disabled selected>Colombia</option>
		    					</select>
		    					<label for="pais">País</label>
							</div>
							<div class="input-field col s12 m6 l4">
								<input disabled id="email" value="" name="email" type="email" class="validate" autocomplete="off" required pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" >
								<a id="hiddenCorreo" style="display: none;"></a>
								<label for="email">Correo electrónico</label>
							</div>
							<div class="input-field col s12 m6 l4" name="password" id="password">
								<input id="password" name="password" type="password" class="validate" autocomplete="off" required disabled>
								<label for="password">Contraseña</label>
							</div>
							<div class="row" id="editDataOptions" name="editDataOptions" style='visibility:hidden;'>
								<div class="col s6">
									<a class="btn-floating btn-large waves-effect waves-light blue center" onclick="cancelUserDataModification();"><i class="material-icons">clear</i></a>
								</div>
								<div class="col s6">
									<a class="btn-floating btn-large waves-effect waves-light red darken-4 center" onclick="sendModifiedData();"><i class="material-icons">save</i></a>
								</div>
							</div>
						{!!Form::close() !!}
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
		/*global $*/
		
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
		
		function showElements (data) {
			$('#firstname').val( data.nombre);
			$('#lastname').val( data.apellido);
			$("#tipodocumento").val(data.tipodocumento);
			$('#numerodocumento').val( data.numerodocumento);
			$('#genero').val(data.genero);
			$('#birthdate').val(data.fechanacimiento);
			$('#phone').val( data.telefono);
			$('#address').val( data.direccion);
			$('#ciudad').val( data.ciudad);
			$('#pais').val( 'Colombia');
			$('#email').val( data.correo);
			$("#hiddenNumeroDocumento").val(data.numerodocumento);
			$("#hiddenCorreo").val(data.correo);
			
			Materialize.updateTextFields();
			$('#profile_data').attr("style", "visibility: visible")
			$('#profile_options').attr("style", "visibility: visible")
		}
		
		function typeUser(){
			var oldNumeroDocumento = document.getElementById('hiddenNumeroDocumento');
			$.ajaxSetup({
				   headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
	    		
    		$.ajax({
				url : '{{URL::to("typeUserRootModule")}}',
				type : 'post',
				data : {'numerodocumento':oldNumeroDocumento.value},
				dataType : 'json',
				success : function (data) {
					var type = data[0].tipousuario;
					console.log(type);
					if(type == "admin" || type == "trainer"){
						Materialize.toast('Eliminando usuario "'+type+'"...', 5000);
						deleteUser();
					}else{
						Materialize.toast('No puedes eliminar usuarios "'+type+'"', 5000);
					}
				}
			});
		}
		
		function edit () {
			$(":input").removeAttr('disabled');
	        $('select').material_select();
	        document.getElementById('password').style.visibility='visible';
	        document.getElementById('editDataOptions').style.visibility='visible';
		}
		
		function deleteUser () {
			var oldNumeroDocumento = document.getElementById('hiddenNumeroDocumento');
				$.ajaxSetup({
					   headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
					});
		    		
	    		$.ajax({
					url : '{{URL::to("deleteSelectedUserRootModule")}}',
					type : 'post',
					data : {'numerodocumento':oldNumeroDocumento.value},
					dataType : 'json',
					success : function (data) {
						Materialize.updateTextFields();
						Materialize.toast('Usuario eliminado!', 5000, 'green');
					},
					error : function (data) {
						Materialize.toast('Transaccion Fallida!', 5000, 'red');
					}
				});
		}
		
		function cancelUserDataModification () {
			$(":input").attr('disabled', true);
			$("#search").attr('disabled', false);
			document.getElementById('password').style.visibility='hidden';
	        document.getElementById('editDataOptions').style.visibility='hidden';
	        Materialize.updateTextFields();
		}
		
		function sendModifiedData () {
			
			var numerodocumento = document.getElementById('numerodocumento');
			var oldNumeroDocumento = document.getElementById('hiddenNumeroDocumento');
			var oldEmail = document.getElementById('hiddenCorreo');
	    	var telefono = document.getElementById('phone');
	    	var nombre = document.getElementById('firstname');
	    	var apellido = document.getElementById('lastname');
	    	var direccion = document.getElementById('address');
	    	var correo = document.getElementById('email');
	    	var tipodocumento = document.getElementById('tipodocumento');
	    	var genero = document.getElementById('genero');
	    	var fechanacimiento = document.getElementById('birthdate');
	    	var contraseña = document.getElementById('password');
	    	var ciudad = document.getElementById('ciudad');
	    	
	    	var regexpEmail = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
	    	
	    	/*console.log((regexpEmail.test(correo.value)&&correo.required));
	    	console.log((regexpLetter.test(nombre.value)&&nombre.required));
	    	console.log((regexpLetter.test(apellido.value)&&apellido.required));
	    	console.log(direccion.required);
	    	console.log(genero.required);
	    	console.log(ciudad.required);
	    	console.log(fechanacimiento.required);
	    	console.log(tipodocumento.required);
	    	console.log((regexpNumber.test(numerodocumento.value)&&numerodocumento.required));
	    	console.log((regexpNumber.test(telefono.value)&&telefono.required));*/
	    	
	    	if(
	    		(regexpEmail.test(correo.value)&&correo.required) && nombre.required && 
	    		apellido.required && direccion.required && genero.required && ciudad.required && 
		    	fechanacimiento.required && tipodocumento.required && numerodocumento.required &&
		    	telefono.required)
	    	{
	    		$.ajaxSetup({
				   headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
	    		
	    		$.ajax({
					url : '{{URL::to("changeUsersDataRootModule")}}',
					type : 'post',
					data : {'id':oldNumeroDocumento.value, 'numerodocumento':numerodocumento.value, 
							'phone':telefono.value, 'firstname':nombre.value,'ciudad':ciudad.value, 'lastname':apellido.value, 
							'address':direccion.value, 'email':correo.value, 'genero':genero.value, 
							'fechanacimiento':fechanacimiento.value, 'tipodocumento':tipodocumento.value, 
							'password':contraseña.value, 'oldEmail':oldEmail.value },
					dataType : 'json',
					success : function (data) {
						$("#oldNumeroDocumento").val(data.numerodocumento);
						cancelUserDataModification ();
						Materialize.toast('Cambios Realizados!',5000,'green');
					},
					error : function (data) {
						cancelUserDataModification ();
						Materialize.toast('Transaccion Cancelada!', 4000,'red');
					}
				});
	    	} else {
	    		Materialize.toast("Ingrese correctamente todos los campos.", 5000,'red');
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
					url: '{{URL::to("liveSearchRootModule")}}',
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
					url : '{{URL::to("getSelectedUserRootModule")}}',
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