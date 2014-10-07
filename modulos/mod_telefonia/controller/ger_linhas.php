<?php
	require_once("../model/ger_linhas.php");
	require_once("../../../actions/security.php");

	//Load table data
	if($_POST['op'] == 'loadTable'){
		$end = $_POST['regsLimit'];
		$page = $_POST['page'];

		if(isset($_POST['searchVal']) && $_POST['searchVal'] != ''){
			$where = "Where numLinha like '%".$_POST['searchVal']."%' Or plano like '%".$_POST['searchVal']."%' Or iccid like '%".$_POST['searchVal']."%'";
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

		echo $linhas->save($_POST['formData'], $idUser, $date); //Get return after insert

	} else if ($_POST['op'] == 'loadData'){ //Load line data to edit
		$linhas = new Linhas();

		echo $linhas->loadData($_POST['idLinha']); //Get return to populate fields
	
	} else if ($_POST['op'] == 'update'){ //Edit line
		$idUser = $_SESSION['idUser'];

		$linhas = new Linhas();

		//Get actual date
		$date = date('d/m/Y H:i');

		echo $linhas->edit($_POST['formData'], $idUser, $date, $_POST['idLinha']); //Get return after update

	} else if ($_POST['op'] == 'delete'){ //Delete line
		$idUser = $_SESSION['idUser'];

		$linhas = new Linhas();

		//Get actual date
		$date = date('d/m/Y H:i');

		echo $linhas->delete($idUser, $date, $_POST['idLinha']); //Get return after delete
	}
?>
