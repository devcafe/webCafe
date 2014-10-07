<?php
	include("../../../conf/conn.php");
	include("../../../actions/security.php");

	header('Content-Type: text/html; charset=UTF-8');

	$op = $_POST['op'];
	
	// order lojas por id
	$ordemLojas = $_POST['ordemLojas'];

	if(empty($ordemLojas)){
		$ordemLojas = 'order_a-z';
	}

	if ($ordemLojas == 'order_a-z'){
		$selectOrder = 'ORDER BY idLoja ASC';
	}else{
		$selectOrder = 'ORDER BY idLoja DESC';
	}

	if($op == ''){
		
		//Total de registros por pagina
		$total_reg = "25";	

		//Página atual
		$pc = $_POST['pag'];

		//Valor inicial da busca
		$inicio = $pc - 1; 
		$inicio = $inicio * $total_reg;

		//Busca limitada
		$limite = $pdo->prepare("Select * From ipsum_operacionallojas a Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) $selectOrder LIMIT $inicio,$total_reg");
		$limite->execute();

		$todos = $pdo->prepare("Select * From ipsum_operacionallojas");
		$todos->execute();

		$tr = $todos->rowCount();
		$tp = $tr / $total_reg;

		$lastPage = round($tp);
	} elseif($op == 'withFields') {
		//Total de registros por pagina
		$total_reg = "25";	

		//Página atual
		$pc = $_POST['pag'];

		//Valor inicial da busca
		$inicio = $pc - 1; 
		$inicio = $inicio * $total_reg;

		//Busca limitada
		$limite = $pdo->prepare("Select * From ipsum_operacionallojas a Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) $selectOrder LIMIT $inicio,$total_reg");
		$limite->execute();

		$todos = $pdo->prepare("Select * From ipsum_operacionallojas a Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) $selectOrder ");
		$todos->execute();

		$tr = $todos->rowCount();
		$tp = $tr / $total_reg;

		$lastPage = round($tp);
	} elseif($op == 'withFieldsFiltro'){ 
		//Total de registros por pagina
		$total_reg = "25";	

		//Página atual
		$pc = $_POST['pag'];

		//Valor inicial da busca
		$inicio = $pc - 1; 
		$inicio = $inicio * $total_reg;

		//Recebe dados para filtrar
		$cnpj = $_POST['cnpj'];
		$razaoSocial = $_POST['razaoSocial'];
		$nomeFantasia = $_POST['nomeFantasia'];
		$bairro = $_POST['bairro'];
		$rua = $_POST['rua'];
		$bandeira = $_POST['bandeira'];
		$cep = $_POST['cep'];
		$cidade = $_POST['cidade'];
		$uf = $_POST['uf'];
		$numero = $_POST['numero'];

		if($_POST['idLojaFiltro'] != ''){

			$idLojaQuery = 'a.idLoja = :idLojaFiltro';

			//Consulta para retornar lojas de acordo com o filtro
			$limite = $pdo->prepare("
				Select * 
				From ipsum_operacionallojas a
			 	Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) 
				Where 
					$idLojaQuery
				And a.cnpj like :cnpj
				And a.estabReceitaRazaoSocial like :razaoSocial
				And a.estabReceitaNF like :nomeFantasia
				And a.bairro like :bairro
				And a.rua like :rua
				And b.bandeira like :bandeira
				And a.cep like :cep
				And a.cidade like :cidade
				And a.uf like :uf
				And a.numero like :numero
				$selectOrder
				Limit 
					$inicio,$total_reg
			");

			$limite->execute(array(":idLojaFiltro" =>  $_POST['idLojaFiltro'] , ":cnpj" => "%" . $cnpj . "%", ":razaoSocial" => "%" . $razaoSocial . "%", ":nomeFantasia" => "%" . $nomeFantasia . "%", ":bairro" => "%" . $bairro . "%", ":rua" => "%" . $rua . "%", ":bandeira" => "%" . $bandeira . "%", ":cep" => "%" . $cep . "%", ":cidade" => "%" . $cidade . "%", ":uf" => "%" . $uf . "%", ":numero" => "%" . $numero . "%"));

			$todos = $pdo->prepare("
				Select * 
				From ipsum_operacionallojas a
				Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) 
				Where 
					$idLojaQuery
				And a.cnpj like :cnpj
				And a.estabReceitaRazaoSocial like :razaoSocial
				And a.estabReceitaNF like :nomeFantasia
				And a.bairro like :bairro
				And a.rua like :rua
				And b.bandeira like :bandeira
				And a.cep like :cep
				And a.cidade like :cidade
				And a.uf like :uf
				And a.numero like :numero
				$selectOrder
			");
			$todos->execute(array(":idLojaFiltro" =>  $_POST['idLojaFiltro'] , ":cnpj" => "%" . $cnpj . "%", ":razaoSocial" => "%" . $razaoSocial . "%", ":nomeFantasia" => "%" . $nomeFantasia . "%", ":bairro" => "%" . $bairro . "%", ":rua" => "%" . $rua . "%", ":bandeira" => "%" . $bandeira . "%", ":cep" => "%" . $cep . "%", ":cidade" => "%" . $cidade . "%", ":uf" => "%" . $uf . "%", ":numero" => "%" . $numero . "%"));

			$tr = $todos->rowCount();
			$tp = $tr / $total_reg;

			$lastPage = round($tp);
		} else {
			//Consulta para retornar lojas de acordo com o filtro
			$limite = $pdo->prepare("
				Select * 
				From ipsum_operacionallojas a
			 	Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) 
				Where 
					a.cnpj like :cnpj
				And a.estabReceitaRazaoSocial like :razaoSocial
				And a.estabReceitaNF like :nomeFantasia
				And a.bairro like :bairro
				And a.rua like :rua
				And b.bandeira like :bandeira
				And a.cep like :cep
				And a.cidade like :cidade
				And a.uf like :uf
				And a.numero like :numero
				$selectOrder
				Limit 
					$inicio,$total_reg
			");

			$limite->execute(array(":cnpj" => "%" . $cnpj . "%", ":razaoSocial" => "%" . $razaoSocial . "%", ":nomeFantasia" => "%" . $nomeFantasia . "%", ":bairro" => "%" . $bairro . "%", ":rua" => "%" . $rua . "%", ":bandeira" => "%" . $bandeira . "%", ":cep" => "%" . $cep . "%", ":cidade" => "%" . $cidade . "%", ":uf" => "%" . $uf . "%", ":numero" => "%" . $numero . "%"));

			$todos = $pdo->prepare("
				Select * 
				From ipsum_operacionallojas a
				Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) 
				Where 
					a.cnpj like :cnpj
				And a.estabReceitaRazaoSocial like :razaoSocial
				And a.estabReceitaNF like :nomeFantasia
				And a.bairro like :bairro
				And a.rua like :rua
				And b.bandeira like :bandeira
				And a.cep like :cep
				And a.cidade like :cidade
				And a.uf like :uf
				And a.numero like :numero
				$selectOrder
			");
			$todos->execute(array(":cnpj" => "%" . $cnpj . "%", ":razaoSocial" => "%" . $razaoSocial . "%", ":nomeFantasia" => "%" . $nomeFantasia . "%", ":bairro" => "%" . $bairro . "%", ":rua" => "%" . $rua . "%", ":bandeira" => "%" . $bandeira . "%", ":cep" => "%" . $cep . "%", ":cidade" => "%" . $cidade . "%", ":uf" => "%" . $uf . "%", ":numero" => "%" . $numero . "%"));

			$tr = $todos->rowCount();
			$tp = $tr / $total_reg;

			$lastPage = round($tp);
		}
	}else {
		//Total de registros por pagina
		$total_reg = "25";	

		//Página atual
		$pc = $_POST['pag'];

		//Valor inicial da busca
		$inicio = $pc - 1; 
		$inicio = $inicio * $total_reg;

		//Recebe dados para filtrar
		$cnpj = $_POST['cnpj'];
		$razaoSocial = $_POST['razaoSocial'];
		$nomeFantasia = $_POST['nomeFantasia'];
		$bairro = $_POST['bairro'];
		$rua = $_POST['rua'];
		$bandeira = $_POST['bandeira'];
		$cep = $_POST['cep'];
		$cidade = $_POST['cidade'];
		$uf = $_POST['uf'];
		$numero = $_POST['numero'];

		if($_POST['idLojaFiltro'] != ''){

			$idLojaQuery = 'a.idLoja = :idLojaFiltro';

			//Consulta para retornar lojas de acordo com o filtro
			$limite = $pdo->prepare("
				Select * 
				From ipsum_operacionallojas a
			 	Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) 
				Where 
					$idLojaQuery
				And a.cnpj like :cnpj
				And a.estabReceitaRazaoSocial like :razaoSocial
				And a.estabReceitaNF like :nomeFantasia
				And a.bairro like :bairro
				And a.rua like :rua
				And b.bandeira like :bandeira
				And a.cep like :cep
				And a.cidade like :cidade
				And a.uf like :uf
				And a.numero like :numero
				$selectOrder
				Limit 
					$inicio,$total_reg
			");

			$limite->execute(array(":idLojaFiltro" =>  $_POST['idLojaFiltro'] , ":cnpj" => "%" . $cnpj . "%", ":razaoSocial" => "%" . $razaoSocial . "%", ":nomeFantasia" => "%" . $nomeFantasia . "%", ":bairro" => "%" . $bairro . "%", ":rua" => "%" . $rua . "%", ":bandeira" => "%" . $bandeira . "%", ":cep" => "%" . $cep . "%", ":cidade" => "%" . $cidade . "%", ":uf" => "%" . $uf . "%", ":numero" => "%" . $numero . "%"));

			$todos = $pdo->prepare("
				Select * 
				From ipsum_operacionallojas a
				Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) 
				Where 
					$idLojaQuery
				And a.cnpj like :cnpj
				And a.estabReceitaRazaoSocial like :razaoSocial
				And a.estabReceitaNF like :nomeFantasia
				And a.bairro like :bairro
				And a.rua like :rua
				And b.bandeira like :bandeira
				And a.cep like :cep
				And a.cidade like :cidade
				And a.uf like :uf
				And a.numero like :numero
				$selectOrder
			");
			$todos->execute(array(":idLojaFiltro" =>  $_POST['idLojaFiltro'] , ":cnpj" => "%" . $cnpj . "%", ":razaoSocial" => "%" . $razaoSocial . "%", ":nomeFantasia" => "%" . $nomeFantasia . "%", ":bairro" => "%" . $bairro . "%", ":rua" => "%" . $rua . "%", ":bandeira" => "%" . $bandeira . "%", ":cep" => "%" . $cep . "%", ":cidade" => "%" . $cidade . "%", ":uf" => "%" . $uf . "%", ":numero" => "%" . $numero . "%"));

			$tr = $todos->rowCount();
			$tp = $tr / $total_reg;

			$lastPage = round($tp);
		} else {

			//Consulta para retornar lojas de acordo com o filtro
			$limite = $pdo->prepare("
				Select * 
				From ipsum_operacionallojas a
			 	Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) 
				Where 
					a.cnpj like :cnpj
				And a.estabReceitaRazaoSocial like :razaoSocial
				And a.estabReceitaNF like :nomeFantasia
				And a.bairro like :bairro
				And a.rua like :rua
				And b.bandeira like :bandeira
				And a.cep like :cep
				And a.cidade like :cidade
				And a.uf like :uf
				And a.numero like :numero
				$selectOrder
				Limit 
					$inicio,$total_reg
			");

			$limite->execute(array(":cnpj" => "%" . $cnpj . "%", ":razaoSocial" => "%" . $razaoSocial . "%", ":nomeFantasia" => "%" . $nomeFantasia . "%", ":bairro" => "%" . $bairro . "%", ":rua" => "%" . $rua . "%", ":bandeira" => "%" . $bandeira . "%", ":cep" => "%" . $cep . "%", ":cidade" => "%" . $cidade . "%", ":uf" => "%" . $uf . "%", ":numero" => "%" . $numero . "%"));

			$todos = $pdo->prepare("
				Select * 
				From ipsum_operacionallojas a
				Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) 
				Where 
					a.cnpj like :cnpj
				And a.estabReceitaRazaoSocial like :razaoSocial
				And a.estabReceitaNF like :nomeFantasia
				And a.bairro like :bairro
				And a.rua like :rua
				And b.bandeira like :bandeira
				And a.cep like :cep
				And a.cidade like :cidade
				And a.uf like :uf
				And a.numero like :numero
				$selectOrder
			");

			$todos->execute(array(":cnpj" => "%" . $cnpj . "%", ":razaoSocial" => "%" . $razaoSocial . "%", ":nomeFantasia" => "%" . $nomeFantasia . "%", ":bairro" => "%" . $bairro . "%", ":rua" => "%" . $rua . "%", ":bandeira" => "%" . $bandeira . "%", ":cep" => "%" . $cep . "%", ":cidade" => "%" . $cidade . "%", ":uf" => "%" . $uf . "%", ":numero" => "%" . $numero . "%"));

			$tr = $todos->rowCount();
			$tp = $tr / $total_reg;

			$lastPage = round($tp);
		}
	}

	if($op != "withFields" && $op != 'withFieldsFiltro'){

		$lista = '';
		$lista .= '<div class = "totalReg"> <b> Total de registros: </b> <span class = "blue">'. $tr .'</span></div>';

		$i = 0;
		
		$lista .= '<table id = "lojasTable">';
			$lista .= '<tr>';
				$lista .= "<td id = 'idLojaOrder' class ='{$ordemLojas}'> ID </td>";
				$lista .= '<td> CNPJ </td>';
				$lista .= '<td> Bandeira </td>';
				$lista .= '<td> Nome do estabelecimento </td>';
				$lista .= '<td> CEP </td>';
				$lista .= '<td> Bairro </td>';
				$lista .= '<td> Endereço </td>';
				$lista .= '<td> Nº </td>';
				$lista .= '<td> Complemento </td>';
				$lista .= '<td> Cidade </td>';
				$lista .= '<td> UF </td>';
				$lista .= '<td> Receita - Data abertura </td>';
				$lista .= '<td> Receita - Razão social </td>';
				$lista .= '<td> Receita - Nome fantasia </td>';
				$lista .= '<td> Receita - Endereço </td>';
				$lista .= '<td> Receita - Número </td>';
				$lista .= '<td> Receita - Complemento </td>';
				$lista .= '<td> Receita - Bairro </td>';
				$lista .= '<td> Receita - Cidade </td>';
				$lista .= '<td> Receita - UF </td>';
				$lista .= '<td> Receita - CEP </td>';
				$lista .= '<td> Receita - Situação </td>';
				$lista .= '<td> Receita - Situação data </td>';
				$lista .= '<td> Receita - Tel 01 </td>';
				$lista .= '<td> Receita - Tel 02 </td>';
				$lista .= '<td> Receita - Data fechamento </td>';
			$lista .= '</tr>';
			while($res = $limite->fetch(PDO::FETCH_OBJ)){
				if($i % 2 == 0){
					$lista .= '<tr class = "par" id = "'. $res->idLoja .'">';
						$lista .= '<td>'. $res->idLoja .'</td>';
						$lista .= '<td>'. $res->cnpj .'</td>';
						$lista .= '<td>'. $res->bandeira .'</td>';
						$lista .= '<td>'. $res->nome .'</td>';
						$lista .= '<td>'. $res->cep .'</td>';
						$lista .= '<td>'. $res->bairro .'</td>';
						$lista .= '<td>'. $res->rua .'</td>';
						$lista .= '<td>'. $res->numero .'</td>';
						$lista .= '<td>'. $res->complemento .'</td>';
						$lista .= '<td>'. $res->cidade .'</td>';
						$lista .= '<td>'. $res->uf .'</td>';
						$lista .= '<td>'. $res->estabReceitaAberturaData .'</td>';
						$lista .= '<td>'. $res->estabReceitaRazaoSocial .'</td>';
						$lista .= '<td>'. $res->estabReceitaNF .'</td>';
						$lista .= '<td>'. $res->estabReceitaEndereco .'</td>';
						$lista .= '<td>'. $res->estabReceitaNumero .'</td>';
						$lista .= '<td>'. $res->estabReceitaComplemento .'</td>';
						$lista .= '<td>'. $res->estabReceitaBairro .'</td>';
						$lista .= '<td>'. $res->estabReceitaCidade .'</td>';
						$lista .= '<td>'. $res->estabReceitaUF .'</td>';
						$lista .= '<td>'. $res->estabReceitaCEP .'</td>';
						$lista .= '<td>'. $res->estabReceitaSituacao .'</td>';
						$lista .= '<td>'. $res->estabReceitaSituacaoData .'</td>';
						$lista .= '<td>'. $res->estabTel01 .'</td>';
						$lista .= '<td>'. $res->estabTel02 .'</td>';
						$lista .= '<td>'. $res->dataFechamento .'</td>';
					$lista .= '</tr>';	
				} else {
					$lista .= '<tr class = "impar" id = "'. $res->idLoja .'">';
						$lista .= '<td>'. $res->idLoja .'</td>';
						$lista .= '<td>'. $res->cnpj .'</td>';
						$lista .= '<td>'. $res->bandeira .'</td>';
						$lista .= '<td>'. $res->nome .'</td>';
						$lista .= '<td>'. $res->cep .'</td>';
						$lista .= '<td>'. $res->bairro .'</td>';
						$lista .= '<td>'. $res->rua .'</td>';
						$lista .= '<td>'. $res->numero .'</td>';
						$lista .= '<td>'. $res->complemento .'</td>';
						$lista .= '<td>'. $res->cidade .'</td>';
						$lista .= '<td>'. $res->uf .'</td>';
						$lista .= '<td>'. $res->estabReceitaAberturaData .'</td>';
						$lista .= '<td>'. $res->estabReceitaRazaoSocial .'</td>';
						$lista .= '<td>'. $res->estabReceitaNF .'</td>';
						$lista .= '<td>'. $res->estabReceitaEndereco .'</td>';
						$lista .= '<td>'. $res->estabReceitaNumero .'</td>';
						$lista .= '<td>'. $res->estabReceitaComplemento .'</td>';
						$lista .= '<td>'. $res->estabReceitaBairro .'</td>';
						$lista .= '<td>'. $res->estabReceitaCidade .'</td>';
						$lista .= '<td>'. $res->estabReceitaUF .'</td>';
						$lista .= '<td>'. $res->estabReceitaCEP .'</td>';
						$lista .= '<td>'. $res->estabReceitaSituacao .'</td>';
						$lista .= '<td>'. $res->estabReceitaSituacaoData .'</td>';
						$lista .= '<td>'. $res->estabTel01 .'</td>';
						$lista .= '<td>'. $res->estabTel02 .'</td>';
						$lista .= '<td>'. $res->dataFechamento .'</td>';
					$lista .= '</tr>';	
				}	
				$i++;	
			}
		$lista .= '</table>';
	} elseif ($op == 'withFields') {

		$lista = '';
		$lista .= '<div class = "totalReg"> <b> Total de registros: </b> <span class = "blue">'. $tr .'</span></div>';

		$i = 0;	

		$lista .= '<table id = "lojasTable">';
			$lista .= '<tr>';
			foreach($_POST['itens'] as $res){
				switch($res){
					case 1: $lista .= "<td id = 'idLojaOrder' class ='{$ordemLojas}'> ID </td>";break;
					case 2: $lista .= '<td> CNPJ </td>';break;
					case 3: $lista .= '<td> Bandeira </td>';break;
					case 4: $lista .= '<td> Nome do estabelecimento </td>';break;
					case 5: $lista .= '<td> CEP </td>';break;
					case 6: $lista .= '<td> Bairro </td>';break;
					case 7: $lista .= '<td> Endereço </td>';break;
					case 8: $lista .= '<td> Numero </td>';break;
					case 9: $lista .= '<td> Complemento </td>';break;
					case 10: $lista .= '<td> Cidade </td>';break;
					case 11: $lista .= '<td> UF </td>';break;
					case 12: $lista .= '<td> Receita - Data abertura </td>';break;
					case 13: $lista .= '<td> Receita - Razão social </td>';break;
					case 14: $lista .= '<td> Receita - Nome fantasia </td>';break;
					case 15: $lista .= '<td> Receita - Endereço </td>';break;
					case 16: $lista .= '<td> Receita - Número </td>';break;
					case 17: $lista .= '<td> Receita - Complemento </td>';break;
					case 18: $lista .= '<td> Receita - Bairro </td>';break;
					case 19: $lista .= '<td> Receita - Cidade </td>';break;
					case 20: $lista .= '<td> Receita - UF </td>';break;
					case 21: $lista .= '<td> Receita - CEP </td>';break;
					case 22: $lista .= '<td> Receita - Situação </td>';break;
					case 23: $lista .= '<td> Receita - Situação data </td>';break;
					case 24: $lista .= '<td> Receita - Tel 01 </td>';break;
					case 25: $lista .= '<td> Receita - Tel 02 </td>';break;
					case 26: $lista .= '<td> Receita - Data fechamento </td>';break;
				}
			}
			$lista .= '</tr>';
			while($res = $limite->fetch(PDO::FETCH_OBJ)){
				if($i % 2 == 0){
					$lista .= '<tr class = "par" id = "'. $res->idLoja .'">';
					foreach($_POST['itens'] as $data){
						switch($data){
							case 1: $lista .= '<td>'. $res->idLoja .'</td>';break;
							case 2: $lista .= '<td>'. $res->cnpj .'</td>';break;
							case 3: $lista .= '<td>'. $res->bandeira .'</td>';;break;
							case 4: $lista .= '<td>'. $res->nome .'</td>';break;
							case 5: $lista .= '<td>'. $res->cep .'</td>';break;
							case 6: $lista .= '<td>'. $res->bairro .'</td>';break;
							case 7: $lista .= '<td>'. $res->rua .'</td>';break;
							case 8: $lista .= '<td>'. $res->numero .'</td>';break;
							case 9: $lista .= '<td>'. $res->complemento .'</td>';break;
							case 10: $lista .= '<td>'. $res->cidade .'</td>';break;
							case 11: $lista .= '<td>'. $res->uf .'</td>';break;
							case 12: $lista .= '<td>'. $res->estabReceitaAberturaData .'</td>';break;
							case 13: $lista .= '<td>'. $res->estabReceitaRazaoSocial .'</td>';break;
							case 14: $lista .= '<td>'. $res->estabReceitaNF .'</td>';break;
							case 15: $lista .= '<td>'. $res->estabReceitaEndereco .'</td>';break;
							case 16: $lista .= '<td>'. $res->estabReceitaNumero .'</td>';break;
							case 17: $lista .= '<td>'. $res->estabReceitaComplemento .'</td>';break;
							case 18: $lista .= '<td>'. $res->estabReceitaBairro .'</td>';break;
							case 19: $lista .= '<td>'. $res->estabReceitaCidade .'</td>';break;
							case 20: $lista .= '<td>'. $res->estabReceitaUF .'</td>';break;
							case 21: $lista .= '<td>'. $res->estabReceitaCEP .'</td>';break;
							case 22: $lista .= '<td>'. $res->estabReceitaSituacao .'</td>';break;
							case 23: $lista .= '<td>'. $res->estabReceitaSituacaoData .'</td>';break;
							case 24: $lista .= '<td>'. $res->estabTel01 .'</td>';break;
							case 25: $lista .= '<td>'. $res->estabTel02 .'</td>';break;
							case 26: $lista .= '<td>'. $res->dataFechamento .'</td>';break;
						}
					}


					$lista .= '</tr>';	
				} else {
					$lista .= '<tr class = "par" id = "'. $res->idLoja .'">';
					foreach($_POST['itens'] as $data){
						switch($data){
							case 1: $lista .= '<td>'. $res->idLoja .'</td>';break;
							case 2: $lista .= '<td>'. $res->cnpj .'</td>';break;
							case 3: $lista .= '<td>'. $res->bandeira .'</td>';;break;
							case 4: $lista .= '<td>'. $res->nome .'</td>';break;
							case 5: $lista .= '<td>'. $res->cep .'</td>';break;
							case 6: $lista .= '<td>'. $res->bairro .'</td>';break;
							case 7: $lista .= '<td>'. $res->rua .'</td>';break;
							case 8: $lista .= '<td>'. $res->numero .'</td>';break;
							case 9: $lista .= '<td>'. $res->complemento .'</td>';break;
							case 10: $lista .= '<td>'. $res->cidade .'</td>';break;
							case 11: $lista .= '<td>'. $res->uf .'</td>';break;
							case 12: $lista .= '<td>'. $res->estabReceitaAberturaData .'</td>';break;
							case 13: $lista .= '<td>'. $res->estabReceitaRazaoSocial .'</td>';break;
							case 14: $lista .= '<td>'. $res->estabReceitaNF .'</td>';break;
							case 15: $lista .= '<td>'. $res->estabReceitaEndereco .'</td>';break;
							case 16: $lista .= '<td>'. $res->estabReceitaNumero .'</td>';break;
							case 17: $lista .= '<td>'. $res->estabReceitaComplemento .'</td>';break;
							case 18: $lista .= '<td>'. $res->estabReceitaBairro .'</td>';break;
							case 19: $lista .= '<td>'. $res->estabReceitaCidade .'</td>';break;
							case 20: $lista .= '<td>'. $res->estabReceitaUF .'</td>';break;
							case 21: $lista .= '<td>'. $res->estabReceitaCEP .'</td>';break;
							case 22: $lista .= '<td>'. $res->estabReceitaSituacao .'</td>';break;
							case 23: $lista .= '<td>'. $res->estabReceitaSituacaoData .'</td>';break;
							case 24: $lista .= '<td>'. $res->estabTel01 .'</td>';break;
							case 25: $lista .= '<td>'. $res->estabTel02 .'</td>';break;
							case 26: $lista .= '<td>'. $res->dataFechamento .'</td>';break;
						}
					}


					$lista .= '</tr>';	
				}	
				$i++;	
			}
		$lista .= '</table>';
	} elseif($op == 'withFieldsFiltro') {

		$lista = '';
		$lista .= '<div class = "totalReg"> <b> Total de registros: </b> <span class = "blue">'. $tr .'</span></div>';

		$i = 0;	

		$lista .= '<table id = "lojasTable">';
			$lista .= '<tr>';
			foreach($_POST['itens2'] as $res){

				switch($res){
					case 1: $lista .= "<td id = 'idLojaOrder' class ='{$ordemLojas}'> ID </td>";break;
					case 2: $lista .= '<td> CNPJ </td>';break;
					case 3: $lista .= '<td> Bandeira </td>';break;
					case 4: $lista .= '<td> Nome do estabelecimento </td>';break;
					case 5: $lista .= '<td> CEP </td>';break;
					case 6: $lista .= '<td> Bairro </td>';break;
					case 7: $lista .= '<td> Endereço </td>';break;
					case 8: $lista .= '<td> Numero </td>';break;
					case 9: $lista .= '<td> Complemento </td>';break;
					case 10: $lista .= '<td> Cidade </td>';break;
					case 11: $lista .= '<td> UF </td>';break;
					case 12: $lista .= '<td> Receita - Data abertura </td>';break;
					case 13: $lista .= '<td> Receita - Razão social </td>';break;
					case 14: $lista .= '<td> Receita - Nome fantasia </td>';break;
					case 15: $lista .= '<td> Receita - Endereço </td>';break;
					case 16: $lista .= '<td> Receita - Número </td>';break;
					case 17: $lista .= '<td> Receita - Complemento </td>';break;
					case 18: $lista .= '<td> Receita - Bairro </td>';break;
					case 19: $lista .= '<td> Receita - Cidade </td>';break;
					case 20: $lista .= '<td> Receita - UF </td>';break;
					case 21: $lista .= '<td> Receita - CEP </td>';break;
					case 22: $lista .= '<td> Receita - Situação </td>';break;
					case 23: $lista .= '<td> Receita - Situação data </td>';break;
					case 24: $lista .= '<td> Receita - Tel 01 </td>';break;
					case 25: $lista .= '<td> Receita - Tel 02 </td>';break;
					case 26: $lista .= '<td> Receita - Data fechamento </td>';break;
				}
			}
			$lista .= '</tr>';
			while($res = $limite->fetch(PDO::FETCH_OBJ)){
				if($i % 2 == 0){
					$lista .= '<tr class = "par" id = "'. $res->idLoja .'">';
					foreach($_POST['itens2'] as $data){
						switch($data){
							case 1: $lista .= '<td>'. $res->idLoja .'</td>';break;
							case 2: $lista .= '<td>'. $res->cnpj .'</td>';break;
							case 3: $lista .= '<td>'. $res->bandeira .'</td>';;break;
							case 4: $lista .= '<td>'. $res->nome .'</td>';break;
							case 5: $lista .= '<td>'. $res->cep .'</td>';break;
							case 6: $lista .= '<td>'. $res->bairro .'</td>';break;
							case 7: $lista .= '<td>'. $res->rua .'</td>';break;
							case 8: $lista .= '<td>'. $res->numero .'</td>';break;
							case 9: $lista .= '<td>'. $res->complemento .'</td>';break;
							case 10: $lista .= '<td>'. $res->cidade .'</td>';break;
							case 11: $lista .= '<td>'. $res->uf .'</td>';break;
							case 12: $lista .= '<td>'. $res->estabReceitaAberturaData .'</td>';break;
							case 13: $lista .= '<td>'. $res->estabReceitaRazaoSocial .'</td>';break;
							case 14: $lista .= '<td>'. $res->estabReceitaNF .'</td>';break;
							case 15: $lista .= '<td>'. $res->estabReceitaEndereco .'</td>';break;
							case 16: $lista .= '<td>'. $res->estabReceitaNumero .'</td>';break;
							case 17: $lista .= '<td>'. $res->estabReceitaComplemento .'</td>';break;
							case 18: $lista .= '<td>'. $res->estabReceitaBairro .'</td>';break;
							case 19: $lista .= '<td>'. $res->estabReceitaCidade .'</td>';break;
							case 20: $lista .= '<td>'. $res->estabReceitaUF .'</td>';break;
							case 21: $lista .= '<td>'. $res->estabReceitaCEP .'</td>';break;
							case 22: $lista .= '<td>'. $res->estabReceitaSituacao .'</td>';break;
							case 23: $lista .= '<td>'. $res->estabReceitaSituacaoData .'</td>';break;
							case 24: $lista .= '<td>'. $res->estabTel01 .'</td>';break;
							case 25: $lista .= '<td>'. $res->estabTel02 .'</td>';break;
							case 26: $lista .= '<td>'. $res->dataFechamento .'</td>';break;
						}
					}


					$lista .= '</tr>';	
				} else {
					$lista .= '<tr class = "par" id = "'. $res->idLoja .'">';
					foreach($_POST['itens2'] as $data){
						switch($data){
							case 1: $lista .= '<td>'. $res->idLoja .'</td>';break;
							case 2: $lista .= '<td>'. $res->cnpj .'</td>';break;
							case 3: $lista .= '<td>'. $res->bandeira .'</td>';;break;
							case 4: $lista .= '<td>'. $res->nome .'</td>';break;
							case 5: $lista .= '<td>'. $res->cep .'</td>';break;
							case 6: $lista .= '<td>'. $res->bairro .'</td>';break;
							case 7: $lista .= '<td>'. $res->rua .'</td>';break;
							case 8: $lista .= '<td>'. $res->numero .'</td>';break;
							case 9: $lista .= '<td>'. $res->complemento .'</td>';break;
							case 10: $lista .= '<td>'. $res->cidade .'</td>';break;
							case 11: $lista .= '<td>'. $res->uf .'</td>';break;
							case 12: $lista .= '<td>'. $res->estabReceitaAberturaData .'</td>';break;
							case 13: $lista .= '<td>'. $res->estabReceitaRazaoSocial .'</td>';break;
							case 14: $lista .= '<td>'. $res->estabReceitaNF .'</td>';break;
							case 15: $lista .= '<td>'. $res->estabReceitaEndereco .'</td>';break;
							case 16: $lista .= '<td>'. $res->estabReceitaNumero .'</td>';break;
							case 17: $lista .= '<td>'. $res->estabReceitaComplemento .'</td>';break;
							case 18: $lista .= '<td>'. $res->estabReceitaBairro .'</td>';break;
							case 19: $lista .= '<td>'. $res->estabReceitaCidade .'</td>';break;
							case 20: $lista .= '<td>'. $res->estabReceitaUF .'</td>';break;
							case 21: $lista .= '<td>'. $res->estabReceitaCEP .'</td>';break;
							case 22: $lista .= '<td>'. $res->estabReceitaSituacao .'</td>';break;
							case 23: $lista .= '<td>'. $res->estabReceitaSituacaoData .'</td>';break;
							case 24: $lista .= '<td>'. $res->estabTel01 .'</td>';break;
							case 25: $lista .= '<td>'. $res->estabTel02 .'</td>';break;
							case 26: $lista .= '<td>'. $res->dataFechamento .'</td>';break;
						}
					}


					$lista .= '</tr>';	
				}	
				$i++;	
			}
		$lista .= '</table>';
	}
 
	
	
	$anterior = $pc -1; 
	$proximo = $pc +1;

	$nav = '';

		$nav .= "<div class = 'navLojas'>";

		$nav .= " <a class = 'toPage voltarPag' style = 'margin-right: 10px' href='#' id = '1'> <img src= '../main/resources/images/Operacional/arrowLeft.png' alt=''> <span> Primeira pagina </span> </a>"; 

		if ($pc>1) { 
			$nav .= "<a class = 'toPage voltarPag' href='#' id = '$anterior'> <span> Voltar </span> <img src= '../main/resources/images/Operacional/arrowLeft.png' alt=''> </a>"; 
		} 

		if ($pc<$tp && $pc != $lastPage) { 
			$nav .= " <a class = 'toPage proximaPag' style = 'margin-right: 10px' href='#' id = '$proximo'> <img src= '../main/resources/images/Operacional/arrowRight.png' alt=''> <span> Proximo </span> </a>"; 
		}

		$nav .= " <a class = 'toPage proximaPag' href='#' id = '$lastPage'> <img src= '../main/resources/images/Operacional/arrowRight.png' alt=''> <span> Ultima pagina </span> </a>"; 

	$nav .= "</div>";

	echo $nav;
	echo $lista;
?>