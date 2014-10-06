<?php
	require_once("../model/ger_aparelhos.php");

	if($_POST['op'] == 'loadTable'){
		$end = $_POST['regsLimit'];
		$page = $_POST['page'];

		if(isset($_POST['searchVal']) && $_POST['searchVal'] != ''){
			$where = "
				Where
					marcaAparelho like '%".$_POST['searchVal']."%' 
				Or modeloAparelho like '%".$_POST['searchVal']."%'
				Or imeiAparelho like '%".$_POST['searchVal']."%'
				Or tipo like '%".$_POST['searchVal']."%'
				Or aparelhoStatus like '%".$_POST['searchVal']."%'
				Or acessorios like '%".$_POST['searchVal']."%'
				Or observacoes like '%".$_POST['searchVal']."%'
			";
		} else {
			$where = '';
		}

		if(isset($_POST['order']) && $_POST['order'] != ''){
			$orderBy = 'Order By ' . $_POST['order'];
		} else {
			$orderBy = '';
		}

		$aparelhos = new Aparelhos();
		echo $aparelhos->loadTableData($end, $page, $where, $orderBy);
	}
?>
