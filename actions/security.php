<?php
	session_start();

	if($_SESSION['loged'] != true){
		header('location: ../index.php');
	}
?>