<?php 
	include("../../../conf/conn.php");

	$sql = $pdo->prepare("Select id, nome, sobrenome From ipsum_usuarios Where nome like :nome And id <> 1");
	$sql->execute(array(":nome" =>  "%". $_POST['colaboradoresSearch'] ."%"));

	$lista = '';

	while($res = $sql->fetch(PDO::FETCH_OBJ)){
		$lista .= '<tr>';
			$lista .= '<td colspan = "2"> <div class = "checkBox" name="userToList" id="alt_'. $res->id .'">'. $res->nome . ' '. $res->sobrenome .'</td>';
		$lista .= '</tr>';
	}

	echo $lista;

?>