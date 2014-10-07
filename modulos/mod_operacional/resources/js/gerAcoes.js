$(document).ready(function() {

	/*************************************/
	/* Inicialização
	/*************************************/
	//Esconde modals
	$('#addAcaoModal').hide();
	$('#alteraAcaoModal').hide();

	//Carrega lista de ações
	carregaAcoes();

	/*************************************/
	/* Funções
	/*************************************/
	//Cadastrar ação
	$('.addAcao').on('click', function(){
		//Limpa dados ao abrir modal
		$('#nomeAcaoCad').val('');
		$('#listaColaboradoresAcao').empty();
		$('.listaColaboradoresAcaoToSave').empty();

		//Abre modal com lojas
		$( "#addAcaoModal" ).dialog({
			width: 600,
			show: {
		        effect: "blind",
		        duration: 500
	     	}
		});

	})

	//Adiciona colcaboradores a lista
	$('#colaboradoresSearch').on('keyup', function(){
		var colaboradoresSearch = $('#colaboradoresSearch').val();

		$.ajax({
			type: 'POST',
			data: {
				colaboradoresSearch: colaboradoresSearch
			},
			url: 'mod_operacional/ajax/carregaListaColaboradoresAcao.php',
			success: function (data){
				
				$('.listaColaboradoresAcao').empty();

				//Carrega lista em div
				$('.listaColaboradoresAcao').append(data);
			}
		})
	});

	//Adiciona colcaboradores a lista (alterar ação)
	$('#alterarAcaoForm').on('keyup', '#colaboradoresSearchAlt', function(){
		var colaboradoresSearch = $('#colaboradoresSearchAlt').val();

		$.ajax({
			type: 'POST',
			data: {
				colaboradoresSearch: colaboradoresSearch
			},
			url: 'mod_operacional/ajax/carregaListaColaboradoresAcaoAlt.php',
			success: function (data){
				
				$('.listaColaboradoresAcaoAlt').empty();

				//Carrega lista em div
				$('.listaColaboradoresAcaoAlt').append(data);
			}
		})
	});

	//Adiciona na lista que será inserida no banco
	$('.listaColaboradoresAcao').on('click', '.checkBox', function(){
		var id = $(this).attr('id');
		var nome = $(this).html();

		if($('.listaColaboradoresAcaoToSave tr.'+id).length){
			alert("Este usuário já foi adicionado");
		} else {
			$(this).remove();

			$('.listaColaboradoresAcaoToSave').append('<tr class = '+id+'> <td>'+ nome +'</td> </tr>');
			$('.listaColaboradoresAcaoToSave').append('<tr> <td> <input type = "hidden" name = "userId" value = '+ id +'> </td> </tr>');
		}

	})

	//Adiciona na lista que será inserida no banco (tela para alterar ação)
	$('#alterarAcaoForm').on('click', '.listaColaboradoresAcaoAlt .checkBox', function(){
		var id = $(this).attr('id');
		var nome = $(this).html();

		if($('.colaboradoresToSaveAlt tr.'+id).length){
			alert("Este usuário já foi adicionado");
		} else {

			$(this).remove();

			$('.colaboradoresToSaveAlt').append('<tr class = '+id+'> <td>'+ nome +'</td> </tr>');
			$('.colaboradoresToSaveAlt').append('<tr> <td> <input type = "hidden" class = "'+ id.split("_")[1] +'" name = "userId" value = "'+ id.split("_")[1] +'"> </td> </tr>');
		}

	})

	//Remove colaboradores da lista para não adicionar
	$('.listaColaboradoresAcaoToSave').on('click', 'tr', function(){
		$(this).remove();
	});

	//Remove colaboradores da lista para não adicionar (tela para alterar ação)
	$('#alterarAcaoForm').on('click', '.colaboradoresToSaveAlt tr:not(:first-child)', function(){
		$(this).remove();
		var idHidden = $(this).attr('class').split("_")[1];

		$('.'+idHidden).remove();
	});

	//Grava ação no banco
	$('#cadastraAcao').on('click', function(){

		var nomeAcao = $('#nomeAcaoCad').val();

		var itens = '';

		$('.colaboradoresToSave input[type=hidden]').each(function(){
			itens += $(this).val()+',';
		})

		itens = itens.substring(0, itens.length - 1);

		$.ajax({
			type: 'POST',
			data: {
				itens: itens,
				nomeAcao: nomeAcao
			},
			url: 'mod_operacional/ajax/cadAcao.php',
			success: function (data){
				alert(data);

				$( "#addAcaoModal" ).dialog( 'destroy' );

				carregaAcoes();
			}
		})

	})

	//Carrega lista de ações
	function carregaAcoes(){
		var pag = $('#pagina').val();

		$.ajax({
			type: 'POST',
			data: {
				pag: pag
			},
			url: 'mod_operacional/ajax/carregaAcoes.php',
			success: function (data){
				$('.acoesList').empty();
				$('.acoesList').append(data);
			}
		})
		
	}

	//Altera ação
	$('.acoesList').on('dblclick', '#acoesTable tr', function(){
		var id = $(this).attr('id');

		//Carrega dados da ação no formulário
		$.ajax({
			type: 'POST',
			data: {
				id: id
			},
			url: 'mod_operacional/ajax/carregaDadosAcao.php',
			success: function (data){
				//Abre modal com lojas
				$( "#alteraAcaoModal" ).dialog({
					width: 600,
					show: {
				        effect: "blind",
				        duration: 500
			     	}
				});

				$('#alterarAcaoForm').empty();
				$('#alterarAcaoForm').append(data);
			}
		})
		
	})

	//Envia dados para gravar no banco
	$('#alterarAcaoForm').on('click', '#alterarAcao', function(){
		var nomeAcao = $('#nomeAcaoAlt').val();
		var idAcaoAlt = $('#idAcaoAlt').val();
		var itens = '';

		$('.colaboradoresToSaveAlt input[type=hidden]').each(function(){
			itens += $(this).val()+',';
		})

		itens = itens.substring(0, itens.length - 1);

		$.ajax({
			type: 'POST',
			data: {
				itens: itens,
				nomeAcao: nomeAcao,
				idAcaoAlt: idAcaoAlt
			},
			url: 'mod_operacional/ajax/altAcao.php',
			success: function (data){
				alert(data);

				carregaAcoes();

				$( "#alteraAcaoModal" ).dialog( 'destroy' );
			}
		})
	});


	//Muda de página
	$('.acoesList').on('click', '.toPage', function(){

		//Verifica o novo id
		var newPage = $(this).attr('id');

		//Passa o novo id a um elemento hidden
		$('#pagina').val(newPage);

		//Chama a função para carregar proxima pagina
		carregaAcoes();

	})

	//Marca campos como selecionados ao clicar em uma ação
	$('.acoesList').on('click', 'table tr:not(:first-child)', function(){
		
		if($(this).hasClass('selected')){
			//Remove classe que marca como selecionado
			$(this).removeClass('selected');
		} else {
			//Adiciona classe que marca como selecionado
			$(this).addClass('selected');
		}
		
	});

	//Deleta itens selecionados
	$('.delAcao').on('click', function(){
		var i = 0;
		var itens = [];

		//Pega o id de todos os itens selecionados e guarda em um array
		$('table tr:not(:first-child)').each(function(){
			//Pega os itens apenas que estão selecionados
			if($(this).hasClass('selected')){
				itens[i] = $(this).attr('id');
				i++;
			}
		})

		if(itens == ''){
			alert("Favor selecionar ao menos um item");
		} else {
			//Solicita confirmação antes de apagar
			var answer = confirm("Tem certeza que deseja apagar o(s) iten(s) selecionado(s)?");

			if(answer){
				//Envia array com os itens selecionados para exclusão
				$.ajax({
					type: 'POST',
					url: 'mod_operacional/ajax/deletaAcao.php',
					data: {
						itens: itens
					},
					success: function(data){
						//Recarrega lista para atualizar dados
						carregaAcoes();

						alert(data);
					}
				})
			}
			
		}
		
	})
});