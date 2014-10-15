<?php
	require_once("../model/ger_sysUsuarios.php");
	require_once("../../../actions/security.php");

	//Check if page variable export exists, if does'nt, continue with normal operations
	if(!(isset($_GET['export']))){
		//Load table data
		if($_POST['op'] == 'loadTable'){
			$end = $_POST['regsLimit'];
			$page = $_POST['page'];

			if(isset($_POST['searchVal']) && $_POST['searchVal'] != ''){
				$where = "
					Where
						firstName like '%".$_POST['searchVal']."%' 
					Or lastName like '%".$_POST['searchVal']."%'
					Or user like '%".$_POST['searchVal']."%'
					Or email like '%".$_POST['searchVal']."%'
					Or departamento like '%".$_POST['searchVal']."%'";

			} else {
				$where = '';
			}

			if(isset($_POST['order']) && $_POST['order'] != ''){
				$orderBy = 'Order By ' . $_POST['order'];
			} else {
				$orderBy = '';
			}

			$acoes = new Usuarios();
			echo $acoes->loadTableData($end, $page, $where, $orderBy); //Get table return

		} else if ($_POST['op'] == 'save'){ //Save operation
			$idUser = $_SESSION['idUser'];

			$usuarios = new Usuarios();

			//Get actual date
			$date = date('d/m/Y H:i');

			//Verify if the job alreay exists
			if($usuarios->checkUser($_POST['formData']) > 0){
				echo 2; //This means the job already exists
			} else {
				echo $usuarios->save($_POST['formData'], $idUser, $date); //Get return after insert
			}

		} else if ($_POST['op'] == 'loadModules'){ //Load modules
			$usuarios = new Usuarios();

			//Load and return modules as json
			echo json_encode($usuarios->loadModules());

		} else if ($_POST['op'] == 'loadModulePages'){ //Load module pages
			$usuarios = new Usuarios();

			//Load and return module pages as json
			echo json_encode($usuarios->loadModulePages($_POST['idModulo']));

		} else if ($_POST['op'] == 'loadModulePagesRules'){ //Load module pages rules
			$usuarios = new Usuarios();

			//Get module id
			$idModulo = $usuarios->getModuleId($_POST['idPagina']);

			//Load and return module pages rules as json
			echo json_encode($usuarios->loadModulePagesRules($_POST['idPagina'], $idModulo));

		} 
	}
?>
