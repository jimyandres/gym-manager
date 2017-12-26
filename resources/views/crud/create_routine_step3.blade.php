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
	    	height: 10em;
	    	padding: 3rem 1rem 3rem 1rem;
	    }
	    
	    .training-background{
	    	background:url({{ URL::asset('archivos/img/kickboxer.jpg') }}) no-repeat;
   			background-size: cover;
	    }
	    
	    .fixed-action-btn.toolbar ul{
            padding-left: 300px;
        }
        
        @media (max-width: 992px){
        	.fixed-action-btn.toolbar ul {
            	padding-left: 0px;
        	}
        }
        
        .button-box{
            height: 4em;
            padding-top: 1em !important;
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
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <nav>
        <div class="nav-wrapper nav-breadcrumb red darken-4">
            <div class="col s12">
                <a class="breadcrumb">Paso 1</a>
                <a class="breadcrumb">Paso 2</a>
                <a class="breadcrumb">Paso 3</a>
            </div>
        </div>
    </nav>
    <div>
        <div class="row form-header training-background">
			<div class="col s10 white-text">
				<h4>Creación de rutina</h4>
			</div>
			<div class="col s2 button-box">
			    <button id="submitData" class="btn-floating waves-effect waves-light red darken-4"><i class="material-icons">send</i></button>
			</div>
		</div>
        <div id="dayCards" class="row">
            
        </div>
        
        <div class="fixed-action-btn toolbar">
            <a class="btn-floating btn-large red darken-3"><i class="large material-icons">add</i></a>
            <ul>
                <li id="monday_tab" class="waves-effect waves-light"><a href="#addDay">LUN</a></li>
                <li id="tuesday_tab" class="waves-effect waves-light"><a href="#addDay">MAR</a></li>
                <li id="wednesday_tab" class="waves-effect waves-light"><a href="#addDay">MIE</a></li>
                <li id="thursday_tab" class="waves-effect waves-light"><a href="#addDay">JUE</a></li>
                <li id="friday_tab" class="waves-effect waves-light"><a href="#addDay">VIE</a></li>
                <li id="saturday_tab" class="waves-effect waves-light"><a href="#addDay">SAB</a></li>
            </ul>
        </div>
        <!-- Modal Structure -->
        <div id="addExercise" class="modal">
            <div class="modal-content">
                <h5>Nuevo ejercicio</h5>
                <div class="row">
                    <div class="input-field col s12">
                        <select id="modalMuscleGroup" required>
                            <!--<option value="" disabled selected>Seleccione</option>-->
                            <!--<option value="1">Grupo Muscular 1</option>-->
                            <!--<option value="2">Grupo Muscular 2</option>-->
                            <!--<option value="3">Grupo Muscular 3</option>-->
                        </select>
                        <label class="black-text">Grupo muscular</label>
                    </div>
                    <div class="input-field col s12">
                        <select id="modalExercise" required>
                            <!--<option value="" disabled selected>Seleccione</option>-->
                            <!--<option value="1">Ejercicio 1</option>-->
                            <!--<option value="2">Ejercicio 2</option>-->
                            <!--<option value="3">Ejercicio 3</option>-->
                        </select>
                        <label class="black-text">Ejercicio</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="modalSets" type="text" class="validate" pattern="[\d]+">
                        <label data-error="Solo números" for="modalSets" class="black-text">Series</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="modalReps" type="text" class="validate" pattern="[\d]+">
                        <label data-error="Solo números" for="modalReps" class="black-text">Repeticiones</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="cancelExercise" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                <a id="saveExercise" class="modal-action waves-effect waves-green btn-flat ">Guardar</a>
            </div>
        </div>
        </div>
    
@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('archivos/js/dashboard_elements.js')}}"></script>
	<script type="text/javascript" src="{{asset('archivos/js/profile_init.js')}}"></script>
	
	<script type="text/javascript">
	    $(document).ready(function () {
	        var ejercicio = $("#modalExercise");
			ejercicio.empty();
			ejercicio.append('<option value="" selected>Seleccione un ejercicio</option>');
			ejercicio.trigger('contentChanged'); 
			
			var grupo_muscular = $("#modalMuscleGroup");
            $.get('{{route('routine::getGrupoMuscular')}}', function(data, status) {
                grupo_muscular.empty();
                grupo_muscular.append('<option value="" selected>Seleccione un grupo muscular</option>');
                data.forEach(element => {
                // 	if('{{old('grupo_muscular')}}' === element.idtipoenfermedad) {
                //         selected = 'selected';
                //     } else {
                //         selected = '';
                //     }
                	grupo_muscular.append(`<option value=${element.idgrupomusculo}> ${element.musculo}</option>`);
                });
                grupo_muscular.change();
                grupo_muscular.trigger('contentChanged');
            });
	    });
	    
	    $("#modalMuscleGroup").change(function(event) {
            var ejercicio = $("#modalExercise");
            var grupo_muscular = event.target.value;
            if(grupo_muscular === "") {
                ejercicio.empty();
                ejercicio.append('<option value="" selected>Seleccione un ejercicio</option>');
                ejercicio.trigger('contentChanged');
            } else {
            	var address = "{{route('routine::getEjercicio', ':TIPO')}}".replace(/:TIPO/g, grupo_muscular);
                $.get(address, function (data, status) {
                    ejercicio.empty();
                    ejercicio.append('<option value="" selected>Seleccione un ejercicio</option>');
                    data.forEach(element => {
	               // 	if('{{old('ejercicio')}}' === element.idejercicio) {
	               //         selected = 'selected';
	               //     } else {
	               //         selected = '';
	               //     }
	                	ejercicio.append(`<option value=${element.idejercicio}> ${element.nombre}</option>`);
	                });
                    ejercicio.change();
                    ejercicio.trigger('contentChanged');
                });
            }
        });
	    
	    $('select').on('contentChanged', function() {
		    // re-initialize (update)
		    $(this).material_select();
		 });
	</script>
	
	<script type="text/javascript">
        var phases = ['HeatingList', 'TrainingList', 'StretchingList'];//Fases de la rutina (Calentamiento, entrenamiento, estiramiento)
        var countPhaseItems = [].fill.call({ length: phases.length }, 0);//Contador de items en cada fase
        var days = {
            'monday':'Lunes',
            'tuesday':'Martes',
            'wednesday':'Miercoles',
            'thursday':'Jueves',
            'friday':'Viernes',
            'saturday':'Sabado',
            'sunday':'Doming'
        };
        var muscularGroups = ['','Grupo muscular 1', 'Grupo muscular 2', 'Grupo muscular 3'];//Cargar los grupos musculares
        var exercises = ['', 'Ejercicio 1', 'Ejercicio 2', 'Ejercicio 3'];//Cargar los ejercicios
       //Elementos de diseño
        var phaseIcons = ['whatshot', 'directions_run', 'airline_seat_recline_extra'];//Iconos de cada fase
        var phaseColors = ['red', 'blue', 'green'];//Colores de cada fase
        //Datos a enviar a la base de datos
        var data = {};
        
        var modalRoutinePhase;//La lista en donde se ejecutó el modal
        
        function removeDayFromId(id){//Para remover el nombre del dia, del id del elemento
            var daysList = Object.keys(days);//Obtenemos la lista de los dias
            //console.log(dayList);
            for(var i=0;i< daysList.length;i++){//Preguntamos por cada dia, si se encuentra en el id
                var findDay = id.indexOf(daysList[i]);
                //console.log(i +" iteracion:"+findDay);
                if(findDay != -1){//Si lo encontramos, lo removemos
                    return [id.replace(daysList[i],''), daysList[i]];
                }
            }
        }
        
        function addExercise(muscularGroupText,muscularGroup,exerciseText,exercise, sets, reps){
            var dayId = removeDayFromId(modalRoutinePhase.attr('id'));
            var newId = dayId[0];
            var day = dayId[1];
            //console.log(modalRoutinePhase.attr('id'));
            //console.log(newId);
            var phaseIndex = jQuery.inArray(newId, phases);//Buscamos el indice entero de la fase
            //console.log(day);
            //console.log(phaseIndex);
            // console.log(muscularGroup);
            // console.log(exercise);
            // console.log(sets);
            // console.log(reps);
            // var exercise_group = [];
            // exercise_group[0] = muscularGroup;
            // exercise_group[1] = exercise;
            // exercise_group[2] = sets;
            // exercise_group[3] = reps;
            var exercise_group = {};
            exercise_group.muscularGroup = muscularGroup;
            exercise_group.exercise = exercise;
            exercise_group.sets = sets;
            exercise_group.reps = reps;
            //console.log(data[day][phaseIndex].length);
            data[day][phaseIndex].push(exercise_group);
            //console.log(data);
            var icon = phaseIcons[phaseIndex];
            var color = phaseColors[phaseIndex];
            var idListItem = phases[phaseIndex].charAt(0)+'Exercise'+ (countPhaseItems[phaseIndex]+1).toString() + (data[day][phaseIndex].length -1).toString();//El id tendrá la nomenclatura fase
            var newItem = '<li id="'+idListItem+'" class="collection-item avatar"><i class="material-icons circle '+color+'">'+icon+'</i><span class="title"><b>'+exerciseText+'</b></span><p>'+muscularGroupText+'<br>Series: '+sets+' Repeticiones: '+reps+'</p><a href="#removeExercise" class="secondary-content red-text"><i class="material-icons">close</i></a></li>';
            modalRoutinePhase.append(newItem);
            countPhaseItems[phaseIndex] += 1;
            //console.log(modalRoutinePhase);
            modalRoutinePhase = null;
        }
        
        function addDay(dayId){
            //console.log("Agregar dia " + dayId);
            var newCard = '<div id="'+dayId+'" class="col s12 m6"><div class="card"><div class="card-content"><span class="card-title">'+days[dayId]+'</span><div class="row"><ul class="collapsible" data-collapsible="accordion"><li><div class="collapsible-header"><i class="material-icons">whatshot</i>Calentamiento</div><div class="collapsible-body"><ul id="'+dayId+'HeatingList" class="collection"><li class="collection-item grey-text text-darken-2">Añade un ejercicio<a href="#addExercise" class="secondary-content green-text"><i class="material-icons">add</i></a></li></ul></div></li><li><div class="collapsible-header"><i class="material-icons">directions_run</i>Entrenamiento</div><div class="collapsible-body"><ul id="'+dayId+'TrainingList" class="collection"><li class="collection-item grey-text text-darken-2">Añade un ejercicio<a href="#addExercise" class="secondary-content green-text"><i class="material-icons">add</i></a></li></ul></div></li><li><div class="collapsible-header"><i class="material-icons">airline_seat_recline_extra</i>Estiramiento</div><div class="collapsible-body"><ul id="'+dayId+'StretchingList" class="collection"><li class="collection-item grey-text text-darken-2">Añade un ejercicio<a href="#addExercise" class="secondary-content green-text"><i class="material-icons">add</i></a></li></ul></div></li></ul></div></div></div></div>';
            $('#dayCards').append(newCard);
            //Se cargan los elementos de materialize
            $('.collapsible').collapsible();
            $('select').material_select();
            data[dayId] = {0:[], 1:[], 2:[]};
            console.log(data);
        }

        function cleanInputs(){
            $('#modalMuscleGroup').val(null);//Colocamos los select en su estado original
            $('#modalMuscleGroup').material_select();
            $('#modalExercise').val(null);
            $('#modalExercise').material_select();
            $('#modalSets').val('');
            $('#modalSets').removeClass('valid');
            $('#modalSets').removeClass('invalid');
            $('#modalReps').val('');
            $('#modalReps').removeClass('valid');
            $('#modalReps').removeClass('invalid'); 
            //console.log('Inputs limpios');
        }
        
        $('.modal').modal({
            ready: function(modal, trigger) { //Cuando el modal se abre
                //console.log(modal, trigger);
                modalRoutinePhase = trigger.parents('ul .collection');
                //console.log(routinePhase);
            }
        });
        
        $('#saveExercise').click(function(){
            if($('#modalMuscleGroup').val() == null || $('#modalMuscleGroup').val() == "" || $('#modalExercise').val() == null ||  $('#modalExercise').val() == "" || $('#modalSets').hasClass('invalid') || $('#modalSets').val() =="" || $('#modalReps').hasClass('invalid') || $('#modalSets').val() == ""){
                console.log('Revise los datos');
            }else{
                addExercise(/*muscularGroupsText*/$("#modalMuscleGroup option:selected").text(),/*muscularGroups*/$("#modalMuscleGroup").val(),/*exercisesText*/$("#modalExercise option:selected").text(),/*exercises*/$("#modalExercise").val(),$('#modalSets').val(), $('#modalReps').val());
                 $('.modal').modal('close');
                 cleanInputs();
            }
        });
        
        $('#cancelExercise').click(cleanInputs);
        
        $(document).on('click', 'a[href="#removeExercise"]', function(e){//Funcion para eliminar un ejercicio
            var listItem = $(e.target).parents('li .collection-item');//Obtenemos el list item a traves de los padres del origen del evento
            var listItemID = listItem.attr('id');
            var ulItem = $(e.target).parents('ul .collection');
            var excerciseInfo = removeDayFromId(ulItem.attr('id'));
            var day = excerciseInfo[1];
            var phase = jQuery.inArray(excerciseInfo[0], phases);
            var index = listItemID.substr(listItemID.length - 1);
            // console.log(day);
            // console.log(phase);
            // console.log(index);
            // console.log(data[day][phase][index]);
            data[day][phase].splice(index, 1);
            // console.log(data[day][phase][index]);
            // console.log(data);
            var phaseIndex;
            //console.log(phaseIndex);
            listItem.remove();
            //console.log(countPhaseItems);
            countPhaseItems[phaseIndex] -= 1;
            //console.log(countPhaseItems);
        });
        
        $('a[href="#addDay"]').click(function(e) {
            var listItem = $(e.target).parents('li');
            var day = listItem.attr('id').substring(0, listItem.attr('id').indexOf('_'));
            if($('#dayCards').has('#'+day).length){//Si el dia ya se encuentra
                console.log('El dia '+days[day]+' ya se encuentra');
            }else{
                addDay(day);
                listItem.css({
                    'background-color':'#000'
                });
            }
        });
        
        $("#submitData").on('click', function() {
            var requestData = JSON.stringify(data);
            console.log(requestData);
            
            $.ajaxSetup({
				   headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
				
            $.ajax({
                url: "{{route('routine::asignarRutina3', $id)}}",
                method: "POST",
                dataType: "json",
                //data: {data: requestData},
                data: data,
                success: function(res) {
                    if(res.status) {
                        window.location.href = res.redirect;
                        // setTimeout(function(){
                        // }, 5000);
                        //Materialize.toast("Rutina creada staisfactoriamente", 5000, 'green');
                        //alert("OK");
                    } else {
                        Materialize.toast("Error en los datos: " + res.msg, 5000, 'red');
                    }
                }
            });
        });
        
	</script>
@endsection