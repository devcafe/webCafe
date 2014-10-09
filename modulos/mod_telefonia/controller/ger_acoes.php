<?php
	require_once("../model/ger_acoes.php");
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
						nome like '%".$_POST['searchVal']."%' 
					Or cnpj like '%".$_POST['searchVal']."%'
					Or razaoSocial like '%".$_POST['searchVal']."%'";
			} else {
				$where = '';
			}

			if(isset($_POST['order']) && $_POST['order'] != ''){
				$orderBy = 'Order By ' . $_POST['order'];
			} else {
				$orderBy = '';
			}

			$acoes = new Acoes();
			echo $acoes->loadTableData($end, $page, $where, $orderBy); //Get table return

		} else if ($_POST['op'] == 'save'){ //Save operation
			$idUser = $_SESSION['idUser'];

			$acoes = new Acoes();

			//Get actual date
			$date = date('d/m/Y H:i');

			//Verify if the job alreay exists
			// if($acoes->checkJob($_POST['formData']) > 0){
			// 	echo 2; //This means the job already exists
			// } else {
				echo $acoes->save($_POST['formData'], $idUser, $date); //Get return after insert
			// }

		} else if ($_POST['op'] == 'loadData'){ //Load job data to edit
			$acoes = new Acoes();
			
			echo $acoes->loadData($_POST['idAcao']); //Get return to populate fields
		
		} else if ($_POST['op'] == 'update'){ //Edit job
			$idUser = $_SESSION['idUser'];

			$acoes = new Acoes();

			//Get actual date
			$date = date('d/m/Y H:i');

			echo $acoes->edit($_POST['formData'], $idUser, $date, $_POST['idAcao']); //Get return after update

		} else if ($_POST['op'] == 'delete'){ //Delete job
			$idUser = $_SESSION['idUser'];

			$acoes = new Acoes();

			//Get actual date
			$date = date('d/m/Y H:i');

			echo $acoes->delete($idUser, $date, $_POST['idAcao']); //Get return after delete

		} 
	} else if(isset($_GET['export'])) { //If variable export exists in url, export data in excel
		$acoes = new Acoes();

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		//Create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		//Output the column headings
		fputcsv($output, array('idAcao', 'nome', 'cnpj', 'razaoSocial', 'dataCadastro', 'dataAlteracao', 'userAdd', 'userLastChange'), ';', " ");

		//Call the method to get contents from database
		$acoes->exportExcel($output);	

	} else if(isset($_GET['import'])){ //If variable import exists in url, import data in excel
			$acoes = new Acoes();

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

			            $acoes->importExcel($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8);
					}
				}

				echo "<script>alert('Dados importados com sucesso!');window.location.href='http://localhost/webCafe/main.php?mod=mod_telefonia&page=ger_acoes';</script>";
			}
	}
?>
