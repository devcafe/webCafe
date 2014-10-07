<?php 
	require("../../conf/conn.php"); 
	include("../../actions/security.php");
?>

<!-- Javascript -->
<script src="mod_operacional/resources/js/cadLoja.js"></script>

<!-- CSS -->
<link rel="stylesheet" href = "mod_operacional/resources/css/cadLoja.css">

<div class = "formInner">
	<form method = "post" id = "formCadLoja">
		<div><input name = "idLojaEdicao"type = "hidden" id = "idLojaEdicao" value="null"></div>
		<legend id = "legendMenu"> Cadastrar Loja </legend>
		<table>
			<tr>
				<td> Campos marcados com <span class = "obgField"> * </span> são obrigatórios </td>
			</tr>

			<tr class = "fakeRow"> </tr>
			<tr class = "fakeRow"> </tr>
		</table>


		
		
		<table>	
			<tr>
				<td> <label for = "cnpj">CNPJ:  <span class = "obgField"> * </span></label> </td>
			</tr>
			<tr>
				<td> <input  type = "text" name = "cnpj" id = "cnpj" title = "Informe o CNPJ da loja"><div id ="status" class="invalido">  </div> <div id ="status2"> </div></td>
			</tr>

			<tr class = "fakeRow"> </tr>
		</table>

		<table>	
			<tr>
				<td> <label for = "bandeira">Bandeira:  <span class = "obgField"> *</span></label> </td>
			</tr>
			<tr>
				<td class = "bandeiraTD"> <input  type = "text" name = "bandeira" id = "bandeira" disabled > </td>
				<td> <a href = "#" id = "selectBandeira"> Selecionar bandeira </a> </td>
				<td> <a href = "#" id = "addBandeira"> Cadastrar bandeira </a> </td>
				<input type = "hidden" name = "idBandeiraHidden" id = "idBandeiraHidden">
			</tr>

			<tr class = "fakeRow"> </tr>
		</table>

		

		<table>	
			<tr>
				<td> <label for = "cep"> CEP: <span class = "obgField"> *</span></label> </td>
				<td> <label for = "bairro"> Bairro: <span class = "obgField"> *</span></label> </td>
			</tr>
			<tr>
				<td class = "cepTD"> <input  type = "text" name = "cep" id = "cep"> </td>
				<td> <input  type = "text" name = "bairro" id = "bairro" maxlength="60" > </td>
			</tr>

			<tr class = "fakeRow"> </tr>
		</table>


		<table>	
			<tr>
				<td> <label for = "rua"> Rua: <span class = "obgField"> *</span></label> </td>
				<td> <label for = "numero"> Nº: </label> </td>
				<td> <label for = "complemento"> Complemento: </label> </td>
				<td> <label for = "complemento"> Cidade: <span class = "obgField"> *</span></label> </td>
				<td> <label for = "uf"> UF: <span class = "obgField"> *</span></label> </td>
			</tr>
			<tr>
				<td class = "ruaTD"> <input  type = "text" name = "rua" id = "rua" maxlength="100" > </td>
				<td class = "numeroTD"> <input  type = "text" step ="9" name = "numero" id = "numero" maxlength="6" title = "Este campo aceita apenas números e não pode ser preenchido com 0"> </td>
				<td class = "complementoTD"> <input  type = "text" name = "complemento" id = "complemento"> </td>
				<td class = "cidadeTD"> <input  type = "text" name = "cidade" id = "cidade" > </td>
				<td> <input  type = "text" name = "uf" id = "uf" maxlength="2" title = "Este campos aceita apenas letras"> </td>
			</tr>

			<tr class = "fakeRow"> </tr>
		</table>


		<table>	
			<tr>
				<td> <label for = "nome"> Nome do estabelecimento: <span class = "obgField"> *</span></label> </td>
			</tr>
			<tr>
				<td> <input  type = "text" name = "nome" id = "nome" > </td>
			</tr>

			
		</table>

		<div id = "dadosReceita">
			<!-- Dados na receita -->
			<legend> Dados na receita federal </legend>

			<table>	
				<tr>
					<td> <label for = "estabReceitaRazaoSocial"> Razão social: </label> </td>
				</tr>
				<tr>
					<td> <input  type = "text" name = "estabReceitaRazaoSocial" id = "estabReceitaRazaoSocial"> </td>
				</tr>

				<tr class = "fakeRow"> </tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "estabReceitaNomeEmpresarial">Nome empresarial:  <span class = "obgField"> *</span></label> </td>
				</tr>
				<tr>
					<td> <input  type = "text" name = "estabReceitaNomeEmpresarial" id = "estabReceitaNomeEmpresarial"> </td>
				</tr>

				<tr class = "fakeRow"> </tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "estabReceitaNF"> Nome fantasia: </label> </td>
				</tr>
				<tr>
					<td> <input  type = "text" name = "estabReceitaNF" id = "estabReceitaNF"> </td>
				</tr>

				<tr class = "fakeRow"> </tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "estabReceitaCEP"> CEP: <span class = "obgField"> *</span></label> </td>
					<td> <label for = "estabReceitaBairro">Bairro:  <span class = "obgField"> *</span></label> </td>
				</tr>
				<tr>
					<td class = "cepTD"> <input  type = "text" name = "estabReceitaCEP" id = "estabReceitaCEP"> </td>
					<td> <input  type = "text" name = "estabReceitaBairro" id = "estabReceitaBairro"> </td>
				</tr>

				<tr class = "fakeRow"> </tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "estabReceitaEndereco"> Endereço: <span class = "obgField"> *</span></label> </td>
					<td> <label for = "estabReceitaNumero"> Nº: </label> </td>
					<td> <label for = "estabReceitaComplemento"> Complemento: </label> </td>
					<td> <label for = "estabReceitaCidade"> Cidade: <span class = "obgField"> *</span></label> </td>
					<td> <label for = "estabReceitaUF"> UF: <span class = "obgField"> *</span></label> </td>
				</tr>
				<tr>
					<td class = "ruaTD"> <input  type = "text" name = "estabReceitaEndereco" id = "estabReceitaEndereco"> </td>
					<td class = "numeroTD"> <input  type = "text" name = "estabReceitaNumero" id = "estabReceitaNumero" maxlength="6" title = "Este campo aceita apenas numeros e não pode ser preenchido com 0"> </td>
					<td class = "complementoTD"> <input  type = "text" name = "estabReceitaComplemento" id = "estabReceitaComplemento"> </td>
					<td class = "cidadeTD"> <input  type = "text" name = "estabReceitaCidade" id = "estabReceitaCidade"> </td>
					<td> <input  type = "text" name = "estabReceitaUF" id = "estabReceitaUF" maxlength = "2" title = "Este campo aceita apenas letras"> </td>
				</tr>

				<tr class = "fakeRow"> </tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "estabTel01"> Telefone 01: </label> </td>
					<td> <label for = "estabTel02"> Telefone 02: </label> </td>
				</tr>
				<tr>
					<td class = "tel01TD"> <input  type = "text" name = "estabTel01" id = "estabTel01" maxlength = "14"> </td>
					<td> <input  type = "text" name = "estabTel02" id = "estabTel02" maxlength = "14"> </td>
				</tr>

				<tr class = "fakeRow"> </tr>
			</table>

			<table>	
				<tr>
					<td> <label for = "estabReceitaAberturaData"> Data de abertura: <span class = "obgField"> *</span></label> </td>
					<td> <label for = "estabReceitaSituacao"> Situação: <span class = "obgField"> *</span></label> </td>
					<td> <label for = "estabReceitaSituacaoData"> Situação data: <span class = "obgField"> *</span></label> </td>
					<td> <label for = "dataFechamento"> Data fechamento </label> </td>
				</tr>
				<tr>
					<td class = "dataTD"> <input  type = "text" name = "estabReceitaAberturaData" id = "estabReceitaAberturaData"> </td>
					<td class = "situacaoTD">
						<select name = "estabReceitaSituacao" id = "estabReceitaSituacao"> 
							<option value="ATIVA">ATIVA</option>
							<option value="BAIXADA">BAIXADA</option>
							<option value="SUSPENSA">SUSPENSA</option>
							<option value="INATIVA">INATIVA</option>
						</select>			
					</td>
					<td class = "dataTD"> <input  type = "text" name = "estabReceitaSituacaoData" id = "estabReceitaSituacaoData"> </td>
					<td> <input  type = "text" name = "dataFechamento" id = "dataFechamento"> </td>
				</tr>

				<tr style = "height:50px"> </tr>

				<tr>
					<td colspan = "12"> <input type = "button" name = "cadLojaBtn" id = "cadLojaBtn" value = "Cadastrar loja"> </td>
				</tr>
			</table>
		</div>

		<input id = "userAdd" name = "userAdd" type = "hidden" value = "<?php echo $_SESSION['idUsuario']; ?>">
	</form>
