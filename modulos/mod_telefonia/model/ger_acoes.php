<?php
	require_once("../../../conf/conn.php");
	require_once("../../../actions/security.php");

	class Acoes {

		//Method to load table data
		function loadTableData($end, $page, $where, $orderBy){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select idAcao, nome, cnpj, razaoSocial From webcafe_modTelefonia_acoes $where $orderBy");
			$sql->execute();
			$total = $sql->rowCount();

			$start = $page - 1;
			$start = $start * $end;

			$limit = $pdo->prepare("Select idAcao, nome, cnpj, razaoSocial From webcafe_modTelefonia_acoes $where $orderBy Limit $start, $end");
			$limit->execute();

			$pages = $total/$end;

			if($page > $pages){
				$res['actualPage'] = ceil($pages);
			} else {
				$res['actualPage'] = $page;
			}

			$res['maxRegsPage'] = 6;
			$res['totalPages'] = ceil($pages);
			$res['totalRegs'] = $total;
			$res[1] = $limit->fetchAll(PDO::FETCH_OBJ);

			$pdo = null;

			return json_encode($res);
		}

		// //Method to verify if the job already exists
		// function checkJob($dados){
		// 	$pdo = new Connection();

		// 	//Transform data into variables
		// 	$data = parse_str($dados);

		// 	$sql = $pdo->prepare("Select imei From webcafe_modtelefonia_acoes Where imei = :imei");
		// 	$sql->execute(array(":imei" => $imei));
		// 	$count = $sql->rowCount();

		// 	return $count;
		// }

		//Method to save data
		function save($dados, $idUser, $date){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			//Insert into database
			$sql = $pdo->prepare("
				Insert Into webcafe_modtelefonia_acoes
					(`idAcao`, `nome`, `cnpj`, `razaoSocial`, `dataCadastro`, `userAdd`) 
				Values 
					(:idAcao, :nome, :cnpj, :razaoSocial, :dataCadastro, :userAdd)
			");

			$sql->execute(array(
				':idAcao' => '', 
				':nome' => $nome,
				':cnpj' => $cnpj,
				':razaoSocial' => $razaoSocial,
				':dataCadastro' => $date,
				':userAdd' => $idUser
			));

			if($sql){
				return 1; //Insert success
			} else  {
				return 2; //Problem on insert
			}
		}

		//Method to load data before edit
		function loadData($idAcao){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select * From webcafe_modtelefonia_acoes Where idAcao = :idAcao");
			$sql->execute(array(":idAcao" => $idAcao));
			$res = $sql->fetch(PDO::FETCH_OBJ);

			return json_encode($res);
		}

		//Method to edit job
		function edit($dados, $idUser, $date, $idAcao){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			$sql = $pdo->prepare("
				Update webcafe_modtelefonia_acoes
			 	Set 
			 		`nome`= :nome,
			 		`cnpj`= :cnpj,
			 		`razaoSocial`= :razaoSocial,
			 		`dataAlteracao`= :dataAlteracao,
			 		`userLastChange`= :userLastChange
				Where 
					`idAcao` = :idAcao
			");

			$sql->execute(array(
				':nome' => $nome,
				':cnpj' => $cnpj,
				':razaoSocial' => $razaoSocial,
				':dataAlteracao' => $date,
				':userLastChange' => $idUser,
				':idAcao' => $idAcao
			));

			if($sql){
				return 1; //Update success
			} else  {
				return 2; //Problem on update
			}
		}

		//Method to delete line
		function delete($idUser, $date, $idAcao){
			$pdo = new Connection();

			$sql = $pdo->prepare("Delete From `webcafe_modtelefonia_acoes` Where idAcao = :idAcao");
			$sql->execute(array(":idAcao" => $idAcao));

			if($sql){
				return 1; //Delete success
			} else  {
				return 2; //Problem on delete
			}

		}

		//Method to export to excel
		function exportExcel($output){
			$pdo = new Connection();

			$rows = $pdo->prepare('Select idAcao, nome, cnpj, razaoSocial, dataCadastro, dataAlteracao, userAdd, userLastChange From webcafe_modtelefonia_acoes');
			$rows->execute();

			//Loop over the rows, outputting them
			while ($row = $rows->fetch(PDO::FETCH_OBJ)) {
				fputcsv($output, array($row->idAcao, $row->nome, $row->cnpj, $row->razaoSocial, $row->dataCadastro, $row->dataAlteracao, $row->userAdd, $row->userLastChange), ';');
			}
		}

		//Method used to import data from excel
		function importExcel($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8){
			$pdo = new Connection();

			$query = $pdo->prepare("
				Insert Into webcafe_modtelefonia_acoes
					(`idAcao`, `nome`, `cnpj`, `razaoSocial`, `dataCadastro`, `dataAlteracao`, `userAdd`, `userLastChange`) 
				Values 
					('".$col1."','".$col2."','".$col3."','".$col4."','".$col5."','".$col6."','".$col7."','".$col8."')");
			$query->execute();
		}
	}

?>