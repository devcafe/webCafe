<?php
	include("../../../conf/conn.php");
	include("../../../actions/security.php");

	header('Content-Type: text/html; charset=UTF-8');

	$itens = $_POST['itens'];

	$lista = '';

	$i = 0;


	foreach($itens as $res){
		
		$lista .= '<tr id = "mat_'. $res['raMat'] .'">';
			foreach($res as $row){
				$lista .= '<td>'. trim($row) .'</td>';
			}			
		$lista .= '</tr>';	

	}


	echo $lista;

?>