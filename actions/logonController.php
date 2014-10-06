<?php 
	require_once("logonModel.php");

	//Inicia a sessão
	session_start();

	//Recebe os dados da tela de login
	$userLogin = strtolower(trim($_POST['userLogin']));
	$pwdLogin = sha1(trim($_POST['pwdLogin']));

	//Monta array para trabalhar com os métodos
	$dados = array('userLogin' => $userLogin, 'pwdLogin' => $pwdLogin,);

	//Valida se o usuário e senha estão correos
	$logon = new logon();

	//Se o retornar 1 valor, ele grava a sessão autentica o usuário e rerenciona para página principal
	if($logon->authUser($dados) == 1){
		///Grava dados na sessão
		$logon->userSession($dados);

		//Grava nome na sessão
		$_SESSION['userName'] = $logon->userSession($dados)->name;

		//Grava id na sessão
		$_SESSION['idUser'] = $logon->userSession($dados)->idUser;

		//Grava usuário como logado enquanto a sessão estiver aberta
		$_SESSION['loged'] = true;

		//Grava tipo do usuário
		//$_SESSION['access'] = $logon->userSession($dados)->access;

		//Usuário autenticado
		$msg = 1;
		

	} else {
		//O usuario ou senha fornececido esta incorreto
		$msg = 2;		
	}

	echo $msg;
?>