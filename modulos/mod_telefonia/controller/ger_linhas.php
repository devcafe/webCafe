<?php
	require_once("../model/ger_linhas.php");
	require_once("../../../actions/security.php");

	//Check if page variable export exists, if does'nt, continue with normal operations
	if(!(isset($_GET['export'])) && !(isset($_GET['import']))){
		//Load table data
		if($_POST['op'] == 'loadTable'){
			$end = $_POST['regsLimit'];
			$page = $_POST['page'];

			if(isset($_POST['searchVal']) && $_POST['searchVal'] != ''){
				$where = "
					Where
						a.numLinha like '%".$_POST['searchVal']."%' 
					Or b.marca like '%".$_POST['searchVal']."%'
					Or b.modelo like '%".$_POST['searchVal']."%'
					Or b.imei like '%".$_POST['searchVal']."%'
					Or a.linhaStatus like '%".$_POST['searchVal']."%'
					Or c.nome like '%".$_POST['searchVal']."%'";
			} else {
				$where = '';
			}

			if(isset($_POST['order']) && $_POST['order'] != ''){
				$orderBy = 'Order By ' . $_POST['order'];
			} else {
				$orderBy = '';
			}

			$linhas = new Linhas();
			echo $linhas->loadTableData($end, $page, $where, $orderBy); //Get table return

		} else if ($_POST['op'] == 'save'){ //Save operation
			$idUser = $_SESSION['idUser'];

			$linhas = new Linhas();

			//Get actual date
			$date = date('d/m/Y H:i');

			//Verify if theline alreay exists
			if($linhas->checkLine($_POST['formData']) > 0){
				echo 2; //This means the line number already exists
			} else {
				echo $linhas->save($_POST['formData'], $idUser, $date); //Get return after insert
				$linhas->updateDeviceStatus($_POST['formData'], $idUser, $date, 'Uso'); //Update device status, change to "uso"
			}

		} else if ($_POST['op'] == 'autoCompleteDevice'){ //Autocomplete to get avaible devices
			//$idUser = $_SESSION['idUser'];

			$linhas = new Linhas();			

			if($_POST['operation'] != 'add'){
				$idUsuario = $linhas->getUserId($_POST['idLinha']); //Get line device id
			} else {
				$idUsuario = '';
			}

			echo json_encode($linhas->autoCompleteDevices($_POST['operation'], $idUsuario)); //Load data to populate select, return a json

		} else if ($_POST['op'] == 'autoCompleteUser'){ //Autocomplete to get all users
			$linhas = new Linhas();			

			echo json_encode($linhas->autoCompleteUsers()); //Load data to populate select, return a json

		} else if ($_POST['op'] == 'loadData'){ //Load line data to edit
			$linhas = new Linhas();

			echo $linhas->loadData($_POST['idLinha']); //Get return to populate fields
		
		} else if ($_POST['op'] == 'update'){ //Edit line
			$idUser = $_SESSION['idUser'];

			$linhas = new Linhas();

			//Get actual date
			$date = date('d/m/Y H:i');
			
			$idAparelho = $linhas->getLineDevice($_POST['idLinha']); //Get line device id
			
			//Update old device status, change to "disponivel"
			//if the device is the same, the second funcion change again to "uso"
			//its needed because user can change devices
			$linhas->updateDeviceStatus('idAparelho='.$idAparelho, $idUser, $date, 'Disponivel'); 
			
			//Update the new device status, change to "uso" (can be the old device)
			$linhas->updateDeviceStatus($_POST['formData'], $idUser, $date, 'Uso'); 
			
			echo $linhas->edit($_POST['formData'], $idUser, $date, $_POST['idLinha']); //Get return after update

		} else if ($_POST['op'] == 'delete'){ //Delete line
			$idUser = $_SESSION['idUser'];

			$linhas = new Linhas();

			//Get actual date
			$date = date('d/m/Y H:i');

			$idAparelho = $linhas->getLineDevice($_POST['idLinha']); //Get line device id
			$linhas->updateDeviceStatus('idAparelho='.$idAparelho, $idUser, $date, 'Disponivel'); //Update device status, change to "disponivel"
			echo $linhas->delete($idUser, $date, $_POST['idLinha']); //Get return after delete

		} 
	} else if(isset($_GET['export'])) { //If variable export exists in url, export data in excel
		$linhas = new Linhas();

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		//Create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		//Output the column headings
		fputcsv($output, array('idLinha', 'idAparelho', 'idUsuario', 'numLinha', 'plano', 'iccid', 'linhaStatus', 'operadora', 'observacoes', 'dataCadastro', 'userAdd', 'userLastChange'), ';', " ");

		//Call the method to get contents from database
		$linhas->exportExcel($output);	

	} else if(isset($_GET['import'])){ //If variable import exists in url, import data in excel
			$linhas = new Linhas();
			//$pdo = new Connection();

	 		if ($_FILES["file"]["error"] > 0){
			    echo "Error: " . $_FILES["file"]["error"] . "<br>";
			} else {
			    $a = $_FILES["file"]["tmp_name"];

				// Name of your CSV file
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

			            $linhas->importExcel($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13);
					}
				}

				echo "<script>alert('Record successfully uploaded.');window.location.href='http://localhost/webCafe/main.php?mod=mod_telefonia&page=ger_linhas';</script>";
			}
	}
?>
