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
use App\datopersonal;

$correo=Session::get('correo');
$usuario = datopersonal::where('correo',$correo)->first();
?>

@if(Session::get('rol') == "trainer")
@else
<script type="text/javascript">
window.location="{{route('inicio')}}";
</script>
@endif
@section('title')
	Crear Rutina
@endsection

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{asset('materialize/css/materialize_custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/dashboard.css')}}">
	
	<style type="text/css">
	    .nav-breadcrumb{
	        padding-left: 15px;
	        padding-right: 15px;
	    }
	    
	    .form-header{
	    	background: #000;
	    	height: 10em;
	    	padding: 3rem 1rem 3rem 1rem;
	    }
	    
	    .health-background{
	    	background:url({{ URL::asset('archivos/img/doctors.jpg') }}) no-repeat;
   			background-size: cover;
	    }
	</style>
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
    <nav>
        <div class="nav-wrapper nav-breadcrumb red darken-4">
            <div class="col s12">
                <a class="breadcrumb">Paso 1</a>
            </div>
        </div>
    </nav>
    <div>
    	<div id="health form">
    		<div class="row form-header health-background">
    			<div class="col s12">
    				<h4>Cuestionario de salud</h4>
    			</div>
    		</div>
    		<form role="form" method="POST" action="{{ route('routine::asignarRutina1', $id)}}">
    		<div class="row">
			    <div class="col s12 m6">
			    	<div class="row">
			    	<div class="col s12">
			        <div class="card">
			            <div class="card-content">
			                <span class="card-title">Cuestionario previo</span>
			                {!! csrf_field() !!}
			                <div class="input-field row">
			                    ¿En alguna ocasión le ha dicho su médico que tiene algún problema cardiaco y que solamente podría hacer ejercicio físico recomendado y prescrito por un médico?
			                    <p>
			                        <input name="pregunta1" type="radio" id="yes1" value="yes" required {{ old('pregunta1') == "yes" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="yes1">Si</label>
			                    </p>
			                    <p>
			                        <input name="pregunta1" type="radio" id="no1" value="no" {{ old('pregunta1') == "no" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="no1">No</label>
			                    </p>
			                </div>
			                <div class="divider"></div>
			                <div class="input-field row">
			                    ¿Siente dolor en el pecho cuando realiza ejercicio físico? 
			                    <p>
			                        <input name="pregunta2" type="radio" id="yes2" value="yes" required {{ old('pregunta2') == "yes" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="yes2">Si</label>
			                    </p>
			                    <p>
			                        <input name="pregunta2" type="radio" id="no2" value="no" {{ old('pregunta2') == "no" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="no2">No</label>
			                    </p>
			                </div>
			                <div class="divider"></div>
			                <div class="input-field row">
			                    ¿Durante el último mes ha sentido dolor en el pecho aunque no estuviera haciendo ejercicio físico? 
			                    <p>
			                        <input name="pregunta3" type="radio" id="yes3" value="yes" required {{ old('pregunta3') == "yes" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="yes3">Si</label>
			                    </p>
			                    <p>
			                        <input name="pregunta3" type="radio" id="no3" value="no" {{ old('pregunta3') == "no" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="no3">No</label>
			                    </p>
			                </div>
			                <div class="divider"></div>
			                <div class="input-field row">
			                    ¿Tiene que dormir con varias almohadas porque tumbada/o siente ahogo? 
			                    <p>
			                        <input name="pregunta4" type="radio" id="yes4" value="yes" required {{ old('pregunta4') == "yes" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="yes4">Si</label>
			                    </p>
			                    <p>
			                        <input name="pregunta4" type="radio" id="no4" value="no" {{ old('pregunta4') == "no" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="no4">No</label>
			                    </p>
			                </div>
			                <div class="divider"></div>
			                <div class="input-field row">
			                    ¿Ha perdido el equilibrio a causa de mareos o “perdida de conocimiento”?
			                    <p>
			                        <input name="pregunta5" type="radio" id="yes5" value="yes" required {{ old('pregunta5') == "yes" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="yes5">Si</label>
			                    </p>
			                    <p>
			                        <input name="pregunta5" type="radio" id="no5" value="no" {{ old('pregunta5') == "no" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="no5">No</label>
			                    </p>
			                </div>
			                <div class="divider"></div>
			                <div class="input-field row">
			                     ¿Tiene algún dolor o problema en alguna articulación que empeora cuando aumenta su actividad física? 
			                    <p>
			                        <input name="pregunta6" type="radio" id="yes6" value="yes" required {{ old('pregunta6') == "yes" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="yes6">Si</label>
			                    </p>
			                    <p>
			                        <input name="pregunta6" type="radio" id="no6" value="no" {{ old('pregunta6') == "no" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="no6">No</label>
			                    </p>
			                </div>
			                <div class="divider"></div>
			                <div class="input-field row">
			                    ¿Su médico le prescribe medicinas para problemas de corazón? 
			                    <p>
			                        <input name="pregunta7" type="radio" id="yes7" value="yes" required {{ old('pregunta7') == "yes" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="yes7">Si</label>
			                    </p>
			                    <p>
			                        <input name="pregunta7" type="radio" id="no7" value="no" {{ old('pregunta7') == "no" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="no7">No</label>
			                    </p>
			                </div>
			                <div class="divider"></div>
			                <div class="input-field row">
			                    ¿Conoce alguna razón por la que no deba hacer ejercicio físico?
			                    <p>
			                        <input name="pregunta8" type="radio" id="yes8" value="yes" required {{ old('pregunta8') == "yes" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="yes8">Si</label>
			                    </p>
			                    <p>
			                        <input name="pregunta8" type="radio" id="no8" value="no" {{ old('pregunta8') == "no" ? 'checked' : '' }}>
			                        <label class="grey-text text-darken-3" for="no8">No</label>
			                    </p>
			                </div>
			            </div>
			        </div>
			        </div>
			        </div>
			    </div>
			    <div class="col s12 m6">
			    	<div class="row">
			    		<div class="col s12">
				    		<div class="card">
					            <div class="card-content">
					                <span class="card-title">Enfermedades padecidas</span>
					                <div class="input-field">
					                    <div class="row">
					                        <div class="input-field col s12">
					                            <select id="tipo_enfermedad" name="tipo_enfermedad">
					                                <!--<option value="" selected>Seleccione un tipo de enfermedad</option>-->
					                                <!--<option value="1">Cardiaca</option>-->
					                                <!--<option value="2">Broncopulmonar</option>-->
					                                <!--<option value="3">Musculoesqueleticas</option>-->
					                            </select>
					                            <label class="black-text">Tipo de enfermedad</label>
					                        </div>
					                        <div class="input-field col s12">
					                        <select id="enfermedad" name="enfermedad">
					                            <!--<option value="" selected>Seleccione una enfermedad</option>-->
					                            <!--<option value="1">Cardiaca 1</option>-->
					                            <!--<option value="2">Cardiaca 2</option>-->
					                            <!--<option value="3">Cardiaca 3</option>-->
					                        </select>
					                        <label class="black-text">Enfermedad</label>
					                    </div>
					                    </div>
					                </div>
					            </div>
					        </div>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="col s12">
					        <div class="card">
					        	<div class="card-content">
					        		<span class="card-title">Traumatismos</span>
					        		<div class="input-field">
					                    <div class="row">
					                        <div class="input-field col s12">
					                            <select id="tipo_lesion" name="tipo_traumatismo">
					                                <!--<option value="" selected>Seleccione un tipo de traumatismo</option>-->
					                                <!--<option value="1">Traumatismo 1</option>-->
					                                <!--<option value="2">Traumatismo 2</option>-->
					                                <!--<option value="3">Traumatismo 3</option>-->
					                            </select>
					                            <label class="black-text">Tipo de traumatismo</label>
					                        </div>
					                        <div class="input-field col s12">
						                        <select id="lesion" name="grupo_muscular">
						                            <!--<option value="" selected>Seleccione un grupo muscular</option>-->
						                            <!--<option value="1">Grupo muscular 1</option>-->
						                            <!--<option value="2">Grupo muscular 2</option>-->
						                            <!--<option value="3">Grupo muscular 3</option>-->
						                        </select>
						                        <label class="black-text">Grupo muscular afectado</label>
						                    </div>
					                    </div>
					                </div>
					        	</div>
					        </div>
					    </div>
				    </div>
				    <div class="row">
		    			<span class="red-text center-align">@include('flash::message')</span>
		    		</div>
		    		@if(session('confirm'))
		    			<div class="row">
		    				<div class="col s12 medium-small center-align input-field">
		    					<p>
				      				<input type="checkbox" class="filled-in validate" id="confirmation" name="confirmation" value="yes" required>
				      				<label data-error="Debe aceptar antes de continuar" for="confirmation">Acepto</label>
				      				<!--@if ($errors->has('confirmation'))
					                    <small class="text-danger"><strong>{{ $errors->first('confirmation') }}</strong></small>
					                @endif-->
				                </p>
							</div>
		    			</div>
	    			@endif
				    <div class="row">
				    	<div class="col s12 center-align">
				    		<button  class="waves-effect waves-light btn-large red darken-3"><i class="material-icons right">send</i>Enviar</button>
				    		{{--<a href={{ route('entrenadorUsuarios/{id}/asignarRutina/2', 'id_prueba') }} class="waves-effect waves-light btn-large red darken-3"><i class="material-icons right">send</i>Enviar</a>--}}
				    	</div>
				    </div>
			    </div>
			</div>
			</form>
    	</div>
    </div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('archivos/js/dashboard_elements.js')}}"></script>
	<script type="text/javascript" src="{{asset('archivos/js/profile_init.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			var enfermedad = $("#enfermedad");
			enfermedad.empty();
			enfermedad.append("<option value='' selected>Seleccione una enfermedad</option>");
			enfermedad.trigger('contentChanged');
			
			var lesion = $("#lesion");
			lesion.empty();
			lesion.append("<option value='' selected>Seleccione una lesion</option>");
			lesion.trigger('contentChanged');
			
            var tipo_enfermedad = $("#tipo_enfermedad");
            $.get('{{route('routine::getTipoEnfermedad')}}', function(data, status) {
                tipo_enfermedad.empty();
                tipo_enfermedad.append("<option value='' selected>Seleccione un tipo de enfermedad</option>");
                data.forEach(element => {
                	if('{{old('tipo_enfermedad')}}' === element.idtipoenfermedad) {
                        selected = 'selected';
                    } else {
                        selected = '';
                    }
                	tipo_enfermedad.append(`<option value=${element.idtipoenfermedad} ${selected}> ${element.tipoenfermedad}</option>`);
                });
                tipo_enfermedad.change();
                tipo_enfermedad.trigger('contentChanged');
            });
            
            var tipo_lesion = $("#tipo_lesion");
            $.get('{{route('routine::getTipoLesion')}}', function(data, status) {
                tipo_lesion.empty();
                tipo_lesion.append("<option value='' selected>Seleccione un tipo de lesion</option>");
                data.forEach(element => {
                	if('{{old('tipo_traumatismo')}}' === element.idtipolesion) {
                        selected = 'selected';
                    } else {
                        selected = '';
                    }
                	tipo_lesion.append(`<option value=${element.idtipolesion} ${selected}> ${element.tipolesion}</option>`);
                });
                tipo_lesion.change();
                tipo_lesion.trigger('contentChanged');
            });
        });
        
        $("#tipo_enfermedad").change(function(event) {
            var enfermedad = $("#enfermedad");
            var tipo_enfermedad = event.target.value;
            if(tipo_enfermedad === "") {
                enfermedad.empty();
                enfermedad.append("<option value='' selected>Seleccione una enfermedad</option>");
                enfermedad.trigger('contentChanged');
            } else {
            	var address = "{{route('routine::getEnfermedad', ':TIPO')}}".replace(/:TIPO/g, tipo_enfermedad);
                $.get(address, function (data, status) {
                    enfermedad.empty();
                    enfermedad.append("<option value='' selected>Seleccione una enfermedad</option>");
                    data.forEach(element => {
	                	if('{{old('enfermedad')}}' === element.idenfermedad) {
	                        selected = 'selected';
	                    } else {
	                        selected = '';
	                    }
	                	enfermedad.append(`<option value=${element.idenfermedad} ${selected}> ${element.nombreenfermedad}</option>`);
	                });
                    enfermedad.change();
                    enfermedad.trigger('contentChanged');
                });
            }
        });
        
         $("#tipo_lesion").change(function(event) {
            var lesion = $("#lesion");
            var tipo_lesion = event.target.value;
            if(tipo_lesion === "") {
                lesion.empty();
                lesion.append("<option value='' selected>Seleccione una lesion</option>");
                lesion.trigger('contentChanged');
            } else {
            	var address = "{{route('routine::getLesion', ':TIPO')}}".replace(/:TIPO/g, tipo_lesion);
                $.get(address, function (data, status) {
                    lesion.empty();
                    lesion.append("<option value='' selected>Seleccione una lesion</option>");
                    data.forEach(element => {
	                	if('{{old('grupo_muscular')}}' === element.idlesion) {
	                        selected = 'selected';
	                    } else {
	                        selected = '';
	                    }
	                	lesion.append(`<option value=${element.idlesion} ${selected}> ${element.nombrelesion}</option>`);
	                });
                    lesion.change();
                    lesion.trigger('contentChanged');
                });
            }
        });
        
        $('select').on('contentChanged', function() {
		    // re-initialize (update)
		    $(this).material_select();
		 });
	</script>
@endsection