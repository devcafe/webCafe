<?php
	require_once("accessModel.php");

	function accessModulos($module){
		//Check if the user has access for module
		$acessoModulo = new Acessos();

		$resModulos = $acessoModulo->checkAccessModules($_SESSION['idUser']);

		$resModulos = explode(';', $resModulos[0]->modulos);
		
		if (in_array($module, $resModulos)) { 
			return true;
		} else {
			return false;
		}		
	}

	function accessPages($page){
		//Check if the user has access for page
		$acessoPagina = new Acessos();

		$resPaginas = $acessoPagina->checkAccessPages($_SESSION['idUser']);

		$resPaginas = explode(';', $resPaginas[0]->paginas);
		
		if (in_array($page, $resPaginas)) { 
			return true;
		} else {
			return false;
		}
	}

	function accessRules($rule){
		//Check user access rules
		$acessos = new Acessos();

		$resAcessos = $acessos->checkAccessRules($_SESSION['idUser']);

		$resAcessos = explode(';', $resAcessos[0]->acessos);
		
		if (in_array($rule, $resAcessos)) { 
			return true;
		} else {
			return false;
		}
	}

?>