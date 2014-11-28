<?php
	require_once("../conf/conn.php");
	

	class Documentos {

		//Method to load table data
		function loadTableData($end, $page, $where, $orderBy){
			$pdo = new Connection();

			$sql = $pdo->prepare("
				select
					a.idDocumento 
				From
   				 webcafe_documentos a inner join  webcafe_usuarios b ON a.responsavel = b.idUser
   			    $where
   			    	$orderBy");
		
			$sql->execute();
			$total = $sql->rowCount();

			$start = $page - 1;
			$start = $start * $end;

			$limit = $pdo->prepare("
				Select 
					a.idDocumento, 
					a.departamento, 
					a.assunto, 
					a.documento, 
					a.path, 
					CONCAT(b.firstName, ' ', b.lastName) as responsavel
				From
					webcafe_documentos a
						inner join
					webcafe_usuarios b on a.responsavel = b.idUser
 				$where
 					$orderBy
 				Limit $start, $end");
			
			  				
			$limit->execute();

			$pages = $total/$end;

			if($page > $pages){
				$res['actualPage'] = ceil($pages);
			} else {
				$res['actualPage'] = $page;
			}

			$res['maxRegsPage'] = 6;
			$res['totalPages'] = ceil($pages);
			$res['totalRegs'] = $total;
			$res[1] = $limit->fetchAll(PDO::FETCH_OBJ);

			$pdo = null;

			return json_encode($res);
		}

		//Method to load data before edit
		function loadData($idDocumento){
			$pdo = new Connection();

			$sql = $pdo->prepare("select path, documento from webcafe_documentos where idDocumento = :idDocumento");
			$sql->execute(array(":idDocumento" => $idDocumento));
			$res = $sql->fetch(PDO::FETCH_OBJ);

			return json_encode($res);
		}

		function cadDocumento($path, $responsavel){
			$departamento = "Coord";
			$doc = "pedro";
			$assunto = "definir2";
			// echo $path;
			// echo $responsavel;

			//Grava no banco
			$pdo = new Connection();

			$documento = $pdo->prepare('
				Insert Into	webcafe_documentos
					(`idDocumento`,`departamento`, `assunto`, `documento`, `path`, `responsavel`)
				VALUES 
					(:idDocumento,:departamento, :assunto, :documento, :path, :responsavel)		
			');

			$documento->execute(array(
				':idDocumento' => '', 
				':departamento' => $departamento, 
				':assunto' => $assunto,
				':documento' => $doc, 
				':path' => $path,
				':responsavel' => $responsavel,
			));

			if($documento)
				return true;
			else
				return false;
		}

		
		
	}

?>