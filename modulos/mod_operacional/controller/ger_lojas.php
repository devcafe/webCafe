<?php
	require_once("../model/ger_lojas.php");
	require_once("../../../actions/security.php");
	require_once("../../../conf/conn.php");

	//Check if page variable export exists, if does'nt, continue with normal operations
	if(!(isset($_GET['export'])) && !(isset($_GET['import']))){
		//Load table data
		if($_POST['op'] == 'loadTable'){
			$end = $_POST['regsLimit'];
			$page = $_POST['page'];

			if(isset($_POST['searchVal']) && $_POST['searchVal'] != ''){
				$where = "
					Where
						idLoja like '%".$_POST['searchVal']."%' 
					Or cnpj like '%".$_POST['searchVal']."%'
					Or bandeira like '%".$_POST['searchVal']."%'
					Or nome like '%".$_POST['searchVal']."%'
					Or rua like '%".$_POST['searchVal']."%'
					Or numero like '%".$_POST['searchVal']."%'
					Or complemento like '%".$_POST['searchVal']."%'
					Or bairro like '%".$_POST['searchVal']."%'
					Or cidade like '%".$_POST['searchVal']."%'
					Or uf like '%".$_POST['searchVal']."%'
					Or cep like '%".$_POST['searchVal']."%'
					";
			} else {
				$where = '';
			}

			if(isset($_POST['order']) && $_POST['order'] != ''){
				$orderBy = 'Order By ' . $_POST['order'];
			} else {
				$orderBy = '';
			}

			$lojas = new Lojas();
			echo $lojas->loadTableData($end, $page, $where, $orderBy); //Get table return

		} else if ($_POST['op'] == 'save'){ //Save operation
			$idUser = $_SESSION['idUser'];

			$lojas = new Lojas();

			//Get actual date
			$date = date('d/m/Y H:i');

			//Transform data into variables
			$data = parse_str($_POST['formData']);

			//Verify if theline alreay exists
			if($lojas->checkStore($_POST['formData']) > 0){
				echo 2; //This means the line number already exists
			}elseif($cnpj == ""){
				//"O campo CNPJ é obrigatório!";
				echo 3;
			}elseif($bandeira == ""){
				//"O Campo Bandeira é obrigatório" ;
				echo 4;
			}elseif($nome == ""){
				//"O Campo Nome do estabelecimento é obrigatório" ;
				echo 5;
			}elseif($cep == "" or $bairro == "" or $rua =="" or $cidade == "" or $uf == ""){
				//"O endereço completo da loja é obrigatório, isto inclui: CEP, Bairro, Rua, Ciade e Estado (UF)" ;
				echo 6;
			}elseif($estabReceitaNomeEmpresarial == ""){
				//"O Campo Nome empresarial é obrigatório" ;
				echo 7;
			}elseif($estabReceitaEndereco == "" or $estabReceitaNumero == "" or $estabReceitaBairro == "" or $estabReceitaCidade == "" or $estabReceitaCEP == "" or $estabReceitaUF == ""){
				//"O endereço completo na receia federal é obrigatório, insto inclui: Nome Empresarial, CEP, Bairro, Rua, Ciade e Estado (UF)" ;
				echo 8;
			}elseif($estabReceitaAberturaData == ""){
				//"O Campo situação data é obrigatório" ;
				echo 9;
			}elseif($estabReceitaSituacaoData == ""){
				//"O Campo data de abertura é obrigatório" ;
				echo 10;
			}else {
				echo $lojas->save($_POST['formData'], $idUser, $date); //Get return after insert
			}

		} else if ($_POST['op'] == 'loadData'){ //Load line data to edit
			$lojas = new Lojas();

			echo $lojas->loadData($_POST['idLoja']); //Get return to populate fields
		
		} else if ($_POST['op'] == 'update'){ //Edit line
			$idUser = $_SESSION['idUser'];

			$lojas = new Lojas();

			//Get actual date
			$date = date('d/m/Y H:i');

			echo $lojas->edit($_POST['formData'], $idUser, $date, $_POST['idLoja']); //Get return after update

		} else if ($_POST['op'] == 'delete'){ //Delete line
			$idUser = $_SESSION['idUser'];

			$lojas = new Lojas();

			//Get actual date
			$date = date('d/m/Y H:i');

			echo $lojas->delete($idUser, $date, $_POST['idLoja']); //Get return after delete

		} else if ($_POST['op'] == 'autoCompleteFlag'){ //Autocomplete to get avaible flags
			$loja = new Lojas();			

			echo json_encode($loja->autoCompleteFlag()); //Load data to populate select, return a json

		}else if ($_POST['op'] == 'loadCep'){ //Autocomplete to get avaible flags
			$loja = new Lojas();

			echo json_encode($loja->loadCep($_POST['cep'])); //Load data to populate select, return a json

		}else if ($_POST['op'] == 'checkCnpj'){ //Autocomplete to get avaible flags
			$loja = new Lojas();

			echo $loja->checkCnpj($_POST['cnpj']); //Load data to populate select, return a json

		}else if ($_POST['op'] == 'flagRegister'){ //Autocomplete to get avaible flags
			$loja = new Lojas();

			if($loja->checkflag($_POST['nameFlag']) > 0){
				echo 2;
			}else{
				echo $loja->flagRegister($_POST['nameFlag']);
			}

			
		}		 
	} else if(isset($_GET['export'])) { //If variable export exists in url, export data in excel
		$lojas = new Lojas();

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		//Create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		//Output the column headings
		fputcsv($output, array('CodigoPDV', 'CNPJ', 'Bandeira', 'NomePDV', 'Rua', 'Bairro', 'cidade', 'UF'), ';', " ");

		//Call the method to get contents from database
		$lojas->exportExcel($output);	

	} else if(isset($_GET['import'])){ //If variable import exists in url, import data in excel
			$lojas = new Lojas();
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

			            $lojas->importExcel($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11);
					}
				}

				echo "<script>alert('Record successfully uploaded.');window.location.href='http://localhost/webCafe/main.php?mod=mod_telefonia&page=ger_lojas';</script>";
			}
	}

?>
