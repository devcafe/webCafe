$(function(){
	/****************************************/
	/* General
	/****************************************/

	//Tha body of main table, where the data will be appended
	var table_gerAparelhos = $('#gerAparelhos_table tbody');

	//The amount of data to retrieve in each page
	var regsLimit = $('#gerAparelhos_regs option:selected').val();

	//The first page (it's a hidden input with value = 1)
	var page = $('#paginationController').val();

	//Pagination wrapper
	var paginationWrapper = $('#gerAparelhos_pagination');

	//Call the function on page load
	loadTable('1', regsLimit);

	//Datepicker
	$( "#dataEnvioManutencao" ).datepicker({ 
		dayNamesMin: [ "Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab" ],
		monthNames: [ "Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez" ],
		//changeYear: true,
		//changeMonth: true,
		yearRange: "1950:2020",
		dateFormat: "dd-mm-y"
	});

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
			url: 'modulos/mod_telefonia/controller/ger_aparelhos.php',
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
				$('#gerAparelhos_tableRegTotal').html(data['totalRegs']);

				//Show the total pages
				$("#gerAparelhos_tableTotalPages").html(data['totalPages']);

				//Check if the result dont return any data, in cases where the user
				//try to search for a value which do not exist
				if(data['totalPages'] <= 0){
					//Update the table
					table_gerAparelhos.empty();
					paginationWrapper.empty();

					//Append the information to user warning the query not returned any result
					table_gerAparelhos.append(""+
						"<tr>"+
							"<td colspan = '2'>Nenhum resultado encontrado</td>"+
						"</tr>"+
					"");

				} else if(page > data['totalPages']){ //Check if the user try to search for a page that does not exist
					alert("Página não existe");
				} else { //Return the data and append the pagination
					//Show actual page
					$('#gerAparelhos_tableRegPage').html(data['actualPage']);

					//To update table data, clear first
					table_gerAparelhos.empty();
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

					//Check if user have rigths to view device info
					if($('input[name=accessView]').length <= 0){
						var disabledView = 'disabled';
					} else {
						var disabledView = '';
					}

					//Check if user have rigths to delete device
					if($('input[name=accessDelete]').length <= 0){
						var disabledDelete = 'disabled';
					} else {
						var disabledDelete = '';
					}

					//Check if user have rigths to edit device
					if($('input[name=accessEdit]').length <= 0){
						var disabledEdit = 'disabled';
					} else {
						var disabledEdit = '';
					}

					//Append data in table
					for(var i=0;i<data[1].length;i++){	
						//Check for device status. If status is equal to "uso", user cant delete
						//because the device as attached to one line
						if(data[1][i].status == 'Uso'){
							var disabled = 'disabled'
						} else {
							var disabled = '';
						}
						
						table_gerAparelhos.append(""+
							"<tr>"+
								"<td class = 'show width50 pull-left'>"+
									"<button "+disabledView+" id = 'show_"+ data[1][i].idAparelho +"' name = 'show' type='button' class='btn btn-default' data-toggle='modal' data-target='#show_aparelho'>"+
									  "<span class='glyphicon glyphicon-search'></span>"+
									"</button>"+
								"</td>"+
								"<td>"+data[1][i].marca+"</td>"+
								"<td>"+data[1][i].modelo+"</td>"+
								"<td>"+data[1][i].imei+"</td>"+
								"<td>"+data[1][i].tipo+"</td>"+
								"<td>"+data[1][i].status+"</td>"+
								"<td class = 'width100'>"+
									"<button "+disabled+" "+disabledDelete+" id = 'del_"+ data[1][i].idAparelho +"' name = 'delete' type='button' class='btn btn-danger pull-left'>"+
									  "<span class='glyphicon glyphicon-trash'></span>"+
									"</button>"+
									"<button "+disabledEdit+" id = 'edit_"+ data[1][i].idAparelho +"' name = 'edit' type='button' class='btn btn-warning pull-left' data-toggle='modal' data-target='#add_aparelho'>"+
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
	$("#gerAparelhos_pagination").on('click', 'li a:not(.reticence)', function(){
		//Get the page number
		var page = $(this).attr('id').split('_')[1];

		//The amount of records to show in table
		var regsLimit = $('#gerAparelhos_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//This function is used to go page to page
	$("#gerAparelhos_pagination").on('click', 'li a.onePage', function(){
		//Get the operation (next or prev)
		var op = $(this).attr('id').split('_')[0];

		//The amount of records to show in table
		var regsLimit = $('#gerAparelhos_regs option:selected').val();

		//Get the search data to keep the filter
		$('#gerAparelhos_pagination_search').val();
		var searchVal = $('#gerAparelhos_pagination_search').val();

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
	$('#gerAparelhos_regs').change(function(){
		//If uncomment this line, its able to possibility to keep the current page on change the amount of data to show 
		//var page = $('#gerLinhas_pagination li a.current').attr('id').split('_')[1];

		//Get the amount of records to show
		var regsLimit = $('#gerAparelhos_regs option:selected').val();

		//To keep the search filter
		var searchVal = $('#gerAparelhos_pagination_search').val();

		//Call the main function
		loadTable('1', regsLimit, searchVal);
	})

	//To go to one page on give a page number
	$('#gerAparelhos_pagination_go').click(function(){
		//Get the page number
		var page = $('#gerAparelhos_pagination_goPage').val();

		//To keep the amount of records to show in table
		var regsLimit = $('#gerAparelhos_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//Function to search for a value
	$('#gerAparelhos_pagination_search').keyup(function(){
		//Value for search
		var searchVal = $(this).val();

		//Back for page 1 after search
		var page = '1';

		//Amount of records to show in table
		var regsLimit = $('#gerAparelhos_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit, searchVal);
	})

	//This function is used to order the data
	$('#gerAparelhos_table thead th span').on('click', function(){
		//To keep the search filter
		var searchVal = $('#gerAparelhos_pagination_search').val();

		//Back to page 1 after order
		var page = '1';

		//The amount of records to show in table
		var regsLimit = $('#gerAparelhos_regs option:selected').val();

		//The field to order
		var field = $(this).parent().attr('id');

		//Variable used to order
		var oder = '';

		//Check what is the actual order
		if($(this).hasClass('glyphicon-chevron-down')){
			//Back all the others columns to default icon
			$('#gerAparelhos_table thead th span').removeClass("glyphicon-chevron-up");
			$('#gerAparelhos_table thead th span').addClass("glyphicon-chevron-down");

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
	
	//On click in the add a cell phone, update the button attributes
	$('#gerAparelhos_addAparelhoBtn').on('click', function(){
		//Remove input text and replace for a select text when device status is diferent to "uso"
		$('#deviceStatus select').remove();
		$('#deviceStatus input').remove();
		$('#deviceStatus').append('<select name = "status" id = "status" class="form-control"><option value = "Disponivel">Disponivel</option><option value = "Manutencao">Manutenção</option><option value = "Furtado">Furtado</option></select>');

		//Clear the form, beacause user can click first on edit
		$('#gerAparelhos_form')[0].reset();

		//Clear textarea
		$('textarea[name=acessorios]').html('');
		$('textarea[name=observacoes]').html('');

		//Remove input hidden used to control the cell phone that is changed
		$('input[name=edit_idAparelho]').remove();

		//Update button, its necessary because the operation changes
		$('#gerAparelhos_update').remove();
		$('#gerAparelhos_save').remove();
		$('#gerAparelhos_modalFooter').append("<button type='button' id = 'gerAparelhos_save' name = 'gerAparelhos_save' class='btn btn-primary'>Salvar</button>");
	})

	//Save cell phone
	$('#gerAparelhos_modalFooter').on('click', '#gerAparelhos_save', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerAparelhos_regs option:selected').val();

		//Get data to save
		var formData = $('#gerAparelhos_form').serialize();

		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_aparelhos.php',
			type: 'POST',
			data: {
				formData: formData,
				op: 'save' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Check the return
				if(data == 1){ //Means the insert as successful
					alert("Aparelho cadastrado com sucesso!");

					//Reload table
					loadTable('1', regsLimit);

					//Hide the modal
					$('#add_aparelho').modal('hide');

					//Clear the form
					$('#gerAparelhos_form')[0].reset();

				} else if(data == 2) { //Have a problem to insert
					alert("O aparelho informado já foi cadastrado");
				} else {
					alert("Falha ao inserir aparelho");
				}
			}
		});
	})

	//Function to populate fields before edit data
	$('#gerAparelhos_table').on('click', 'button[name=edit]', function(){
		//Remove the last changed device
		$('input[name=edit_idAparelho]').remove();

		//Get cell phone id to edit
		var idAparelho = $(this).attr('id').split("_")[1];

		//Update button, its necessary because the operation changes
		$('#gerAparelhos_save').remove();
		$('#gerAparelhos_update').remove();
		$('#gerAparelhos_modalFooter').append("<button type='button' id = 'gerAparelhos_update' name = 'gerAparelhos_update' class='btn btn-primary'>Gravar</button>");

		//Add a hidden input to control the cell phone
		$('#gerAparelhos_form').append('<input type = "hidden" value = "'+ idAparelho +'" name = "edit_idAparelho"> ');

		//First populate the cell phone data in fields
		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_aparelhos.php',
			type: 'POST',
			data: {
				idAparelho: idAparelho, //Cell phone id to load data
				op: 'loadData' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Set select option readonly prop to false
				$('select[name=status]').attr('disabled', false);

				//Popupate fields
				$('input[name=marca]').val(data.marca);
				$('input[name=modelo]').val(data.modelo);
				$('input[name=imei]').val(data.imei);
				$('select[name=tipo]').val(data.tipo);
				//$('select[name=status]').val(data.status);
				$('input[name=dataEnvioManutencao]').html(data.dataEnvioManutencao);			
				$('textarea[name=acessorios]').html(data.acessorios);	
				$('textarea[name=observacoes]').html(data.observacoes);	

				//Remove select and replace for a input text when device status is equal "uso"
				//its necessary because user cant change the device status while the device as attached into one line
				if(data.status == 'Uso'){
					$('#deviceStatus select').remove();
					$('#deviceStatus').append("<input readonly type = 'text' name = 'status' value = '"+ data.status +"' class='form-control'> ");
				}
			}
		})
	})

	//Function to edit data
	$('#gerAparelhos_modalFooter').on('click', '#gerAparelhos_update', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerAparelhos_regs option:selected').val();

		//The cell phone that user want to update
		var idAparelho = $('input[name=edit_idAparelho]').val();

		//Get data to update
		var formData = $('#gerAparelhos_form').serialize();

		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_aparelhos.php',
			type: 'POST',
			data: {
				formData: formData,
				idAparelho: idAparelho,
				op: 'update' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Check the return
				if(data == 1){ //Means the update as successful
					alert("Aparelho alterado com sucesso!");

					//Reload table
					loadTable('1', regsLimit);

					//Hide the modal
					$('#add_aparelho').modal('hide');

					//Clear the form
					$('#gerAparelhos_form')[0].reset();

				} else { //Have a problem to insert
					alert("Falha ao atualizar aparelho");
				}
			}
		});
	})

	//Function to delete cell phone
	$('#gerAparelhos_table').on('click', 'button[name=delete]', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#gerAparelhos_regs option:selected').val();

		//The cell phone that user want to delete
		var idAparelho = $(this).attr('id').split("_")[1];

		//Ask user if he really wanna delete the record
		var anwswer = confirm("Tem certeza que deseja remover esse aparelho?");

		if(anwswer){
			$.ajax({
				url: 'modulos/mod_telefonia/controller/ger_aparelhos.php',
				type: 'POST',
				data: {
					idAparelho: idAparelho,
					op: 'delete' //The optional operation to pass for back-end
				},
				dataType: 'json',
				success: function(data){
					//Check the return
					if(data == 1){ //Means the update as successful
						alert("Aparelho removido com sucesso!");

						//Reload table
						loadTable('1', regsLimit);
					} else { //Have a problem to insert
						alert("Falha ao remover aparelho");
					}
				}
			});
		}
	});

	//Function to see the cell phone data
	$('#gerAparelhos_table').on('click', 'button[name=show]', function(){
		var idAparelho = $(this).attr('id').split("_")[1];

		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_aparelhos.php',
			type: 'POST',
			data: {
				idAparelho: idAparelho, //Cell phone id to load data
				op: 'loadData' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				//Popupate fields
				$('#show_marca').html(data.marca);
				$('#show_modelo').html(data.modelo);
				$('#show_imei').html(data.imei);
				$('#show_tipo').html(data.tipo);
				$('#show_status').html(data.status);
				$('#show_observacoes').html(data.observacoes);
				$('#show_acessorios').html(data.acessorios);
			}
		})
	});

	//Function to export to excel
	$("#gerAparelhos_exportExcel").click(function(e) {
		$.ajax({
			url: 'modulos/mod_telefonia/controller/ger_aparelhos.php',
			type: 'POST',
			data: {
				op: 'exportExcel' //The optional operation to pass for back-end
			},
			success:function(data){
				window.location = "modulos/mod_telefonia/controller/ger_aparelhos.php?export=true";
			}
		})
	});
})
