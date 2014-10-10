$(function(){
	/****************************************/
	/* General
	/****************************************/

	//Tha body of main table, where the data will be appended
	var table_gerLojas = $('#gerLojas_table tbody');

	//The amount of data to retrieve in each page
	var regsLimit = $('#gerLojas_regs option:selected').val();

	//The first page (it's a hidden input with value = 1)
	var page = $('#paginationController').val();

	//Pagination wrapper
	var paginationWrapper = $('#gerLojas_pagination');

	//Call the function on page load
	loadTable('1', regsLimit);

	//mask fields
	$("input[name=cnpj]").mask("99.999.999/9999-99");
	$("input[name=cep]").mask("99999-999");
	$("input[name=estabReceitaCEP]").mask("99999-999");

	/****************************************/
	/* Functions
	/****************************************/

	//Main funcion to load table.
	//This funcion need page and regsLimit as mandatory, searchVal and order as optional.
	function loadTable(page, regsLimit, searchVal, order){
		//Searchval is optional
		searchVal = typeof searchVal !== 'undefined' ? searchVal : '';

		//Order is optional
		order = typeof order !== 'undefined' ? order : '';

		//Pagination variable, to mount the pagination in DOM one time
		var pagination = '';

		//Send ajax to get data using the parameters received
		//The data returner is a json object
		$.ajax({
			url: 'modulos/mod_operacional/controller/ger_lojas.php',
			type: 'POST',
			data: {
				regsLimit: regsLimit, //The amount of regs i wanna show in page
				page: page, //The actual page
				searchVal: searchVal, //The search value
				order: order, //The order field and type (DESC or ASC)
				op: 'loadTable' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){	
				//Show the total regs				
				$('#gerLojas_tableRegTotal').html(data['totalRegs']);

				//Show the total pages
				$("#gerLojas_tableTotalPages").html(data['totalPages']);

				//Check if the result dont return any data, in cases where the user
				//try to search for a value which do not exist
				if(data['totalPages'] <= 0){
					//Update the table
					table_gerLojas.empty();
					paginationWrapper.empty();

					//Append the information to user warning the query not returned any result
					table_gerLojas.append(""+
						"<tr>"+
							"<td colspan = '2'>Nenhum resultado encontrado</td>"+
						"</tr>"+
					"");

				} else if(page > data['totalPages']){ //Check if the user try to search for a page that does not exist
					alert("Página não existe");
				} else { //Return the data and append the pagination
					//Show actual page
					$('#gerLojas_tableRegPage').html(data['actualPage']);

					//To update table data, clear first
					table_gerLojas.empty();
					paginationWrapper.empty();

					//Check if page is diferent from 1, because its not possible to go a page previous 1
					if(page != 1){
						pagination += '<li><a href="#" class = "onePage" id = "prev_'+(parseInt(page)-1)+'">&laquo;</a></li>';
					} else {
						pagination += '<li><a href="#" class = "onePage" id = "prev_1">&laquo;</a></li>';
					}

					//Loop for json object to append data in table
					//data['totalPages'] is passed from back-end, its the total of data returned from query
					for(var i=1;i<=data['totalPages'];i++){
						//Checks if the count is bigger or equal the total pages - 1, 
						//beacause i wanna to show 2 pages after "..."
						//Ex.: 1, 2, 3, ... , 6, 7
						if(i >= data['totalPages'] - 1){
							if(i == page){
								pagination += '<li class = "active"><a href="#" class = "current" id = "page_'+i+'">'+i+'</a></li>';
							} else {
								pagination += '<li><a href="#" id = "page_'+i+'">'+i+'</a></li>';
							}
						} else if(i <= 5) { //Checks if the page is minor or equal 5, because i wanna to show 5 records in pagination before "..."
							if(i == page){
								pagination += '<li class = "active"><a href="#" class = "current" id = "page_'+i+'">'+i+'</a></li>';
							} else {
								pagination += '<li><a href="#" id = "page_'+i+'">'+i+'</a></li>';
							}
						} else if(i == 6) { //If the count is equal 6, show the "..."
							if(page > 5 && page < data['totalPages'] - 1){
								pagination += '<li class = "active"><a href="#" class = "current" id = "page_'+page+'">'+page+'</a></li>';
							}
							pagination += '<li><a href="#" class = "reticence" >...</a></li>';
						}
					}

					//Check if page is bigger than last page, because its not possible to go a page after the last
					if(page >= data['totalPages']){
						pagination += '<li><a href="#" class = "onePage" id = "next_'+page+'">&raquo;</a></li>';
					} else {
						pagination += '<li><a href="#" class = "onePage" id = "next_'+(parseInt(page)+1)+'">&raquo;</a></li>';
					}

					//Append the pagination
					paginationWrapper.append(pagination);

					//Append data in table
					for(var i=0;i<data[1].length;i++){					
						table_gerLojas.append(""+
							"<tr>"+
								"<td class = 'show width50 pull-left'>"+
									"<button id = 'show_"+ data[1][i].idLoja +"' name = 'show' type='button' class='btn btn-default' data-toggle='modal' data-target='#show_loja'>"+
									  "<span class='glyphicon glyphicon-search'></span>"+
									"</button>"+
								"</td>"+
								"<td>"+data[1][i].idLoja+"</td>"+
								"<td>"+data[1][i].cnpj+"</td>"+
								"<td>"+data[1][i].bandeira+"</td>"+
								"<td>"+data[1][i].nome+"</td>"+
								"<td>"+data[1][i].rua+"</td>"+
								"<td>"+data[1][i].numero+"</td>"+
								"<td>"+data[1][i].complemento+"</td>"+
								"<td>"+data[1][i].bairro+"</td>"+
								"<td>"+data[1][i].cidade+"</td>"+
								"<td>"+data[1][i].uf+"</td>"+
								"<td>"+data[1][i].cep+"</td>"+
								"<td class = 'width100'>"+
									"<button id = 'del_"+ data[1][i].idLoja +"' name = 'delete' type='button' class='btn btn-danger pull-left'>"+
									  "<span class='glyphicon glyphicon-trash'></span>"+
									"</button>"+
									"<button id = 'edit_"+ data[1][i].idLoja +"' name = 'edit' type='button' class='btn btn-warning pull-left' data-toggle='modal' data-target='#add_Loja'>"+
									  "<span class='glyphicon glyphicon-pencil'></span>"+
									"</button>"+
								"</td>"+
							"</tr>"+
						"");
					}
				}
			}
		})
	}

	//This function go to a specific page, if user click in the pagination
	$("#gerLojas_pagination").on('click', 'li a:not(.reticence)', function(){
		//Get the page number
		var page = $(this).attr('id').split('_')[1];

		//The amount of records to show in table
		var regsLimit = $('#gerLojas_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//This function is used to go page to page
	$("#gerLojas_pagination").on('click', 'li a.onePage', function(){
		//Get the operation (next or prev)
		var op = $(this).attr('id').split('_')[0];

		//The amount of records to show in table
		var regsLimit = $('#gerLojas_regs option:selected').val();

		//Get the search data to keep the filter
		$('#gerLojas_pagination_search').val();
		var searchVal = $('#gerLojas_pagination_search').val();

		//Check for op (next or prev)
		if(op == 'next'){
			//Get the page number
			var page = $(this).attr('id').split('_')[1];

			//Call the main function
			loadTable(page, regsLimit, searchVal);
		} else {
			//Get the page number
			var page = $(this).attr('id').split('_')[1];

			//Call the main functio
			loadTable(page, regsLimit, searchVal);
		}
	});

	//This function is used to change the amount of data to show in page
	$('#gerLojas_regs').change(function(){
		//If uncomment this store, its able to possibility to keep the current page on change the amount of data to show 
		//var page = $('#gerLojas_pagination li a.current').attr('id').split('_')[1];

		//Get the amount of records to show
		var regsLimit = $('#gerLojas_regs option:selected').val();

		//To keep the search filter
		var searchVal = $('#gerLojas_pagination_search').val();

		//Call the main function
		loadTable('1', regsLimit, searchVal);
	})

	//To go to one page on give a page number
	$('#gerLojas_pagination_go').click(function(){
		//Get the page number
		var page = $('#gerLojas_pagination_goPage').val();

		//To keep the amount of records to show in table
		var regsLimit = $('#gerLojas_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//Function to search for a value
	$('#gerLojas_pagination_search').keyup(function(){
		//Value for search
		var searchVal = $(this).val();

		//Back for page 1 after search
		var page = '1';

		//Amount of records to show in table
		var regsLimit = $('#gerLojas_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit, searchVal);
	})

	//This function is used to order the data
	$('#gerLojas_table thead th span').on('click', function(){
		//To keep the search filter
		var searchVal = $('#gerLojas_pagination_search').val();

		//Back to page 1 after order
		var page = '1';

		//The amount of records to show in table
		var regsLimit = $('#gerLojas_regs option:selected').val();

		//The field to order
		var field = $(this).parent().attr('id');

		//Variable used to order
		var oder = '';

		//Check what is the actual order
		if($(this).hasClass('glyphicon-chevron-down')){
			//Back all the others columns to default icon
			$('#gerLojas_table thead th span').removeClass("glyphicon-chevron-up");
			$('#gerLojas_table thead th span').addClass("glyphicon-chevron-down");

			//Change only the clicked column icon to UP
			$(this).removeClass("glyphicon-chevron-down");
			$(this).addClass("glyphicon-chevron-up");

			//Field to order
			order = field + " ASC";

			//Call the main function
			loadTable(page, regsLimit, searchVal, order);
		} else {
			//Change only the clicked column icon to DOWN
			$(this).addClass("glyphicon-chevron-down");
			$(this).removeClass("glyphicon-chevron-up");

			//Field to order
			order = field + " DESC";

			//Call the main function
			loadTable(page, regsLimit, searchVal, order);
		}
	})
	
	//On click in the add store, update the button attributes
	$('#gerLojas_addLojaBtn').on('click', function(){

		//Call the function to load flag data and populate select
		loadFlagData();

		//Clear the form, beacause user can click first on edit
		$('#gerLojas_form')[0].reset();

		//Clear textarea
		$('textarea[name=observacoes]').html('');

		//Remove input hidden used to control the store that is changed
		$('input[name=edit_idLoja]').remove();

		//Enabled numLoja field
		$('input[name=numLoja]').prop('readonly', false);

		//Update button, its necessary because the operation changes
		$('#gerLojas_update').remove();
		$('#gerLojas_save').remove();
		$('#gerLojas_modalFooter').append("<button type='button' id = 'gerLojas_save' name = 'gerLojas_save' class='btn btn-primary'>Salvar</button>");
	})

	function loadFlagData(){
    	//Send a ajax to populate select
    	//Its used "select2" plugin to able user to search on select list
	    $.ajax({
	    	url: 'modulos/mod_operacional/controller/ger_lojas.php',
			type: 'POST',
			data: {
				op: 'autoCompleteFlag' //The optional operation to pass for back-end
			},
			dataType: 'json',	            
	        success: function(data) {
	        	var count = 0;

	        	//Loop tougth the returned data to populate the select
				$.each(data, function(){
					$('select[name=bandeira]').append('<option value = "'+ data[count].idBandeira +'">'+ data[count].bandeira +'</option>');		
					count++;
				})
	        }
	    }).done(function(){ //After done ajax, call select2 function to active plugin on select
	    	$("select[name=bandeira]").select2({ formatNoMatches: "Nenhuma bandeira encontrada" });
	    })
	}

	//Save new store
	$('#gerLojas_modalFooter').on('click', '#gerLojas_save', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerLojas_regs option:selected').val();

		//Get data to save
		var formData = $('#gerLojas_form').serialize();
		$.ajax({
			url: 'modulos/mod_operacional/controller/ger_lojas.php',
			type: 'POST',
			data: {
				formData: formData,
				op: 'save' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Check the return
				if(data == 1){ //Means the insert as successful
					console.log(data);
					alert("Loja cadastrada com sucesso!");

					//Reload table
					loadTable('1', regsLimit);

					//Hide the modal
					$('#add_loja').modal('hide');

					//Clear the form
					$('#gerLojas_form')[0].reset();

					//Clear textarea
					$('textarea[name=observacoes]').html('');
				} else if(data == 2) { //Have a problem to insert
					alert("A loja informada já foi cadastrada");
				} else {
					alert("Falha ao inserir loja");
				}
			}
		});
	})

	// //Function to populate fields before edit data
	// $('#gerLojas_table').on('click', 'button[name=edit]', function(){
	// 	//Get store id to edit
	// 	var idLoja = $(this).attr('id').split("_")[1];

	// 	//Update button, its necessary because the operation changes
	// 	$('#gerLojas_save').remove();
	// 	$('#gerLojas_update').remove();
	// 	$('#gerLojas_modalFooter').append("<button type='button' id = 'gerLojas_update' name = 'gerLojas_update' class='btn btn-primary'>Gravar</button>");

	// 	//Add a hidden input to control the store
	// 	$('#gerLojas_form').append('<input type = "hidden" value = "'+ idLoja +'" name = "edit_idLoja"> ');

	// 	//First populate the store data in fields
	// 	$.ajax({
	// 		url: 'modulos/mod_operacional/controller/ger_lojas.php',
	// 		type: 'POST',
	// 		data: {
	// 			idLoja: idLoja, //store id to load data
	// 			op: 'loadData' //The optional operation to pass for back-end
	// 		},
	// 		dataType: 'json',
	// 		success: function(data){
	// 			//Popupate fields
	// 			$('input[name=numLoja]').val(data.numLoja);
	// 			$('input[name=plano]').val(data.plano);
	// 			$('input[name=iccid]').val(data.iccid);
	// 			$('select[name=operadora]').val(data.operadora);
	// 			$('select[name=status]').val(data.LojaStatus);
	// 			$('textarea[name=observacoes]').html(data.observacoes);

	// 			//Disable numLoja field
	// 			$('input[name=numLoja]').prop('readonly', true);
	// 		}
	// 	})
	// })

	// //Function to edit data
	// $('#gerLojas_modalFooter').on('click', '#gerLojas_update', function(){
	// 	//The amount of records to show in table, used to reload table
	// 	var regsLimit = $('#gerLojas_regs option:selected').val();

	// 	//The store that user want to update
	// 	var idLoja = $('input[name=edit_idLoja]').val();

	// 	//Get data to update
	// 	var formData = $('#gerLojas_form').serialize();

	// 	$.ajax({
	// 		url: 'modulos/mod_operacional/controller/ger_lojas.php',
	// 		type: 'POST',
	// 		data: {
	// 			formData: formData,
	// 			idLoja: idLoja,
	// 			op: 'update' //The optional operation to pass for back-end
	// 		},
	// 		dataType: 'json',
	// 		success: function(data){
	// 			//Check the return
	// 			if(data == 1){ //Means the update as successful
	// 				alert("Loja alterada com sucesso!");

	// 				//Reload table
	// 				loadTable('1', regsLimit);

	// 				//Hide the modal
	// 				$('#add_Loja').modal('hide');

	// 				//Clear the form
	// 				$('#gerLojas_form')[0].reset();

	// 				//Clear textarea
	// 				$('textarea[name=observacoes]').html('');
	// 			} else { //Have a problem to insert
	// 				alert("Falha ao atualizar Loja");
	// 			}
	// 		}
	// 	});
	// })

	//Function to delete store
	$('#gerLojas_table').on('click', 'button[name=delete]', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerLojas_regs option:selected').val();

		//The store that user want to delete
		var idLoja = $(this).attr('id').split("_")[1];

		//Ask user if he really wanna delete the record
		var anwswer = confirm("Tem certeza que deseja remover essa Loja?");

		if(anwswer){
			$.ajax({
				url: 'modulos/mod_operacional/controller/ger_lojas.php',
				type: 'POST',
				data: {
					idLoja: idLoja,
					op: 'delete' //The optional operation to pass for back-end
				},
				dataType: 'json',
				success: function(data){
					//Check the return
					if(data == 1){ //Means the update as successful
						alert("Loja removida com sucesso!");

						//Reload table
						loadTable('1', regsLimit);
					} else { //Have a problem to insert
						alert("Falha ao remover Loja");
					}
				}
			});
		}
	});
	$('#teste').click(function(){
		console.log($('select[name=bandeira]').val());
	})
	//Function to see the store
	$('#gerLojas_table').on('click', 'button[name=show]', function(){
		var idLoja = $(this).attr('id').split("_")[1];			

		$.ajax({
			url: 'modulos/mod_operacional/controller/ger_lojas.php',
			type: 'POST',
			data: {
				idLoja: idLoja, //Store id to load data
				op: 'loadData' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Popupate fields
				$('#show_idLoja').html(data.idLoja);
				$('#show_cnpj').html(data.cnpj);
				$('#show_bandeira').html(data.bandeira);
				$('#show_nome').html(data.nome);
				$('#show_rua').html(data.rua);
				$('#show_numero').html(data.numero);
				$('#show_complemento').html(data.complemento);
				$('#show_bairro').html(data.bairro);				
				$('#show_cidade').html(data.cidade);
				$('#show_uf').html(data.uf);
				$('#show_cep').html(data.cep);
				$('#show_estabReceitaAberturaData').html(data.estabReceitaAberturaData);
				$('#show_estabReceitaRazaoSocial').html(data.estabReceitaRazaoSocial);
				$('#show_estabReceitaNomeEmpresarial').html(data.estabReceitaNomeEmpresarial);
				$('#show_estabReceitaNF').html(data.estabReceitaNF);
				$('#show_estabReceitaEndereco').html(data.estabReceitaEndereco);
				$('#show_estabReceitaNumero').html(data.estabReceitaNumero);
				$('#show_estabReceitaComplemento').html(data.estabReceitaComplemento);
				$('#show_estabReceitaBairro').html(data.estabReceitaBairro);
				$('#show_estabReceitaCidade').html(data.estabReceitaCidade);
				$('#show_estabReceitaUF').html(data.estabReceitaUF);
				$('#show_estabReceitaCEP').html(data.estabReceitaCEP);
				$('#show_estabReceitaSituacao').html(data.estabReceitaSituacao);
				$('#show_estabReceitaSituacaoData').html(data.estabReceitaSituacaoData);
				$('#show_estabTel01').html(data.estabTel01);
				$('#show_estabTel02').html(data.estabTel02);
				$('#show_dataFechamento').html(data.dataFechamento);
			
			}
		})
	});

	// //Function to export to excel
	// $("#gerLojas_exportExcel").click(function(e) {
	// 	$.ajax({
	// 		url: 'modulos/mod_operacional/controller/ger_lojas.php',
	// 		type: 'POST',
	// 		data: {
	// 			op: 'exportExcel' //The optional operation to pass for back-end
	// 		},
	// 		success:function(data){
	// 			window.location = "modulos/mod_operacional/controller/ger_lojas.php?export=true";
	// 		}
	// 	})
	// });

	function cleanFields(){
		$('input[name=rua]').val('');
		$('input[name=bairro]').val('');
		$('input[name=cidade]').val('');
		$('input[name=uf]').val('');
	}

	$('input[name=cep]').focusout(function(){
		cleanFields();
		var cep = $('input[name=cep]').val();		
		$.ajax({
			url: 'modulos/mod_operacional/controller/ger_lojas.php',
			type : 'POST', 
			data: {
				cep:cep,
				op:'loadCep',
			},
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.sucesso == 1){										
					$('input[name=rua]').val(data.rua);
					$('input[name=bairro]').val(data.bairro);
					$('input[name=cidade]').val(data.cidade);
					$('input[name=uf]').val(data.estado);
					$('input[name=numero]').focus();
					
				}
			}
		});   
		return false;  

	});

		function cleanFieldsReceita(){
		$('input[name=rua]').val('');
		$('input[name=bairro]').val('');
		$('input[name=cidade]').val('');
		$('input[name=uf]').val('');
	}

	$('input[name=estabReceitaCEP]').focusout(function(){
		cleanFieldsReceita();
		var cep = $('input[name=estabReceitaCEP]').val();		
		$.ajax({
			url: 'modulos/mod_operacional/controller/ger_lojas.php',
			type : 'POST', 
			data: {
				cep:cep,
				op:'loadCep',
			},
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.sucesso == 1){										
					$('input[name=estabReceitaEndereco]').val(data.rua);
					$('input[name=estabReceitaBairro]').val(data.bairro);
					$('input[name=estabReceitaCidade]').val(data.cidade);
					$('input[name=estabReceitaUF]').val(data.estado);
					$('input[name=estabReceitaNumero]').focus();
					
				}
			}
		});   
		return false;  

	});
 
 
		

	
	
})
