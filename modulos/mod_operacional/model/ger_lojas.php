<?php
	require_once("../../../conf/conn.php");
	require_once("../../../actions/security.php");

	class Lojas {

		//Method to load table data
		function loadTableData($end, $page, $where, $orderBy){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select idLoja, cnpj, bandeira, idEstabBandeira, nome, rua, numero, complemento, bairro, cidade, uf, cep  From webcafe_modoperacional_lojas a inner join webcafe_modoperacional_bandeiras b on (a.idEstabBandeira = b.idBandeira ) $where $orderBy");
			$sql->execute();
			$total = $sql->rowCount();

			$start = $page - 1;
			$start = $start * $end;

			$limit = $pdo->prepare("Select idLoja, cnpj, bandeira, idEstabBandeira, nome, rua, numero, complemento, bairro, cidade, uf, cep  From webcafe_modoperacional_lojas a inner join webcafe_modoperacional_bandeiras b on (a.idEstabBandeira = b.idBandeira ) $where $orderBy Limit $start, $end");
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

			function u($str){
				$str = strtoupper($str);
				return $str;
			}
			

			$sql = $pdo->prepare("INSERT INTO `webcafe_modoperacional_lojas` (`idLoja`,`cnpj`, `idEstabBandeira`, `nome`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cep`, `estabReceitaAberturaData`, `estabReceitaRazaoSocial`, `estabReceitaNomeEmpresarial`, `estabReceitaNF`, `estabReceitaEndereco`, `estabReceitaNumero`, `estabReceitaComplemento`, `estabReceitaBairro`, `estabReceitaCidade`, `estabReceitaUF`, `estabReceitaCEP`, `estabReceitaSituacao`, `estabReceitaSituacaoData`, `estabTel01`, `estabTel02`, `dataFechamento`, `userAdd`) VALUES (:idLoja,:cnpj, :idEstabBandeira, :nome, :rua, :numero, :complemento, :bairro, :cidade, :uf, :cep, :estabReceitaAberturaData, :estabReceitaRazaoSocial, :estabReceitaNomeEmpresarial, :estabReceitaNF, :estabReceitaEndereco, :estabReceitaNumero, :estabReceitaComplemento, :estabReceitaBairro, :estabReceitaCidade, :estabReceitaUF, :estabReceitaCEP, :estabReceitaSituacao, :estabReceitaSituacaoData, :estabTel01, :estabTel02, :dataFechamento, :userAdd)");

			$sql->execute(array(
				':idLoja' => '',
				':cnpj' => $cnpj, 
				':idEstabBandeira' => $bandeira, 
				':nome' => u($nome), 
				':rua' => u($rua), 
				':numero' => $numero, 
				':complemento' => u($complemento), 
				':bairro' => u($bairro), 
				':cidade' => u($cidade), 
				':uf' => u($uf), 
				':cep' => $cep, 
				':estabReceitaAberturaData' => $estabReceitaAberturaData, 
				':estabReceitaRazaoSocial' => u($estabReceitaRazaoSocial), 
				':estabReceitaNomeEmpresarial' => u($estabReceitaNomeEmpresarial), 
				':estabReceitaNF' => u($estabReceitaNF), 
				':estabReceitaEndereco' => u($estabReceitaEndereco), 
				':estabReceitaNumero' => $estabReceitaNumero, 
				':estabReceitaComplemento' => u($estabReceitaComplemento), 
				':estabReceitaBairro' => u($estabReceitaBairro), 
				':estabReceitaCidade' => u($estabReceitaCidade), 
				':estabReceitaUF' => u($estabReceitaUF), 
				':estabReceitaCEP' => $estabReceitaCEP, 
				':estabReceitaSituacao' => $estabReceitaSituacao, 
				':estabReceitaSituacaoData' => $estabReceitaSituacaoData, 
				':estabTel01' => $estabTel01, 
				':estabTel02' => $estabTel02, 
				':dataFechamento' => $dataFechamento, 
				':userAdd' => $idUser,
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

			$sql = $pdo->prepare("SELECT * From webcafe_modoperacional_lojas a inner join webcafe_modoperacional_bandeiras b on (a.idEstabBandeira = b.idBandeira ) Where idLoja = :idLoja");
			$sql->execute(array(":idLoja" => $idLoja));
			$res = $sql->fetch(PDO::FETCH_OBJ);

			return json_encode($res);
		}

		//Method to load flag select (used as autocomplete too)
		function autoCompleteFlag(){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select idBandeira, bandeira From webcafe_modoperacional_bandeiras");

			$sql->execute();

			$obj = $sql->fetchAll(PDO::FETCH_OBJ);
	     		
			return $obj;
		}

		function loadCep($cep){
			function normalizeStr($str) {
				$invalid = array(
					"Ã" => "A", "ã" => "a", "Á" => "A", "á" => "a", "Â" => "A", "â" => "a",
					"Ê" => "E", "ê" => "e", "É" => "E", "é" => "e", "Ç" => "C", "ç" => "c",
					"_" => " ", "Ó" => "O", "ó" => "o", "Ô" => "O", "ô" => "o", "Õ" => "O",
					"õ" => "o", "Í" => "I", "í" => "i", "Ú" => "U", "ú" => "u"
				);

				$str = str_replace(array_keys($invalid), array_values($invalid), $str);

				return $str;
			}

			// $cep = $_POST['cep'];

			$reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);

			$dados['sucesso'] = (string) $reg->resultado;

			$dados['rua']     = normalizeStr((string) $reg->tipo_logradouro . ' ' . $reg->logradouro);
			$dados['bairro']  = normalizeStr((string) $reg->bairro);
			$dados['cidade']  = normalizeStr((string) $reg->cidade);
			$dados['estado']  = (string) $reg->uf;			 

			return $dados;
		}		

		//Method to edit store
		function edit($dados, $idUser, $date, $idLoja){
			$pdo = new Connection();

			//Transform data into variables
			$data = parse_str($dados);

			function u($str){
				$str = strtoupper($str);
				return $str;
			}			
			
			$sql = $pdo->prepare("
				Update webcafe_modoperacional_lojas
			 	Set 
			 		`cnpj`= :cnpj,
			 		`idEstabBandeira`= :idEstabBandeira,
			 		`nome`= :nome,
			 		`rua`= :rua,
			 		`numero`= :numero,
			 		`complemento`= :complemento,
			 		`bairro`= :bairro,
			 		`cidade`= :cidade,
			 		`uf`= :uf,
			 		`cep`= :cep,
			 		`estabReceitaAberturaData`= :estabReceitaAberturaData,
			 		`estabReceitaRazaoSocial`= :estabReceitaRazaoSocial,
			 		`estabReceitaNomeEmpresarial`= :estabReceitaNomeEmpresarial,
			 		`estabReceitaNF`= :estabReceitaNF,
			 		`estabReceitaEndereco`= :estabReceitaEndereco,
			 		`estabReceitaNumero`= :estabReceitaNumero,
			 		`estabReceitaComplemento`= :estabReceitaComplemento,
			 		`estabReceitaBairro`= :estabReceitaBairro,
			 		`estabReceitaCidade`= :estabReceitaCidade,
			 		`estabReceitaUF`= :estabReceitaUF,
			 		`estabReceitaCEP`= :estabReceitaCEP,
			 		`estabReceitaSituacao`= :estabReceitaSituacao,
			 		`estabReceitaSituacaoData`= :estabReceitaSituacaoData,
			 		`estabTel01`= :estabTel01,
			 		`estabTel02`= :estabTel02,
			 		`dataFechamento`= :dataFechamento			 		
				Where 
					`idLoja` = :idLoja
			");

			$sql->execute(array(
				':cnpj' => $cnpj,
				':idEstabBandeira' => $bandeira,
				':nome' => u($nome),
				':rua' => u($rua),
				':numero' => $numero,
				':complemento' => u($complemento),
				':bairro' => u($bairro),
				':cidade' => u($cidade),
				':uf' => u($uf),
				':cep' => $cep,
				':estabReceitaAberturaData' => $estabReceitaAberturaData,
				':estabReceitaRazaoSocial' => u($estabReceitaRazaoSocial),
				':estabReceitaNomeEmpresarial' => u($estabReceitaNomeEmpresarial),
				':estabReceitaNF' => u($estabReceitaNF),
				':estabReceitaEndereco' => u($estabReceitaEndereco),
				':estabReceitaNumero' => $estabReceitaNumero,
				':estabReceitaComplemento' => u($estabReceitaComplemento),
				':estabReceitaBairro' => u($estabReceitaBairro),
				':estabReceitaCidade' => u($estabReceitaCidade),
				':estabReceitaUF' => u($estabReceitaUF),
				':estabReceitaCEP' => $estabReceitaCEP,
				':estabReceitaSituacao' => $estabReceitaSituacao,
				':estabReceitaSituacaoData' => $estabReceitaSituacaoData,
				':estabTel01' => $estabTel01,
				':estabTel02' => $estabTel02,
				':dataFechamento' => $dataFechamento,				
				':idLoja' => $idLoja
			));

			if($sql){
				return 1; //Update success
			} else  {
				return 2; //Problem on update
			}
		}

		//Method to delete store
		function delete($idUser, $date, $idLoja){
			$pdo = new Connection();

			$sql = $pdo->prepare("Delete From `webcafe_modoperacional_lojas` Where idLoja = :idLoja");
			$sql->execute(array(":idLoja" => $idLoja));

			if($sql){
				return 1; //Delete success
			} else  {
				return 2; //Problem on delete
			}

		}

		//Method to export to excel
		function exportExcel($output){
			$pdo = new Connection();

			$rows = $pdo->prepare('Select a.idLoja, a.cnpj, b.bandeira, a.nome, a.rua, a.bairro, a.cidade, a.uf From webcafe_modoperacional_lojas a Inner Join webcafe_modoperacional_bandeiras b On (a.idEstabBandeira = b.idBandeira)');
			$rows->execute();

			//Loop over the rows, outputting them
			while ($row = $rows->fetch(PDO::FETCH_OBJ)) {
				fputcsv($output, array($row->idLoja, $row->cnpj, $row->bandeira, $row->nome, $row->rua, $row->bairro, $row->cidade, $row->uf), ';');
			}
		}

		//Method used to impor data from excel
	// 	function importExcel($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11){
	// 		$pdo = new Connection();
			
	// 		$query = $pdo->prepare("
	// 			Insert Into webcafe_modoperacional_lojas
	// 				(`idLoja`, `numLinha`, `plano`, `iccid`, `linhaStatus`, `operadora`, `observacoes`, `dataCadastro`, `dataAlteracao`, `userAdd`, `userLastChange`) 
	// 			Values 
	// 				('".$col1."','".$col2."','".$col3."','".$col4."','".$col5."','".$col6."','".$col7."','".$col8."','".$col9."','".$col10."','".$col11."')");
	// 		$query->execute();
	// 	}
	// // }

		function checkCnpj($cnpj){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select cnpj From webcafe_modoperacional_lojas Where cnpj = :cnpj");
			$sql->execute(array(":cnpj" => $cnpj));

			$count = $sql->rowCount();
			return $count;

		}

		function checkFLag($nameFlag){
			$pdo = new Connection();

			$sql= $pdo->prepare("select * from webcafe_modoperacional_bandeiras where bandeira = :nameFlag");
			$sql->execute(array(':nameFlag' => strtoupper($nameFlag)));
			$count = $sql->rowCount();
			return $count;
		}

		function flagRegister($nameFlag){
			$pdo = new Connection();

			$sql = $pdo->prepare("INSERT INTO `webcafe`.`webcafe_modoperacional_bandeiras` (`bandeira`) VALUES (:nameFlag)");
			$sql->execute(array(':nameFlag' => strtoupper($nameFlag)));

			if($sql){
				return 1; //Update success
			} else  {
				return 2; //Problem on update
			}

		}



	}
	
?>
	
