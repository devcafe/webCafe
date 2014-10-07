<?php 

	include("../../../conf/conn.php");

	$usersAcao = $_POST['idLoggedUser'];

	//Pega todas as ações
	//$acoes = $pdo->prepare("Select idAcao From ipsum_operacionalacao Where users like :usersAcao");
	$acoes = $pdo->prepare("Select idAcao From ipsum_operacionalacao Where FIND_IN_SET(".$usersAcao.",users)");
	$acoes->execute();
	
	$acoesIn = '';

	while($resAcoes = $acoes->fetch(PDO::FETCH_OBJ)){
		$acoesIn .= $resAcoes->idAcao . ',';
	}

	$acoesIn = substr($acoesIn, 0, -1);
	
	$idAcaoSelect = isset($_POST['idAcaoSelect']) ? $_POST['idAcaoSelect'] : '';

	//pesquisa no banco as ações
 	$sqlAcao = $pdo->prepare('select * from ipsum_operacionalacao Where idAcao in ('.$acoesIn.')');
 	$sqlAcao->execute();
 	$lista = "";
 	$lista .= '<select style = "width:100%" name = "nomeAcao" id = "nomeAcao">'; 		
	 	//faz um laço e gera os options para ser inserido no php	 	
	 	while ($acao = $sqlAcao->fetch(PDO::FETCH_OBJ)) {
	 		if($acao->idAcao == $idAcaoSelect){
	 		$lista .= "<option value = '" . $acao->idAcao . "' selected>" . $acao->nomeAcao . "</option>";	 			
	 		}
	 		$lista .= "<option value = '" . $acao->idAcao . "'>" . $acao->nomeAcao . "</option>";
	 	}
	 $lista .= "</select>";	

 	echo $lista;



?>