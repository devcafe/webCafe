$(document).ready(function(){

	// $('#mainWrapper').on('click', 'ul li ul li a', function(){
	// 	//Pega página atual
	// 	var page = $(this).attr('id');

	// 	//Area onde o conteúdo será carregado
	// 	var content = $('#contentWrapper');

	// 	//Abre view	na area de conteudo
	// 	content.load( "modulos/mod_telefonia/view/"+ page +".php" );
	// });

	var content = $('#contentWrapper');

	function getParameterByName(name) {
	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	        results = regex.exec(location.search);
	    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	var page = getParameterByName('page');
	var mod = getParameterByName('mod');

	content.load( "modulos/"+ mod +"/view/"+ page +".php" );
})	