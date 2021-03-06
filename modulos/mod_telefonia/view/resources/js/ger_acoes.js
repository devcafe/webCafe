$(function(){
	/****************************************/
	/* General
	/****************************************/

	//Tha body of main table, where the data will be appended
	var table_gerAcoes = $('#gerAcoes_table tbody');

	//The amount of data to retrieve in each page
	var regsLimit = $('#gerAcoes_regs option:selected').val();

	//The first page (it's a hidden input with value = 1)
	var page = $('#paginationController').val();

	//Pagination wrapper
	var paginationWrapper = $('#gerAcoes_pagination');

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
			url: 'modulos/mod_telefonia/controller/ger_acoes.php',
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
				$('#gerAcoes_tableRegTotal').html(data['totalRegs']);

				//Show the total pages
				$("#gerAcoes_tableTotalPages").html(data['totalPages']);

				//Check if the result dont return any data, in cases where the user
				//try to search for a value which do not exist
				if(data['totalPages'] <= 0){
					//Update the table
					table_gerAcoes.empty();
					paginationWrapper.empty();

					//Append the information to user warning the query not returned any result
					table_gerAcoes.append(""+
						"<tr>"+
							"<td colspan = '2'>Nenhum resultado encontrado</td>"+
						"</tr>"+
					"");

				} else if(page > data['totalPages']){ //Check if the user try to search for a page that does not exist
					alert("Página não existe");
				} else { //Return the data and append the pagination
					//Show actual page
					$('#gerAcoes_tableRegPage').html(data['actualPage']);

					//To update table data, clear first
					table_gerAcoes.empty();
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

					//Check if user have rigths to view job info
					if($('input[name=accessView]').length <= 0){
						var disabledView = 'disabled';
					} else {
						var disabledView = '';
					}

					//Check if user have rigths to delete job
					if($('input[name=accessDelete]').length <= 0){
						var disabledDelete = 'disabled';
					} else {
						var disabledDelete = '';
					}

					//Check if user have rigths to edit job
					if($('input[name=accessEdit]').length <= 0){
						var disabledEdit = 'disabled';
					} else {
						var disabledEdit = '';
					}

					//Append data in table
					for(var i=0;i<data[1].length;i++){					
						table_gerAcoes.append(""+
							"<tr>"+
								"<td class = 'show width50 pull-left'>"+
									"<button "+disabledView+" id = 'show_"+ data[1][i].idAcao +"' name = 'show' type='button' class='btn btn-default' data-toggle='modal' data-target='#show_acao'>"+
									  "<span class='glyphicon glyphicon-search'></span>"+
									"</button>"+
								"</td>"+
								"<td>"+data[1][i].nome+"</td>"+
								"<td>"+data[1][i].cnpj+"</td>"+
								"<td>"+data[1][i].razaoSocial+"</td>"+
								"<td class = 'width100'>"+
									"<button "+disabledDelete+" id = 'del_"+ data[1][i].idAcao +"' name = 'delete' type='button' class='btn btn-danger pull-left'>"+
									  "<span class='glyphicon glyphicon-trash'></span>"+
									"</button>"+
									"<button "+disabledEdit+" id = 'edit_"+ data[1][i].idAcao +"' name = 'edit' type='button' class='btn btn-warning pull-left' data-toggle='modal' data-target='#add_acao'>"+
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
	$("#gerAcoes_pagination").on('click', 'li a:not(.reticence)', function(){
		//Get the page number
		var page = $(this).attr('id').split('_')[1];

		//The amount of records to show in table
		var regsLimit = $('#gerAcoes_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//This function is used to go page to page
	$("#gerAcoes_pagination").on('click', 'li a.onePage', function(){
		//Get the operation (next or prev)
		var op = $(this).attr('id').split('_')[0];

		//The amount of records to show in table
		var regsLimit = $('#gerAcoes_regs option:selected').val();

		//Get the search data to keep the filter
		$('#gerAcoes_pagination_search').val();
		var searchVal = $('#gerAcoes_pagination_search').val();

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
	$('#gerAcoes_regs').change(function(){
		//If uncomment this line, its able to possibility to keep the current page on change the amount of data to show 
		//var page = $('#gerLinhas_pagination li a.current').attr('id').split('_')[1];

		//Get the amount of records to show
		var regsLimit = $('#gerAcoes_regs option:selected').val();

		//To keep the search filter
		var searchVal = $('#gerAcoes_pagination_search').val();

		//Call the main function
		loadTable('1', regsLimit, searchVal);
	})

	//To go to one page on give a page number
	$('#gerAcoes_pagination_go').click(function(){
		//Get the page number
		var page = $('#gerAcoes_pagination_goPage').val();

		//To keep the amount of records to show in table
		var regsLimit = $('#gerAcoes_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//Function to search for a value
	$('#gerAcoes_pagination_search').keyup(function(){
		//Value for search
		var searchVal = $(this).val();

		//Back for page 1 after search
		var page = '1';

		//Amount of records to show in table
		var regsLimit = $('#gerAcoes_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit, searchVal);
	})

	//This function is used to order the data
	$('#gerAcoes_table thead th span').on('click', function(){
		//To keep the search filter
		var searchVal = $('#gerAcoes_pagination_search').val();

		//Back to page 1 after order
		var page = '1';

		//The amount of records to show in table
		var regsLimit = $('#gerAcoes_regs option:selected').val();

		//The field to order
		var field = $(this).parent().attr('id');

		//Variable used to order
		var oder = '';

		//Check what is the actual order
		if($(this).hasClass('glyphicon-chevron-down')){
			//Back all the others columns to default icon
			$('#gerAcoes_table thead th span').removeClass("glyphicon-chevron-up");
			$('#gerAcoes_table thead th span').addClass("glyphicon-chevron-down");

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
	
	//On click in the add a job, update the button attributes
	$('#gerAcoes_addAcaoBtn').on('click', function(){
		//Clear the form, beacause user can click first on edit
		$('#gerAcoes_form')[0].reset();

		//Remove input hidden used to control the cell phone that is changed
		$('input[name=edit_idAcao]').remove();

		//Update button, its necessary because the operation changes
		$('#gerAcoes_update').remove();
		$('#gerAcoes_save').remove();
		$('#gerAcoes_modalFooter').append("<button type='button' id = 'gerAcoes_save' name = 'gerAcoes_save' class='btn btn-primary'>Salvar</button>");
	})

	//Save job
	$('#gerAcoes_modalFooter').on('click', '#gerAcoes_save', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerAcoes_regs option:selected').val();

		//Get data to save
		var formData = $('#gerAcoes_form').serialize();

		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_acoes.php',
			type: 'POST',
			data: {
				formData: formData,
				op: 'save' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Check the return
				if(data == 1){ //Means the insert as successful
					alert("Ação cadastrada com sucesso!");

					//Reload table
					loadTable('1', regsLimit);

					//Hide the modal
					$('#add_acao').modal('hide');

					//Clear the form
					$('#gerAcoes_form')[0].reset();

				} else if(data == 2) { //Have a problem to insert
					alert("A ação informada já foi cadastrada");
				} else {
					alert("Falha ao inserir acao");
				}
			}
		});
	})

	//Function to populate fields before edit data
	$('#gerAcoes_table').on('click', 'button[name=edit]', function(){
		//Remove the last changed job
		$('input[name=edit_idAcao]').remove();

		//Get job id to edit
		var idAcao = $(this).attr('id').split("_")[1];

		//Update button, its necessary because the operation changes
		$('#gerAcoes_save').remove();
		$('#gerAcoes_update').remove();
		$('#gerAcoes_modalFooter').append("<button type='button' id = 'gerAcoes_update' name = 'gerAcoes_update' class='btn btn-primary'>Gravar</button>");

		//Add a hidden input to control the cell phone
		$('#gerAcoes_form').append('<input type = "hidden" value = "'+ idAcao +'" name = "edit_idAcao"> ');

		//First populate the job data in fields
		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_acoes.php',
			type: 'POST',
			data: {
				idAcao: idAcao, //Job id to load data
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
	$('#gerAcoes_modalFooter').on('click', '#gerAcoes_update', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerAcoes_regs option:selected').val();

		//The job that user want to update
		var idAcao = $('input[name=edit_idAcao]').val();

		//Get data to update
		var formData = $('#gerAcoes_form').serialize();

		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_acoes.php',
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
					$('#gerAcoes_form')[0].reset();

				} else { //Have a problem to insert
					alert("Falha ao atualizar acao");
				}
			}
		});
	})

	//Function to delete job
	$('#gerAcoes_table').on('click', 'button[name=delete]', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerAcoes_regs option:selected').val();

		//The job that user want to delete
		var idAcao = $(this).attr('id').split("_")[1];

		//Ask user if he really wanna delete the record
		var anwswer = confirm("Tem certeza que deseja remover esse acao?");

		if(anwswer){
			$.ajax({
				url: 'modulos/mod_telefonia/controller/ger_acoes.php',
				type: 'POST',
				data: {
					idAcao: idAcao,
					op: 'delete' //The optional operation to pass for back-end
				},
				dataType: 'json',
				success: function(data){
					//Check the return
					if(data == 1){ //Means the update as successful
						alert("Acao removida com sucesso!");

						//Reload table
						loadTable('1', regsLimit);
					} else { //Have a problem to insert
						alert("Falha ao remover acao");
					}
				}
			});
		}
	});

	//Function to see the job data
	$('#gerAcoes_table').on('click', 'button[name=show]', function(){
		var idAcao = $(this).attr('id').split("_")[1];

		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_acoes.php',
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
	$("#gerAcoes_exportExcel").click(function(e) {
		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_acoes.php',
			type: 'POST',
			data: {
				op: 'exportExcel' //The optional operation to pass for back-end
			},
			success:function(data){
				window.location = "modulos/mod_telefonia/controller/ger_acoes.php?export=true";
			}
		})
	});
})
