<?php
	include("../conf/conn.php");
	
	class Logon {

		//Faz logon
		function authUser($dados){
			$pdo = new Connection();

			$auth = $pdo->prepare("select usuario, senha from ipsum_usuarios where usuario = :userLogin And senha = :pwdLogin");
			$auth->execute(array(":userLogin" => $dados['userLogin'], ":pwdLogin" => $dados['pwdLogin']));

			$count = $auth->rowCount();

			return $count;
		}

		// Sessão
		function userSession($dados){
			$pdo = new Connection();

			$auth = $pdo->prepare("select id idUser, concat(nome,' ', sobrenome) name, acessos access from ipsum_usuarios where usuario = :userLogin And senha = :pwdLogin");
			$auth->execute(array(":userLogin" => $dados['userLogin'], ":pwdLogin" => $dados['pwdLogin']));

			$res = $auth->fetch(PDO::FETCH_OBJ);

			return $res;
		}
	}
?>