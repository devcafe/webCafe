<?php
	require_once("../model/ger_aparelhos.php");
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
						marca like '%".$_POST['searchVal']."%' 
					Or modelo like '%".$_POST['searchVal']."%'
					Or imei like '%".$_POST['searchVal']."%'
					Or tipo like '%".$_POST['searchVal']."%'
					Or status like '%".$_POST['searchVal']."%'
					And idAparelho <> 1";
			} else {
				$where = 'Where idAparelho <> 1';
			}

			if(isset($_POST['order']) && $_POST['order'] != ''){
				$orderBy = 'Order By ' . $_POST['order'];
			} else {
				$orderBy = '';
			}

			$aparelhos = new Aparelhos();
			echo $aparelhos->loadTableData($end, $page, $where, $orderBy); //Get table return

		} else if ($_POST['op'] == 'save'){ //Save operation
			$idUser = $_SESSION['idUser'];

			$aparelhos = new Aparelhos();

			//Get actual date
			$date = date('d/m/Y H:i');

			//Verify if the cell phone alreay exists
			if($aparelhos->checkCellPhone($_POST['formData']) > 0){
				echo 2; //This means the cell phone imei already exists
			} else {
				echo $aparelhos->save($_POST['formData'], $idUser, $date); //Get return after insert
			}

		} else if ($_POST['op'] == 'loadData'){ //Load cell phone data to edit
			$aparelhos = new Aparelhos();

			echo $aparelhos->loadData($_POST['idAparelho']); //Get return to populate fields
		
		} else if ($_POST['op'] == 'update'){ //Edit cell phone
			$idUser = $_SESSION['idUser'];

			$aparelhos = new Aparelhos();

			//Get actual date
			$date = date('d/m/Y H:i');

			echo $aparelhos->edit($_POST['formData'], $idUser, $date, $_POST['idAparelho']); //Get return after update

		} else if ($_POST['op'] == 'delete'){ //Delete cell phone
			$idUser = $_SESSION['idUser'];

			$aparelhos = new Aparelhos();

			//Get actual date
			$date = date('d/m/Y H:i');

			echo $aparelhos->delete($idUser, $date, $_POST['idAparelho']); //Get return after delete

		} 
	} else if(isset($_GET['export'])) { //If variable export exists in url, export data in excel
		$aparelhos = new Aparelhos();

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		//Create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		//Output the column headings
		fputcsv($output, array('idAparelho', 'marca', 'modelo', 'imei', 'tipo', 'status', 'dataEnvioManutencao', 'acessorios', 'observacoes', 'dataCadastro', 'dataAlteracao', 'userAdd', 'userLastChange'), ';', " ");

		//Call the method to get contents from database
		$aparelhos->exportExcel($output);	

	} else if(isset($_GET['import'])){ //If variable import exists in url, import data in excel
			$aparelhos = new Aparelhos();

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

			            $aparelhos->importExcel($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11);
					}
				}

				echo "<script>alert('Dados importados com sucesso!');window.location.href='http://localhost/webCafe/main.php?mod=mod_telefonia&page=ger_aparelhos';</script>";
			}
	}
?>
