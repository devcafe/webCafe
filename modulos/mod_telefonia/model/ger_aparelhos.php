<?php
	require_once("../../../conf/conn.php");
	require_once("../../../actions/security.php");

	class Aparelhos {

		//Method to load table data
		function loadTableData($end, $page, $where, $orderBy){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select idAparelho, marca, modelo, imei, tipo, status From webcafe_modTelefonia_aparelhos $where $orderBy");
			$sql->execute();
			$total = $sql->rowCount();

			$start = $page - 1;
			$start = $start * $end;

			$limit = $pdo->prepare("Select idAparelho, marca, modelo, imei, tipo, status From webcafe_modTelefonia_aparelhos $where $orderBy Limit $start, $end");
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

		//Method to verify if the cell phone already exists
		function checkCellPhone($dados){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			$sql = $pdo->prepare("Select imei From webcafe_modTelefonia_aparelhos Where imei = :imei");
			$sql->execute(array(":imei" => $imei));
			$count = $sql->rowCount();

			return $count;
		}

		//Method to save data
		function save($dados, $idUser, $date){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			//Insert into database
			$sql = $pdo->prepare("
				Insert Into webcafe_modtelefonia_aparelhos
					(`idAparelho`, `marca`, `modelo`, `imei`, `tipo`, `status`, `dataEnvioManutencao`, `acessorios`, `observacoes`, `dataCadastro`, `userAdd`) 
				Values 
					(:idAparelho, :marca, :modelo, :imei, :tipo, :status, :dataEnvioManutencao, :acessorios, :observacoes, :dataCadastro, :userAdd)
			");

			$sql->execute(array(
				':idAparelho' => '', 
				':marca' => $marca,
				':modelo' => $modelo,
				':imei' => $imei,
				':tipo' => $tipo,
				':status' => $status,
				':dataEnvioManutencao' => $dataEnvioManutencao,
				':acessorios' => $acessorios,
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
		function loadData($idAparelho){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select * From webcafe_modTelefonia_aparelhos Where idAparelho = :idAparelho");
			$sql->execute(array(":idAparelho" => $idAparelho));
			$res = $sql->fetch(PDO::FETCH_OBJ);

			return json_encode($res);
		}

		//Method to edit cell phone
		function edit($dados, $idUser, $date, $idAparelho){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			$sql = $pdo->prepare("
				Update webcafe_modTelefonia_aparelhos
			 	Set 
			 		`marca`= :marca,
			 		`modelo`= :modelo,
			 		`imei`= :imei,
			 		`tipo`= :tipo,
			 		`status`= :status,
			 		`dataEnvioManutencao`= :dataEnvioManutencao,
			 		`acessorios`= :acessorios,
			 		`observacoes`= :observacoes,
			 		`userLastChange`= :userLastChange
				Where 
					`idAparelho` = :idAparelho
			");

			$sql->execute(array(
				':marca' => $marca,
				':modelo' => $modelo,
				':imei' => $imei,
				':tipo' => $tipo,
				':status' => $status,
				':dataEnvioManutencao' => $dataEnvioManutencao,
				':acessorios' => $acessorios,
				':observacoes' => $observacoes,
				':userLastChange' => $idUser,
				':idAparelho' => $idAparelho
			));

			if($sql){
				return 1; //Update success
			} else  {
				return 2; //Problem on update
			}
		}

		//Method to delete line
		function delete($idUser, $date, $idAparelho){
			$pdo = new Connection();

			$sql = $pdo->prepare("Delete From `webcafe_modtelefonia_aparelhos` Where idAparelho = :idAparelho");
			$sql->execute(array(":idAparelho" => $idAparelho));

			if($sql){
				return 1; //Delete success
			} else  {
				return 2; //Problem on delete
			}

		}

		//Method to export to excel
		function exportExcel($output){
			$pdo = new Connection();

			$rows = $pdo->prepare('Select idAparelho, marca, modelo, imei, tipo, status, dataEnvioManutencao, acessorios, observacoes, dataCadastro, dataAlteracao, userAdd, userLastChange From webcafe_modtelefonia_aparelhos');
			$rows->execute();

			//Loop over the rows, outputting them
			while ($row = $rows->fetch(PDO::FETCH_OBJ)) {
				fputcsv($output, array($row->idAparelho, $row->marca, $row->modelo, $row->imei, $row->tipo, $row->status, $row->dataEnvioManutencao, $row->acessorios, $row->observacoes, $row->dataCadastro, $row->dataCadastro, $row->dataAlteracao, $row->userLastChange), ';');
			}
		}

		//Method used to import data from excel
		function importExcel($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11){
			$pdo = new Connection();

			$query = $pdo->prepare("
				Insert Into webcafe_modTelefonia_aparelhos
					(`idAparelho`, `marca`, `modelo`, `imei`, `tipo`, `status`, `dataEnvioManutencao`, `acessorios`, `observacoes`, `userAdd`, `userLastChange`) 
				Values 
					('".$col1."','".$col2."','".$col3."','".$col4."','".$col5."','".$col6."','".$col7."','".$col8."','".$col9."','".$col10."','".$col11."')");
			$query->execute();
		}
	}

?>