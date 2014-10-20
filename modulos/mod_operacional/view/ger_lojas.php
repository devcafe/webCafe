<?php 
	require_once("../../../actions/accessController.php"); 
	require_once("../../../actions/security.php"); 
?>

<script src="modulos/mod_operacional/view/resources/js/ger_lojas.js"></script>
<link rel="stylesheet" href="modulos/mod_operacional/view/resources/css/ger_lojas.css" />
<script src="libs/bootstrap/js/bootstrap-typeahead.js"></script>

<h3>Gerenciar Lojas </h3>
<div id = "tableWrapper_gerLojas">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="input-group pull-right col-md-4">
				<div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
				<input class="form-control" type="text" id = "gerLojas_pagination_search" placeholder="Procurar...">
			</div>
			<div class="input-group col-md-2 pull-left">
				<select id = "gerLojas_regs" class="form-control">
				  <option>5</option>
				  <option selected>10</option>
				  <option>20</option>
				  <option>50</option>
				</select>
			</div>

			<?php if(accessRules(25) || accessRules(99)){ ?>
			<button type="button" id = "gerLojas_addLojaBtn" class="btn btn-primary pull-left marginLeft20" data-toggle="modal" data-target="#add_loja">
			  <span class="glyphicon glyphicon-plus"></span> Adicionar loja
			</button>
			<?php } ?>

			<?php if(accessRules(34) || accessRules(99)){ ?>
			<button type="button" id = "gerLojas_exportExcel" class="btn btn-success pull-left marginLeft20">
			  <span class="glyphicon glyphicon-export"></span> Exportar para excel
			</button>
			<?php } ?>

			<!--<?php if(accessRules(35) || accessRules(99)){ ?>
			<button type="button" id = "gerLojas_importExcel" class="btn btn-success pull-left marginLeft20" data-toggle="modal" data-target="#gerLojas_import_data">
			  <span class="glyphicon glyphicon-import"></span> Importar dados
			</button>
			<?php } ?>-->
		</div>
	</div>

	<?php if(accessRules(9) || accessRules(99)){ echo "<input type = 'hidden' value = 'true' name = 'accessView'>"; } ?>
	<?php if(accessRules(22) || accessRules(99)){ echo "<input type = 'hidden' value = 'true' name = 'accessDelete'>"; } ?>
	<?php if(accessRules(23) || accessRules(99)){ echo "<input type = 'hidden' value = 'true' name = 'accessEdit'>"; } ?>

	<div id="gerLojas_tabelWrapperExport" class = "table-responsive">
		<table id = "gerLojas_table" class="table table-striped table-condensed table-hover">
			<thead> 
				<th class = "width50"></th>
				<th id = "idLoja" class = "width100"> IDLOJA <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "cnpj"> CNPJ <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "bandeira"> BANDEIRA <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "nome"> NOME <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "rua"> RUA <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "numero" class = "width50"> Nº <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<!--<th id = "complemento"> Complemto <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>-->
				<th id = "bairro"> BAIRRO <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "cidade"> CIDADE <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "uf" class = "width50"> UF <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<!--<th id = "cep"> CEP <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>-->

				<th class = "width100"></th>
			</thead>

			<tbody>

			</tbody>

			<tfoot>
				<th class = "width50"></th>
				<th> ID </th>
				<th> CNPJ </th>
				<th> Bandeira </th>
				<th> Estabelecimento </th>
				<th> Rua </th>
				<th> Nº </th>
				<!--<th> Complemento </th>-->
				<th> Bairro </th>
				<th> Cidade </th>
				<th> UF </th>
				<!--<th> cep </th>-->
				<th class = "width100"></th>
			</tfoot>
		</table>
	</div>

	<div class="panel-body">
		<div id = "gerLojas_tableInfos" class = "pull-left pagination text-center"> 
			<p> 
				<strong> Voce esta na pagina: </strong> <span id = "gerLojas_tableRegPage"> </span>
				<strong> de: </strong> <span id = "gerLojas_tableTotalPages"> </span>
				<strong> | Total de registros: </strong> <span id = "gerLojas_tableRegTotal"> </span> 
			</p>
		</div>

		<ul class="pagination pull-right" id = "gerLojas_pagination">
		  
		</ul>

		<!-- <button type="button" class="btn btn-primary pull-right top20 right20"> Ir</button> -->
		<div class="input-group col-md-1 pull-right top20 right20">
			<input type="text" id = "gerLojas_pagination_goPage" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-default" id = "gerLojas_pagination_go" type="button">Ir!</button>
			</span>
		</div>

		<input type = "hidden" id = "paginationController" value = "1">
	</div>

