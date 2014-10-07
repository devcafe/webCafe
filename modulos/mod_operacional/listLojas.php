<?php
	require("../../conf/conn.php"); 
	header('Content-Type: text/html; charset=UTF-8');
?>

<!-- Javascript -->
<script src="mod_operacional/resources/js/listLojas.js"></script>

<!-- CSS -->
<link rel="stylesheet" href = "mod_operacional/resources/css/listLojas.css">

<div class = "formInner">
	<form method = "post">
		<legend> Lojas </legend>
		<div class = "painel">
			<div class = "filtro">
				<form method = "post" id = "formFiltro">
					<div class = "filtro01">
						<input type = "text" class = "toReset" name = "idLojaFiltro" id = "idLojaFiltro" placeholder = "ID">
						<input type = "text" class = "toReset" name = "cnpj" id = "cnpj" placeholder = "CNPJ">
						<input type = "text" class = "toReset" name = "razaoSocial" id = "razaoSocial" placeholder = "Razão Social">
						<input type = "text" class = "toReset" name = "nomeFantasia" id = "nomeFantasia" placeholder = "Nome Fantasia">
						<input type = "text" class = "toReset" name = "bairro" id = "bairro" placeholder = "Bairro">
						<input type = "text" class = "toReset" name = "rua" id = "rua" placeholder = "Rua">
					</div>
					<div class = "filtro02">
						<input type = "text" class = "toReset" name = "bandeira" id = "bandeira" placeholder = "Bandeira">
						<input type = "text" class = "toReset" name = "cep" id = "cep" placeholder = "CEP">
						<input type = "text" class = "toReset" name = "cidade" id = "cidade" placeholder = "Cidade">
						<input type = "text" class = "toReset" name = "uf" id = "uf" placeholder = "UF">
						<input type = "text" class = "toReset" name = "numero" id = "numero" placeholder = "Nº">
						<input type = "button" name = "limparFiltro" id = "limparFiltro" value = "Limpar filtro">
					</div>
				</form>
			</div>
				<div class = "btnFiltrar" id = "btnFiltrar" title = "Filtrar"> <img src = "../main/resources/images/filter.png" width = "20" > </div>
		</div>
		<div id = "orderLoja" class = "order_a-z"></div>
		<div id = "listaLojas">

		</div>
		<input type = "hidden" id = "pagina" value = "1">
		<input type = "hidden" id = "checkFiltro" value = "0">
	</form>
</div>

<!-- Modals -->
<!-- Visualizar dados da loja -->
<div id = "lojasModal" title = "Dados da loja">
	<form id = "dadosLojaModalForm">
		<table>	
			<tr>
				<td> <label for = "cnpjList"> CNPJ: </label> </td>
			</tr>
			<tr>
				<td> <input disabled type = "text" name = "cnpjList" id = "cnpjList"> </td>
			</tr>
		</table>

		<table>	
			<tr>
				<td> <label for = "bandeiraList"> Bandeira: </label> </td>
			</tr>
			<tr>
				<td> <input disabled type = "text" name = "bandeiraList" id = "bandeiraList"> </td>
			</tr>
		</table>

		<table>	
			<tr>
				<td> <label for = "razaoSocialList"> Razão Social: </label> </td>
			</tr>
			<tr>
				<td> <input disabled type = "text" name = "razaoSocialList" id = "razaoSocialList"> </td>
			</tr>
		</table>

		<table>	
			<tr>
				<td> <label for = "nomeFantasiaList"> Nome do estabelecimento: </label> </td>
			</tr>
			<tr>
				<td> <input disabled type = "text" name = "nomeFantasiaList" id = "nomeFantasiaList"> </td>
			</tr>
		</table>

		<table>	
			<tr>
				<td> <label for = "cepList"> CEP: </label> </td>
			</tr>
			<tr>
				<td> <input disabled type = "text" name = "cepList" id = "cepList"> </td>
			</tr>
		</table>

		<table>	
			<tr>
				<td> <label for = "ruaList"> Endereço: </label> </td>
			</tr>
			<tr>
				<td> <input disabled type = "text" name = "ruaList" id = "ruaList"> </td>
			</tr>
		</table>

		<table>	
			<tr>
				<td> <label for = "bairroList"> Bairro: </label> </td>
				<td> <label for = "numeroList"> Nº: </label> </td>
			</tr>
			<tr>
				<td> <input disabled type = "text" name = "bairroList" id = "bairroList"> </td>
				<td> <input disabled type = "text" name = "numeroList" id = "numeroList"> </td>
			</tr>
		</table>

		<table>	
			<tr>
				<td> <label for = "cidadeList"> Cidade: </label> </td>
				<td> <label for = "ufList"> UF: </label> </td>
			</tr>
			<tr>
				<td> <input disabled type = "text" name = "cidadeList" id = "cidadeList"> </td>
				<td> <input disabled type = "text" name = "ufList" id = "ufList"> </td>
			</tr>

			<tr class = "fakeRow"> </tr>
		</table>
	</form>
</div>