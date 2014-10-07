<?php require("../../conf/conn.php"); ?>

<!-- Javascript -->
<script src="mod_operacional/resources/js/gerAcoes.js"></script>

<!-- CSS -->
<link rel="stylesheet" href = "mod_operacional/resources/css/gerAcoes.css">

<div class = "formInner">
	<form method = "post">
		<legend> Gerenciar ações </legend>
		<div class = "painel">
			<div class = "addAcao"> <img src = "../main/resources/images/add.png" width = "22" > </div> 
			<div class = "delAcao"> <img src = "../main/resources/images/delete.png" width = "22" > </div>
		</div>
		<table>
			
			<tr class = "fakeRow"> </tr>

			<tr class = "acoesList">

			</tr>
		</table>
</div>
<input type = "hidden" id = "pagina" value = "1">

<!-- Modals -->
<!-- Adicionar ação -->
<div id = "addAcaoModal" title = "Adicionar ação">
	<form id = "cadastrarAcaoForm">
		<table>
			<tr>
				<td> <label for = "nomeAcao"> Ação: </td>
				<td> <input type = "text" name = "nomeAcao" id = "nomeAcaoCad"> </td>
			</tr>

			<tr class = "fakeRow"> </tr>

			<tr>
				<td> <label for = "colaboradores"> Pesquisar colaboradores: </td>
				<td> <input type = "text" name = "colaboradoresSearch" id = "colaboradoresSearch"> </td>
			</tr>

			<tr class = "fakeRow"> </tr>
		</table>

		<table id = "colaboradoresTable">
			<tr>
				<td> <b> Colaboradores </b> </td>
			</tr>

			<tr class = "rowLine"><td colspan = "10"> </td> </tr>

			<tr class = "listaColaboradoresAcao"> 

			</tr>		
			<tr class = "fakeRow"> </tr>
			<tr class = "fakeRow"> </tr>	
		</table>

		<table class = "colaboradoresToSave">
			<tr>
				<td> <b> Colaboradores na ação: </b></td>
			</tr>

			<tr class = "rowLine"><td colspan = "10"> </td> </tr>	

			<tr class = "listaColaboradoresAcaoToSave"> 

			</tr>		
		</table>

		<table>
			<tr class = "fakeRow"> </tr>

			<tr>
				<td> <input type = 'button' name = 'cadastraAcao' id = 'cadastraAcao' value = 'Cadastrar ação'> </td>
			</tr>
		</table>
	</form>
</div>

<!-- Alterar ação -->
<div id = "alteraAcaoModal" title = "Alterar ação">
	<form id = "alterarAcaoForm">

	</form>
</div>