<?php
	require_once("homeModel.php");
	require_once("security.php");
	

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

		}  else if ($_POST['op'] == 'loadData'){ //Load job data to edit
			$documentos = new Documentos();
			
			echo $documentos->loadData($_POST['idDocumento']); //Get return to populate fields
		
		}  else if ($_POST['op'] == 'delete'){ //Delete job
			$idDocumento = $_SESSION['idUser'];

			$documentos = new Documentos();

			//Get actual date
			$date = date('d/m/Y H:i');

			echo $documentos->delete($idDocumento, $date, $_POST['idDocumento']); //Get return after delete

		} 


	} else {
		if( $_FILES ) { // Verificando se existe o envio de arquivos.
		
			if( $_FILES['arquivo'] ) { // Verifica se o campo não está vazio.
				
				$dir = './arquivos/'; // Diretório que vai receber o arquivo.
				$tmpName = $_FILES['arquivo']['tmp_name']; // Recebe o arquivo temporário.
				$name = $_FILES['arquivo']['name']; // Recebe o nome do arquivo.
				
				// move_uploaded_file( $arqTemporário, $nomeDoArquivo )
				if( move_uploaded_file( $tmpName, $dir . $name ) ) { // move_uploaded_file irá realizar o envio do arquivo.		
					header('Location: sucesso.php'); // Em caso de sucesso, retorna para a página de sucesso.			
				} else {			
					header('Location: erro.php'); // Em caso de erro, retorna para a página de erro.			
				}
				
			}

		}
	}
	
	// 	$documento = new Documentos();


	// 	//Diretório onde a documento será salva
	// 	$dir = "resources/documentos/";

	// 	//Extensões permitidas
	// 	$allowed =  array('pdf');

	// 	//Data
	// 	$date = date('Y_m_d_h_i_s');
	
	// 	//Verifica se foi selecionado algum arquivo
	// 	if (isset($_FILES["docFile"])) {
	// 		//Nome do arquivo
	// 		$filename = $_FILES['docFile']['name'];

	// 		//Extensão
	// 		$ext = substr($filename, strrpos($filename, '.')+1);

	// 		//Verifica se a extensão do arquivo é permitida
	// 		if(!in_array($ext,$allowed) ) {
	// 			echo "Extensão de arquivo não permitida";
	// 		} else {
	// 			//Verifica o tamanho máximo do arquivo
	// 			if($_FILES['docFile']['size'] > 4000000){
	// 				echo "O tamanho do arquivo excede 4 MB";
	// 			} else {
	// 				$name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename). '_'. $date . '.'. $ext;

	// 				echo $_FILES["docFile"]["tmp_name"];

	// 				//Faz upload
	// 		        $toFolder = move_uploaded_file($_FILES["docFile"]["tmp_name"], $dir . $name);


	// 		        //Grava caminho da documento no banco
	// 		        $toDataBase = $documento->cadDocumento($dir . $name, $_SESSION['idUser']);

	// 		        if($toFolder == true && $toDataBase == true){
	// 		        	echo "Upload realizado com sucesso";
	// 		        }
	// 		    }
	// 		}
	// 	} else {
	// 		echo "Favor selecionar um documento";
	// 	}
	// }


?>
