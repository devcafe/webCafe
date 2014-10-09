<?php
	require_once("../../../conf/conn.php");
	require_once("../../../actions/security.php");

	class Lojas {

		//Method to load table data
		function loadTableData($end, $page, $where, $orderBy){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select idLoja, cnpj, bandeira, nome, rua, numero, complemento, bairro, cidade, uf, cep  From webcafe_modoperacional_lojas a inner join webcafe_modoperacional_bandeiras b on (a.idEstabBandeira = b.idBandeira ) $where $orderBy");
			$sql->execute();
			$total = $sql->rowCount();

			$start = $page - 1;
			$start = $start * $end;

			$limit = $pdo->prepare("Select idLoja, cnpj, bandeira, nome, rua, numero, complemento, bairro, cidade, uf, cep  From webcafe_modoperacional_lojas a inner join webcafe_modoperacional_bandeiras b on (a.idEstabBandeira = b.idBandeira ) $where $orderBy Limit $start, $end");
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

		//Method to verify if the store already exists
		function checkStore($dados){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			$sql = $pdo->prepare("Select cnpj From webcafe_modoperacional_lojas Where cnpj = :cnpj");
			$sql->execute(array(":cnpj" => $cnpj));
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
				Insert Into webcafe_modoperacional_lojas 
					(`idLoja`, `cnpj`,`idEstabBandeira`,`nome`,`rua`,`numero`,`complemento`,`bairro`,`cidade`,`uf`,`cep`,`estabReceitaAberturaData`,`estabReceitaRazaoSocial`,`estabReceitaNomeEmpresarial`,`estabReceitaNF`,`estabReceitaEndereco`,`estabReceitaNumero`,`estabReceitaComplemento`,`estabReceitaBairro`,`estabReceitaCidade`,`estabReceitaUF`,`estabReceitaCEP`,`estabReceitaSituacao`,`estabReceitaSituacaoData`,`estabTel01`,`estabTel02`,`dataFechamento`) 
				Values 
					(:idLoja,:cnpj,:idEstabBandeira,:nome,:rua,:numero,:complemento,:bairro,:cidade,:uf,:cep,:estabReceitaAberturaData,:estabReceitaRazaoSocial,:estabReceitaNomeEmpresarial,:estabReceitaNF,:estabReceitaEndereco,:estabReceitaNumero,:estabReceitaComplemento,:estabReceitaBairro,:estabReceitaCidade,:estabReceitaUF,:estabReceitaCEP,:estabReceitaSituacao,:estabReceitaSituacaoData,:estabTel01,:estabTel02,:dataFechamento)
			");

			$sql->execute(array(
				':idLinha' => '', 
				':cnpj' => $cnpj,
				':idEstabBandeira' => $bandeira,
				':nome' => $nome,
				':rua' => $rua,
				':numero' => $numero,
				':complemento' => $complemento,
				':bairro' => $bairro,
				':cidade' => $cidade,
				':uf' => $uf,				
				':cep' => $cep,
				':estabReceitaAberturaData' => $estabReceitaAberturaData,
				':estabReceitaRazaoSocial' => $estabReceitaRazaoSocial,
				':estabReceitaNomeEmpresarial' => $estabReceitaNomeEmpresarial,
				':estabReceitaNF' => $estabReceitaNF,
				':estabReceitaEndereco' => $estabReceitaEndereco,
				':estabReceitaNumero' => $estabReceitaNumero,
				':estabReceitaComplemento' => $estabReceitaComplemento,
				':estabReceitaBairro' => $estabReceitaBairro,
				':estabReceitaCidade' => $estabReceitaCidade,
				':estabReceitaUF' => $estabReceitaUF,
				':estabReceitaCEP' => $estabReceitaCEP,
				':estabReceitaSituacao' => $estabReceitaSituacao,
				':estabReceitaSituacaoData' => $estabReceitaSituacaoData,
				':estabTel01' => $estabTel01,
				':estabTel02' => $estabTel02,
				':dataFechamento' => $dataFechamento,
			));

			if($sql){
				return 1; //Insert success
			} else  {
				return 2; //Problem on insert
			}
		}

		//Method to load data before edit
		function loadData($idLoja){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select * From webcafe_modoperacional_lojas a inner join webcafe_modoperacional_bandeiras b on (a.idEstabBandeira = b.idBandeira ) Where idLoja = :idLoja");
			$sql->execute(array(":idLoja" => $idLoja));
			$res = $sql->fetch(PDO::FETCH_OBJ);

			return json_encode($res);
		}

		// function loadFlag($keyword){
		// 	$pdo = new Connection();
		// 	$keyword = '%'.$_POST['keyword'].'%';
		// 	$sql = $pdo->prepare("SELECT * FROM webcafe_modoperacional_bandeiras WHERE bandeira LIKE (:keyword) ORDER BY bandeira ASC LIMIT 0,10");
		// 	$sql->bindParam(':keyword', $keyword, PDO::PARAM_STR);
		// 	$sql->execute();
		// 	$res = $sql->fetchAll();			
		// 	foreach ($res as $rs) {
		// 		// put in bold the written text
		// 		$bandeira = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['bandeira']);
		// 		// add new option
		// 	    echo '<li id ="'.$rs['idBandeira'].'">'. $bandeira .'</li>';
		// 	}			
		// }		

	// 	//Method to edit store
	// 	function edit($dados, $idUser, $date, $idLinha){
	// 		$pdo = new Connection();

	// 		//Transform data into variables
	// 		$data = parse_str($dados);

	// 		$sql = $pdo->prepare("
	// 			Update webcafe_modoperacional_lojas
	// 		 	Set 
	// 		 		`numLinha`= :numLinha,
	// 		 		`plano`= :plano,
	// 		 		`iccid`= :iccid,
	// 		 		`linhaStatus`= :linhaStatus,
	// 		 		`operadora`= :operadora,
	// 		 		`observacoes`= :observacoes,
	// 		 		`dataAlteracao`= :dataAlteracao,
	// 		 		`userLastChange`= :userLastChange 
	// 			Where 
	// 				`idLinha` = :idLinha
	// 		");

	// 		$sql->execute(array(
	// 			':numLinha' => $numLinha,
	// 			':plano' => $plano,
	// 			':iccid' => $iccid,
	// 			':linhaStatus' => $status,
	// 			':operadora' => $operadora,
	// 			':observacoes' => $observacoes,
	// 			':dataAlteracao' => $date,
	// 			':userLastChange' => $idUser,
	// 			':idLinha' => $idLinha
	// 		));

	// 		if($sql){
	// 			return 1; //Update success
	// 		} else  {
	// 			return 2; //Problem on update
	// 		}
	// 	}

	// 	//Method to delete store
	// 	function delete($idUser, $date, $idLinha){
	// 		$pdo = new Connection();

	// 		$sql = $pdo->prepare("Delete From `webcafe_modoperacional_lojas` Where idLinha = :idLinha");
	// 		$sql->execute(array(":idLinha" => $idLinha));

	// 		if($sql){
	// 			return 1; //Delete success
	// 		} else  {
	// 			return 2; //Problem on delete
	// 		}

	// 	}

		//Method to export to excel
	// 	function exportExcel($output){
	// 		$pdo = new Connection();

	// 		$rows = $pdo->prepare('Select numLinha, plano, iccid, linhaStatus, operadora, observacoes From webcafe_modoperacional_lojas');
	// 		$rows->execute();

	// 		//Loop over the rows, outputting them
	// 		while ($row = $rows->fetch(PDO::FETCH_OBJ)) {
	// 			fputcsv($output, array($row->numLinha, $row->plano, $row->iccid, $row->linhaStatus, $row->operadora, $row->observacoes), ';');
	// 		}
	// 	}

	// 	//Method used to impor data from excel
	// 	function importExcel($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11){
	// 		$pdo = new Connection();
			
	// 		$query = $pdo->prepare("
	// 			Insert Into webcafe_modoperacional_lojas
	// 				(`idLinha`, `numLinha`, `plano`, `iccid`, `linhaStatus`, `operadora`, `observacoes`, `dataCadastro`, `dataAlteracao`, `userAdd`, `userLastChange`) 
	// 			Values 
	// 				('".$col1."','".$col2."','".$col3."','".$col4."','".$col5."','".$col6."','".$col7."','".$col8."','".$col9."','".$col10."','".$col11."')");
	// 		$query->execute();
	// 	}
	// }
	}
?>
	
