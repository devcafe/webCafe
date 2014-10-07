<?php
	include("../../../conf/conn.php");

	$sql = $pdo->prepare("
		Update ipsum_operacionalacao
		SET nomeAcao = :nomeAcao, users = :users
		Where idAcao = :idAcao
		
	");

	$sql->execute(array(":nomeAcao" => trim($_POST['nomeAcao']), ":users" => $_POST['itens'],":idAcao" => $_POST['idAcaoAlt'] ));

	$msg = "Ação alterada com sucesso";

	echo $msg;

?>