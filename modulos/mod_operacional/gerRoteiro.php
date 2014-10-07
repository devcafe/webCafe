<?php 
	require("../../conf/conn.php"); 
	require("../../actions/security.php"); 
?>

<!-- Javascript -->
<script src="mod_operacional/resources/js/gerRoteiro.js"></script>

<!-- CSS -->
<link rel="stylesheet" href = "mod_operacional/resources/css/gerRoteiro.css?1">

<div class = "formInner">	
		<legend> Criar Roteiro </legend>
		<!--<div class = "painel">
			<div class = "btnFiltrar" id = "btnFiltrar" title = "Filtrar"> <img src = "../main/resources/images/filter.png" width = "20" > </div>
		</div>-->
		<div id = "cadRoteiro">
			<div id = "selRoteiro">
				<a href = "#" id = "delRoteiro"> <img src = "../main/resources/images/delete.png" width = "20" > </a> 
				<a href = "#" id = "criarRoteiroBtn">  <img src = "../main/resources/images/operacional/script.png" width = "20" >  </a>
			</div>
			<div id = "colaboradorData">				
					<div id = "addDataRoteiro">
						

					</div>
				</table>
			</div>			
		</div>	
</div>
<input type = "hidden" name = "idLoggedUser" name = "idLoggedUser" value = "<?php echo $_SESSION['idUsuario']; ?>">

<!-- Modals -->

<div id ="criarRoteiroModal" class = "criarRoteiroModal" title = "Criar roteiros">
	<form id = "criarRoteiro">
	
		<table id = "teste">	
			<tr>
				<td><label for = "nomeRoteiro"> Nome do Roteiro: </label></td>
				<td><label for = "nomeAcao"> Nome da Ação: </label></td>
			</tr>
			<tr>	
				<td><input type = "text" name = "nomeRoteiro" id = "nomeRoteiro"><input type = "hidden" name = "idRoteiroEdicao" id = "idRoteiroEdicao" value = "null"></td>
				<td>				
					<div id="acaoSelect">
					</div>				
				</td>
			</tr>	

			<tr class = "fakeRow"> </tr>

			<tr> 
				<td><label for = "nomeColaborador">Colaborador: </label></td>
			</tr>	

			<tr>
				<td id = 'nomeColaborador'>Selecione um colaborador...</td>	
				<td><a href = "#" id = "selectColaBtn"> <img src = "../main/resources/images/addUser.png" width = "20" disabled></td>			
			</tr>	
			
			<tr class = "fakeRow"> </tr>

			<tr>
				<td><label for = "lojasRoteiro"> Lojas do roteiro: </label> </td>
				<td><a href = "#" id = "selectLojasBtn">  <img src = "../main/resources/images/operacional/addStores.png" width = "20" >  </a></td>
			</tr>		
		</table>
		<table id = 'lojasForm'>
			<tr>
				<td>#</td>
				<td>ID</td>
				<td>CNPJ</td>
				<td>Nome da Loja</td>
				<td>seg</td>
				<td>ter</td>
				<td>qua</td>
				<td>qui</td>
				<td>sex</td>
				<td>sab</td>
				<td>dom</td>
				<td>Carta</td>						
			</tr>
			
			<div class = "addDataLoja">	 
			</div>

		</table>

		<input type = "button" value = "Cadastrar roteiro" id = "cadastrarRoteiro">
		<label id = "excluirLojasLabel">* Para exluir uma loja basta dar um duplo click sobre a loja que deseja excluir </label> 

	</form>

</div>
<!-- Calaboradores modal -->

<div id = "colaboradorModal" class = "modalColaboradores" title = "Colaboradores">
	<div id = "colaboradoresForm">
		<label for = "toSearch"> Buscar: </label> <input type = "text" name = "toSearch" id = "toSearch">
		<input type="radio" name="buscaCampo" value="matricula" checked="checked">Matricula
		<input type="radio" name="buscaCampo" value="nome">Nome
		<input type = "button" name = "consultarColaborador" id = "consultarColaborador" value = "Pesquisar colaborador">
	</div>
	<div class = "listaColaboradores">

	</div>


</div>

<!-- Lojas modal -->

<div id = "lojasModal" class = "lojasModal" title = "lojas Modal">
	<div id = "lojasFormToAdd">
		<!-- Pesquisa loja -->
		<label for = "toSearchLoja"> Buscar: </label> <input type = "text" name = "toSearchLoja" id = "toSearchLoja">
		<input type="radio" name="buscaCampoLoja" class = "radioLoja" id ="idRadio" value="idLoja" checked="checked">ID
		<input type="radio" name="buscaCampoLoja" class = "radioLoja" id = "cnpjRadio" value="cnpj">CNPJ
		<input type = "button" name = "consultarLoja" id = "consultarLoja" value = "Pesquisar loja">
	</div>
	<div class = "listaLoja">
	</div>
	<div class = "contadorLojas">
	</div>
</div>
<!-- ./modal -->

<!-- Lojas modal -->
<div id = "printRoteiroModal" title = "Imprimir roteiro">
	<div id = "addDataPrint">
	</div>
	<div id = "gerarModeloExemplo">
	</div>
</div>
<!-- ./modal -->