</div>


<!-- Modals -->
<!-- Add/Update store -->
<div class="modal fade" id = "add_loja">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Adicionar loja</h4>
			</div>
			<div class="modal-body">
				<form role="form" id = "gerLojas_form">
					<div class="row">
						<div id = "error-message-wrapper" class="col-xs-12"> </div>
					</div>
					<div class="row">
						<div class="form-group">
						<div class="col-xs-12">
								<div class="form-group has-feedback">
									<label for="estabReceitaAberturaData"><h3>Dados da loja</h3></label>									
								</div>
							</div>						
							<div class="col-xs-7">
								<div class="form-group has-feedback">
									<label for="cnpj">CNPJ:</label>
									<input type="text" name = "cnpj" class="form-control" placeholder="CNPJ">
								</div>
							</div>
							<div class="col-xs-5">
								<div class="form-group has-feedback">
									<label for="bandeira" >Bandeira: <a src = "#" contenteditable="true" tabindex = '-1' >Cadastrar bandeira</a></label>
									<select name ="bandeira" class = "bandeirasSelectContainner"> </select>														
								</div>
							</div>						
							<div class="col-xs-2">
								<div class="form-group has-feedback">
									<label for="cep">CEP:</label>
									<input type="text" name = "cep" class="form-control" placeholder="CEP">
								</div>
							</div>
							<div class="col-xs-5">
								<div class="form-group has-feedback">
									<label for="rua">Rua:</label>
									<input type="text" name = "rua" class="form-control" placeholder="Rua">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group has-feedback">
									<label for="numero">Numero:</label>
									<input type="text" name = "numero" class="form-control" placeholder="Numero">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="complemento">Complemento:</label>
									<input type="text" name = "complemento" class="form-control" placeholder="Complemento">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group has-feedback">
									<label for="bairro">Bairro:</label>
									<input type="text" name = "bairro" class="form-control" placeholder="Bairro">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group has-feedback">
									<label for="uf">UF:</label>
									<input type="text" name = "uf" class="form-control" placeholder="UF">
								</div>
							</div>
							<div class="col-xs-3 ">
								<div class="form-group has-feedback">
									<label for="cidade">Cidade:</label>
									<input type="text" name = "cidade" class="form-control" placeholder="Cidade">
								</div>
							</div>
								<div class="col-xs-12">
								<div class="form-group has-feedback">
									<label for="nome">Nome:</label>
									<input type="text" name = "nome" class="form-control" placeholder="Nome da loja">
								</div>
							</div>

							<!-- fake -->

							<div class="col-xs-12">
								<div class="form-group has-feedback">
																	
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group has-feedback">
																	
								</div>
							</div>
								<!-- /fake -->

							<div class="col-xs-12">
								<div class="form-group has-feedback">
									<label for="estabReceitaAberturaData"><h3>Dados da receita</h3></label>									
								</div>
							</div>

							<div class="col-xs-7">
								<div class="form-group has-feedback">
									<label for="estabReceitaRazaoSocial">Razão social:</label>
									<input type="text" name = "estabReceitaRazaoSocial" class="form-control" placeholder="Razão social">
								</div>
							</div>

							<div class="col-xs-7">
								<div class="form-group has-feedback">
									<label for="estabReceitaNomeEmpresarial">Nome empresarial:</label>
									<input type="text" name = "estabReceitaNomeEmpresarial" class="form-control" placeholder="Nome empresarial">
								</div>
							</div>

							<div class="col-xs-7">
								<div class="form-group has-feedback">
									<label for="estabReceitaNF">Nome fantasia:</label>
									<input type="text" name = "estabReceitaNF" class="form-control" placeholder="Nome fantasia">
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group has-feedback">
																	
								</div>
							</div>

							<div class="col-xs-2">					
								<div class="form-group has-feedback">
									<label for="estabReceitaCEP">CEP:</label>
									<input type="text" name = "estabReceitaCEP" class="form-control" placeholder="CEP">
								</div>
							</div>
							<div class="col-xs-5">
								<div class="form-group has-feedback">
									<label for="estabReceitaEndereco">Endereço na receita:</label>
									<input type="text" name = "estabReceitaEndereco" class="form-control" placeholder="Endereço na receita">
								</div>
							</div>

							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="estabReceitaBairro">Bairro:</label>
									<input type="text" name = "estabReceitaBairro" class="form-control" placeholder="Bairro">
								</div>
							</div>								
							
							<div class="col-xs-2">
								<div class="form-group has-feedback">
									<label for="estabReceitaNumero">Numero:</label>
									<input type="text" name = "estabReceitaNumero" class="form-control" placeholder="Numero">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="estabReceitaComplemento">Complemento:</label>
									<input type="text" name = "estabReceitaComplemento" class="form-control" placeholder="Complemento">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group has-feedback">
									<label for="estabReceitaCidade">Cidade:</label>
									<input type="text" name = "estabReceitaCidade" class="form-control" placeholder="Cidade">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group has-feedback">
									<label for="estabReceitaUF">UF:</label>
									<input type="text" name = "estabReceitaUF" class="form-control" placeholder="UF">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="estabTel01">Telefone 01:</label>
									<input type="text" name = "estabTel01" class="form-control" placeholder="Telefone 1">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="estabTel02">Telefone 02: </label>
									<input type="text" name = "estabTel02" class="form-control" placeholder="Telefone 2">
								</div>
							</div>

							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="estabReceitaAberturaData">Data abertura:</label>
									<input type="text" name = "estabReceitaAberturaData" class="form-control" placeholder="Data abertura:">
								</div>
							</div>
							
							<div class="col-xs-3">
								<div class="form-group has-feedback">
									<label for="estabReceitaSituacao">Situação:</label>
									<select  name="estabReceitaSituacao" id="estabReceitaSituacao" class="form-control">
										<option val="ATIVO" >ATIVO</option>
										<option val="BAIXADA" >BAIXADA</option>
										<option val="SUSPENSA" >SUSPENSA</option>
										<option val="INATIVA" >INATIVA</option>
									</select>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="estabReceitaSituacaoData">Situação data:</label>
									<input type="text" name = "estabReceitaSituacaoData" class="form-control" placeholder="Situação data">
								</div>
							</div>
							
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="dataFechamento">Data fechamento:</label>
									<input type="text" name = "dataFechamento" class="form-control" placeholder="Data fechamento">
								</div>
							</div>

							
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer" id = "gerLojas_modalFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="button" id = "gerLojas_save" name = "gerLojas_save" class="btn btn-primary">Salvar</button>
			</div>
		</div> <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<!-- See store information -->
