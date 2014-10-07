<?php 
	include("../../../conf/conn.php");

	$verificarCnpj = $_POST['verificarCnpj'];
	//pega o ultimo caracter e verifica se ele é um inteiro
	$leg = substr($verificarCnpj,-1);

	if($leg != '_'){
		$sql = $pdo->prepare('Select cnpj, nome From ipsum_operacionallojas where cnpj = ?');
		$sql->execute(array($verificarCnpj));
		$res = $sql->rowCount();
		$lojas = $sql->fetch(PDO::FETCH_OBJ);
	}	
	

	if($leg == '_'){
		echo 1;		
	}else {
		if($res == 0){
			// diz que o cnpj é valido
			echo 0;

		}else{			
			echo "Este CNPJ é da loja <b>{$lojas->nome}.</b>";

		}

	}
	
?>