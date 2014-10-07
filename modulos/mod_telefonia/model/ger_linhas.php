<?php
	require_once("../../../conf/conn.php");
	require_once("../../../actions/security.php");

	class Linhas {

		//Method to load table data
		function loadTableData($end, $page, $where, $orderBy){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select idLinha, numLinha, plano, iccid From webcafe_modTelefonia_linhas $where $orderBy");
			$sql->execute();
			$total = $sql->rowCount();

			$start = $page - 1;
			$start = $start * $end;

			$limit = $pdo->prepare("Select idLinha, numLinha, plano, iccid From webcafe_modTelefonia_linhas $where $orderBy Limit $start, $end");
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

		//Method to save data
		function save($dados, $idUser, $date){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			//Insert into database
			$sql = $pdo->prepare("
				Insert Into webcafe_modtelefonia_linhas 
					(`idLinha`, `numLinha`, `plano`, `iccid`, `linhaStatus`, `operadora`, `observacoes`, `dataCadastro`, `userAdd`) 
				Values 
					(:idLinha, :numLinha, :plano, :iccid, :linhaStatus, :operadora, :observacoes, :dataCadastro, :userAdd)
			");

			$sql->execute(array(
				':idLinha' => '', 
				':numLinha' => $numLinha,
				':plano' => $plano,
				':iccid' => $iccid,
				':linhaStatus' => $status,
				':operadora' => $operadora,
				':observacoes' => $observacoes,
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
		function loadData($idLinha){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select * From webcafe_modTelefonia_linhas Where idLinha = :idLinha");
			$sql->execute(array(":idLinha" => $idLinha));
			$res = $sql->fetch(PDO::FETCH_OBJ);

			return json_encode($res);
		}

		//Method to edit line
		function edit($dados, $idUser, $date, $idLinha){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			$sql = $pdo->prepare("
				Update webcafe_modTelefonia_linhas
			 	Set 
			 		`numLinha`= :numLinha,
			 		`plano`= :plano,
			 		`iccid`= :iccid,
			 		`linhaStatus`= :linhaStatus,
			 		`operadora`= :operadora,
			 		`observacoes`= :observacoes,
			 		`dataAlteracao`= :dataAlteracao,
			 		`userLastChange`= :userLastChange 
				Where 
					`idLinha` = :idLinha
			");

			$sql->execute(array(
				':numLinha' => $numLinha,
				':plano' => $plano,
				':iccid' => $iccid,
				':linhaStatus' => $status,
				':operadora' => $operadora,
				':observacoes' => $observacoes,
				':dataAlteracao' => $date,
				':userLastChange' => $idUser,
				':idLinha' => $idLinha
			));

			if($sql){
				return 1; //Update success
			} else  {
				return 2; //Problem on update
			}
		}

		//Method to delete line
		function delete($idUser, $date, $idLinha){
			$pdo = new Connection();

			$sql = $pdo->prepare("Delete From `webcafe_modtelefonia_linhas` Where idLinha = :idLinha");
			$sql->execute(array(":idLinha" => $idLinha));

			if($sql){
				return 1; //Delete success
			} else  {
				return 2; //Problem on delete
			}

		}
	}

?>
	
