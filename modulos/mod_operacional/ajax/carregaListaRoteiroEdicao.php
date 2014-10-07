<?php
	include("../../../conf/conn.php");

	//recebe o id do item selecionado para o select
	$idRoteiro = $_POST['idRoteiro'];

	$sql = $pdo->prepare("Select
			idRoteiro, nomeRoteiro, a.idAcao, idColaborador, nomeAcao 
		From	
			ipsum_operacionalroteiros a	
		Inner Join 
			ipsum_operacionalacao b 
		On 
			(a.idAcao = b.idAcao) 
		where 
			idRoteiro = ?");

	$sql->execute(array($idRoteiro));
	$res = $sql->fetch(PDO::FETCH_OBJ);
	echo json_encode($res);
?>