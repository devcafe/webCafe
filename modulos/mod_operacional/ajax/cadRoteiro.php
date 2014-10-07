<?php
	include("../../../conf/conn.php");
	include("../../../actions/security.php");

	$idRoteiro = $_POST['idRoteiro'];	
	$nomeRoteiro = $_POST['nomeRoteiro'];
	$nomeAcao = $_POST['nomeAcao'];
	//verifica se há valor
	$matricula = isset($_POST['matricula']) ? $_POST['matricula'] : "0";
	$lojasItens = $_POST['lojasItens'];
	$dataCadastro = date('d/m/Y');
	$idUsuarioCad = $_SESSION['idUsuario'];
	//verifica se está vazio
	$matricula = $matricula == "" ? "0" : $matricula ; 

	if($nomeRoteiro != "" and $matricula != "" and $lojasItens != ""){

		if($idRoteiro == "null"){
		// verifica quantos registro tem ordenado por idRoteiro e gera um idRoteiro
			$sqlCount = $pdo->prepare('select max(idRoteiro) as idRoteiro from ipsum_operacionalroteiros');
			$sqlCount->execute();	
			$idRoteiro = $sqlCount->fetch(PDO::FETCH_OBJ);
			$idRoteiro = $idRoteiro->idRoteiro + 1;
		}else{
			//apaga as lojas do banco
			$sqlDelet = $pdo->prepare('Delete From ipsum_operacionalroteiros where idRoteiro = ?');
			$sqlDelet->execute(array($idRoteiro));		
		}
		
		//grava no banco 
		foreach ($lojasItens as $loja) {
			// trata o id carta que vem no forma cartaId_[idCarta]
			// if($loja['idCarta'] == 'null'){
			// 	$idCarta = null;
				
			// }else{
			// 	$idCarta = explode('_', $loja['idCarta']);			
			// 	$idCarta = $idCarta[1];	
			// }


			 $sqlInsert = $pdo->prepare(
				'INSERT INTO `ipsum`.`ipsum_operacionalroteiros` 
					(
					`idRoteiro`, `nomeRoteiro`, `idAcao`, `idColaborador`, `dataCadastro`, `idUsuarioCad`, `idLoja`, `seg`, `ter`, `qua`, `qui`, `sex`, `sab`, `dom`, `idCarta`
					) VALUES (
						?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
					)'
				);			 
			$sqlInsert->execute(array($idRoteiro, $nomeRoteiro, $nomeAcao, $matricula, $dataCadastro, $idUsuarioCad, $loja['idLoja'], $loja['seg'], $loja['ter'], $loja['qua'], $loja['qui'], $loja['sex'], $loja['sab'], $loja['dom'], $loja['idCarta']));		
		$msg = "Roteiro cadastrado com sucesso";
		}
	}else {
		$msg = "Ocorreu um erro no cadastro, favor contatar o administrador";
	}

	//exibe a mensagem correta
	echo $msg;

?>