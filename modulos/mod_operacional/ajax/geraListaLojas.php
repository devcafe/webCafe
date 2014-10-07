<?php
	include("../../../conf/conn.php");
	include("../../../actions/security.php");

	header('Content-Type: text/html; charset=UTF-8');


	$idLojaAdd = $_POST['idLojaAdd'];
	$cnpjAdd = $_POST['cnpjAdd'];
	$nomeAdd = $_POST['nomeAdd'];
		//idroteiro
	$idRoteiro = isset($_POST['idRoteiro']) ? $_POST['idRoteiro'] : '';

	$lista = '';
		
	$i = 0;	
		$lista .= "<tr id = " . $idLojaAdd . " class = 'lojasAdicionadas'>";
			$lista .= "<td><div id = 'carta'></div><a href = '#' class = 'openPrintCarta'  id = 'carta_" . $idLojaAdd . "'> <img src = '../main/resources/images/noPrint.png' width = '20' > </a></td>" ;					
			$lista .= "<td><input type = 'hidden' value = " . $idLojaAdd . " class = 'idLojaSelecionada ". $idLojaAdd ."'>" . $idLojaAdd . "</td>";
			$lista .= "<td>" . $cnpjAdd . "</td>";
			$lista .= "<td>" . $nomeAdd . "</td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro seg' id = '". $idLojaAdd ."_seg'' maxlength='1'tabindex='1'></td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro ter' id = 'ter' maxlength='1' tabindex='2'></td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro qua' id = 'qua' maxlength='1' tabindex='3'></td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro qui' id = 'qui' maxlength='1' tabindex='4'></td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro sex' id = 'sex' maxlength='1' tabindex='5'></td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro sab' id = 'sab' maxlength='1' tabindex='6'></td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro dom' id = 'dom' maxlength='1'tabindex='7' ></td>";
			$lista .= "<td id = 'nomeCartaLoja'><a href = '#' class = 'openModalPrint'  id = 'carta_" . $idLojaAdd . "'> Nenhum</>a</td>";
			$lista .= "<input type = 'hidden' id = 'idCarta' value = '1'>";
		
		$lista .= "</tr>";
	if($idLojaAdd != "null") {
		echo $lista;
	}

	$sqlLojas = $pdo->prepare("select a.idLoja, seg, ter, qua, qui, sex, sab, dom, cnpj, nome, a.idCarta, c.nomeCarta  from ipsum_operacionalroteiros a inner join ipsum_operacionallojas b inner join ipsum_operacionalcartasapresentacao c on (a.idLoja = b.idLoja and a.idCarta = c.idCarta )  where idRoteiro = ?");
	$sqlLojas->execute(array($idRoteiro));

	$lista = '';
	$lista .= "<tr>" ;
			$lista .= "<td>#</td>" ;			
			$lista .= "<td>ID</td>" ;
			$lista .= "<td>CNPJ</td>" ;
			$lista .= "<td>Nome da Loja</td>" ;
			$lista .= "<td>seg</td>" ;
			$lista .= "<td>ter</td>" ;
			$lista .= "<td>qua</td>" ;
			$lista .= "<td>qui</td>" ;
			$lista .= "<td>sex</td>" ;
			$lista .= "<td>sab</td>" ;
			$lista .= "<td>dom</td>" ;
			$lista .= "<td>Carta</td>" ;						
		$lista .= "</tr>" ;
	while($resLojas = $sqlLojas->fetch(PDO::FETCH_OBJ)){
		if($resLojas->idCarta == 1){
			$imgPrint = "noPrint.png";
		}else {
			$imgPrint = "print.png";
		}		
		$lista .= "<tr id = " . $resLojas->idLoja . " class = 'lojasAdicionadas'>";
			$lista .= "<td><div id = 'carta'></div><a href = '#' class = 'openPrintCarta'  id = 'carta_" . $resLojas->idLoja . "'> <img src = '../main/resources/images/". $imgPrint ."' width = '20' > </a></td>" ;					
			$lista .= "<td><input type = 'hidden' value = " . $resLojas->idLoja . " class = 'idLojaSelecionada ". $resLojas->idLoja ."'>" . $resLojas->idLoja . "</td>";
			$lista .= "<td>" . $resLojas->cnpj . "</td>";
			$lista .= "<td>" . $resLojas->nome . "</td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro seg' id = '". $resLojas->idLoja ."_seg'' value = '". $resLojas->seg ."' maxlength='1' tabindex='1'></td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro ter' id = 'ter' value = '". $resLojas->ter ."' maxlength='1' tabindex='2'></td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro qua' id = 'qua' value = '". $resLojas->qua ."' maxlength='1' tabindex='3'></td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro qui' id = 'qui' value = '". $resLojas->qui ."' maxlength='1' tabindex='4'></td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro sex' id = 'sex' value = '". $resLojas->sex ."' maxlength='1' tabindex='5'></td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro sab' id = 'sab' value = '". $resLojas->sab ."' maxlength='1' tabindex='6'></td>";
			$lista .= "<td><input type = 'text' class = 'ordemDiaRoteiro dom' id = 'dom' value = '". $resLojas->dom ."' maxlength='1' tabindex='7'></td>";
			$lista .= "<td id = 'nomeCartaLoja'><a href = '#' class = 'openModalPrint'  id = 'carta_" . $resLojas->idLoja . "'> ".$resLojas->nomeCarta ." </a></td>";
			$lista .= "<input type = 'hidden' id = 'idCarta' value ='".$resLojas->idCarta."' >";
		$lista .= "</tr>";
	};
	if($idLojaAdd == "null") {
		echo $lista;
	}


?>