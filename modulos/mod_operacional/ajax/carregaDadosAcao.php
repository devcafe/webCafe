<?php
	include("../../../conf/conn.php");

	$sql = $pdo->prepare("Select * From ipsum_operacionalacao Where idAcao = ?");
	$sql->execute(array($_POST['id']));

	$res = $sql->fetch(PDO::FETCH_OBJ);

	$lista = '
		<table>
			<tr>
				<td> <label for = "nomeAcaoAlt"> Ação: </td>
				<td> <input type = "text" name = "nomeAcaoAlt" id = "nomeAcaoAlt" value = "'. $res->nomeAcao .'"> </td>
			</tr>

			<tr class = "fakeRow"> </tr>

			<tr>
				<td> <label for = "colaboradoresSearchAlt"> Pesquisar colaboradores: </td>
				<td> <input type = "text" name = "colaboradoresSearchAlt" id = "colaboradoresSearchAlt"> </td>
			</tr>

			<tr class = "fakeRow"> </tr>
		</table>

		<table id = "colaboradoresTableAlt">
			<tr>
				<td> <b> Colaboradores </b> </td>
			</tr>

			<tr class = "rowLine"><td colspan = "10"> </td> </tr>

			<tr class = "listaColaboradoresAcaoAlt"> 

			</tr>		
			<tr class = "fakeRow"> </tr>
			<tr class = "fakeRow"> </tr>	
		</table>

		<table class = "colaboradoresToSaveAlt">
			<tr>
				<td> <b> Colaboradores na ação: </b></td>
			</tr>
			<tr class = "rowLine"><td colspan = "10"> </td> </tr>';
		
		$checkUsers = $pdo->prepare("Select users From ipsum_operacionalacao Where idAcao = ?");
		$checkUsers->execute(array($res->idAcao));

		$resUsers = $checkUsers->fetch(PDO::FETCH_OBJ);

		$resUsers = explode(',', $resUsers->users);		
		
		if($resUsers[0] != ''){
			foreach($resUsers as $row){
				$getUserData = $pdo->prepare("Select * From ipsum_usuarios Where id = ?");
				$getUserData->execute(array($row));

				$resUsersData = $getUserData->fetch(PDO::FETCH_OBJ);

				$lista .= '<tr class = "alt_'. $row .'">';
					$lista .= '<td colspan = "2"> <div class = "checkBox" name="userToListAlt" id="alt_'. $row .'">'. $resUsersData->nome . ' ' . $resUsersData->sobrenome .'</td>';
				$lista .= '</tr>';

				$lista .= '<tr> <td> <input type = "hidden" class = "'. $row .'" name = "userId" value = "' . $row . '"> </td> </tr>';
			}
		}
	

		$lista .= '			
		</table>

		<table>
			<tr class = "fakeRow"> </tr>

			<tr>
				<td> <input type = "button" name = "alterarAcao" id = "alterarAcao" value = "Alterar ação"> </td>
				<td> <input type = "hidden" name = "idAcaoAlt" id = "idAcaoAlt" value = "'.$_POST['id'].'"> </td>
			</tr>
		</table>';

	echo $lista;

?>