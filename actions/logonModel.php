<?php
	include("../conf/conn.php");
	
	class Logon {

		//Faz logon
		function authUser($dados){
			$pdo = new Connection();

			$auth = $pdo->prepare("select user, password from webcafe_usuarios where user = :userLogin And password = :pwdLogin");
			$auth->execute(array(":userLogin" => $dados['userLogin'], ":pwdLogin" => $dados['pwdLogin']));

			$count = $auth->rowCount();

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