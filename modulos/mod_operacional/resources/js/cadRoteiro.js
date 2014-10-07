$(document).ready(function(){

	/*************************************/
	/* Inicialização
	/*************************************/

	//Esconde modals
	$('#colaboradorModal').hide();

	/*************************************/
	/* Funções
	/*************************************/

	//Marca campos como selecionados ao clicar em uma linha
	$('#addDataUser').on('click', 'tr', function(){
		
		if($(this).hasClass('selected')){
			//Remove classe que marca como selecionado
			$(this).removeClass('selected');
		} else {
			//Adiciona classe que marca como selecionado
			$(this).addClass('selected');
		}
		
	});

	//Seleciona lojas para montar roteiro para dado colaborador
	$('#selectLojasBtn').on('click', function(){
		//Verifica se foi selecionado ao menos um item
		var i = 0;
	
		//Pega o id de todos os itens selecionados e guarda em um array
		$('#colaboradorData table tr').each(function(){

			//Pega os itens apenas que estão selecionados
			if($(this).hasClass('selected')){
				i++;
			}
		})

		if(i <= 0){
			alert("Favor selecionar ao menos um colaborador");
		} else {

		}
	})

	//Selecionar colaboradores
	$('#selectColaBtn').on('click', function(){
		//Abre modal com lojas
		$( "#colaboradorModal" ).dialog({
			width: 600,
			show: {
		        effect: "blind",
		        duration: 500
	     	}
		});
	})

	//Pesquisa colaborador
	$('#consultarColaborador').on('click', function(){
		var toSearch = $('#toSearch').val();
		var buscaCampo = $('input[name=buscaCampo]:checked', '#colaboradoresForm').val()

		$.ajax({
			type: 'POST',
			data: {
				toSearch: toSearch,
				buscaCampo: buscaCampo
			},
			url: 'mod_operacional/ajax/carregaListaColaboradores.php',
			success: function (data){
				
				$('.listaColaboradores').empty();

				//Carrega lista em div
				$('.listaColaboradores').append(data);
			}
		})
	})

	//Adiciona usuario a lista para criar roteiro
	$('.listaColaboradores').on('click', '#addToList', function(event){
		event.preventDefault();
		event.stopPropagation();

		var itens = [];
		var i = 0;

		//Pega todos os colaboradores selecionados
		$('input[name=userCheck]:checked').each(function() {
				itens[i] = { raMat: $(this).val(), raNome: $(this).closest('td').next('td').next('td').html() };

				//Verifica se item existe
				if($('#mat_'+ $(this).val()).length > 0){
					alert("A matricula "+ $(this).val() + ' já foi adicionada');

					//Remove item do array já que o mesmo é duplicado
					itens = $.grep(itens, function( a ) {
						return a !== $(this).val();
					});
				} else {
					
					$.ajax({
						type: 'POST',
						data: {
							itens: itens
						},
						url: 'mod_operacional/ajax/geraListaColaboradores.php',
						success: function (data){
							$('#addDataUser').append(data);				
						}
					})	

					i--;
				}

				i++;

		});

		
	})

})