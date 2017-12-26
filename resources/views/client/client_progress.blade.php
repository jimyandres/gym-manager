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

@if(Session::get('rol') == "cliente")
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

@section('title', 'Mi Progreso')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{asset('materialize/css/materialize_custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('archivos/css/dashboard.css')}}">
	
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="//code.highcharts.com/themes/dark-unica.js"></script>

	<script type="text/javascript"> 
	$(function(){
		
		// BRAZOS ----------------------------------
		Highcharts.chart('chart_brazo', {
		    chart: {
		        type: 'spline'
		    },
		    title: {
		        text: '{{$estado['brazo']}}'
		    },
		    xAxis: {
		        type: 'datetime',
		        dateTimeLabelFormats: { // don't display the dummy year
		            month: '%e. %b',
		            year: '%b'
		        },
		    },
		    yAxis: {
		        title: {
		            text: 'Medida (cm)'
		        }
		    },
		    tooltip: {
		        headerFormat: '<b>{series.name}</b><br>',
		        pointFormat: '{point.x:%e. %b}: {point.y:.2f} cm'
		    },
		
		    plotOptions: {
		        spline: {
		            marker: {
		                enabled: true
		            }
		        }
		    },

		    series: [{
		        name: 'Bíceps (relajado)',
		        data: [
		        	@foreach ($brazo as $brazos)
						[Date.parse('{{$brazos->fecha}}'), {{$brazos->b1}}],
					@endforeach
		        	// [Date.parse('1970-10-16'),  2.9],
		        ]
		    }, {
		        name: 'Bíceps (Tensionado)',
		        data: [
		        	@foreach ($brazo as $brazos)
						[Date.parse('{{$brazos->fecha}}'), {{$brazos->b2}}],
					@endforeach
		        ]
		    }, {
		        name: 'Bíceps (flexionado)',
		        data: [
		            @foreach ($brazo as $brazos)
						[Date.parse('{{$brazos->fecha}}'), {{$brazos->b3}}],
					@endforeach
		        ]
		    }, {
		        name: 'Antebrazo',
		        data: [
		            @foreach ($brazo as $brazos)
						[Date.parse('{{$brazos->fecha}}'), {{$brazos->b4}}],
					@endforeach
		        ]
		    }]
		});
		
		// PIERNA ----------------------------------
		Highcharts.chart('chart_pierna', {
		    chart: {
		        type: 'spline'
		    },
		    title: {
		        text: '{{$estado['pierna']}}'
		    },
		    xAxis: {
		        type: 'datetime',
		        dateTimeLabelFormats: { // don't display the dummy year
		            month: '%e. %b',
		            year: '%b'
		        },
		    },
		    yAxis: {
		        title: {
		            text: 'Medida (cm)'
		        }
		    },
		    tooltip: {
		        headerFormat: '<b>{series.name}</b><br>',
		        pointFormat: '{point.x:%e. %b}: {point.y:.2f} cm'
		    },
		
		    plotOptions: {
		        spline: {
		            marker: {
		                enabled: true
		            }
		        }
		    },
		    
		    series: [{
		        name: 'Gluteos-cadera (máximo)',
		        data: [
		        	// [Date.parse('1970-10-16'),  2.9],
		        	@foreach ($pierna as $piernas)
						[Date.parse('{{$piernas->fecha}}'), {{$piernas->p1}}],
					@endforeach
		        ]
		    }, {
		        name: 'Pantorrilla',
		        data: [
		            @foreach ($pierna as $piernas)
						[Date.parse('{{$piernas->fecha}}'), {{$piernas->p2}}],
					@endforeach
		        ]
		    }, {
		        name: 'Cuádriceps',
		        data: [
		            @foreach ($pierna as $piernas)
						[Date.parse('{{$piernas->fecha}}'), {{$piernas->p3}}],
					@endforeach
		        ]
		    }]
		});
		
		// TORSO ----------------------------------
		Highcharts.chart('chart_torso', {
		    chart: {
		        type: 'spline'
		    },
		    title: {
		        text: '{{$estado['torso']}}'
		    },
		    xAxis: {
		        type: 'datetime',
		        dateTimeLabelFormats: { // don't display the dummy year
		            month: '%e. %b',
		            year: '%b'
		        },
		    },
		    yAxis: {
		        title: {
		            text: 'Medida (cm)'
		        }
		    },
		    tooltip: {
		        headerFormat: '<b>{series.name}</b><br>',
		        pointFormat: '{point.x:%e. %b}: {point.y:.2f} cm'
		    },
		
		    plotOptions: {
		        spline: {
		            marker: {
		                enabled: true
		            }
		        }
		    },
			
		    series: [{
		        name: 'Cintura (mínimo)',
		        data: [
		        	// [Date.parse('1970-10-16'),  2.9],
		        	@foreach ($torso as $torsos)
						[Date.parse('{{$torsos->fecha}}'), {{$torsos->t1}}],
					@endforeach
		        ]
		    }, {
		        name: 'Pectoral',
		        data: [
		            @foreach ($torso as $torsos)
						[Date.parse('{{$torsos->fecha}}'), {{$torsos->t2}}],
					@endforeach
		        ]
		    }]
		});
		
		// OTROS ----------------------------------
		Highcharts.chart('chart_otro', {
		    chart: {
		        type: 'spline'
		    },
		    title: {
		        text: '{{$estado['otro']}}'
		    },
		    xAxis: {
		        type: 'datetime',
		        dateTimeLabelFormats: { // don't display the dummy year
		            month: '%e. %b',
		            year: '%b'
		        },
		    },
		    yAxis: {
		        title: {
		            text: 'Peso (kg)'
		        }
		    },
		    tooltip: {
		        headerFormat: '<b>{series.name}</b><br>',
		        pointFormat: '{point.x:%e. %b}: {point.y:.2f} kg'
		    },
		
		    plotOptions: {
		        spline: {
		            marker: {
		                enabled: true
		            }
		        }
		    },
		
		    series: [{
		        name: 'Peso',
		        data: [
		        	// [Date.parse('1970-10-16'),  2.9],
		        	@foreach ($otro as $otros)
						[Date.parse('{{$otros->fecha}}'), {{$otros->o1}}],
					@endforeach
		        ]
		    }]
		});
		
		Highcharts.chart('chart_IMC', {
		    chart: {
		        type: 'spline'
		    },
		    title: {
		        text: '{{$estado['imc']}}'
		    },
		    xAxis: {
		        type: 'datetime',
		        dateTimeLabelFormats: { // don't display the dummy year
		            month: '%e. %b',
		            year: '%b'
		        },
		    },
		    yAxis: {
		        title: {
		            text: '(kg/m^2)'
		        }
		    },
		    tooltip: {
		        headerFormat: '<b>{series.name}</b><br>',
		        pointFormat: '{point.x:%e. %b}: {point.y:.2f} kg/m^2'
		    },
		
		    plotOptions: {
		        spline: {
		            marker: {
		                enabled: true
		            }
		        }
		    },
		
		    series: [{
		        name: 'IMC',
		        data: [
		        	// [Date.parse('1970-10-16'),  2.9],
		        	@foreach ($otro as $otros)
		        		
						[Date.parse('{{$otros->fecha}}'), {{$otros->o1 / pow($otros->o2, 2)}}],
					@endforeach
		        ]
		    }]
		});
	});
	</script>
	
@endsection


@section('content')
	<div class="row center-align white-text">
    	<h4>Mi Progreso</h4>
    </div>
	
	<ul id="tabs-onShow" class="tabs red darken-4">
		<li class="tab col s3"><a class="white-text" href="#swipe-arm">Brazo</a></li>
		<li class="tab col s3"><a class="white-text" href="#swipe-trunk">Torso</a></li>
		<li class="tab col s3"><a class="white-text" href="#swipe-legs">Piernas</a></li>
		<li class="tab col s3"><a class="white-text" href="#swipe-others">Otros</a></li>
	</ul>
	
	<div id="swipe-arm" class="col s12">
		<div class="row">
			<div class="col s12" style="margin-top: 10px">
				<div id="chart_brazo"></div>
			</div>
		</div>
	</div>
	
	<div id="swipe-trunk" class="col s12">
		<div class="row">
			<div class="col s12" style="margin-top: 10px">
				<div id="chart_torso"></div>
			</div>
		</div>
	</div>
	<div id="swipe-legs" class="col s12">
		<div class="row">
			<div class="col s12" style="margin-top: 10px">
				<div id="chart_pierna"></div>
			</div>
		</div>
	</div>
	<div id="swipe-others" class="col s12">
		<div class="row">
			<div class="col s12" style="margin-top: 10px">
				<div id="chart_otro"></div>
			</div>
			<div class="col s12" style="margin-top: 10px">
				<div id="chart_IMC"></div>
			</div>
		</div>
	</div>

@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('archivos/js/dashboard_elements.js')}}"></script>
	<script type="text/javascript" src="{{asset('archivos/js/profile_init.js')}}"></script>
@endsection