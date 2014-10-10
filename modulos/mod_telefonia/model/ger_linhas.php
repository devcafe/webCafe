<?php
	require_once("../../../conf/conn.php");
	require_once("../../../actions/security.php");

	class Linhas {

		//Method to load table data
		function loadTableData($end, $page, $where, $orderBy){
			$pdo = new Connection();

			$sql = $pdo->prepare("
				Select 
					a.idLinha, a.numLinha, concat(marca, ' - ', modelo, ' - ', imei) As aparelho, a.linhaStatus, c.nome
				From  
					webcafe_modTelefonia_linhas a
				Inner Join webcafe_modtelefonia_aparelhos b On (a.idAparelho = b.idAparelho)
				Inner Join webcafe_modtelefonia_usuarios c On (a.idUsuario = c.idUsuario)
				$where 
				$orderBy");

			$sql->execute();
			$total = $sql->rowCount();

			$start = $page - 1;
			$start = $start * $end;

			$limit = $pdo->prepare("
				Select 
					a.idLinha, a.numLinha, concat(marca, ' - ', modelo, ' - ', imei) As aparelho, a.linhaStatus, c.nome
				From 
					webcafe_modTelefonia_linhas a
				Inner Join webcafe_modtelefonia_aparelhos b On (a.idAparelho = b.idAparelho)
				Inner Join webcafe_modtelefonia_usuarios c On (a.idUsuario = c.idUsuario) 
				$where 
				$orderBy 
				Limit $start, $end");

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

		//Method to verify if the line already exists
		function checkLine($dados){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			$sql = $pdo->prepare("Select numLinha From webcafe_modtelefonia_linhas Where numLinha = :numLinha");
			$sql->execute(array(":numLinha" => $numLinha));
			$count = $sql->rowCount();

			return $count;
		}

		//Method to load device select (used as autocomplete too)
		function autoCompleteDevices($operation, $idUser){
			$pdo = new Connection();

			if($operation == 'add'){			

				$sql = $pdo->prepare('Select idAparelho, concat(marca, "-" , modelo, "-", imei ) As aparelho From webcafe_modtelefonia_aparelhos Where status = "Disponivel" And idAparelho <> 1');

				$sql->execute();

				$obj = $sql->fetchAll(PDO::FETCH_OBJ);
		     		
				return $obj;
			} else {
				//$sql = $pdo->prepare('Select idAparelho, concat(marca, "-" , modelo, "-", imei ) As aparelho From webcafe_modtelefonia_aparelhos Where idAparelho <> 1 And status = "Disponivel"');
				//Get all devices with status "disponivel" and user current device
				$sql = $pdo->prepare('
					Select distinct a.idAparelho, concat(a.marca, "-" , a.modelo, "-", a.imei ) As aparelho 
					From webcafe_modtelefonia_aparelhos a 
					Inner Join webcafe_modtelefonia_linhas b On ( 
					    a.`status` = "Disponivel"
						Or a.idAparelho = 1
					    Or a.idAparelho in (Select idAparelho From webcafe_modtelefonia_linhas Where idUsuario = :idUsuario)
					)
				');

				$sql->execute(array(":idUsuario" => $idUser));

				$obj = $sql->fetchAll(PDO::FETCH_OBJ);
		     		
				return $obj;
			}
		}

		//Method to load user select (used as autocomplete too)
		function autoCompleteUsers(){
			$pdo = new Connection();

			$sql = $pdo->prepare('Select idUsuario, concat(nome, "-" , cpf) As usuario From webcafe_modtelefonia_usuarios Where idUsuario <> 1');

			$sql->execute();

			$obj = $sql->fetchAll(PDO::FETCH_OBJ);
	     		
			return $obj;
		}

		//Method to save data
		function save($dados, $idUser, $date){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			//Insert into database
			$sql = $pdo->prepare("
				Insert Into webcafe_modtelefonia_linhas 
					(`idLinha`, `idAparelho`, `idUsuario`, `numLinha`, `plano`, `iccid`, `linhaStatus`, `operadora`, `observacoes`, `dataCadastro`, `userAdd`) 
				Values 
					(:idLinha, :idAparelho, :idUsuario, :numLinha, :plano, :iccid, :linhaStatus, :operadora, :observacoes, :dataCadastro, :userAdd)
			");

			$sql->execute(array(
				':idLinha' => '', 
				':idAparelho' => $idAparelho, 
				':idUsuario' => $idUsuario, 
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

		//Method to get line atached device
		function getLineDevice($idLinha){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select idAparelho From webcafe_modTelefonia_linhas Where idLinha = :idLinha");
			$sql->execute(array(":idLinha" => $idLinha));
			$res = $sql->fetch(PDO::FETCH_OBJ);

			return $res->idAparelho;
		}

		//Method used to change device status after insert
		//It's necessary because you only put a line into a avaible device
		function updateDeviceStatus($dados, $idUser, $date, $deviceStatus){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			$sql = $pdo->prepare("
				Update webcafe_modtelefonia_aparelhos
			 	Set 
			 		`status`= :status,
			 		`dataAlteracao`= :dataAlteracao,
			 		`userLastChange`= :userLastChange 
				Where 
					`idAparelho` = :idAparelho
			");

			$sql->execute(array(
				':status' => $deviceStatus,
				':dataAlteracao' => $date,
				':userLastChange' => $idUser,
				':idAparelho' => $idAparelho
			));
		}

		//Method to load data before edit
		function loadData($idLinha){
			$pdo = new Connection();

			$sql = $pdo->prepare("
				Select 
					* 
				From 
					webcafe_modTelefonia_linhas a
					Inner Join webcafe_modtelefonia_aparelhos b On (a.idAparelho = b.idAparelho)
					Inner Join webcafe_modtelefonia_usuarios c On (a.idUsuario = c.idUsuario) 
				Where 
					a.idLinha = :idLinha");
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
			 		`idAparelho`= :idAparelho,
			 		`idUsuario`= :idUsuario,
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
		 		':idAparelho'=> $idAparelho,
		 		':idUsuario'=> $idUsuario,
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

		//Method to export to excel
		function exportExcel($output){
			$pdo = new Connection();

			$rows = $pdo->prepare('Select idLinha, numLinha, plano, iccid, linhaStatus, operadora, observacoes, dataCadastro, dataAlteracao, userAdd, userLastChange From webcafe_modtelefonia_linhas');
			$rows->execute();

			//Loop over the rows, outputting them
			while ($row = $rows->fetch(PDO::FETCH_OBJ)) {
				fputcsv($output, array($row->idLinha, $row->numLinha, $row->plano, $row->iccid, $row->linhaStatus, $row->operadora, $row->observacoes, $row->dataCadastro, $row->dataAlteracao, $row->userAdd, $row->userLastChange), ';');
			}
		}

		//Method used to impor data from excel
		function importExcel($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11){
			$pdo = new Connection();

			$query = $pdo->prepare("
				Insert Into webcafe_modTelefonia_linhas
					(`idLinha`, `numLinha`, `plano`, `iccid`, `linhaStatus`, `operadora`, `observacoes`, `dataCadastro`, `dataAlteracao`, `userAdd`, `userLastChange`) 
				Values 
					('".$col1."','".$col2."','".$col3."','".$col4."','".$col5."','".$col6."','".$col7."','".$col8."','".$col9."','".$col10."','".$col11."')");
			$query->execute();
		}
	}

?>