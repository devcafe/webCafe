<?php
	include("../conf/conn.php");
	
	class Logon {

		//Faz logon
		function authUser($dados, $date){
			$pdo = new Connection();

			$auth = $pdo->prepare("select idUser, user, password from webcafe_usuarios where user = :userLogin And password = :pwdLogin");
			$auth->execute(array(":userLogin" => $dados['userLogin'], ":pwdLogin" => $dados['pwdLogin']));

			//Pega id do usuário para gravar data do ultimo logon
			$res = $auth->fetch(PDO::FETCH_OBJ);

			$count = $auth->rowCount();

			//Grava data do ultimo logon
			$logonDate = $pdo->prepare("Update webcafe_usuarios Set lastLogin = :lastLogon Where idUser = :idUser");
			$logonDate->execute(array(":lastLogon" => $date, ":idUser" => $res->idUser));

			return $count;
		}

		//Sessão
		function userSession($dados){
			$pdo = new Connection();

			$auth = $pdo->prepare("select idUser, concat(firstName,' ', lastName) name from webcafe_usuarios where user = :userLogin And password = :pwdLogin");
			$auth->execute(array(":userLogin" => $dados['userLogin'], ":pwdLogin" => $dados['pwdLogin']));

			$res = $auth->fetch(PDO::FETCH_OBJ);

			return $res;
		}
	}
?>