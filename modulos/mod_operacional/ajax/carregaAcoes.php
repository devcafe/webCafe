<?php
	include("../../../conf/conn.php");

	//Total de registros por pagina
	$total_reg = "10";	

	//Página atual
	$pc = $_POST['pag'];

	//Valor inicial da busca
	$inicio = $pc - 1; 
	$inicio = $inicio * $total_reg;

	//Busca limitada
	$limite = $pdo->prepare("Select * From ipsum_operacionalacao LIMIT $inicio,$total_reg");
	$limite->execute();

	$todos = $pdo->prepare("Select * From ipsum_operacionalacao");
	$todos->execute();

	$tr = $todos->rowCount();
	$tp = $tr / $total_reg;

	$lastPage = ceil($tp);

	$anterior = $pc -1; 
	$proximo = $pc +1;

	$lista = '';
		$lista .= '<div class = "totalReg"> <b> Total de registros: </b> <span class = "blue">'. $tr .'</span></div>';

		$i = 0;
		
		$lista .= '<table id = "acoesTable">';
			$lista .= '<tr>';
				$lista .= '<td> Ação </td>';
			$lista .= '</tr>';
			while($res = $limite->fetch(PDO::FETCH_OBJ)){
				if($i % 2 == 0){
					$lista .= '<tr class = "par" id = "'. $res->idAcao .'">';
						$lista .= '<td>'. $res->nomeAcao .'</td>';
					$lista .= '</tr">';
				} else {
					$lista .= '<tr class = "impar" id = "'. $res->idAcao .'">';
						$lista .= '<td>'. $res->nomeAcao .'</td>';
					$lista .= '</tr">';
				}

				$i++;
			}
		$lista .= '</table>';

	$nav = '';
	
		$nav .= "<div class = 'navLojas'>";

		$nav .= " <a class = 'toPage voltarPag' style = 'margin-right: 10px' href='#' id = '1'> <img src= '../main/resources/images/Operacional/arrowLeft.png' alt=''> <span> Primeira pagina </span> </a>"; 

		if ($pc>1) { 
			$nav .= "<a class = 'toPage voltarPag' href='#' id = '$anterior'> <span> Voltar </span> <img src= '../main/resources/images/Operacional/arrowLeft.png' alt=''> </a>"; 
		} 

		if ($pc<$tp && $pc != $lastPage) { 
			$nav .= " <a class = 'toPage proximaPag' style = 'margin-right: 10px' href='#' id = '$proximo'> <img src= '../main/resources/images/Operacional/arrowRight.png' alt=''> <span> Proximo </span> </a>"; 
		}

		$nav .= " <a class = 'toPage proximaPag' href='#' id = '$lastPage'> <img src= '../main/resources/images/Operacional/arrowRight.png' alt=''> <span> Ultima pagina </span> </a>"; 

	$nav .= "</div>";

	echo $nav;
	echo $lista;
?>