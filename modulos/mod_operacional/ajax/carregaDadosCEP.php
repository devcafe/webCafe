<?php
	header('Content-Type: text/html; charset=UTF-8');

	function normalizeStr($str) {
		$invalid = array(
			"Ã" => "A", "ã" => "a", "Á" => "A", "á" => "a", "Â" => "A", "â" => "a",
			"Ê" => "E", "ê" => "e", "É" => "E", "é" => "e", "Ç" => "C", "ç" => "c",
			"_" => " ", "Ó" => "O", "ó" => "o", "Ô" => "O", "ô" => "o", "Õ" => "O",
			"õ" => "o", "Í" => "I", "í" => "i", "Ú" => "U", "ú" => "u"
		);

		$str = str_replace(array_keys($invalid), array_values($invalid), $str);

		return $str;
	}

	$cep = $_POST['cep'];
	 
	$reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);
	 
	$dados['sucesso'] = (string) $reg->resultado;

	$dados['rua']     = normalizeStr((string) $reg->tipo_logradouro . ' ' . $reg->logradouro);
	$dados['bairro']  = normalizeStr((string) $reg->bairro);
	$dados['cidade']  = normalizeStr((string) $reg->cidade);
	$dados['estado']  = (string) $reg->uf;			 

	echo json_encode($dados);
?>