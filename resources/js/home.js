$(document).ready(function(){

	/****************************************/
	/* General
	/****************************************/

	//Tha body of main table, where the data will be appended
	var table_doc = $('#doc_table tbody');

	//The amount of data to retrieve in each page
	var regsLimit = $('#doc_regs option:selected').val();
	
	//The first page (it's a hidden input with value = 1)
	var page = $('#paginationController').val();

	//Pagination wrapper
	var paginationWrapper = $('#doc_pagination');

	//Call the function on page load
	loadTable('1', regsLimit);

	$.validate({
		modules : 'security',
		validateOnBlur : true,
		scrollToTopOnError : false
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
			url: 'actions/homeController.php',
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
				$('#doc_tableRegTotal').html(data['totalRegs']);

				//Show the total pages
				$("#doc_tableTotalPages").html(data['totalPages']);

				//Check if the result dont return any data, in cases where the user
				//try to search for a value which do not exist
				if(data['totalPages'] <= 0){
					//Update the table
					table_doc.empty();
					paginationWrapper.empty();

					//Append the information to user warning the query not returned any result
					table_doc.append(""+
						"<tr>"+
							"<td colspan = '2'>Nenhum resultado encontrado</td>"+
						"</tr>"+
					"");

				} else if(page > data['totalPages']){ //Check if the user try to search for a page that does not exist
					alert("Página não existe");
				} else { //Return the data and append the pagination

					//Show actual page
					$('#doc_tableRegPage').html(data['actualPage']);

					//To update table data, clear first
					table_doc.empty();
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

						table_doc.append(""+
							"<tr>"+
								"<td class = 'show width50 pull-left'>"+
									"<button id = 'show_"+ data[1][i].idDocumento +"' name = 'show' type='button' class='btn btn-default' data-toggle='modal' data-target='#show_doc'>"+
									  "<span class='glyphicon glyphicon-search'></span>"+
									"</button>"+
								"</td>"+
								"<td>"+data[1][i].departamento+"</td>"+
								"<td>"+data[1][i].assunto+"</td>"+
								"<td>"+data[1][i].documento+"</td>"+
								"<td>"+data[1][i].responsavel+"</td>"+
								"<td class = 'width100'>"+
									"<button id = 'del_"+ data[1][i].idDocumento +"' name = 'delete' type='button' class='btn btn-danger pull-left'>"+
									  "<span class='glyphicon glyphicon-trash'></span>"+
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
	$("#doc_pagination").on('click', 'li a:not(.reticence)', function(){
		//Get the page number
		var page = $(this).attr('id').split('_')[1];

		//The amount of records to show in table
		var regsLimit = $('#doc_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//This function is used to go page to page
	$("#doc_pagination").on('click', 'li a.onePage', function(){
		//Get the operation (next or prev)
		var op = $(this).attr('id').split('_')[0];

		//The amount of records to show in table
		var regsLimit = $('#doc_regs option:selected').val();

		//Get the search data to keep the filter
		$('#doc_pagination_search').val();
		var searchVal = $('#doc_pagination_search').val();

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
	$('#doc_regs').change(function(){
		//If uncomment this line, its able to possibility to keep the current page on change the amount of data to show 
		//var page = $('#doc_pagination li a.current').attr('id').split('_')[1];

		//Get the amount of records to show
		var regsLimit = $('#doc_regs option:selected').val();

		//To keep the search filter
		var searchVal = $('#doc_pagination_search').val();

		//Call the main function
		loadTable('1', regsLimit, searchVal);
	})

	//To go to one page on give a page number
	$('#doc_pagination_go').click(function(){
		//Get the page number
		var page = $('#doc_pagination_goPage').val();

		//To keep the amount of records to show in table
		var regsLimit = $('#doc_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit);
	})

	//Function to search for a value
	$('#doc_pagination_search').keyup(function(){
		//Value for search
		var searchVal = $(this).val();

		//Back for page 1 after search
		var page = '1';

		//Amount of records to show in table
		var regsLimit = $('#doc_regs option:selected').val();

		//Call the main function
		loadTable(page, regsLimit, searchVal);
	})

	//This function is used to order the data
	$('#doc_table thead th span').on('click', function(){
		//To keep the search filter
		var searchVal = $('#doc_pagination_search').val();

		//Back to page 1 after order
		var page = '1';

		//The amount of records to show in table
		var regsLimit = $('#doc_regs option:selected').val();

		//The field to order
		var field = $(this).parent().attr('id');

		//Variable used to order
		var oder = '';

		//Check what is the actual order
		if($(this).hasClass('glyphicon-chevron-down')){
			//Back all the others columns to default icon
			$('#doc_table thead th span').removeClass("glyphicon-chevron-up");
			$('#doc_table thead th span').addClass("glyphicon-chevron-down");

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
	});
	
	//Function to see the job data
	$('#doc_table').on('click', 'button[name=show]', function(){
		var idDocumento = $(this).attr('id').split("_")[1];

		$.ajax({
			url: 'actions/homeController.php',
			type: 'POST',
			data: {
				idDocumento: idDocumento, //Job id to load data
				op: 'loadData' //The optional operation to pass for back-end
			},
			dataType: 'json',
			success: function(data){
				$("#docViewer").empty();								
				$("#docTitle").text(data.documento);								
				$("#docViewer").append("<iframe src='"+data.path+"' width='850' height='500'></iframe>");
				
			}
		})
	});	
	$('#uploadDoc').click(function(){		
        $('#docForm').ajaxForm({
            uploadProgress: function(event, position, total, percentComplete) {
                $('progress').attr('value',percentComplete);
                $('#porcentagem').html(percentComplete+'%');
            },        
            success: function(data) {
                $('progress').attr('value','100');
                $('#porcentagem').html('100%');
               	$("#notaUpload").html(data.messagem);
               	if(data.messagem == "Arquivo salvo com sucesso, caso queria enviar outro basta refazer o processo. Se já terminou pode fechar."){
               		$("#docForm")[0].reset();
               		//Reload table
					loadTable('1', regsLimit);
               	}               	
            },
            error : function(){
                $('#notaUpload').html('Erro ao enviar requisição! Se o erro persistir de um refresh na pagina.');
            },
            dataType: 'json',
            url: 'actions/homeController.php',            
        }).submit();
    })

    //Limpar campos apos upload
    $("input[name=AddDepartamento]").keypress(function(){
    	$("#notaUpload").html('');
    	$('progress').attr('value','0');
        $('#porcentagem').html('0%');

    });
    $("#doc_addAcaoBtn").click(function(){
    	$("#notaUpload").html('');
    	$('progress').attr('value','0');
        $('#porcentagem').html('0%');
    });

    //Function to delete job
	$('#doc_table').on('click', 'button[name=delete]', function(){
		//The amount of records to show in table, used to reload table
		var regsLimit = $('#doc_regs option:selected').val();

		//The job that user want to delete
		var idDocumento = $(this).attr('id').split("_")[1];		

		//Ask user if he really wanna delete the record
		var anwswer = confirm("Tem certeza que deseja remover esse documento?");

		if(anwswer){
			$.ajax({
				url: 'actions/homeController.php',
				type: 'POST',
				data: {
					idDocumento: idDocumento,
					op: 'delete' //The optional operation to pass for back-end
				},
				dataType: 'json',
				success: function(data){
					//Check the return
					if(data == 1){ //Means the update as successful
						alert("Documento removida com sucesso!");

						//Reload table
						loadTable('1', regsLimit);
					} else if(data == 2) { //Have a problem to insert
						alert("Falha ao remover documento");
					} else if (data == 3){//It is only possible to delete items that you have created yourself
						alert("Só é possivel apagar itens que você mesmo criou.");
					}else { //Unknown error, please contact your system administrator
						alert("Erro desconhecido, favor contactar o administrador do sistema!");
					}
				}
			});
		}
	});

	

	
})
