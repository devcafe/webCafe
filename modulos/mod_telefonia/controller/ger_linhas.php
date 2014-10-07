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
		echo $linhas->loadTableData($end, $page, $where, $orderBy);
	} else if ($_POST['op'] == 'save'){ //Save operation
		$idUser = $_SESSION['idUser'];
		echo $idUser;
	}
?>
