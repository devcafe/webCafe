<?php
	include("../../../conf/conn.php");

	$idLoja = $_POST['idLoja'];

	//Carrega dados
	$sql = $pdo->prepare("Select * From ipsum_operacionallojas a Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) Where idLoja = ?");

	$sql->execute(array($idLoja));

	$lojas = $sql->fetch(PDO::FETCH_OBJ);

	echo json_encode ($lojas);
?>