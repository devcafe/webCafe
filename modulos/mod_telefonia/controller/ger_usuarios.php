<?php
	require_once("../model/ger_usuarios.php");
	require_once("../../../actions/security.php");

	//Check if page variable export exists, if does'nt, continue with normal operations
	if(!(isset($_GET['export'])) && !(isset($_GET['import']))){
		//Load table data
		if($_POST['op'] == 'loadTable'){
			$end = $_POST['regsLimit'];
			$page = $_POST['page'];

			if(isset($_POST['searchVal']) && $_POST['searchVal'] != ''){
				if(preg_match('/:/', $_POST['searchVal'])) {
   					$term = explode(':', $_POST['searchVal']);
   					$column = strtolower($term[0]);
   					$value = ltrim($term[1]);
   					$where = "where ". $column ." like '%". $value ."%'";   						
				}else{
					$where = "
						Where
							nome like '%".$_POST['searchVal']."%' 
						Or celular like '%".$_POST['searchVal']."%'
						Or cep like '%".$_POST['searchVal']."%'
						Or endereco like '%".$_POST['searchVal']."%'
						Or bairro like '%".$_POST['searchVal']."%'
						Or cidade like '%".$_POST['searchVal']."%'
						Or uf like '%".$_POST['searchVal']."%'
						And idUsuario <> 1";
					}

			} else {
				$where = 'Where idUsuario <> 1';
			}

			if(isset($_POST['order']) && $_POST['order'] != ''){
				$orderBy = 'Order By ' . $_POST['order'];
			} else {
				$orderBy = '';
			}

			$usuarios = new Usuarios();
			echo $usuarios->loadTableData($end, $page, $where, $orderBy); //Get table return

		} else if ($_POST['op'] == 'save'){ //Save operation
			$idUser = $_SESSION['idUser'];

			$usuarios = new Usuarios();

			//Get actual date
			$date = date('d/m/Y H:i');

			//Verify if the user alreay exists
			if($usuarios->checkUser($_POST['formData']) > 0){
				echo 2; //This means the user CPF already exists
			} else {
				echo $usuarios->save($_POST['formData'], $idUser, $date); //Get return after insert
			}

		} else if ($_POST['op'] == 'loadData'){ //Load user data to edit
			$usuarios = new Usuarios();

			echo $usuarios->loadData($_POST['idUsuario']); //Get return to populate fields
		
		} else if ($_POST['op'] == 'update'){ //Edit user
			$idUser = $_SESSION['idUser'];

			$usuarios = new Usuarios();

			//Get actual date
			$date = date('d/m/Y H:i');

			echo $usuarios->edit($_POST['formData'], $idUser, $date, $_POST['idUsuario']); //Get return after update

		} else if ($_POST['op'] == 'delete'){ //Delete user
			$idUser = $_SESSION['idUser'];

			$usuarios = new Usuarios();

			//Get actual date
			$date = date('d/m/Y H:i');

			echo $usuarios->delete($idUser, $date, $_POST['idUsuario']); //Get return after delete

		}else if ($_POST['op'] == 'loadCep'){ //Autocomplete to get avaible flags
			$usuarios = new Usuarios();

			echo json_encode($usuarios->loadCep($_POST['cep'])); //Load data to populate select, return a json

		} 
	} else if(isset($_GET['export'])) { //If variable export exists in url, export data in excel
		$usuarios = new Usuarios();

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		//Create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		//Output the column headings
		fputcsv($output, array('idusuario', 'nome', 'telefone', 'celular', 'cep', 'endereco', 'bairro', 'cidade', 'uf', 'rg', 'profissao', 'cpf', 'observacoes', 'dataCadastro', 'userAdd', 'dataAlteracao', 'userLastChange'), ';', " ");

		//Call the method to get contents from database
		$usuarios->exportExcel($output);	

	} else if(isset($_GET['import'])){ //If variable import exists in url, import data in excel
			$usuarios = new Usuarios();

	 		if ($_FILES["file"]["error"] > 0){
			    echo "Error: " . $_FILES["file"]["error"] . "<br>";
			} else {
			    $a = $_FILES["file"]["tmp_name"];

				//Name of CSV file
				$csv_file = $a; 

				if (($getfile = fopen($csv_file, "r")) !== FALSE) {
		         	$data = fgetcsv($getfile, 1000, ";");
				  	while (($data = fgetcsv($getfile, 1000, ";")) !== FALSE) {
			            $result = $data;

			            $str = implode(";", $result);
			            $slice = explode(";", $str);

			            $col1 = $slice[0];
			            $col2 = $slice[1];
			            $col3 = $slice[2];
			            $col4 = $slice[3];
			            $col5 = $slice[4];
			            $col6 = $slice[5];
			            $col7 = $slice[6];
			            $col8 = $slice[7];
			            $col9 = $slice[8];
			            $col10 = $slice[9];
			            $col11 = $slice[10];
			            $col12 = $slice[11];
			            $col13 = $slice[12];
			            $col14 = $slice[13];
			            $col15 = $slice[14];
			            $col16 = $slice[15];
			            $col17 = $slice[16];

			            $usuarios->importExcel($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15, $col16, $col17 );
					}
				}

				echo "<script>alert('Dados importados com sucesso!');window.location.href='http://localhost/webCafe/main.php?mod=mod_telefonia&page=ger_usuarios';</script>";
			}
	}
?>
