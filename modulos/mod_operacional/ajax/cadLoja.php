<?php
	include("../../../conf/conn.php");
	header('Content-Type: text/html; charset=UTF-8');
	
	//Dados do formulário
	$dados = $_POST['dados'];

	parse_str($dados); 		

	//print_r($dados);

	//função para deixar os valores em letra maiuscula
	function u($str){
		$str = strtoupper($str);
		return $str;
	}
	$nome = u($nome);

	//valida os numeros
	if($numero == '')
		$numero = 'S/N';

	if($estabReceitaNumero == '')
		$estabReceitaNumero = 'S/N';

	// verifica se existe uma loja para edição
	 if ($idLojaEdicao != 'null') {
	 		
		 	// valida se todos os campos estão vazios
		 	if($cnpj == ""){
				//"O campo CNPJ é obrigatório!";
				$msg = 1;
			}elseif($idBandeiraHidden == ""){
				//"O Campo Bandeira é obrigatório" ;
				$msg = 2;
			}elseif($nome == ""){
				//"O Campo Nome do estabelecimento é obrigatório" ;
				$msg = 3;
			}elseif($cep == "" or $bairro == "" or $rua =="" or $cidade == "" or $uf == ""){
				//"O endereço completo da loja é obrigatório, isto inclui: CEP, Bairro, Rua, Ciade e Estado (UF)" ;
				$msg = 4;
			}elseif($estabReceitaNomeEmpresarial == ""){
				//"O Campo Nome empresarial é obrigatório" ;
				$msg = 5;
			}elseif($estabReceitaEndereco == "" or $estabReceitaNumero == "" or $estabReceitaBairro == "" or $estabReceitaCidade == "" or $estabReceitaCEP == "" or $estabReceitaUF == ""){
				//"O endereço completo na receia federal é obrigatório, insto inclui: Nome Empresarial, CEP, Bairro, Rua, Ciade e Estado (UF)" ;
				$msg = 6;
			}elseif($estabReceitaAberturaData == ""){
				//"O Campo situação data é obrigatório" ;
				$msg = 7;
			}elseif($estabReceitaSituacaoData == ""){
				//"O Campo data de abertura é obrigatório" ;
				$msg = 8;
			}else{

				//Insere chamado
				$sql = $pdo->prepare("
					UPDATE `ipsum_operacionallojas` 
					SET 
						`cnpj`= ?, 
						`idEstabBandeira`= ?, 
						`nome`= ?, 
						`rua`= ?,
						`numero`= ?,
						`complemento`= ?,
						`bairro`= ?,
						`cidade`= ?,
						`uf`= ?,
						`cep`= ?,
						`estabReceitaAberturaData`= ?,
						`estabReceitaRazaoSocial`= ?,
						`estabReceitaNomeEmpresarial`= ?,
						`estabReceitaNF`= ?,
						`estabReceitaEndereco`= ?,
						`estabReceitaNumero`= ?,
						`estabReceitaComplemento`= ?,
						`estabReceitaBairro`= ?,
						`estabReceitaCidade`= ?,
						`estabReceitaUF`= ?,
						`estabReceitaCEP`= ?,
						`estabReceitaSituacao`= ?,
						`estabReceitaSituacaoData`= ?,
						`estabTel01`= ?,
						`estabTel02`= ?,
						`dataFechamento`= ?,
						`userAdd`=?
					WHERE 
						`idLoja`= ?
				");
				
				$sql->execute(array(
					$cnpj,
					$idBandeiraHidden,
					u($nome),
					u($rua),
					$numero,
					u($complemento),
					u($bairro),
					u($cidade),
					u($uf),
					$cep,
					u($estabReceitaAberturaData),
					u($estabReceitaRazaoSocial),
					u($estabReceitaNomeEmpresarial),
					u($estabReceitaNF),
					u($estabReceitaEndereco),
					$estabReceitaNumero,
					u($estabReceitaComplemento),
					u($estabReceitaBairro),
					u($estabReceitaCidade),
					u($estabReceitaUF),
					$estabReceitaCEP,
					u($estabReceitaSituacao),
					$estabReceitaSituacaoData,
					$estabTel01,
					$estabTel02,
					$dataFechamento,
					$userAdd,
					$idLojaEdicao)
				);
				//"Loja alterada com Sucesso";
				$msg = 12;
			}			

	 }else {
	 	
		
		//Verifica se ja existe o cnpj cadastrado
		$cnpjQuery = $pdo->prepare("Select cnpj From ipsum_operacionallojas Where cnpj = ?");
		$cnpjQuery->execute(array($cnpj));
		$cnpjCount = $cnpjQuery->rowCount();

		//Verifica se ja existe o nome cadastrado
		$nomeQuery = $pdo->prepare("Select nome From ipsum_operacionallojas Where nome = ?");
		$nomeQuery->execute(array($nome));
		$nomeCount = $nomeQuery->rowCount();

		
		if($cnpjCount >= 1){
			//CNPJ já esta cadastrado
			$msg = 10;
		} elseif($nomeCount >= 1){
			//Nome já esta cadastrado
			$msg = 11;
		} else {
			// valida se todos os campos estão vazios
			if($cnpj == ""){
				//"O campo CNPJ é obrigatório!";
				$msg = 1;
			}elseif($idBandeiraHidden == ""){
				//"O Campo Bandeira é obrigatório" ;
				$msg = 2;
			}elseif($nome == ""){
				//"O Campo Nome do estabelecimento é obrigatório" ;
				$msg = 3;
			}elseif($cep == "" or $bairro == "" or $rua =="" or $cidade == "" or $uf == ""){
				//"O endereço completo da loja é obrigatório, isto inclui: CEP, Bairro, Rua, Ciade e Estado (UF)" ;
				$msg = 4;
			}elseif($estabReceitaNomeEmpresarial == ""){
				//"O Campo Nome empresarial é obrigatório" ;
				$msg = 5;
			}elseif($estabReceitaEndereco == "" or $estabReceitaNumero == "" or $estabReceitaBairro == "" or $estabReceitaCidade == "" or $estabReceitaCEP == "" or $estabReceitaUF == ""){
				//"O endereço completo na receia federal é obrigatório, insto inclui: Nome Empresarial, CEP, Bairro, Rua, Ciade e Estado (UF)" ;
				$msg = 6;
			}elseif($estabReceitaAberturaData == ""){
				//"O Campo situação data é obrigatório" ;
				$msg = 7;
			}elseif($estabReceitaSituacaoData == ""){
				//"O Campo data de abertura é obrigatório" ;
				$msg = 8;
			}else{
				//Insere chamado
				$sql = $pdo->prepare("	Insert into `ipsum_operacionallojas` 
											(
												`idLoja`, 
												`cnpj`, 
												`idEstabBandeira`, 
												`nome`, 
												`rua`, 
												`numero`, 
												`complemento`, 
												`bairro`, 
												`cidade`, 
												`uf`, 
												`cep`, 
												`estabReceitaAberturaData`, 
												`estabReceitaRazaoSocial`,
												`estabReceitaNomeEmpresarial`,
												`estabReceitaNF`,
												`estabReceitaEndereco`, 
												`estabReceitaNumero`, 
												`estabReceitaComplemento`, 
												`estabReceitaBairro`, 
												`estabReceitaCidade`, 
												`estabReceitaUF`, 
												`estabReceitaCEP`, 
												`estabReceitaSituacao`, 
												`estabReceitaSituacaoData`, 
												`estabTel01`, 
												`estabTel02`, 
												`dataFechamento`, 
												`userAdd`)
										Values 
											(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");


				$sql->execute(array('', $cnpj, $idBandeiraHidden, u($nome), u($rua), $numero, u($complemento), u($bairro), u($cidade), u($uf), $cep, u($estabReceitaAberturaData), u($estabReceitaRazaoSocial), u($estabReceitaNomeEmpresarial), u($estabReceitaNF), u($estabReceitaEndereco), $estabReceitaNumero, u($estabReceitaComplemento), u($estabReceitaBairro), u($estabReceitaCidade), u($estabReceitaUF), $estabReceitaCEP, u($estabReceitaSituacao), $estabReceitaSituacaoData, $estabTel01, $estabTel02, $dataFechamento, $userAdd));
				//"Loja Cadastrada com Sucesso";
				$msg = 9;
			}	
		}
	}

	 echo $msg;

	 //Fecha conexão
	 $pdo = null;

?>