</div>

<!-- Modals -->
<!-- Buscar bandeira -->
<div id = "bandeirasModal" title = "Bandeiras">
	<form method="post" id="bandeirasForm">
		<table>
			<tr>
				<td> <label for = "bandeira"> Bandeira: </label> </td>
				<td> <input type = "text" id = "bandeiraSearch" name = "bandeiraSearch"> </td>

				<td> <input type = "button" name = "searchBandeiraBtn" id = "searchBandeiraBtn" value = "Pesquisar"> </td>
			</tr>
		</table>
		<input type = "hidden" id = "pagina" value = "1">

		<id id = "searchBandeiraResults">

		</div>
	</form>
</div>

<!-- Cadastrar bandeira -->
<div id = "cadBandeirasModal" title = "Cadastrar bandeiras">
	<form method="post" id="cadBandeirasForm">
		<table>
			<tr>
				<td> <label for = "bandeira"> Bandeira: </label> </td>
				<td> <input type = "text" id = "cadBandeiraNome" name = "cadBandeiraNome"> </td>

				<td> <input type = "button" name = "cadBandeiraBtn" id = "cadBandeiraBtn" value = "Cadastrar"> </td>
			</tr>
		</table>
	</form>
</div>


<!-- Confirmar numero -->
<div id="numConfirm" title="Numero da loja">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Atenção! O estabelecimento será cadastrado sem número</p>
</div>

