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

		$todos = $pdo->prepare("Select * From ipsum_operacionallojas $selectOrder ");
		$todos->execute();

		$tr = $todos->rowCount();
		$tp = $tr / $total_reg;

		$lastPage = round($tp);
	} else {
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
				And	a.cnpj like :cnpj 
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
				And	a.cnpj like :cnpj 
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
			$todos->execute(array(":idLojaFiltro" =>  $_POST['idLojaFiltro'], ":cnpj" => "%" . $cnpj . "%", ":razaoSocial" => "%" . $razaoSocial . "%", ":nomeFantasia" => "%" . $nomeFantasia . "%", ":bairro" => "%" . $bairro . "%", ":rua" => "%" . $rua . "%", ":bandeira" => "%" . $bandeira . "%", ":cep" => "%" . $cep . "%", ":cidade" => "%" . $cidade . "%", ":uf" => "%" . $uf . "%", ":numero" => "%" . $numero . "%"));

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

	$lista = '';

	$lista .= '<div class = "totalReg"> <b> Total de registros: </b> <span class = "blue">'. $tr .'</span></div>';

	$i = 0;

	$lista .= '<table id = "lojasTable">';
		$lista .= '<tr>';
			$lista .= "<td id = 'idLojaOrder' class ='{$ordemLojas}'> ID </td>";
			$lista .= '<td> CNPJ </td>';
			$lista .= '<td> Nome do estabelecimento </td>';
			$lista .= '<td> Bandeira </td>';
			$lista .= '<td> Razão social </td>';
			$lista .= '<td> Nome fantasia</td>';
			$lista .= '<td> CEP </td>';
			$lista .= '<td> Bairro </td>';
			$lista .= '<td> Endereço </td>';
			$lista .= '<td> Nº </td>';
			$lista .= '<td> Cidade </td>';
			$lista .= '<td> UF </td>';
		$lista .= '</tr>';
		while($res = $limite->fetch(PDO::FETCH_OBJ)){
			if($i % 2 == 0){
				$lista .= '<tr class = "par" id = "'. $res->idLoja .'">';
					$lista .= '<td>'. $res->idLoja .'</td>';
					$lista .= '<td>'. $res->cnpj .'</td>';
					$lista .= '<td>'. $res->nome .'</td>';
					$lista .= '<td>'. $res->bandeira .'</td>';
					$lista .= '<td>'. $res->estabReceitaRazaoSocial .'</td>';
					$lista .= '<td>'. $res->estabReceitaNF .'</td>';
					$lista .= '<td>'. $res->cep .'</td>';
					$lista .= '<td>'. $res->bairro .'</td>';
					$lista .= '<td>'. $res->rua .'</td>';
					$lista .= '<td>'. $res->numero .'</td>';
					$lista .= '<td>'. $res->cidade .'</td>';
					$lista .= '<td>'. $res->uf .'</td>';
				$lista .= '</tr>';	
			} else {
				$lista .= '<tr class = "impar" id = "'. $res->idLoja .'">';
					$lista .= '<td>'. $res->idLoja .'</td>';
					$lista .= '<td>'. $res->cnpj .'</td>';
					$lista .= '<td>'. $res->nome .'</td>';
					$lista .= '<td>'. $res->bandeira .'</td>';
					$lista .= '<td>'. $res->estabReceitaRazaoSocial .'</td>';
					$lista .= '<td>'. $res->estabReceitaNF .'</td>';
					$lista .= '<td>'. $res->cep .'</td>';
					$lista .= '<td>'. $res->bairro .'</td>';
					$lista .= '<td>'. $res->rua .'</td>';
					$lista .= '<td>'. $res->numero .'</td>';
					$lista .= '<td>'. $res->cidade .'</td>';
					$lista .= '<td>'. $res->uf .'</td>';
				$lista .= '</tr>';	
			}	
			$i++;	
		}
	$lista .= '</table>';
	
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