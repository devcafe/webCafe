<?php

	include("../../../conf/conn.php");
	include("../../../actions/security.php");

	header('Content-Type: text/html; charset=UTF-8');

	// recebe o id da loja no formato 'carta_[id da loja]'
	$idLojaCarta = $_POST['idLojaCarta'];
	//explode em uma array
	$idLoja = explode('_', $idLojaCarta);

	//Select de todas as cartas
	$sqlCartas = $pdo->prepare("select * from ipsum_operacionalcartasapresentacao");
	$sqlCartas->execute();

	//inicia a tabela
	$data ="";
	$data .="<legend>Selecione uma carta</legend>";

	//input com id da loja selecionado
	$data .="<input type='hidden' id = 'idLojaDestinoCarta' value= '". $idLoja[1] ."'>";

	$data .="<table id = 'selectCarta'>";
		$data .="<tr>";
			$data .="<td>id</td>";
			$data .="<td>Nome da carta</td>";
			$data .="<td>Visualizar Carta</td>";
		$data .="</tr>";

	while($carta = $sqlCartas->fetch(PDO::FETCH_OBJ)){
		// Verifica se o id é corresponde a nenhum
		if($carta->idCarta != 1){
			$data .="<tr>";
				$data .="<td id ='". $carta->idCarta ."' >". $carta->idCarta ."</td>";
				$data .="<td id = '". $carta->nomeCarta ."'>". $carta->nomeCarta ."</td>";
				$data .="<td><a href = '#'  name = 'geraCartaApresentacaoExemplo'> Exemplo </a></td>";
			$data .="</tr>";
		}
	}

	$data .="<table>";
	//Opção incluir nenhuma carta
	$data .="<a src ='#' name='nenhumaCarta'>Nenhuma Carta</a>";	

	// $data .= "<a href = '#'  name = 'geraCartaApresentacao'> Gerar carta </a>";
	echo $data;
?>