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

			if(isset($_POST['admin'])){
				$admin = $_POST['admin'];
			} else {
				$admin = '';
			}

			//Verify if the job alreay exists
			if($usuarios->checkUser($_POST['formData']) > 0){
				echo 2; //This means the job already exists
			} else {
				echo $usuarios->save($_POST['formData'], $_POST['password'], $idUser, $date, $_POST['resModulos'], $_POST['resPaginas'], $_POST['resAcessos'], $admin); //Get return after insert
			}

		} else if ($_POST['op'] == 'loadData'){ //Load user data to edit
			$usuarios = new Usuarios();
			
			echo $usuarios->loadData($_POST['idSysUsuario']); //Get return to populate fields
		
		} else if ($_POST['op'] == 'delete'){ //Delete user
			$idUser = $_SESSION['idUser'];

			$usuarios = new Usuarios();

			//Get actual date
			$date = date('d/m/Y H:i');

			echo $usuarios->delete($idUser, $date, $_POST['idSysUsuario']); //Get return after delete

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
