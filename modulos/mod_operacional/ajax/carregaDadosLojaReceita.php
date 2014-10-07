<?php
	include("../../../conf/conn.php");

	$id = $_POST['id'];

	//Carrega dados
	$sql = $pdo->prepare("Select * From ipsum_operacionallojas a Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira) Where idLoja = ?");

	$sql->execute(array($id));

	$lojas = $sql->fetch(PDO::FETCH_OBJ);

	echo json_encode ($lojas);
?>