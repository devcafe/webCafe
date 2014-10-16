$(function(){
	/****************************************/
	/* General
	/****************************************/

	//Tha body of main table, where the data will be appended
	var table_gerSysUsuarios = $('#gerSysUsuarios_table tbody');

	//The amount of data to retrieve in each page
	var regsLimit = $('#gerSysUsuarios_regs option:selected').val();

	//The first page (it's a hidden input with value = 1)
	var page = $('#paginationController').val();

	//Pagination wrapper
	var paginationWrapper = $('#gerSysUsuarios_pagination');

	//Call the function on page load
	loadTable('1', regsLimit);


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
			url: 'modulos/mod_gerencial/controller/ger_sysUsuarios.php',
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
				$('#gerSysUsuarios_tableRegTotal').html(data['totalRegs']);

				//Show the total pages
				$("#gerSysUsuarios_tableTotalPages").html(data['totalPages']);

				//Check if the result dont return any data, in cases where the user
				//try to search for a value which do not exist
				if(data['totalPages'] <= 0){
					//Update the table
					table_gerSysUsuarios.empty();
					paginationWrapper.empty();

					//Append the information to user warning the query not returned any result
					table_gerSysUsuarios.append(""+
						"<tr>"+
							"<td colspan = '2'>Nenhum resultado encontrado</td>"+
						"</tr>"+
					"");

				} else if(page > data['totalPages']){ //Check if the user try to search for a page that does not exist
					alert("Página não existe");
				} else { //Return the data and append the pagination
					//Show actual page
					$('#gerSysUsuarios_tableRegPage').html(data['actualPage']);

					//To update table data, clear first
					table_gerSysUsuarios.empty();
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

					//Check if user have rigths to view user info
					if($('input[name=accessView]').length <= 0){
						var disabledView = 'disabled';
					} else {
						var disabledView = '';
					}

					//Check if user have rigths to delete user
					if($('input[name=accessDelete]').length <= 0){
						var disabledDelete = 'disabled';
					} else {
						var disabledDelete = '';
					}

					//Check if user have rigths to edit user
					if($('input[name=accessEdit]').length <= 0){
						var disabledEdit = 'disabled';
					} else {
						var disabledEdit = '';
					}

					//Append data in table
					for(var i=0;i<data[1].length;i++){					
						table_gerSysUsuarios.append(""+
							"<tr>"+
								"<td class = 'show width50 pull-left'>"+
									"<button "+disabledView+" id = 'show_"+ data[1][i].idUser +"' name = 'show' type='button' class='btn btn-default' data-toggle='modal' data-target='#show_sysUsuario'>"+
									  "<span class='glyphicon glyphicon-search'></span>"+
									"</button>"+
								"</td>"+
								"<td>"+data[1][i].firstName+"</td>"+
								"<td>"+data[1][i].user+"</td>"+
								"<td>"+data[1][i].email+"</td>"+
								"<td>"+data[1][i].departamento+"</td>"+
								"<td class = 'width100'>"+
									"<button "+disabledDelete+" id = 'del_"+ data[1][i].idUser +"' name = 'delete' type='button' class='btn btn-danger pull-left'>"+
									  "<span class='glyphicon glyphicon-trash'></span>"+
									"</button>"+
									"<button "+disabledEdit+" id = 'edit_"+ data[1][i].idUser +"' name = 'edit' type='button' class='btn btn-warning pull-left' data-toggle='modal' data-target='#add_sysUsuario'>"+
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
	$("#gerSysUsuarios_pagination").on('click', 'li a:not(.reticence)', function(){
		//Get the page number
		var page = $(this).attr('id').split('_')[1];

		//The amount of records to show in table
		var regsLimit = $('#gerSysUsuarios_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//This function is used to go page to page
	$("#gerSysUsuarios_pagination").on('click', 'li a.onePage', function(){
		//Get the operation (next or prev)
		var op = $(this).attr('id').split('_')[0];

		//The amount of records to show in table
		var regsLimit = $('#gerSysUsuarios_regs option:selected').val();

		//Get the search data to keep the filter
		$('#gerSysUsuarios_pagination_search').val();
		var searchVal = $('#gerSysUsuarios_pagination_search').val();

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
	$('#gerSysUsuarios_regs').change(function(){
		//If uncomment this line, its able to possibility to keep the current page on change the amount of data to show 
		//var page = $('#gerLinhas_pagination li a.current').attr('id').split('_')[1];

		//Get the amount of records to show
		var regsLimit = $('#gerSysUsuarios_regs option:selected').val();

		//To keep the search filter
		var searchVal = $('#gerSysUsuarios_pagination_search').val();

		//Call the main function
		loadTable('1', regsLimit, searchVal);
	})

	//To go to one page on give a page number
	$('#gerSysUsuarios_pagination_go').click(function(){
		//Get the page number
		var page = $('#gerSysUsuarios_pagination_goPage').val();

		//To keep the amount of records to show in table
		var regsLimit = $('#gerSysUsuarios_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//Function to search for a value
	$('#gerSysUsuarios_pagination_search').keyup(function(){
		//Value for search
		var searchVal = $(this).val();

		//Back for page 1 after search
		var page = '1';

		//Amount of records to show in table
		var regsLimit = $('#gerSysUsuarios_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit, searchVal);
	})

	//This function is used to order the data
	$('#gerSysUsuarios_table thead th span').on('click', function(){
		//To keep the search filter
		var searchVal = $('#gerSysUsuarios_pagination_search').val();

		//Back to page 1 after order
		var page = '1';

		//The amount of records to show in table
		var regsLimit = $('#gerSysUsuarios_regs option:selected').val();

		//The field to order
		var field = $(this).parent().attr('id');

		//Variable used to order
		var oder = '';

		//Check what is the actual order
		if($(this).hasClass('glyphicon-chevron-down')){
			//Back all the others columns to default icon
			$('#gerSysUsuarios_table thead th span').removeClass("glyphicon-chevron-up");
			$('#gerSysUsuarios_table thead th span').addClass("glyphicon-chevron-down");

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
	
	//On click in the add an user, update the button attributes
	$('#gerSysUsuarios_addSysUsuarioBtn').on('click', function(){
		//Hide or show access
		if($('input[name=admin]').prop('checked')){
			//Hide access because the admin user as been checked
			$('#userAccessRules').hide();	
		} else {
			//Show access because the admin user is not checked
			$('#userAccessRules').show();
		}

		//Call function to load modules list
		loadModules();

		//Clear the form, beacause user can click first on edit
		$('#gerSysUsuarios_form')[0].reset();

		//Remove input hidden used to control the cell phone that is changed
		$('input[name=edit_idSysUsuario]').remove();

		//Update button, its necessary because the operation changes
		$('#gerSysUsuarios_update').remove();
		$('#gerSysUsuarios_save').remove();
		$('#gerSysUsuarios_modalFooter').append("<button type='button' id = 'gerSysUsuarios_save' name = 'gerSysUsuarios_save' class='btn btn-primary'>Salvar</button>");
	})

	//Save user
	$('#gerSysUsuarios_modalFooter').on('click', '#gerSysUsuarios_save', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerSysUsuarios_regs option:selected').val();

		//Get data to save
		var formData = $('#gerSysUsuarios_form').serialize();

		//Get admin option
		var admin = $('input[name=admin]:checked').val();

		var modulos = '';
		var paginas = '';
		var acessos = '';

		//Get all modules access
		$('input[name=userModulo]').each(function() {
			modulos += $(this).val() + ';';
		});

		//Get all pages access
		$('input[name=userPage]').each(function() {
			paginas += $(this).val() + ';';
		});

		//Get all access rules
		$('input[name=idAcesso]').each(function() {
			acessos += $(this).val() + ';';
		});

		var resModulos = modulos.substring(-1, modulos.length-1);
		var resPaginas = paginas.substring(-1, paginas.length-1);
		var resAcessos = acessos.substring(-1, acessos.length-1);

		var password = $('input[name=password]').val();

		$.ajax({
			url: 'modulos/mod_gerencial/controller/ger_sysUsuarios.php',
			type: 'POST',
			data: {
				formData: formData,
				resModulos: resModulos,
				resPaginas: resPaginas,
				resAcessos: resAcessos,
				password: password,
				admin: admin,
				op: 'save' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Check the return
				if(data == 1){ //Means the insert as successful
					alert("Usuário cadastrado com sucesso!");

					//Reload table
					loadTable('1', regsLimit);

					//Hide the modal
					$('#add_sysUsuario').modal('hide');

					//Clear the form
					$('#gerSysUsuarios_form')[0].reset();

				} else if(data == 2) { //Have a problem to insert
					alert("O usuário informado já foi cadastrado");
				} else {
					alert("Falha ao inserir usuário");
				}
			}
		});
	})

	//Function to populate fields before edit data
	$('#gerSysUsuarios_table').on('click', 'button[name=edit]', function(){
		//Remove the last changed user
		$('input[name=edit_idSysUsuario]').remove();

		//Get user id to edit
		var idSysUsuario = $(this).attr('id').split("_")[1];

		//Update button, its necessary because the operation changes
		$('#gerSysUsuarios_save').remove();
		$('#gerSysUsuarios_update').remove();
		$('#gerSysUsuarios_modalFooter').append("<button type='button' id = 'gerSysUsuarios_update' name = 'gerSysUsuarios_update' class='btn btn-primary'>Gravar</button>");

		//Add a hidden input to control the user
		$('#gerSysUsuarios_form').append('<input type = "hidden" value = "'+ idSysUsuario +'" name = "edit_idSysUsuario"> ');

		//First populate the user data in fields
		$.ajax({
			url: 'modulos/mod_gerencial/controller/ger_sysUsuarios.php',
			type: 'POST',
			data: {
				idSysUsuario: idSysUsuario, //User id to load data
				op: 'loadData' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Popupate fields
				$('input[name=nome]').val(data.nome);
				$('input[name=cnpj]').val(data.cnpj);
				$('input[name=razaoSocial]').val(data.razaoSocial);
			}
		})
	})

	//Function to edit data
	$('#gerSysUsuarios_modalFooter').on('click', '#gerSysUsuarios_update', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerSysUsuarios_regs option:selected').val();

		//The job that user want to update
		var idAcao = $('input[name=edit_idAcao]').val();

		//Get data to update
		var formData = $('#gerSysUsuarios_form').serialize();

		$.ajax({
			url: 'modulos/mod_gerencial/controller/ger_sysUsuarios.php',
			type: 'POST',
			data: {
				formData: formData,
				idAcao: idAcao,
				op: 'update' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Check the return
				if(data == 1){ //Means the update as successful
					alert("Acao alterada com sucesso!");

					//Reload table
					loadTable('1', regsLimit);

					//Hide the modal
					$('#add_acao').modal('hide');

					//Clear the form
					$('#gerSysUsuarios_form')[0].reset();

				} else { //Have a problem to insert
					alert("Falha ao atualizar acao");
				}
			}
		});
	})

	//Function to delete user
	$('#gerSysUsuarios_table').on('click', 'button[name=delete]', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerSysUsuarios_regs option:selected').val();

		//The user that user want to delete
		var idSysUsuario = $(this).attr('id').split("_")[1];

		//Ask user if he really wanna delete the record
		var anwswer = confirm("Tem certeza que deseja remover esse usuário?");

		if(anwswer){
			$.ajax({
				url: 'modulos/mod_gerencial/controller/ger_sysUsuarios.php',
				type: 'POST',
				data: {
					idSysUsuario: idSysUsuario,
					op: 'delete' //The optional operation to pass for back-end
				},
				dataType: 'json',
				success: function(data){
					//Check the return
					if(data == 1){ //Means the update as successful
						alert("Usuário removido com sucesso!");

						//Reload table
						loadTable('1', regsLimit);
					} else { //Have a problem to insert
						alert("Falha ao remover usuário");
					}
				}
			});
		}
	});

	//Function to see the job data
	$('#gerSysUsuarios_table').on('click', 'button[name=show]', function(){
		var idAcao = $(this).attr('id').split("_")[1];

		$.ajax({
			url: 'modulos/mod_gerencial/controller/ger_sysUsuarios.php',
			type: 'POST',
			data: {
				idAcao: idAcao, //Job id to load data
				op: 'loadData' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Popupate fields
				$('#show_nome').html(data.nome);
				$('#show_cnpj').html(data.cnpj);
				$('#show_razaoSocial').html(data.razaoSocial);
			}
		})
	});

	//Function to export to excel
	$("#gerSysUsuarios_exportExcel").click(function(e) {
		$.ajax({
			url: 'modulos/mod_gerencial/controller/ger_sysUsuarios.php',
			type: 'POST',
			data: {
				op: 'exportExcel' //The optional operation to pass for back-end
			},
			success:function(data){
				window.location = "modulos/mod_gerencial/controller/ger_sysUsuarios.php?export=true";
			}
		})
	});

	//Function to load modules
	function loadModules(){
		$.ajax({
			url: 'modulos/mod_gerencial/controller/ger_sysUsuarios.php',
			type: 'POST',
			data: {
				op: 'loadModules' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success:function(data){
				//Clear modules first
				$('#modulosLista').empty();

				//Append modules list
				for(var i=0;i<data.length;i++){
					$('#modulosLista').append(""+
						"<a href='#'' class='list-group-item' id = '"+data[i].idModulo+"'>"+ data[i].modulo +"</a>"+	
					"");
				}				
			}
		})
	}

	//Function to load pages when user select one module
	$('#modulosLista').on('click', 'a', function(){
		//Remove selected class from previous items
		$('#modulosLista a').removeClass("active");

		//Put selected class to item
		$(this).addClass('active');

		//Get selected module
		var idModulo = $(this).attr('id');

		//Send ajax to get the pages of the selected module
		$.ajax({
			url: 'modulos/mod_gerencial/controller/ger_sysUsuarios.php',
			type: 'POST',
			data: {
				idModulo : idModulo,
				op: 'loadModulePages' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success:function(data){
				//Clear module pages first
				$('#paginasLista').empty();

				//Append module pages list
				for(var i=0;i<data.length;i++){
					$('#paginasLista').append(""+
						"<a href='#'' class='list-group-item' id = '"+data[i].idPagina+"'>"+ data[i].pagina +"</a>"+	
					"");
				}			
			}
		})
	})

	//Function to load access rules when user select one page
	$('#paginasLista').on('click', 'a', function(){
		//Remove selected class from previous items
		$('#paginasLista a').removeClass("active");

		//Put selected class to item
		$(this).addClass('active');

		//Get selected module
		var idPagina = $(this).attr('id');

		//Send ajax to get all access rules for selected page
		$.ajax({
			url: 'modulos/mod_gerencial/controller/ger_sysUsuarios.php',
			type: 'POST',
			data: {
				idPagina : idPagina,
				op: 'loadModulePagesRules' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success:function(data){
				//Clear module pages rules first
				$('#permissoesLista').empty();

				//Append module pages rules list
				for(var i=0;i<data.length;i++){
					$('#permissoesLista').append(""+
						"<a href='#'' class='list-group-item' id = '"+data[i].idAcesso+"'>"+ data[i].regra +"</a>"+	
					"");
				}				
			}
		})
	})

	//Function to select rules 
	$('#permissoesLista').on('click', 'a', function(){
		//Remove active class if the item as already selected
		if($(this).hasClass('active')){
			$(this).removeClass('active');
		} else {
			//Put selected class to item
			$(this).addClass('active');
		}
	})

	//Generate acess list for each item (used to save in database)
	$('#gerSysUsuarios_addAcessoBtn').click(function(){
		//Get selected module
		var selectedModulo = $('#modulosLista a.active').html();

		//Get module ID
		var moduleId = $('#modulosLista a.active').attr('id');

		//Get selected page
		var selectedPage = $('#paginasLista a.active').html();

		//Get page ID
		var pageId = $('#paginasLista a.active').attr('id');

		//Get access ID
		//var idAcesso = $('#permissoesLista a.active').attr('id');

		//Variable used to append module, page and access to list
		var lista = '';

		//Check if user as selected at least one module
		if($('#modulosLista a.active').length <= 0){
			alert("Você precisa selecionar ao menos um modulo");

		} else if($('#paginasLista a.active').length <= 0){ //Check if user selected at least one page
			alert("Você precisa selecionar ao menos uma página");

		} else {
			//First, check if the modulo dont exists
			if(($('#'+selectedModulo).length <= 0)){
					if($('#permissoesLista a.active').length <= 0){ //Check if user selected one rule
						//Remove page from list, because all rules as been removed
						$('#'+selectedPage).prev('li').remove();
						$('#'+selectedPage).remove();

						alert("Favor selecionar ao menos um item");
					} else {

						lista += "<ul>";
							lista += "<li>" + selectedModulo + "</li>";
							lista += "<ul id = '"+ selectedModulo +"'>";
							lista += "<input type = 'hidden' value = '"+ moduleId +"' name = 'userModulo'>";
								lista += "<li>" + selectedPage + "</li>";
									lista += "<ul id = '"+ selectedPage +"'>";
										lista += "<input type = 'hidden' value = '"+ pageId +"' name = 'userPage'>";
										//Loop on rules list to generate an array with all access rules and append to list
										$('#permissoesLista a.active').each(function(){
											lista += "<li>"+ $(this).html() +"</li>";
											lista += "<input type = 'hidden' value = '"+ $(this).attr('id') +"' name = 'idAcesso'>";
										});

								lista += "</ul>";
							lista += "</ul>";
						lista += "</ul>";

						//Append list for first time, because the module doesn't exist
						$('#finalAccessRules').append(lista);
					}

			} else if($('#'+selectedModulo).length == 1 && $('#'+selectedPage).length == 0){ //If the module is already added, and the page not, just add the page to module
					
					if($('#permissoesLista a.active').length <= 0){ //Check if user selected one rule
						//If user dont selected any rule, show an error message
						alert("Favor selecionar ao menos um acesso");
						// //Remove page from list, because all rules as been removed
						// $('#'+selectedPage).prev('li').remove();
						// $('#'+selectedPage).remove();
					} else {

						lista += "<li>" + selectedPage + "</li>";
						lista += "<ul id = '"+ selectedPage +"'>";
							lista += "<input type = 'hidden' value = '"+ pageId +"' name = 'userPage'>";
							//Loop on rules list to generate an array with all access rules and append to list
							$('#permissoesLista a.active').each(function(){
								lista += "<li>"+ $(this).html() +"</li>";
								lista += "<input type = 'hidden' value = '"+ $(this).attr('id') +"' name = 'idAcesso'>";
							});

						lista += "</ul>";

						//Append new page to module on list
						$('#'+selectedModulo).append(lista);
					}

			} else if($('#'+selectedModulo).length == 1 && $('#'+selectedPage).length == 1) { //If the module and page exist, just update the rules	

				//Loop on rules list to generate an array with all access rules and append to list
				$('#permissoesLista a.active').each(function(){
					lista += "<li>"+ $(this).html() +"</li>";
					lista += "<input type = 'hidden' value = '"+ $(this).attr('id') +"' name = 'idAcesso'>";
				});

				if($('#permissoesLista a.active').length == 0){
					//If user dont selected any rule, show an error message
					alert("Favor selecionar ao menos um acesso");
					// //Remove page from list, because all rules as been removed
					// $('#'+selectedPage).prev('li').remove();
					// $('#'+selectedPage).remove();
				} else {
					//Update the module pages acess list
					$('#'+selectedPage).empty();

					//Append the page again with the new rules
					$('#'+selectedPage).append(lista);
				}
			}
		}		
	})

	//Function to hide or show access
	$('input[name=admin]').click(function(){
		if($(this).prop('checked')){
			//Hide access because the admin user as been checked
			$('#userAccessRules').hide();	
		} else {
			//Show access because the admin user is not checked
			$('#userAccessRules').show();
		}
		 
	})
})
