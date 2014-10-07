<?php
	include("../../../conf/conn.php");

	$usersAcao = $_POST['idLoggedUser'];

	//Pega todas as ações
	$acoes = $pdo->prepare("Select idAcao From ipsum_operacionalacao Where users like :usersAcao");
	$acoes->execute(array(":usersAcao" => "%". $usersAcao . "%"));

	$acoesIn = '';

	while($resAcoes = $acoes->fetch(PDO::FETCH_OBJ)){
		$acoesIn .= $resAcoes->idAcao . ',';
	}

	$acoesIn = substr($acoesIn, 0, -1);

	$sqlRoteiros = $pdo->prepare('
		select 
			a.idColaborador, a.idRoteiro, a.nomeRoteiro, b.nome, b.sobrenome, c.nomeAcao 
		from 
			ipsum_operacionalroteiros a 
			inner join ipsum_usuarios b on idUsuarioCad = id 
			inner join ipsum_operacionalacao c on a.idAcao = c.idAcao 
		where
			a.idAcao in ('.$acoesIn.')	
		group by 
			idRoteiro');

	$sqlRoteiros->execute();

	$lista = "";
	$lista .= "<table id = 'tableRoteiros'>";
	$lista .= "<tr>";
			$lista .= "<td>idRoteiro</td>";
			$lista .= "<td>Nome Roteiro</td>";
			$lista .= "<td>Ação</td>";
			$lista .= "<td>Responsavel</td>";
	$lista .= "</tr>";

	while ($roteiro = $sqlRoteiros->fetch(PDO::FETCH_OBJ)) {
		$lista .= "<tr id = '" . $roteiro->idRoteiro . "' class ='idCol" . $roteiro->idColaborador . "'>";
			$lista .= "<td>" . $roteiro->idRoteiro . "</td>";
			$lista .= "<td>" . $roteiro->nomeRoteiro . "</td>";
			$lista .= "<td>" . $roteiro->nomeAcao . "</td>";
			$lista .= "<td>" . $roteiro->nome . " " . $roteiro->sobrenome ."</td>";
		$lista .= "</tr>";
	}
	$lista .= "</table>";

	echo $lista;



?>