<?php require_once("../../../actions/security.php"); ?>

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
				  <option>10</option>
				  <option>20</option>
				  <option>50</option>
				</select>
			</div>

			<button type="button" id = "gerLojas_addLojaBtn" class="btn btn-primary pull-left marginLeft20" data-toggle="modal" data-target="#add_loja">
			  <span class="glyphicon glyphicon-plus"></span> Adicionar loja
			</button>

			<button type="button" id = "gerLojas_exportExcel" class="btn btn-success pull-left marginLeft20">
			  <span class="glyphicon glyphicon-export"></span> Exportar para excel
			</button>

			<button type="button" id = "gerLojas_importExcel" class="btn btn-success pull-left marginLeft20" data-toggle="modal" data-target="#gerLojas_import_data">
			  <span class="glyphicon glyphicon-import"></span> Importar dados
			</button>
		</div>
	</div>

	<div id="gerLojas_tabelWrapperExport">
		<table id = "gerLojas_table" class="table table-striped table-condensed table-hover">
			<thead> 
				<th class = "width50"></th>
				<th id = "idLoja"> ID <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "cnpj"> CNPJ <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "bandeira"> Bandeira <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "nome"> Nome do Estabelecimento <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "rua"> Rua <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "numero"> Nº <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "complemento"> Complemto <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "bairro"> Bairro <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "cidade"> Cidade <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "uf"> UF <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "cep"> CEP <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>

				<th class = "width100"></th>
			</thead>

			<tbody>

			</tbody>

			<tfoot>
				<th class = "width50"></th>
				<th> ID </th>
				<th> CNPJ </th>
				<th> Bandeira </th>
				<th> Nome do Estabelecimento </th>
				<th> Rua </th>
				<th> Nº </th>
				<th> Complemto </th>
				<th> Bairro </th>
				<th> Cidade </th>
				<th> UF </th>
				<th> cep </th>
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
									<label for="estabReceitaAberturaData"><h3>DADOS DA LOJA</h3></label>									
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
									<label for="idEstabBandeira" >BANDEIRA: </label>
									<select name ="bandeira" class="form-control"> </select>														
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group has-feedback">
									<label for="nome">NOME:</label>
									<input type="text" name = "nome" class="form-control" placeholder="NOME">
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
									<label for="rua">RUA:</label>
									<input type="text" name = "rua" class="form-control" placeholder="RUA">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group has-feedback">
									<label for="numero">NUMERO:</label>
									<input type="text" name = "numero" class="form-control" placeholder="NUMERO">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="complemento">COMPLEMENTO:</label>
									<input type="text" name = "complemento" class="form-control" placeholder="COMPLEMENTO">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group has-feedback">
									<label for="bairro">BAIRRO:</label>
									<input type="text" name = "bairro" class="form-control" placeholder="BAIRRO">
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
									<label for="cidade">CIDADE:</label>
									<input type="text" name = "cidade" class="form-control" placeholder="CIDADE">
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
									<label for="estabReceitaAberturaData"><h3>DADOS DA RECEITA</h3></label>									
								</div>
							</div>

							<div class="col-xs-7">
								<div class="form-group has-feedback">
									<label for="estabReceitaRazaoSocial">RAZÃO SOCIAL:</label>
									<input type="text" name = "estabReceitaRazaoSocial" class="form-control" placeholder="RAZÃO SOCIAL">
								</div>
							</div>

							<div class="col-xs-7">
								<div class="form-group has-feedback">
									<label for="estabReceitaNomeEmpresarial">NOME EMPRESARIAL:</label>
									<input type="text" name = "estabReceitaNomeEmpresarial" class="form-control" placeholder="NOME EMPRESARIAL">
								</div>
							</div>

							<div class="col-xs-7">
								<div class="form-group has-feedback">
									<label for="estabReceitaNF">NOME FANTASIA:</label>
									<input type="text" name = "estabReceitaNF" class="form-control" placeholder="NOME FANTASIA">
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group has-feedback">
																	
								</div>
							</div>

							<div class="col-xs-3">					
								<div class="form-group has-feedback">
									<label for="estabReceitaCEP">CEP:</label>
									<input type="text" name = "estabReceitaCEP" class="form-control" placeholder="CEP">
								</div>
							</div>
							<div class="col-xs-5">
								<div class="form-group has-feedback">
									<label for="estabReceitaEndereco">ENDEREÇO NA RECEITA:</label>
									<input type="text" name = "estabReceitaEndereco" class="form-control" placeholder="ENDEREÇO NA RECEITA">
								</div>
							</div>

							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="estabReceitaBairro">Bairro</label>
									<input type="text" name = "estabReceitaBairro" class="form-control" placeholder="Bairro">
								</div>
							</div>								
							
							<div class="col-xs-2">
								<div class="form-group has-feedback">
									<label for="estabReceitaNumero">Nº:</label>
									<input type="text" name = "estabReceitaNumero" class="form-control" placeholder="NUMERO">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="estabReceitaComplemento">COMPLMENTO:</label>
									<input type="text" name = "estabReceitaComplemento" class="form-control" placeholder="COMPLEMENTO">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group has-feedback">
									<label for="estabReceitaCidade">CIDADE:</label>
									<input type="text" name = "estabReceitaCidade" class="form-control" placeholder="CIDADE">
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
									<label for="estabTel01">TELEFONE 01:</label>
									<input type="text" name = "estabTel01" class="form-control" placeholder="TELEFONE 1">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="estabTel02">TELEFONE 02: </label>
									<input type="text" name = "estabTel02" class="form-control" placeholder="TELEFONE 2">
								</div>
							</div>

							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="estabReceitaAberturaData">DATA ABERTURA:</label>
									<input type="text" name = "estabReceitaAberturaData" class="form-control" placeholder="DATA ABERTURA:">
								</div>
							</div>
							
							<div class="col-xs-3">
								<div class="form-group has-feedback">
									<label for="estabReceitaSituacao">SITUAÇÃO:</label>
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
									<label for="estabReceitaSituacaoData">SISTUAÇÃO DATA:</label>
									<input type="text" name = "estabReceitaSituacaoData" class="form-control" placeholder="SITUAÇÃO DATA">
								</div>
							</div>
							
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="dataFechamento">DATA FECHAMENTO:</label>
									<input type="text" name = "dataFechamento" class="form-control" placeholder="DATA FECHAMENTO">
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
							<div class="col-xs-4">
								<label for="idLoja">idLoja</label>
								<span id="show_idLoja"> </span>
							</div>
							<div class="col-xs-4">
								<label for="cnpj">cnpj</label>
								<span id="show_cnpj"> </span>
							</div>
							<div class="col-xs-4">
								<label for="bandeira">bandeira</label>
								<span id="show_bandeira"> </span>
							</div>
							<div class="col-xs-4">
								<label for="nome">nome</label>
								<span id="show_nome"> </span>
							</div>
							<div class="col-xs-4">
								<label for="rua">rua</label>
								<span id="show_rua"> </span>
							</div>
							<div class="col-xs-4">
								<label for="numero">numero</label>
								<span id="show_numero"> </span>
							</div>
							<div class="col-xs-4">
								<label for="complemento">complemento</label>
								<span id="show_complemento"> </span>
							</div>
							<div class="col-xs-4">
								<label for="bairro">bairro</label>
								<span id="show_bairro"> </span>
							</div>
							<div class="col-xs-4">
								<label for="cidadeuf">cidadeuf</label>
								<span id="show_cidadeuf"> </span>
							</div>
							<div class="col-xs-4">
								<label for="cep">cep</label>
								<span id="show_cep"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaAberturaData">estabReceitaAberturaData</label>
								<span id="show_estabReceitaAberturaData"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaRazaoSocial">estabReceitaRazaoSocial</label>
								<span id="show_estabReceitaRazaoSocial"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaNomeEmpresarial">estabReceitaNomeEmpresarial</label>
								<span id="show_estabReceitaNomeEmpresarial"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaNF">estabReceitaNF</label>
								<span id="show_estabReceitaNF"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaEndereco">estabReceitaEndereco</label>
								<span id="show_estabReceitaEndereco"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaNumero">estabReceitaNumero</label>
								<span id="show_estabReceitaNumero"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaComplemento">estabReceitaComplemento</label>
								<span id="show_estabReceitaComplemento"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaBairro">estabReceitaBairro</label>
								<span id="show_estabReceitaBairro"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaCidade">estabReceitaCidade</label>
								<span id="show_estabReceitaCidade"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaUF">estabReceitaUF</label>
								<span id="show_estabReceitaUF"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaCEP">estabReceitaCEP</label>
								<span id="show_estabReceitaCEP"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaSituacao">estabReceitaSituacao</label>
								<span id="show_estabReceitaSituacao"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabReceitaSituacaoData">estabReceitaSituacaoData</label>
								<span id="show_estabReceitaSituacaoData"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabTel01">estabTel01</label>
								<span id="show_estabTel01"> </span>
							</div>
							<div class="col-xs-4">
								<label for="estabTel02">estabTel02</label>
								<span id="show_estabTel02"> </span>
							</div>
							<div class="col-xs-4">
								<label for="dataFechamento">dataFechamento</label>
								<span id="show_dataFechamento"> </span>
							</div>
														
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
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



