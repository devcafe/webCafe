$(document).ready(function(){

	$('#mainWrapper').on('click', 'ul li ul li a', function(){
		//Pega página atual
		var page = $(this).attr('id');

		//Area onde o conteúdo será carregado
		var content = $('#contentWrapper');

		//Abre view	na area de conteudo
		content.load( "modulos/mod_telefonia/view/"+ page +".php" );
	});

})	