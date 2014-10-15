<?php
	require_once("../../../conf/conn.php");
	require_once("../../../actions/security.php");

	class Usuarios {

		//Method to load table data
		function loadTableData($end, $page, $where, $orderBy){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select idUser, firstName, user, lastName, email, departamento From webcafe_usuarios $where $orderBy");
			$sql->execute();
			$total = $sql->rowCount();

			$start = $page - 1;
			$start = $start * $end;

			$limit = $pdo->prepare("Select idUser, firstName, user, lastName, email, departamento From webcafe_usuarios $where $orderBy Limit $start, $end");
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

		// //Method to verify if the user already exists
		function checkUser($dados){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			$sql = $pdo->prepare("Select user From webcafe_usuarios Where user = :user");
			$sql->execute(array(":user" => $user));
			$count = $sql->rowCount();

			return $count;
		}

		//Method to save data
		function save($dados, $password, $idUser, $date, $modulos, $paginas, $acessos){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			$finalPassword = sha1($password);

			//Insert into database
			$sql = $pdo->prepare("
				Insert Into webcafe_usuarios
					(`idUser`, `user`, `password`, `firstName`, `lastName`, `email`, `departamento`, `modulos`, `paginas`, `acessos`, `userAdd`) 
				Values 
					(:idUser, :user, :password, :firstName, :lastName, :email, :departamento, :modulos, :paginas, :acessos, :userAdd)
			");

			$sql->execute(array(
				':idUser' => '', 
				':user' => $user,
				':password' => $finalPassword,
				':firstName' => $firstName,
				':lastName' => $lastName,
				':email' => $email,
				':departamento' => $departamento,
				':modulos' => $modulos,
				':paginas' => $paginas,
				':acessos' => $acessos,
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
		function delete($idUser, $date, $idSysUsuario){
			$pdo = new Connection();

			$sql = $pdo->prepare("Delete From `webcafe_usuarios` Where idUser = :idUser");
			$sql->execute(array(":idUser" => $idSysUsuario));

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

		//Method to load modules
		function loadModules(){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select * From webcafe_modulos");
			$sql->execute();
			$res = $sql->fetchAll(PDO::FETCH_OBJ);

			return $res;
		}

		//Method to load module pages
		function loadModulePages($idModulo){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select * From webcafe_paginas Where idModulo = :idModulo");
			$sql->execute(array(":idModulo" => $idModulo));
			$res = $sql->fetchAll(PDO::FETCH_OBJ);

			return $res;
		}

		//Method to get module id by page id
		function getModuleId($idPagina){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select idModulo From webcafe_paginas Where idPagina = :idPagina");
			$sql->execute(array(":idPagina" => $idPagina));
			$res = $sql->fetch(PDO::FETCH_OBJ);

			return $res->idModulo;
		}

		//Method to load module pages rules
		function loadModulePagesRules($idPagina, $idModulo){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select * From webcafe_moduloPaginaAcesso Where idPagina = :idPagina And idModulo = :idModulo");
			$sql->execute(array(":idPagina" => $idPagina, ":idModulo" => $idModulo));
			$res = $sql->fetchAll(PDO::FETCH_OBJ);

			return $res;
		}
	}

?>