<!-- Confirmar numero da receita -->
<div id="numConfirmReceita" title="Numero da loja (receita)">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Atenção! O estabelecimento será cadastrado sem número da receita</p>
</div>

<!-- CNPJ obrigatório -->
<div id="cnpjObrigatorio" title="CNPJ">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Atenção! O campo CNPJ é obrigatório!</p>
</div>

<!-- Bandeira obrigatório -->
<div id="bandeiraObrigatorio" title="Bandeira">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Atenção! O campo bandeira é obrigatório!</p>
</div>

<!-- Nome obrigatório -->
<div id="nomeObrigatorio" title="Nome do estabelecimento">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Atenção! O campo nome do estabelecimento é obrigatório!</p>
</div>

<!-- Endereço obrigatório -->
<div id="enderecoObrigatorio" title="Endereço">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Atenção! O endereço completo da loja é obrigatório, isto inclui: CEP, Bairro, Rua, Cidade e Estado (UF)</p>
</div>

<!-- Nome empresarial obrigatório -->
<div id="nomeEmpresarialObrigatorio" title="Nome empresarial">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Atenção! O Campo Nome empresarial é obrigatório</p>
</div>

<!-- Endereço receita obrigatório -->
<div id="enderecoReceitaObrigatorio" title="Endereço receita">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Atenção! O endereço completo da receita federal é obrigatório, isto inclui: Nome Empresarial, CEP, Bairro, Rua, Cidade e Estado (UF)</p>
</div>

<!-- Situação data obrigatório -->
<div id="situacaoDataObrigatorio" title="Situação data">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Atenção! O Campo situação data é obrigatório</p>
</div>

<!-- Data de abertura obrigatório -->
<div id="dataAberturaObrigatorio" title="Data de abertura">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Atenção! O Campo data de abertura é obrigatório</p>
</div>

<!-- Loja cadastrada com sucesso -->
<div id="lojaSucesso" title="Loja cadastrada com sucesso">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Loja cadastrada com sucesso</p>
</div>

<!-- CNPJ já cadastrado -->
<div id="cnpjCadastrado" title="CNPJ">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Este CNPJ já foi cadastrado</p>
</div>

<!-- Nome já cadastrado -->
<div id="nomeCadastrado" title="Nome cadastrado">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Este nome já foi cadastrado</p>
</div>

<!-- Bandeira já cadastrada -->
<div id="bandeiraCadastrada" title="Bandeira">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta bandeira já foi cadastrada</p>
</div>

<!-- Bandeira cadastrada com sucesso -->
<div id="bandeiraCadastradaSucesso" title="Bandeira">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Bandeira cadastrada com sucesso</p>
</div>

<!-- Loja Alterada com sucesso -->
<div id="alterarLoja" title="Alterar Loja">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Loja Alterada com sucesso</p>
</div>

