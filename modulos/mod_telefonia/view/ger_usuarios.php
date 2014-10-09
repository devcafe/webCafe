<?php require_once("../../../actions/security.php"); ?>

<script src="modulos/mod_telefonia/view/resources/js/ger_usuarios.js"></script>
<link rel="stylesheet" href="modulos/mod_telefonia/view/resources/css/ger_usuarios.css" />

<h3> Gerenciar Usuários </h3>
<div id = "tableWrapper_gerUsuarios">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="input-group pull-right col-md-4">
				<div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
				<input class="form-control" type="text" id = "gerUsuarios_pagination_search" placeholder="Procurar...">
			</div>
			<div class="input-group col-md-2 pull-left">
				<select id = "gerUsuarios_regs" class="form-control">
				  <option>5</option>
				  <option>10</option>
				  <option>20</option>
				</select>
			</div>

			<button type="button" id = "gerUsuarios_addUsuarioBtn" class="btn btn-primary pull-left marginLeft20" data-toggle="modal" data-target="#add_usuario">
			  <span class="glyphicon glyphicon-plus"></span> Adicionar usuario
			</button>

			<button type="button" id = "gerUsuarios_exportExcel" class="btn btn-success pull-left marginLeft20">
			  <span class="glyphicon glyphicon-export"></span> Exportar para excel
			</button>

			<button type="button" id = "gerUsuarios_importExcel" class="btn btn-success pull-left marginLeft20" data-toggle="modal" data-target="#gerUsuarios_import_data">
			  <span class="glyphicon glyphicon-import"></span> Importar dados
			</button>
		</div>
	</div>

	<div id="gerUsuarios_tabelWrapperExport">
		<table id = "gerUsuarios_table" class="table table-striped table-condensed table-hover">
			<thead> 
				<th class = "width50"></th>
				<th id = "nome"> Nome <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "celular"> Celular <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "cep"> CEP <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "endereco"> Endereço <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "bairro"> Bairro <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "cidade"> Cidade <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "uf"> UF <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th class = "width100"></th>
			</thead>

			<tbody>

			</tbody>

			<tfoot>
				<th class = "width50"></th>
				<th> Nome </th>
				<th> Celular </th>
				<th> CEP </th>
				<th> Endereço </th>
				<th> Bairro </th>
				<th> Cidade </th>
				<th> UF </th>
				<th class = "width100"></th>
			</tfoot>
		</table>
	</div>

	<div class="panel-body">
		<div id = "gerUsuarios_tableInfos" class = "pull-left pagination text-center"> 
			<p> 
				<strong> Voce esta na pagina: </strong> <span id = "gerUsuarios_tableRegPage"> </span>
				<strong> de: </strong> <span id = "gerUsuarios_tableTotalPages"> </span>
				<strong> | Total de registros: </strong> <span id = "gerUsuarios_tableRegTotal"> </span> 
			</p>
		</div>

		<ul class="pagination pull-right" id = "gerUsuarios_pagination">
		  
		</ul>

		<!-- <button type="button" class="btn btn-primary pull-right top20 right20"> Ir</button> -->
		<div class="input-group col-md-1 pull-right top20 right20">
			<input type="text" id = "gerUsuarios_pagination_goPage" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-default" id = "gerUsuarios_pagination_go" type="button">Ir!</button>
			</span>
		</div>

		<input type = "hidden" id = "paginationController" value = "1">
	</div>

</div>

<!-- Modals -->
<!-- Add/Update user -->
<div class="modal fade" id = "add_usuario">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Adicionar usuario</h4>
			</div>
			<div class="modal-body">
				<form role="form" id = "gerUsuarios_form">
					<div class="row">
						<div id = "error-message-wrapper" class="col-xs-12"> </div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="nome">Nome:</label>
									<input type="text" name = "nome" class="form-control" placeholder="Nome do usuário">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label for="telefone">Telefone:</label>
									<input type="text" name = "telefone" id="telefone" class="form-control" placeholder="Telefone">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="celular">Celular:</label>
									<input type="text" name = "celular" id="celular" class="form-control" placeholder="Celular">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="cep">CEP:</label>
									<input type="text" name = "cep" id="cep" class="form-control" placeholder="CEP">
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group has-feedback">
									<label for="endereco">Endereço:</label>
									<input type="text" name = "endereco" id="endereco" class="form-control" placeholder="Endereco">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="bairro">Bairro:</label>
									<input type="text" name = "bairro" id="bairro" class="form-control" placeholder="Bairro">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="cidade">Cidade:</label>
									<input type="text" name = "cidade" id="cidade" class="form-control" placeholder="Cidade">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group has-feedback">
									<label for="uf">UF:</label>
									<input type="text" name = "uf" id="uf" class="form-control" placeholder="UF">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="rg">RG:</label>
									<input type="text" name = "rg" id="rg" class="form-control" placeholder="RG">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="cpf">CPF:</label>
									<input type="text" name = "cpf" id="cpf" class="form-control" placeholder="CPF">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label for="profissao">Profissao:</label>
									<input type="text" name = "profissao" id="profissao" class="form-control" placeholder="Profissao">
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group has-feedback">
									<label for="observacoes">Observações:</label>
									<textarea class="form-control" name = "observacoes" id = "observacoes" rows="3"></textarea>	
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer" id = "gerUsuarios_modalFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="button" id = "gerUsuarios_save" name = "gerUsuarios_save" class="btn btn-primary">Salvar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- See user information -->
<div class="modal fade" id = "show_usuario">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Dados do usuario</h4>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="row">
						<div class="form-group">
							<div class="col-xs-12">
								<label for="nome">Nome:</label>
								<span id = "show_nome"> </span>
							</div>
							<div class="col-xs-6">
								<label for="telefone">Telefone:</label>
								<span id = "show_telefone"> </span>
							</div>
							<div class="col-xs-6">
								<label for="celular">Celular:</label>
								<span id = "show_celular"> </span>
							</div>
							<div class="col-xs-4">
								<label for="cep">CEP:</label>
								<span id = "show_cep"> </span>
							</div>
							<div class="col-xs-12">
								<label for="endereco">Endereço:</label>
								<span id = "show_endereco"> </span>
							</div>
							<div class="col-xs-4">
								<label for="bairro">Bairro:</label>
								<span id = "show_bairro"> </span>
							</div>
							<div class="col-xs-4">
								<label for="cidade">Cidade:</label>
								<span id = "show_cidade"> </span>
							</div>
							<div class="col-xs-4">
								<label for="uf">UF:</label>
								<span id = "show_uf"> </span>
							</div>
							<div class="col-xs-6">
								<label for="rg">RG:</label>
								<span id = "show_rg"> </span>
							</div>
							<div class="col-xs-6">
								<label for="cpf">CPF:</label>
								<span id = "show_cpf"> </span>
							</div>
							<div class="col-xs-4">
								<label for="profissao">Profissao:</label>
								<span id = "show_profissao"> </span>
							</div>
							<div class="col-xs-12">
								<label for="observacoes">Observações:</label>
								<span id = "show_observacoes"> </span>
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
<div class="modal fade" id = "gerUsuarios_import_data">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Importar dados</h4>
			</div>
			<div class="modal-body">
				<form enctype="multipart/form-data" method="post" role="form" action = "modulos/mod_telefonia/controller/ger_usuarios.php?import=true">
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
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->