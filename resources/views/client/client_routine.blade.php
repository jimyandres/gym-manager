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

@if(Session::get('rol') == "cliente")
@else
<script type="text/javascript">
window.location="{{route('inicio')}}";
</script>
@endif

@section('title')
	Mi Rutina
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
	<li><a href={{ route('clientePerfil')}}><i class="material-icons">account_circle</i>Perfil</a></li>
	<li><a href="{{ route('routine::show', Session::get('id')) }}"><i class="material-icons">event_note</i>Mi Rutina</a></li>
	<li><a href={{ route('progress::progreso_cliente', ['id' => Crypt::encrypt(Session::get('id')) ] ) }}><i class="material-icons">supervisor_account</i>Mi Progreso</a></li>
@endsection

@section('content')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <div>
        <div class="row center-align white-text">
        	<h4>Mi Rutina</h4>
        </div>
        <div id="dayCards" class="row">
            
        </div>
    </div>
    
@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('archivos/js/dashboard_elements.js')}}"></script>
	<script type="text/javascript" src="{{asset('archivos/js/profile_init.js')}}"></script>
	
	<script type="text/javascript">
	    var routine = <?php echo json_encode($rutina); ?>;
	    var lista_ejercicios = {!! json_encode($lista_ejercicios) !!};
	    var grupos_musculares = {!! json_encode($grupos_musculares) !!};
	    //console.log(routine);
	    //console.log(lista_ejercicios);
	    //console.log(grupos_musculares);
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
        
        var modalRoutinePhase;//La lista en donde se ejecutó el modal
        
        
        function addExercise(phaseIndex, dayID, muscularGroup, exercise, sets, reps){
            var icon = phaseIcons[phaseIndex];
            var color = phaseColors[phaseIndex];
            var idListItem = phases[phaseIndex].charAt(0)+'Exercise'+ (countPhaseItems[phaseIndex]+1).toString();//El id tendrá la nomenclatura fase
            var newItem = '<li id="'+idListItem+'" class="collection-item avatar"><i class="material-icons circle '+color+'">'+icon+'</i><span class="title"><b>'+exercise+'</b></span><p>'+muscularGroup+'<br>Series: '+sets+' Repeticiones: '+reps+'</p></li>';
            $('#'+dayID+phases[phaseIndex]).append(newItem);
            countPhaseItems[phaseIndex] += 1;
        }
        
        function addDay(dayId){
            //console.log("Agregar dia " + dayId);
            var newCard = '<div id="'+dayId+'" class="col s12 m6"><div class="card"><div class="card-content"><span class="card-title">'+days[dayId]+'</span><div class="row"><ul class="collapsible" data-collapsible="accordion"><li><div class="collapsible-header"><i class="material-icons">whatshot</i>Calentamiento</div><div class="collapsible-body"><ul id="'+dayId+'HeatingList" class="collection"></ul></div></li><li><div class="collapsible-header"><i class="material-icons">directions_run</i>Entrenamiento</div><div class="collapsible-body"><ul id="'+dayId+'TrainingList" class="collection"></li></ul></div></li><li><div class="collapsible-header"><i class="material-icons">airline_seat_recline_extra</i>Estiramiento</div><div class="collapsible-body"><ul id="'+dayId+'StretchingList" class="collection"></ul></div></li></ul></div></div></div></div>';
            $('#dayCards').append(newCard);
            //Se cargan los elementos de materialize
            $('.collapsible').collapsible();
            $('select').material_select();
            //console.log(data);
        }
        
        $(document).ready(function(){
            for(day in routine){
                addDay(day);
                for(phase in routine[day]){
                    //console.log(routine[day][phase]);
                    for(exercise in routine[day][phase]){
                        //console.log(routine[day][phase][exercise]);
                        var exerciseData = routine[day][phase][exercise];
                        addExercise(phase,day,grupos_musculares[exerciseData['muscularGroup']],lista_ejercicios[exerciseData['excercise']],exerciseData['sets'],exerciseData['reps']);
                    }
                }
            }
        });
        
	</script>
@endsection