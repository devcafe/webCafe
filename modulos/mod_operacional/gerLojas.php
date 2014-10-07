<?php require("../../conf/conn.php"); ?>

<!-- Javascript -->
<script src="mod_operacional/resources/js/gerLojas.js"></script>

<!-- CSS -->
<link rel="stylesheet" href = "mod_operacional/resources/css/gerLojas.css">

<div class = "formInner">
	<form method = "post" id = "formFiltro">
		<legend> Gerenciar lojas </legend>
		<div class = "painel">
			<div class = "filtro">
				<!--<form method = "post" id = "formFiltro" class ="formFiltroBase" >-->
					<div class = "filtro01">
						<input type = "text" class = "toReset" name = "idLojaFiltro" id = "idLojaFiltro" placeholder = "ID">
						<input type = "text" class = "toReset"  name = "cnpj" id = "cnpj" placeholder = "CNPJ">
						<input type = "text" class = "toReset" name = "razaoSocial" id = "razaoSocial" placeholder = "Razão Social">
						<input type = "text" class = "toReset" name = "nomeFantasia" id = "nomeFantasia" placeholder = "Nome Fantasia">
						<input type = "text" class = "toReset"  name = "bairro" id = "bairro" placeholder = "Bairro">
						<input type = "text" class = "toReset"  name = "rua" id = "rua" placeholder = "Rua">
					</div>
					<div class = "filtro02">
						<input type = "text" class = "toReset"  name = "bandeira" id = "bandeira" placeholder = "Bandeira">
						<input type = "text" class = "toReset"  name = "cep" id = "cep" placeholder = "CEP">
						<input type = "text" class = "toReset"  name = "cidade" id = "cidade" placeholder = "Cidade">
						<input type = "text" class = "toReset"  name = "uf" id = "uf" placeholder = "UF">
						<input type = "text" class = "toReset"  name = "numero" id = "numero" placeholder = "Nº">
						<input type = "button" name = "limparFiltro" id = "limparFiltro" value = "Limpar filtro">

					</div>
				<!--</form>-->
			</div>
			<div class = "chooseFields">
				<form method = "post">
					<h5> <b> Campos com dados da loja </b> </h5>
					<table class = "fieldsToShow">
						<tr>
							<td> <input type = "checkbox" class = "checkBox" value = "1" name = "id" id = "id" >  <span> ID  </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "2" name = "cnpj" id = "cnpj"><span> CNPJ </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "3" name = "bandeira" id = "bandeira"> <span>Bandeira </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "4" name = "nome" id = "nome"> <span>Nome </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "5" name = "cep" id = "cep"><span> Cep </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "6" name = "bairro" id = "bairro"><span> Bairro </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "7" name = "rua" id = "rua"><span> Endereço </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "8" name = "numero" id = "numero"><span> Numero</span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "9" name = "complemento" id = "complemento"><span> Complemento </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "10" name = "cidade" id = "cidade"><span> Cidade </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "11" name = "uf" id = "uf"><span> UF</span> </td>
						</tr>
					</table>
					
					<h5> <b> Campos com dados da receita </b> </h5>
					<table class = "fieldsToShow">
						<tr>
							<td> <input type = "checkbox" class = "checkBox" value = "12" name = "receitaDataAbertura" id = "receitaDataAbertura"><span> Data abertura </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "13" name = "receitaRazaoSocial" id = "receitaRazaoSocial"><span> Razão social</span>  </td>
							<td> <input type = "checkbox" class = "checkBox" value = "14" name = "receitaNomeFantasia" id = "receitaNomeFantasia"><span> Nome Fantasia</span>  </td>
							<td> <input type = "checkbox" class = "checkBox" value = "15" name = "receitaEndereco" id = "receitaEndereco"><span> Endereço</span>  </td>
							<td> <input type = "checkbox" class = "checkBox" value = "16" name = "receitaNumero" id = "receitaNumero"><span>Número </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "17" name = "receitaComplemento" id = "receitaComplemento"><span> Complemento</span>  </td>
							<td> <input type = "checkbox" class = "checkBox" value = "18" name = "receitaBairro" id = "receitaBairro"><span> Bairro</span>  </td>
							<td> <input type = "checkbox" class = "checkBox" value = "19" name = "receitaCidade" id = "receitaCidade"><span> Cidade </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "20" name = "receitaUF" id = "receitaUF"><span> UF</span>  </td>
							<td> <input type = "checkbox" class = "checkBox" value = "21" name = "receitaCEP" id = "receitaCEP"><span> CEP</span>  </td>
						</tr>

						<tr>
							<td> <input type = "checkbox" class = "checkBox" value = "22" name = "receitaSituacao" id = "receitaSituacao"><span> Situação </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "23" name = "receitaSituacaoData" id = "receitaSituacaoData"><span> Situação data </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "24" name = "receitaTel01" id = "receitaTel01"><span> Tel 01 </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "25" name = "receitaTel02" id = "receitaTel02"><span> Tel 02 </span> </td>
							<td> <input type = "checkbox" class = "checkBox" value = "26" name = "receitaDataFechamento" id = "receitaDataFechamento"><span> Data fechamento</span>  </td>
						</tr>

						<tr>
							<td colspan = "12" class = "toCenter"> <input type = "button" name = "sendFields" id = "sendFields" value = "Consultar"> </td>
						</tr>
					</table>

				</form>
			</div>
				<div class = "btnFiltrar" id = "btnFiltrar" title = "Filtrar"> <img src = "../main/resources/images/filter.png" width = "20" > </div>
				<div class = "btnSelFields" id = "btnSelFields" title = "Selecionar campos"> <img src = "../main/resources/images/checkbox.png" width = "18" > </div>
				<div class = "btnToCSV" id = "btnToCSV" title = "Exportar CSV"> <img src = "../main/resources/images/csv.png" width = "22" > </div>
				<div class = "btnToExcel" id = "btnToExcel" title = "Exportar Excel"> <img src = "../main/resources/images/excel.png" width = "22" > </div>
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
<div id = "lojasModalGer" title = "Dados da loja">
	<form id = "dadosLojaReceitaModalForm">
		<table>
			<tr>
				<td> <a href = "#" id = "dadosVisualizar" name = "dadosVisualizar"> <span class = "showText"> Dados da receita -> </span></a></td>
				<td> <a href = "#" id = "btnAlterarLoja" name = ="btnAlterarLoja" > Alterar Registo </a></td>
			</tr>
		</table>

		<div id = "lojaDados">
			<table>	
				<tr>
					<td> <label for = "cnpjListGer"> CNPJ: </label> </td>					
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "cnpjListGer" id = "cnpjListGer"> </td>
					<td><input  id = "idListGer" type = "hidden" name = "idListGer" ></td>
				</tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "bandeiraListGer"> Bandeira: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "bandeiraListGer" id = "bandeiraListGer"> </td>
				</tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "nomeList"> Nome do estabelecimento: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "nomeListGer" id = "nomeListGer"> </td>
				</tr>
			</table>
			<table>	
				<tr>
					<td> <label for = "cepListGer"> CEP: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "cepListGer" id = "cepListGer"> </td>
				</tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "ruaListGer"> Endereço: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "ruaListGer" id = "ruaListGer"> </td>
				</tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "bairroListGer"> Bairro: </label> </td>
					<td> <label for = "numeroListGer"> Nº: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "bairroListGer" id = "bairroListGer"> </td>
					<td> <input disabled type = "text" name = "numeroListGer" id = "numeroListGer"> </td>
				</tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "cidadeListGer"> Cidade: </label> </td>
					<td> <label for = "ufLisGert"> UF: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "cidadeListGer" id = "cidadeListGer"> </td>
					<td> <input disabled type = "text" name = "ufLisGert" id = "ufLisGert"> </td>
				</tr>

				<tr class = "fakeRow"> </tr>

				<!-- <tr>
					<td colspan = "12"> <input  id = "alteraLojaBtn" name = "alteraLojaBtn" type = "button" value = "Alterar loja"> </td>
				</tr> -->
			</table>
		</div>

			<div id = "lojaDadosReceita">
			<table>	
				
				<tr>
					<td> <label for = "estabReceitaRazaoSocial"> Razão Social: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "estabReceitaRazaoSocial" id = "estabReceitaRazaoSocial"> </td>
				</tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "estabReceitaNomeEmpresarial"> Nome Empresarial: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "estabReceitaNomeEmpresarial" id = "estabReceitaNomeEmpresarial"> </td>
				</tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "estabReceitaNF"> Nome Fantasia: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "estabReceitaNF" id = "estabReceitaNF"> </td>
				</tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "estabReceitaEndereco"> Endereço: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "estabReceitaEndereco" id = "estabReceitaEndereco"> </td>
				</tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "estabReceitaCEP"> CEP: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "estabReceitaCEP" id = "estabReceitaCEP"> </td>
				</tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "estabReceitaComplemento"> Complemento: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "estabReceitaComplemento" id = "estabReceitaComplemento"> </td>
				</tr>
			</table>

			<!--<table>	
				<tr>
					<td> <label for = "ruaList"> Rua: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "ruaList" id = "ruaList"> </td>
				</tr>
			</table>-->

			<table>	
				<tr>
					<td> <label for = "estabReceitaBairro"> Bairro: </label> </td>
					<td> <label for = "estabReceitaNumero"> Nº: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "estabReceitaBairro" id = "estabReceitaBairro"> </td>
					<td> <input disabled type = "text" name = "estabReceitaNumero" id = "estabReceitaNumero"> </td>
				</tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "estabReceitaCidade"> Cidade: </label> </td>
					<td> <label for = "estabReceitaUF"> UF: </label> </td>
				</tr>
				<tr>
					<td> <input disabled type = "text" name = "estabReceitaCidade" id = "estabReceitaCidade"> </td>
					<td> <input disabled type = "text" name = "estabReceitaUF" id = "estabReceitaUF"> </td>
				</tr>

				<table>	
					<tr>
						<td> <label for = "estabReceitaSituacao"> Situacao: </label> </td>
						<td> <label for = "estabReceitaSituacaoData"> Situacao data: </label> </td>
					</tr>
					<tr>
						<td> <input disabled type = "text" name = "estabReceitaSituacao" id = "estabReceitaSituacao"> </td>
						<td> <input disabled type = "text" name = "estabReceitaSituacaoData" id = "estabReceitaSituacaoData"> </td>
					</tr>
				</table>

				<tr class = "fakeRow"> </tr>

				<!-- <tr>
					<td colspan = "12"> <input  id = "alteraLojaBtn" name = "alteraLojaBtn" type = "button" value = "Alterar loja"> </td>
				</tr> -->
			</table>
		</div>
	</form>
</div>