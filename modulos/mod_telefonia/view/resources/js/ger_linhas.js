$(function(){
	/****************************************/
	/* General
	/****************************************/

	//Tha body of main table, where the data will be appended
	var table_gerLinhas = $('#gerLinhas_table tbody');

	//The amount of data to retrieve in each page
	var regsLimit = $('#gerLinhas_regs option:selected').val();

	//The first page (it's a hidden input with value = 1)
	var page = $('#paginationController').val();

	//Pagination wrapper
	var paginationWrapper = $('#gerLinhas_pagination');

	//Call the function on page load
	loadTable('1', regsLimit);

	//Mask some fields
	//Function to make nine digit optional
	var nineDigit = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	options = {onKeyPress: function(val, e, field, options) {
		field.mask(nineDigit.apply({}, arguments), options);
 	}
	};

	//9 digit is optional in cell phone number
	$('input[name=numLinha]').mask(nineDigit, options);

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
			url: 'modulos/mod_telefonia/controller/ger_linhas.php',
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
				$('#gerLinhas_tableRegTotal').html(data['totalRegs']);

				//Show the total pages
				$("#gerLinhas_tableTotalPages").html(data['totalPages']);

				//Check if the result dont return any data, in cases where the user
				//try to search for a value which do not exist
				if(data['totalPages'] <= 0){
					//Update the table
					table_gerLinhas.empty();
					paginationWrapper.empty();

					//Append the information to user warning the query not returned any result
					table_gerLinhas.append(""+
						"<tr>"+
							"<td colspan = '2'>Nenhum resultado encontrado</td>"+
						"</tr>"+
					"");

				} else if(page > data['totalPages']){ //Check if the user try to search for a page that does not exist
					alert("Página não existe");
				} else { //Return the data and append the pagination
					//Show actual page
					$('#gerLinhas_tableRegPage').html(data['actualPage']);

					//To update table data, clear first
					table_gerLinhas.empty();
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
						table_gerLinhas.append(""+
							"<tr>"+
								"<td class = 'show width50 pull-left'>"+
									"<button id = 'show_"+ data[1][i].idLinha +"' name = 'show' type='button' class='btn btn-default' data-toggle='modal' data-target='#show_linha'>"+
									  "<span class='glyphicon glyphicon-search'></span>"+
									"</button>"+
								"</td>"+
								"<td>"+data[1][i].numLinha+"</td>"+
								"<td>"+data[1][i].plano+"</td>"+
								"<td>"+data[1][i].iccid+"</td>"+
								"<td>"+data[1][i].linhaStatus+"</td>"+
								"<td>"+data[1][i].operadora+"</td>"+
								"<td class = 'width100'>"+
									"<button id = 'del_"+ data[1][i].idLinha +"' name = 'delete' type='button' class='btn btn-danger pull-left'>"+
									  "<span class='glyphicon glyphicon-trash'></span>"+
									"</button>"+
									"<button id = 'edit_"+ data[1][i].idLinha +"' name = 'edit' type='button' class='btn btn-warning pull-left' data-toggle='modal' data-target='#add_linha'>"+
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
	$("#gerLinhas_pagination").on('click', 'li a:not(.reticence)', function(){
		//Get the page number
		var page = $(this).attr('id').split('_')[1];

		//The amount of records to show in table
		var regsLimit = $('#gerLinhas_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//This function is used to go page to page
	$("#gerLinhas_pagination").on('click', 'li a.onePage', function(){
		//Get the operation (next or prev)
		var op = $(this).attr('id').split('_')[0];

		//The amount of records to show in table
		var regsLimit = $('#gerLinhas_regs option:selected').val();

		//Get the search data to keep the filter
		$('#gerLinhas_pagination_search').val();
		var searchVal = $('#gerLinhas_pagination_search').val();

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
	$('#gerLinhas_regs').change(function(){
		//If uncomment this line, its able to possibility to keep the current page on change the amount of data to show 
		//var page = $('#gerLinhas_pagination li a.current').attr('id').split('_')[1];

		//Get the amount of records to show
		var regsLimit = $('#gerLinhas_regs option:selected').val();

		//To keep the search filter
		var searchVal = $('#gerLinhas_pagination_search').val();

		//Call the main function
		loadTable('1', regsLimit, searchVal);
	})

	//To go to one page on give a page number
	$('#gerLinhas_pagination_go').click(function(){
		//Get the page number
		var page = $('#gerLinhas_pagination_goPage').val();

		//To keep the amount of records to show in table
		var regsLimit = $('#gerLinhas_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//Function to search for a value
	$('#gerLinhas_pagination_search').keyup(function(){
		//Value for search
		var searchVal = $(this).val();

		//Back for page 1 after search
		var page = '1';

		//Amount of records to show in table
		var regsLimit = $('#gerLinhas_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit, searchVal);
	})

	//This function is used to order the data
	$('#gerLinhas_table thead th span').on('click', function(){
		//To keep the search filter
		var searchVal = $('#gerLinhas_pagination_search').val();

		//Back to page 1 after order
		var page = '1';

		//The amount of records to show in table
		var regsLimit = $('#gerLinhas_regs option:selected').val();

		//The field to order
		var field = $(this).parent().attr('id');

		//Variable used to order
		var oder = '';

		//Check what is the actual order
		if($(this).hasClass('glyphicon-chevron-down')){
			//Back all the others columns to default icon
			$('#gerLinhas_table thead th span').removeClass("glyphicon-chevron-up");
			$('#gerLinhas_table thead th span').addClass("glyphicon-chevron-down");

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
	
	//On click in the add line, update the button attributes
	$('#gerLinhas_addLinhaBtn').on('click', function(){

		//Call the function to load select data and enable autocomplete
		loadDeviceData();

		//Clear the form, beacause user can click first on edit
		$('#gerLinhas_form')[0].reset();

		//Clear textarea
		$('textarea[name=observacoes]').html('');

		//Remove input hidden used to control the line that is changed
		$('input[name=edit_idLinha]').remove();

		//Enabled numLinha field
		$('input[name=numLinha]').prop('readonly', false);

		//Update button, its necessary because the operation changes
		$('#gerLinhas_update').remove();
		$('#gerLinhas_save').remove();
		$('#gerLinhas_modalFooter').append("<button type='button' id = 'gerLinhas_save' name = 'gerLinhas_save' class='btn btn-primary'>Salvar</button>");
	})

    //Function used to load device data on select, its necessary because the line can have a device
    function loadDeviceData(){
    	//Send a ajax to populate select
    	//Its used "select2" plugin to able user to search on select list
	    $.ajax({
	    	url: 'modulos/mod_telefonia/controller/ger_linhas.php',
			type: 'POST',
			data: {
				op: 'autoCompleteDevice' //The optional operation to pass for back-end
			},
			dataType: 'json',	            
	        success: function(data) {
	        	var count = 0;

	        	//Loop tougth the returned data to populate the select
				$.each(data, function(){
					$('#aparelhos').append('<option value = "'+ data[count].idAparelho +'">'+ data[count].aparelho +'</option>');		
					count++;
				})
	        }
	    }).done(function(){ //After done ajax, call select2 function to active plugin on select
	    	$("#aparelhos").select2({ formatNoMatches: "Nenhum aparelho encontrado" });
	    })
	}
	
    //Save new line
	$('#gerLinhas_modalFooter').on('click', '#gerLinhas_save', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerLinhas_regs option:selected').val();

		//Get data to save
		var formData = $('#gerLinhas_form').serialize();

		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_linhas.php',
			type: 'POST',
			data: {
				formData: formData,
				op: 'save' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Check the return
				if(data == 1){ //Means the insert as successful
					alert("Linha cadastrada com sucesso!");

					//Reload table
					loadTable('1', regsLimit);

					//Hide the modal
					$('#add_linha').modal('hide');

					//Clear the form
					$('#gerLinhas_form')[0].reset();

					//Clear textarea
					$('textarea[name=observacoes]').html('');
				} else if(data == 2) { //Have a problem to insert
					alert("A linha informada já foi cadastrada");
				} else {
					alert("Falha ao inserir linha");
				}
			}
		});
	})

	//Function to populate fields before edit data
	$('#gerLinhas_table').on('click', 'button[name=edit]', function(){
		//Get line id to edit
		var idLinha = $(this).attr('id').split("_")[1];

		//Update button, its necessary because the operation changes
		$('#gerLinhas_save').remove();
		$('#gerLinhas_update').remove();
		$('#gerLinhas_modalFooter').append("<button type='button' id = 'gerLinhas_update' name = 'gerLinhas_update' class='btn btn-primary'>Gravar</button>");

		//Add a hidden input to control the line
		$('#gerLinhas_form').append('<input type = "hidden" value = "'+ idLinha +'" name = "edit_idLinha"> ');

		//First populate the line data in fields
		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_linhas.php',
			type: 'POST',
			data: {
				idLinha: idLinha, //Line id to load data
				op: 'loadData' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Popupate fields
				$('input[name=numLinha]').val(data.numLinha);
				$('input[name=plano]').val(data.plano);
				$('input[name=iccid]').val(data.iccid);
				$('select[name=operadora]').val(data.operadora);
				$('select[name=status]').val(data.linhaStatus);
				$('textarea[name=observacoes]').html(data.observacoes);

				//Disable numLinha field
				$('input[name=numLinha]').prop('readonly', true);
			}
		})
	})

	//Function to edit data
	$('#gerLinhas_modalFooter').on('click', '#gerLinhas_update', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerLinhas_regs option:selected').val();

		//The line that user want to update
		var idLinha = $('input[name=edit_idLinha]').val();

		//Get data to update
		var formData = $('#gerLinhas_form').serialize();

		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_linhas.php',
			type: 'POST',
			data: {
				formData: formData,
				idLinha: idLinha,
				op: 'update' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Check the return
				if(data == 1){ //Means the update as successful
					alert("Linha alterada com sucesso!");

					//Reload table
					loadTable('1', regsLimit);

					//Hide the modal
					$('#add_linha').modal('hide');

					//Clear the form
					$('#gerLinhas_form')[0].reset();

					//Clear textarea
					$('textarea[name=observacoes]').html('');
				} else { //Have a problem to insert
					alert("Falha ao atualizar linha");
				}
			}
		});
	})

	//Function to delete line
	$('#gerLinhas_table').on('click', 'button[name=delete]', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerLinhas_regs option:selected').val();

		//The line that user want to delete
		var idLinha = $(this).attr('id').split("_")[1];

		//Ask user if he really wanna delete the record
		var anwswer = confirm("Tem certeza que deseja remover essa linha?");

		if(anwswer){
			$.ajax({
				url: 'modulos/mod_telefonia/controller/ger_linhas.php',
				type: 'POST',
				data: {
					idLinha: idLinha,
					op: 'delete' //The optional operation to pass for back-end
				},
				dataType: 'json',
				success: function(data){
					//Check the return
					if(data == 1){ //Means the update as successful
						alert("Linha removida com sucesso!");

						//Reload table
						loadTable('1', regsLimit);
					} else { //Have a problem to insert
						alert("Falha ao remover linha");
					}
				}
			});
		}
	});

	//Function to see the line
	$('#gerLinhas_table').on('click', 'button[name=show]', function(){
		var idLinha = $(this).attr('id').split("_")[1];

		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_linhas.php',
			type: 'POST',
			data: {
				idLinha: idLinha, //Line id to load data
				op: 'loadData' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Popupate fields
				$('#show_numLinha').html(data.numLinha);
				$('#show_plano').html(data.plano);
				$('#show_iccid').html(data.iccid);
				$('#show_operadora').html(data.operadora);
				$('#show_linhaStatus').html(data.linhaStatus);
				$('#show_observacoes').html(data.observacoes);
			}
		})
	});

	//Function to export to excel
	$("#gerLinhas_exportExcel").click(function(e) {
		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_linhas.php',
			type: 'POST',
			data: {
				op: 'exportExcel' //The optional operation to pass for back-end
			},
			success:function(data){
				window.location = "modulos/mod_telefonia/controller/ger_linhas.php?export=true";
			}
		})
	});
})
