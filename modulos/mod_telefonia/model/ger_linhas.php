<?php
	require_once("../../../conf/conn.php");

	class Linhas {

		function loadTableData($end, $page, $where, $orderBy){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select numLinha, plano From webcafe_modTelefonia_linhas $where $orderBy");
			$sql->execute();
			$total = $sql->rowCount();

			$start = $page - 1;
			$start = $start * $end;

			$limit = $pdo->prepare("Select numLinha, plano From webcafe_modTelefonia_linhas $where $orderBy Limit $start, $end");
			$limit->execute();

			$pages = $total/$end;

			$res['actualPage'] = $page;
			$res['maxRegsPage'] = 6;
			$res['totalPages'] = ceil($pages);
			$res['totalRegs'] = $total;
			$res[1] = $limit->fetchAll(PDO::FETCH_OBJ);

			return json_encode($res);
		}
	}

?>
	
