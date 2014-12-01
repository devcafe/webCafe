<?php
	require_once("homeModel.php");
	require_once("security.php");
	header('Content-Type: text/html; charset=UTF-8');
	

	 if(isset($_POST['op'])){	
		//Load table data
		if($_POST['op'] == 'loadTable'){
			$end = $_POST['regsLimit'];
			$page = $_POST['page'];

			if(isset($_POST['searchVal']) && $_POST['searchVal'] != ''){
				
				//verifica se foi digitado ':'
				if(preg_match('/:/', $_POST['searchVal'])) {
   					$term = explode(':', $_POST['searchVal']);
   					$column = strtolower($term[0]);
   					$value = ltrim($term[1]);

   					//Verifica se foi digitado os termos selecionado para alterar a coluna
   					if($column == "departamento" or $column == "assunto" or $column == "documento"){
   						$column = "a." . $column;
   					}elseif($column == "responsavel"){   					
   						$column = "CONCAT(b.firstName, ' ', b.lastName)";
   					}   					
   					$where = "where ". $column ." like '%". $value ."%'";   						
				}else{
					$where = "
						Where
							a.departamento like '%".$_POST['searchVal']."%' 
						Or a.assunto like '%".$_POST['searchVal']."%'
						Or a.documento like '%".$_POST['searchVal']."%'
						Or CONCAT(b.firstName, ' ', b.lastName) like '%".$_POST['searchVal']."%'
						";
					}

			} else {
				$where = '';
			}

			if(isset($_POST['order']) && $_POST['order'] != ''){
				$orderBy = 'Order By ' . $_POST['order'];
			} else {
				$orderBy = '';
			}

			$documentos = new Documentos();
			echo $documentos->loadTableData($end, $page, $where, $orderBy); //Get table return

		}  else if ($_POST['op'] == 'loadData'){ //Load document data to edit
			$documentos = new Documentos();
			
			echo $documentos->loadData($_POST['idDocumento']); //Get return to populate fields
		
		}  else if ($_POST['op'] == 'delete'){ //Delete document			

			$documentos = new Documentos();

			//Get actual date
			$date = date('d/m/Y H:i');			

			//Get return after delete
			echo $documentos->delete($_POST['idDocumento'],$_SESSION['idUser'], $date); 

		} 


	} else {
		if( $_FILES ) { // Verificando se existe o envio de arquivos.

			if($_FILES['arquivo']['error'] == 0) { // Verifica se o campo não está vazio.

				//Diretório que vai receber o arquivo.			
				$dir = '../resources/documentos/';
				
				//Nome do diretório para gravar no banco
				$path = 'resources/documentos/';

				//Recebe o arquivo temporário.
				$tmpName = $_FILES['arquivo']['tmp_name']; 

				//Recebe o nome do arquivo.
				$name = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $_FILES['arquivo']['name'])); 

				//Extensões permitidas
				$allowed =  array('pdf');

				//Data
				$date = date('Y_m_d_h_i_s');

				//Extensão
				$ext = substr($name, strrpos($name, '.')+1);				

				if(!in_array($ext,$allowed) ) {
					$message = "Extensão de arquivo não permitida, somente arquivos em PDF são aceitos.";
				} else {
					//Verifica o tamanho máximo do arquivo
					if($_FILES['arquivo']['size'] > 40000000){
						$message = "O tamanho do arquivo excede 40 MB";
					} else {
						//Nome randomico
						$name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $name). '_'. $date . '.'. $ext;

						if( move_uploaded_file( $tmpName, $dir . $name ) ) { // move_uploaded_file irá realizar o envio do arquivo.

							$documento = new Documentos();	
							$message = "Arquivo salvo com sucesso, caso queria enviar outro basta refazer o processo. Se já terminou pode fechar.";

							//Grava caminho da documento no banco
							$toDataBase = $documento->cadDocumento($path . $name, $_SESSION['idUser'],$_POST['AddDepartamento'],$_POST['addDocumento'],$_POST['addAssunto']);	
							
						} else {			
							$message = "Ocorreu algum erro estranho, favor contatar o administrador do sistema";
						}						
					}
				}				
			}else{
				$message = "Favor selecionar um arquivo";
			}

			echo "{\"messagem\":\"".$message."\"}";
		}
	}

	

?>
