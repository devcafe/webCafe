<?php
	include("../../../conf/conn.php");

	if($_POST['nomeAcao'] != ''){

		$check = $pdo->prepare("Select nomeAcao From ipsum_operacionalacao Where nomeAcao = ?");
		$check->execute(array(trim($_POST['nomeAcao'])));

		$count = $check->rowCount();

		if($count <= 0){
			$sql = $pdo->prepare("
				Insert into
					ipsum_operacionalacao
				Values(
					:idAcao,
					:nomeAcao,
					:users
				)
			");

			$sql->execute(array(":idAcao" => '',":nomeAcao" => $_POST['nomeAcao'], ":users" => $_POST['itens'] ));

			$msg = "Ação cadastrada com sucesso";
		} else {
			$msg = "Essa ação já foi cadastrada";
		}

		
	} else {
		$msg = "Favor informar o nome da ação";
	}

	echo $msg;

	
?>