<div class="modal fade" id = "show_loja">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Dados da loja</h4>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="row">
						<div class="form-group">
							<div class = "group-height">							
								<div class="col-xs-4">
									<label for="idLoja">ID:</label>
									<span id="show_idLoja"> </span>
								</div>
								<div class="col-xs-8">
									<label for="cnpj">CNPJ:</label>
									<span id="show_cnpj"> </span>
								</div>
								<div class="col-xs-6">
									<label for="bandeira">Bandeira:</label>
									<span id="show_bandeira"> </span>
								</div>
								<div class="col-xs-6">
									<label for="nome">Nome:</label>
									<span id="show_nome"> </span>
								</div>
								<div class="col-xs-6">
									<label for="rua">Rua:</label>
									<span id="show_rua"> </span>
								</div>
								<div class="col-xs-2">
									<label for="numero">Número:</label>
									<span id="show_numero"> </span>
								</div>
								<div class="col-xs-4">
									<label for="bairro">Bairro:</label>
									<span id="show_bairro"> </span>
								</div>
								<div class="col-xs-3">
									<label for="complemento">Complemento:</label>
									<span id="show_complemento"> </span>
								</div>
								<div class="col-xs-3">
									<label for="cidade">Cidade:</label>
									<span id="show_cidade"> </span>
								</div>
								<div class="col-xs-2">
									<label for="uf">UF:</label>
									<span id="show_uf"> </span>
								</div>
								<div class="col-xs-4">
									<label for="cep">CEP:</label>
									<span id="show_cep"> </span>
								</div>
								<div class="col-xs-6">
									<label for="estabReceitaRazaoSocial">Razão social:</label>
									<span id="show_estabReceitaRazaoSocial"> </span>
								</div>
								<div class="col-xs-6">
									<label for="estabReceitaNomeEmpresarial">Nome empresarial:</label>
									<span id="show_estabReceitaNomeEmpresarial"> </span>
								</div>
								<div class="col-xs-4">
									<label for="estabReceitaAberturaData">Data abertura:</label>
									<span id="show_estabReceitaAberturaData"> </span>
								</div>
								<div class="col-xs-6">
									<label for="estabReceitaNF">Nome fantasia:</label>
									<span id="show_estabReceitaNF"> </span>
								</div>
								<div class="col-xs-6">
									<label for="estabReceitaEndereco">Endereço receita:</label>
									<span id="show_estabReceitaEndereco"> </span>
								</div>
								<div class="col-xs-4">
									<label for="estabReceitaNumero">Numero receita:</label>
									<span id="show_estabReceitaNumero"> </span>
								</div>
								<div class="col-xs-5">
									<label for="estabReceitaBairro">Bairro receita:</label>
									<span id="show_estabReceitaBairro"> </span>
								</div>
								<div class="col-xs-4">
									<label for="estabReceitaComplemento">Complemento receita:</label>
									<span id="show_estabReceitaComplemento"> </span>
								</div>
								<div class="col-xs-4">
									<label for="estabReceitaCidade">Cidade receita:</label>
									<span id="show_estabReceitaCidade"> </span>
								</div>
								<div class="col-xs-4">
									<label for="estabReceitaUF">Receita UF:</label>
									<span id="show_estabReceitaUF"> </span>
								</div>
								<div class="col-xs-4">
									<label for="estabReceitaCEP">Receita CEP:</label>
									<span id="show_estabReceitaCEP"> </span>
								</div>
								<div class="col-xs-4">
									<label for="estabReceitaSituacao">Receita situação:</label>
									<span id="show_estabReceitaSituacao"> </span>
								</div>
								<div class="col-xs-6">
									<label for="estabReceitaSituacaoData">Receita situação data:</label>
									<span id="show_estabReceitaSituacaoData"> </span>
								</div>
								<div class="col-xs-4">
									<label for="estabTel01">Tel 01:</label>
									<span id="show_estabTel01"> </span>
								</div>
								<div class="col-xs-4">
									<label for="estabTel02">Tel 02:</label>
									<span id="show_estabTel02"> </span>
								</div>
								<div class="col-xs-4">
									<label for="dataFechamento">Data fechamento:</label>
									<span id="show_dataFechamento"> </span>
								</div>
							</div>														
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default exit" data-dismiss="modal">Fechar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Import data -->
<!-- <div class="modal fade" id = "gerLojas_import_data">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Importar dados</h4>
			</div>
			<div class="modal-body">
				<form enctype="multipart/form-data" method="post" role="form" action = "modulos/mod_telefonia/controller/ger_lojas.php?import=true">
				    <div class="form-group">
				        <label for="exampleInputFile">File Upload</label>
				        <input type="file" name="file" id="file" size="150">
				        <p class="help-block">Only Excel/CSV File Import.</p>
				    </div>
				    <button type="submit" class="btn btn-default" name="import" value="Importar">Upload</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			</div> -->
		<!-- </div> --><!-- /.modal-content -->
	<!-- </div> --><!-- /.modal-dialog -->
<!-- </div> --><!-- /.modal -->



