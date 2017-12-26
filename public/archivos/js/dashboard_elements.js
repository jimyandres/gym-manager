$(document).ready(function(){
    $('.collapsible').collapsible();
	$(".button-collapse").sideNav();
	$('select').material_select();
	$('.datepicker').pickadate({
		firstDay: true,
		format: 'yyyy-mm-dd',
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 50, // Creates a dropdown of 15 years to control year
	    max: 2017
  	});
  	$('.tooltipped').tooltip({delay: 50});
});