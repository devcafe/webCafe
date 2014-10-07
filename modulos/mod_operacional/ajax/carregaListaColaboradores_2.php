<?php
	include("../../../conf/conn.php");

	$toSearch = strtoupper($_POST['toSearch']);
	$buscaCampo = $_POST['buscaCampo'];

	if($buscaCampo == 'matricula'){
		$criterio = 'RA_MAT = '. $toSearch;
	} elseif($buscaCampo == 'nome') {
		$criterio = "RA_NOMECMP like '%$toSearch%'";
	} else {
		echo "Favor selecione um item para pesquisar";
	}

	$sql = $protheus->prepare("
		Select
			* 
		From 
			SRA010 With(nolock)
		Where
			$criterio
		And RA_MSBLQL = 2
	");

	$sql->execute();

	$lista = '';

	$i = 0;

	$lista .= '<table class = "userToAddList">';
		$lista .= '<tr class = "theFirst">';
			$lista .= '<td> </td>';
			$lista .= '<td class = "matTD"> <b> Matricula </b></td>';
			$lista .= '<td> <b> Nome completo </b></td>';
		$lista .= '</tr>';
		while($res = $sql->fetch(PDO::FETCH_OBJ)){
			if($i % 2 == 0){
				$lista .= '<tr class = "par" id = "'. $res->RA_MAT .'">';
					$lista .= '<td class = "checkboxTD"> <input type = "checkbox" name = "userCheck" value = "'. $res->RA_MAT .'" id = "userCheck"> </td>';
					$lista .= '<td>' . $res->RA_MAT .'</td>';
					$lista .= '<td>' . $res->RA_NOMECMP .'</td>';
				$lista .= '</tr>';
			} else {
				$lista .= '<tr class = "impar" id = "'. $res->RA_MAT .'">';
					$lista .= '<td class = "checkboxTD"> <input type = "checkbox" name = "userCheck" value = "'. $res->RA_MAT .'" id = "userCheck"> </td>';
					$lista .= '<td>' . $res->RA_MAT .'</td>';
					$lista .= '<td>' . $res->RA_NOMECMP .'</td>';
				$lista .= '</tr>';
			}

			$i++;
		}

		$lista .= '<tr>';
			$lista .= '<td colspan = "12"> <input type = "button" name = "addToList" id = "addToList" value = "Adicionar"> </td>'; 
		$lista .= '</tr>';
	$lista .= '</table>';

	echo $lista;
?>