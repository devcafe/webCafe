<?php require("../../conf/conn.php"); ?>

<!-- Javascript -->
<script src="mod_operacional/resources/js/cadRoteiro.js"></script>

<!-- CSS -->
<link rel="stylesheet" href = "mod_operacional/resources/css/cadRoteiro.css?">

<div class = "formInner">
	<form method = "post">
		<legend> Criar Roteiro </legend>
		<!--<div class = "painel">
			<div class = "btnFiltrar" id = "btnFiltrar" title = "Filtrar"> <img src = "../main/resources/images/filter.png" width = "20" > </div>
		</div>-->
		<div id = "cadRoteiro">
			<div id = "selLoja">
				<a href = "#" id = "selectColaBtn"> <img src = "../main/resources/images/addUser.png" width = "20" > </a>
				<a href = "#" id = "selectLojasBtn">  <img src = "../main/resources/images/operacional/addStores.png" width = "20" >  </a>
			</div>
			<div id = "colaboradorData">
				<table class = "theFirst">
					<tr>
						<td class = "matriculaTD"> Matricula </td>
						<td> Nome </td>
					</tr>
					<table id = "addDataUser">

					</table>
				</table>
			</div>
		</div>
	</form>
</div>

<!-- Modals -->
<!-- Visualizar dados da loja -->
<div id = "colaboradorModal" class = "modalColaboradores" title = "Colaboradores">
	<form method = "post" id = "colaboradoresForm">
		<label for = "toSearch"> Buscar: </label> <input type = "text" name = "toSearch" id = "toSearch">
		<input type="radio" name="buscaCampo" value="matricula" checked="checked">Matricula
		<input type="radio" name="buscaCampo" value="nome">Nome
		<input type = "button" name = "consultarColaborador" id = "consultarColaborador" value = "Pesquisar colaborador">
	</form>
	<div class = "listaColaboradores">

	</div>
	
</div>
<!--<input type = "hidden" id = "pagina" value = "1">-->
