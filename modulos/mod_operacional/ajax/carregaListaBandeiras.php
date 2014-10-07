<?php 
	include("../../../conf/conn.php");
	include("../../../actions/security.php");

	$searchVal = $_POST['searchVal'];

	//Total de registros por pagina
	$total_reg = "10";	

	//Página atual
	$pc = $_POST['pag'];

	//Valor inicial da busca
	$inicio = $pc - 1; 
	$inicio = $inicio * $total_reg;

	//Busca limitada
	$limite = $pdo->prepare("Select * From ipsum_operacionalbandeiras Where bandeira like :bandeira LIMIT $inicio,$total_reg");
	$limite->execute(array(":bandeira" => "%" . $searchVal . "%"));

	$todos = $pdo->prepare("Select * From ipsum_operacionalbandeiras Where bandeira like :bandeira");
	$todos->execute(array(":bandeira" => "%" . $searchVal . "%"));

	$tr = $todos->rowCount();
	$tp = $tr / $total_reg;

	$lista = '';

	$lista .= '<div class = "totalReg"> <b> Total de registros: </b> <span class = "blue">'. $tr .'</span></div>';

	$i = 0;

	$lista .= '<table id = "lojasTable">';
		$lista .= '<tr>';
			$lista .= '<td> <b> Bandeira </b></td>';
		$lista .= '</tr>';
		while($res = $limite->fetch(PDO::FETCH_OBJ)){
			if($i % 2 == 0){
				$lista .= '<tr class = "par">';
					$lista .= '<td> <input type="radio" name="estaBandeira" value="'.$res->idBandeira.'"><label>'. $res->bandeira .'</label> </td>';
				$lista .= '</tr>';	
			} else {
				$lista .= '<tr class = "impar">';
					$lista .= '<td> <input type="radio" name="estaBandeira" value="'.$res->idBandeira.'" ><label> '. $res->bandeira .'</label></td>';
				$lista .= '</tr>';
			}
			$i++;
		}

		$lista .= "<tr>";
			$lista .= "<td colspan = '3'> <input type = 'button' name = 'addBandeiraToList' id = 'addBandeiraToList' value = 'Ok'> </td>";
		$lista .= "</tr>";
	$lista .= '</table>';

	$anterior = $pc -1; 
	$proximo = $pc +1;

	$nav = '';

	$nav .= "<div class = 'navBandeiras'>";

		if ($pc>1) { 
			$nav .= "<a class = 'toPage voltarPag' href='#' id = '$anterior'> <span> Voltar </span> <img src= '../main/resources/images/Operacional/arrowLeft.png' alt=''> </a>"; 
		} 

		$nav .= "|"; 

		if ($pc<$tp) { 
			$nav .= " <a class = 'toPage proximaPag' href='#' id = '$proximo'> <img src= '../main/resources/images/Operacional/arrowRight.png' alt=''> <span> Proximo </span> </a>"; 
		}

	$nav .= "</div>";

	echo $nav;
	echo $lista;

?>