<?php
	require_once("../../../conf/conn.php");
	require_once("../../../actions/security.php");

	class Usuarios {

		//Method to load table data
		function loadTableData($end, $page, $where, $orderBy){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select idUsuario, nome, celular, cep, endereco, bairro, cidade, uf From webcafe_modtelefonia_usuarios $where $orderBy");
			$sql->execute();
			$total = $sql->rowCount();

			$start = $page - 1;
			$start = $start * $end;

			$limit = $pdo->prepare("Select idUsuario, nome, celular, cep, endereco, bairro, cidade, uf From webcafe_modtelefonia_usuarios $where $orderBy Limit $start, $end");
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

		//Method to verify if the user already exists
		function checkUser($dados){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			$sql = $pdo->prepare("Select cpf From webcafe_modtelefonia_usuarios Where cpf = :cpf");
			$sql->execute(array(":cpf" => $cpf));
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
				Insert Into webcafe_modtelefonia_usuarios
					(`idUsuario`, `nome`, `telefone`, `celular`, `cep`, `endereco`, `bairro`, `cidade`, `uf`, `rg`, `profissao`, `cpf`, `observacoes`, `dataCadastro`, `userAdd`) 
				Values 
					(:idUsuario, :nome, :telefone, :celular, :cep, :endereco, :bairro, :cidade, :uf, :rg, :profissao, :cpf, :observacoes, :dataCadastro, :userAdd)
			");

			$sql->execute(array(
				':idUsuario' => '', 
				':nome' => $nome,
				':telefone' => $telefone,
				':celular' => $celular,
				':cep' => $cep,
				':endereco' => $endereco,
				':bairro' => $bairro,
				':cidade' => $cidade,
				':uf' => $uf,
				':rg' => $rg,
				':profissao' => $profissao,
				':cpf' => $cpf,
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
		function loadData($idUsuario){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select * From webcafe_modtelefonia_usuarios Where idUsuario = :idUsuario");
			$sql->execute(array(":idUsuario" => $idUsuario));
			$res = $sql->fetch(PDO::FETCH_OBJ);

			return json_encode($res);
		}

		//Method to edit user
		function edit($dados, $idUser, $date, $idUsuario){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			$sql = $pdo->prepare("
				Update webcafe_modtelefonia_usuarios
			 	Set 
			 		`nome`= :nome,
			 		`telefone`= :telefone,
			 		`celular`= :celular,
			 		`cep`= :cep,
			 		`endereco`= :endereco,
			 		`bairro`= :bairro,
			 		`cidade`= :cidade,
			 		`uf`= :uf,
			 		`rg`= :rg,
			 		`profissao`= :profissao,
			 		`observacoes`= :observacoes,
			 		`dataAlteracao`= :dataAlteracao,
			 		`userLastChange`= :userLastChange
				Where 
					`idUsuario` = :idUsuario
			");

			$sql->execute(array(
				':nome' => $nome,
				':telefone' => $telefone,
				':celular' => $celular,
				':cep' => $cep,
				':endereco' => $endereco,
				':bairro' => $bairro,
				':cidade' => $cidade,
				':uf' => $uf,
				':rg' => $rg,
				':profissao' => $profissao,
				':observacoes' => $observacoes,
				':dataAlteracao' => $date,
				':userLastChange' => $idUser,
				':idUsuario' => $idUsuario
			));

			if($sql){
				return 1; //Update success
			} else  {
				return 2; //Problem on update
			}
		}

		//Method to delete user
		function delete($idUser, $date, $idUsuario){
			$pdo = new Connection();

			$sql = $pdo->prepare("Delete From `webcafe_modtelefonia_usuarios` Where idUsuario = :idUsuario");
			$sql->execute(array(":idUsuario" => $idUsuario));

			if($sql){
				return 1; //Delete success
			} else  {
				return 2; //Problem on delete
			}

		}

		//Method to export to excel
		function exportExcel($output){
			$pdo = new Connection();

			$rows = $pdo->prepare('Select idUsuario, nome, telefone, celular, cep, endereco, bairro, cidade, uf, rg, profissao, cpf, observacoes, dataCadastro, userAdd, dataAlteracao, userLastChange From webcafe_modtelefonia_usuarios');
			$rows->execute();

			//Loop over the rows, outputting them
			while ($row = $rows->fetch(PDO::FETCH_OBJ)) {
				fputcsv($output, array($row->idUsuario, $row->nome, $row->telefone, $row->celular, $row->cep, $row->endereco, $row->bairro, $row->cidade, $row->uf, $row->rg, $row->profissao, $row->cpf, $row->observacoes, $row->dataCadastro, $row->userAdd, $row->dataAlteracao, $row->userLastChange), ';');
			}
		}

		//Method used to import data from excel
		function importExcel($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15, $col16, $col17){
			$pdo = new Connection();

			$query = $pdo->prepare("
				Insert Into webcafe_modtelefonia_usuarios
					(`idUsuario`, `nome`, `telefone`, `celular`, `cep`, `endereco`, `bairro`, `cidade`, `uf`, `rg`, `profissao`, `cpf`, `observacoes`, `dataCadastro`, `userAdd`, `dataAlteracao`, `userLastChange`  ) 
				Values 
					('".$col1."','".$col2."','".$col3."','".$col4."','".$col5."','".$col6."','".$col7."','".$col8."','".$col9."','".$col10."','".$col11."','".$col12."','".$col13."', '".$col14."', '".$col15."', '".$col16."', '".$col17."')");
			$query->execute();
		}
		function loadCep($cep){
			
			// $cep = $_POST['cep'];

			$reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);

			$dados['sucesso'] = (string) $reg->resultado;

			$dados['rua']     = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
			$dados['bairro']  = (string) $reg->bairro;
			$dados['cidade']  = (string) $reg->cidade;
			$dados['estado']  = (string) $reg->uf;			 

			return $dados;
		}	
	}

?>