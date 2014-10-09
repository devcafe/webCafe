$(function(){
	/****************************************/
	/* General
	/****************************************/

	//Tha body of main table, where the data will be appended
	var table_gerUsuarios = $('#gerUsuarios_table tbody');

	//The amount of data to retrieve in each page
	var regsLimit = $('#gerUsuarios_regs option:selected').val();

	//The first page (it's a hidden input with value = 1)
	var page = $('#paginationController').val();

	//Pagination wrapper
	var paginationWrapper = $('#gerUsuarios_pagination');

	//Call the function on page load
	loadTable('1', regsLimit);

	//Mask some fields
	$('input[name=cep]').mask('00000-000');
	$('input[name=telefone]').mask('(00) 0000-0000');
	$('input[name=cpf]').mask('000.000.000-00');
	$('input[name=rg]').mask('000.000.000-00');

	//Function to make nine digit optional
	var nineDigit = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	options = {onKeyPress: function(val, e, field, options) {
		field.mask(nineDigit.apply({}, arguments), options);
 	}
	};

	//9 digit is optional in cell phone number
	$('input[name=celular]').mask(nineDigit, options);

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
			url: 'modulos/mod_telefonia/controller/ger_usuarios.php',
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
				$('#gerUsuarios_tableRegTotal').html(data['totalRegs']);

				//Show the total pages
				$("#gerUsuarios_tableTotalPages").html(data['totalPages']);

				//Check if the result dont return any data, in cases where the user
				//try to search for a value which do not exist
				if(data['totalPages'] <= 0){
					//Update the table
					table_gerUsuarios.empty();
					paginationWrapper.empty();

					//Append the information to user warning the query not returned any result
					table_gerUsuarios.append(""+
						"<tr>"+
							"<td colspan = '2'>Nenhum resultado encontrado</td>"+
						"</tr>"+
					"");

				} else if(page > data['totalPages']){ //Check if the user try to search for a page that does not exist
					alert("Página não existe");
				} else { //Return the data and append the pagination
					//Show actual page
					$('#gerUsuarios_tableRegPage').html(data['actualPage']);

					//To update table data, clear first
					table_gerUsuarios.empty();
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
						table_gerUsuarios.append(""+
							"<tr>"+
								"<td class = 'show width50 pull-left'>"+
									"<button id = 'show_"+ data[1][i].idUsuario +"' name = 'show' type='button' class='btn btn-default' data-toggle='modal' data-target='#show_usuario'>"+
									  "<span class='glyphicon glyphicon-search'></span>"+
									"</button>"+
								"</td>"+
								"<td>"+data[1][i].nome+"</td>"+
								"<td>"+data[1][i].celular+"</td>"+
								"<td>"+data[1][i].cep+"</td>"+
								"<td>"+data[1][i].endereco+"</td>"+
								"<td>"+data[1][i].bairro+"</td>"+
								"<td>"+data[1][i].cidade+"</td>"+
								"<td>"+data[1][i].uf+"</td>"+
								"<td class = 'width100'>"+
									"<button id = 'del_"+ data[1][i].idUsuario +"' name = 'delete' type='button' class='btn btn-danger pull-left'>"+
									  "<span class='glyphicon glyphicon-trash'></span>"+
									"</button>"+
									"<button id = 'edit_"+ data[1][i].idUsuario +"' name = 'edit' type='button' class='btn btn-warning pull-left' data-toggle='modal' data-target='#add_usuario'>"+
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
	$("#gerUsuarios_pagination").on('click', 'li a:not(.reticence)', function(){
		//Get the page number
		var page = $(this).attr('id').split('_')[1];

		//The amount of records to show in table
		var regsLimit = $('#gerUsuarios_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//This function is used to go page to page
	$("#gerUsuarios_pagination").on('click', 'li a.onePage', function(){
		//Get the operation (next or prev)
		var op = $(this).attr('id').split('_')[0];

		//The amount of records to show in table
		var regsLimit = $('#gerUsuarios_regs option:selected').val();

		//Get the search data to keep the filter
		$('#gerUsuarios_pagination_search').val();
		var searchVal = $('#gerUsuarios_pagination_search').val();

		//Check for op (next or prev)
		if(op == 'next'){
			//Get the page number
			var page = $(this).attr('id').split('_')[1];

			//Call the main function
			loadTable(page, regsLimit, searchVal);
		} else {
			//Get the page number
			var page = $(this).attr('id').split('_')[1];

			//Call the main function
			loadTable(page, regsLimit, searchVal);
		}
	});

	//This function is used to change the amount of data to show in page
	$('#gerUsuarios_regs').change(function(){
		//If uncomment this line, its able to possibility to keep the current page on change the amount of data to show 
		//var page = $('#gerLinhas_pagination li a.current').attr('id').split('_')[1];

		//Get the amount of records to show
		var regsLimit = $('#gerUsuarios_regs option:selected').val();

		//To keep the search filter
		var searchVal = $('#gerUsuarios_pagination_search').val();

		//Call the main function
		loadTable('1', regsLimit, searchVal);
	})

	//To go to one page on give a page number
	$('#gerUsuarios_pagination_go').click(function(){
		//Get the page number
		var page = $('#gerUsuarios_pagination_goPage').val();

		//To keep the amount of records to show in table
		var regsLimit = $('#gerUsuarios_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//Function to search for a value
	$('#gerUsuarios_pagination_search').keyup(function(){
		//Value for search
		var searchVal = $(this).val();

		//Back for page 1 after search
		var page = '1';

		//Amount of records to show in table
		var regsLimit = $('#gerUsuarios_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit, searchVal);
	})

	//This function is used to order the data
	$('#gerUsuarios_table thead th span').on('click', function(){
		//To keep the search filter
		var searchVal = $('#gerUsuarios_pagination_search').val();

		//Back to page 1 after order
		var page = '1';

		//The amount of records to show in table
		var regsLimit = $('#gerUsuarios_regs option:selected').val();

		//The field to order
		var field = $(this).parent().attr('id');

		//Variable used to order
		var oder = '';

		//Check what is the actual order
		if($(this).hasClass('glyphicon-chevron-down')){
			//Back all the others columns to default icon
			$('#gerUsuarios_table thead th span').removeClass("glyphicon-chevron-up");
			$('#gerUsuarios_table thead th span').addClass("glyphicon-chevron-down");

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
	
	//On click in the add a user, update the button attributes
	$('#gerUsuarios_addUsuarioBtn').on('click', function(){
		//Clear the form, beacause user can click first on edit
		$('#gerUsuarios_form')[0].reset();

		//Remove input hidden used to control the user that is changed
		$('input[name=edit_idUsuario]').remove();

		//Clear textarea
		$('textarea[name=observacoes]').html('');

		//Update button, its necessary because the operation changes
		$('#gerUsuarios_update').remove();
		$('#gerUsuarios_save').remove();
		$('#gerUsuarios_modalFooter').append("<button type='button' id = 'gerUsuarios_save' name = 'gerUsuarios_save' class='btn btn-primary'>Salvar</button>");
	})

	//Save user
	$('#gerUsuarios_modalFooter').on('click', '#gerUsuarios_save', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerUsuarios_regs option:selected').val();

		//Get data to save
		var formData = $('#gerUsuarios_form').serialize();

		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_usuarios.php',
			type: 'POST',
			data: {
				formData: formData,
				op: 'save' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Check the return
				if(data == 1){ //Means the insert as successful
					alert("Usuario cadastrado com sucesso!");

					//Reload table
					loadTable('1', regsLimit);

					//Hide the modal
					$('#add_usuario').modal('hide');

					//Clear the form
					$('#gerUsuarios_form')[0].reset();

				} else if(data == 2) { //Have a problem to insert
					alert("O usuario informado já foi cadastrado");
				} else {
					alert("Falha ao inserir usuario");
				}
			}
		});
	})

	//Function to populate fields before edit data
	$('#gerUsuarios_table').on('click', 'button[name=edit]', function(){
		//Get user id to edit
		var idUsuario = $(this).attr('id').split("_")[1];

		//Update button, its necessary because the operation changes
		$('#gerUsuarios_save').remove();
		$('#gerUsuarios_update').remove();
		$('#gerUsuarios_modalFooter').append("<button type='button' id = 'gerUsuarios_update' name = 'gerUsuarios_update' class='btn btn-primary'>Gravar</button>");

		//Add a hidden input to control the user
		$('#gerUsuarios_form').append('<input type = "hidden" value = "'+ idUsuario +'" name = "edit_idUsuario"> ');

		//First populate the user data in fields
		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_usuarios.php',
			type: 'POST',
			data: {
				idUsuario: idUsuario, //User id to load data
				op: 'loadData' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Popupate fields
				$('input[name=nome]').val(data.nome);
				$('input[name=telefone]').val(data.telefone);
				$('input[name=celular]').val(data.celular);
				$('input[name=cep]').val(data.cep);
				$('input[name=endereco]').val(data.endereco);			
				$('input[name=bairro]').val(data.bairro);	
				$('input[name=cidade]').val(data.cidade);	
				$('input[name=uf]').val(data.uf);	
				$('input[name=rg]').val(data.rg);	
				$('input[name=profissao]').val(data.profissao);	
				$('textarea[name=observacoes]').html(data.observacoes);
				$('input[name=cpf]').val(data.cpf);	
			}
		})
	})

	//Function to edit data
	$('#gerUsuarios_modalFooter').on('click', '#gerUsuarios_update', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerUsuarios_regs option:selected').val();

		//The user to update
		var idUsuario = $('input[name=edit_idUsuario]').val();

		//Get data to update
		var formData = $('#gerUsuarios_form').serialize();

		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_usuarios.php',
			type: 'POST',
			data: {
				formData: formData,
				idUsuario: idUsuario,
				op: 'update' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Check the return
				if(data == 1){ //Means the update as successful
					alert("Usuario alterado com sucesso!");

					//Reload table
					loadTable('1', regsLimit);

					//Hide the modal
					$('#add_usuario').modal('hide');

					//Clear the form
					$('#gerUsuarios_form')[0].reset();

				} else { //Have a problem to insert
					alert("Falha ao atualizar usuario");
				}
			}
		});
	})

	//Function to delete user
	$('#gerUsuarios_table').on('click', 'button[name=delete]', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerUsuarios_regs option:selected').val();

		//The user to delete
		var idUsuario = $(this).attr('id').split("_")[1];

		//Ask user if he really wanna delete the record
		var anwswer = confirm("Tem certeza que deseja remover esse usuario?");

		if(anwswer){
			$.ajax({
				url: 'modulos/mod_telefonia/controller/ger_usuarios.php',
				type: 'POST',
				data: {
					idUsuario: idUsuario,
					op: 'delete' //The optional operation to pass for back-end
				},
				dataType: 'json',
				success: function(data){
					//Check the return
					if(data == 1){ //Means the update as successful
						alert("Usuario removido com sucesso!");

						//Reload table
						loadTable('1', regsLimit);
					} else { //Have a problem to insert
						alert("Falha ao remover usuario");
					}
				}
			});
		}
	});

	//Function to see the user data
	$('#gerUsuarios_table').on('click', 'button[name=show]', function(){
		var idUsuario = $(this).attr('id').split("_")[1];

		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_usuarios.php',
			type: 'POST',
			data: {
				idUsuario: idUsuario, //User id to load data
				op: 'loadData' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Popupate fields
				$('#show_nome').html(data.nome);
				$('#show_telefone').html(data.telefone);
				$('#show_celular').html(data.celular);
				$('#show_cep').html(data.cep);
				$('#show_endereco').html(data.endereco);
				$('#show_bairro').html(data.bairro);
				$('#show_cidade').html(data.cidade);
				$('#show_uf').html(data.uf);
				$('#show_rg').html(data.rg);
				$('#show_cpf').html(data.cpf);
				$('#show_profissao').html(data.profissao);
				$('#show_observacoes').html(data.observacoes);
			}
		})
	});

	//Function to export to excel
	$("#gerUsuarios_exportExcel").click(function(e) {
		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_usuarios.php',
			type: 'POST',
			data: {
				op: 'exportExcel' //The optional operation to pass for back-end
			},
			success:function(data){
				window.location = "modulos/mod_telefonia/controller/ger_usuarios.php?export=true";
			}
		})
	});
})
