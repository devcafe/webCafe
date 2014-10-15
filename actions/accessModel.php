<?php
	$dir = $_SERVER['DOCUMENT_ROOT'] . 'webCafe/';
	require_once($dir . "conf/conn.php");

	class Acessos{

		//Method to check user modules access
		function checkAccessModules($idUser){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select modulos From webcafe_usuarios Where idUser = :idUser");
			$sql->execute(array(":idUser" => $idUser));
			$res = $sql->fetchAll(PDO::FETCH_OBJ);

			return $res;
		}

		//Method to check user pages access
		function checkAccessPages($idUser){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select paginas From webcafe_usuarios Where idUser = :idUser");
			$sql->execute(array(":idUser" => $idUser));
			$res = $sql->fetchAll(PDO::FETCH_OBJ);

			return $res;
		}

		//Method to check user access rules
		function checkAccessRules($idUser){
			$pdo = new Connection();

			$sql = $pdo->prepare("Select acessos From webcafe_usuarios Where idUser = :idUser");
			$sql->execute(array(":idUser" => $idUser));
			$res = $sql->fetchAll(PDO::FETCH_OBJ);

			return $res;
		}
	}

?>