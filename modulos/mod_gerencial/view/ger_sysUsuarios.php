<?php require_once("../../../actions/security.php"); ?>

<script src="modulos/mod_gerencial/view/resources/js/ger_sysUsuarios.js"></script>
<link rel="stylesheet" href="modulos/mod_gerencial/view/resources/css/ger_sysUsuarios.css" />

<h3> Gerenciar Ação </h3>
<div id = "tableWrapper_gerSysUsuarios">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="input-group pull-right col-md-4">
				<div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
				<input class="form-control" type="text" id = "gerSysUsuarios_pagination_search" placeholder="Procurar...">
			</div>
			<div class="input-group col-md-2 pull-left">
				<select id = "gerSysUsuarios_regs" class="form-control">
				  <option>5</option>
				  <option>10</option>
				  <option>20</option>
				</select>
			</div>

			<button type="button" id = "gerSysUsuarios_addSysUsuarioBtn" class="btn btn-primary pull-left marginLeft20" data-toggle="modal" data-target="#add_sysUsuario">
			  <span class="glyphicon glyphicon-plus"></span> Adicionar usuário
			</button>

			<button type="button" id = "gerSysUsuarios_exportExcel" class="btn btn-success pull-left marginLeft20">
			  <span class="glyphicon glyphicon-export"></span> Exportar para excel
			</button>

			<!--<button type="button" id = "gerSysUsuarios_importExcel" class="btn btn-success pull-left marginLeft20" data-toggle="modal" data-target="#gerSysUsuarios_import_data">
			  <span class="glyphicon glyphicon-import"></span> Importar dados
			</button>-->
		</div>
	</div>

	<div id="gerSysUsuarios_tabelWrapperExport">
		<table id = "gerSysUsuarios_table" class="table table-striped table-condensed table-hover">
			<thead> 
				<th class = "width50"></th>
				<th id = "firstName"> Nome <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "user"> Usuario <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "email"> E-mail <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "departamento"> Departamento <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th class = "width100"></th>
			</thead>

			<tbody>

			</tbody>

			<tfoot>
				<th class = "width50"></th>
				<th> Nome </th>
				<th> Usuario </th>
				<th> E-mail </th>
				<th> Departamento </th>
				<th class = "width100"></th>
			</tfoot>
		</table>
	</div>

	<div class="panel-body">
		<div id = "gerSysUsuarios_tableInfos" class = "pull-left pagination text-center"> 
			<p> 
				<strong> Voce esta na pagina: </strong> <span id = "gerSysUsuarios_tableRegPage"> </span>
				<strong> de: </strong> <span id = "gerSysUsuarios_tableTotalPages"> </span>
				<strong> | Total de registros: </strong> <span id = "gerSysUsuarios_tableRegTotal"> </span> 
			</p>
		</div>

		<ul class="pagination pull-right" id = "gerSysUsuarios_pagination">
		  
		</ul>

		<!-- <button type="button" class="btn btn-primary pull-right top20 right20"> Ir</button> -->
		<div class="input-group col-md-1 pull-right top20 right20">
			<input type="text" id = "gerSysUsuarios_pagination_goPage" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-default" id = "gerSysUsuarios_pagination_go" type="button">Ir!</button>
			</span>
		</div>

		<input type = "hidden" id = "paginationController" value = "1">
	</div>

</div>

<!-- Modals -->
<!-- Add/Update sys user -->
<div class="modal fade" id = "add_sysUsuario">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Adicionar usuário</h4>
			</div>
			<div class="modal-body">
				<form role="form" id = "gerSysUsuarios_form">
					<div class="row">
						<div id = "error-message-wrapper" class="col-xs-12"> </div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label for="firstName">Nome:</label>
									<input type="text" name = "firstName" class="form-control" placeholder="Nome">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label for="lastName">Sobrenome:</label>
									<input type="text" name = "lastName" class="form-control" placeholder="Sobrenome">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="user">Usuário:</label>
									<input type="text" name = "user" id="user" class="form-control" placeholder="Usuário">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="password">Senha:</label>
									<input type="text" name = "password" id="password" class="form-control" placeholder="Senha">
								</div>
							</div>
							<div class="col-xs-8">
								<div class="form-group has-feedback">
									<label for="email">E-mail:</label>
									<input type="text" name = "email" id="email" class="form-control" placeholder="E-mail">
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group has-feedback">
									<label for="email">Departamento:</label>
									<select name = "departamento" id = "departamento" class="form-control">
										<option value = "Atendimento">Atendimento</option>
										<option value = "Operacional">Operacional</option>
										<option value = "DP">DP</option>
										<option value = "Financeiro">Financeiro</option>
										<option value = "Diretoria">Diretoria</option>
									</select>
								</div>
							</div>
							<div class="col-xs-3">
								<label for="modulos">Modulos</label>
								<div class="list-group" id = "modulosLista"> </div>
							</div>
							<div class="col-xs-3">
								<label for="paginas">Páginas</label>
								<div class="list-group" id = "paginasLista"> </div>
							</div>
							<div class="col-xs-3">
								<label for="permissoes">Permissões</label>
								<div class="list-group" id = "permissoesLista">	</div>
							</div>
							<div class="col-xs-3">
								<button type="button" id = "gerSysUsuarios_addAcessoBtn" class="btn btn-primary pull-left marginLeft20" >
								  <span class="glyphicon glyphicon-plus"></span> Adicionar
								</button>
							</div>
							<div class="col-xs-12">
								<div id = "finalAccessRules"> </div>
							</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer" id = "gerSysUsuarios_modalFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="button" id = "gerSysUsuarios_save" name = "gerSysUsuarios_save" class="btn btn-primary">Salvar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- See sys user information -->
<div class="modal fade" id = "show_sysUsuario">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Dados do usuário</h4>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="row">
						<div class="form-group">
							<div class="col-xs-6">
								<label for="nome">Nome:</label>
								<span id = "show_nome"> </span>
							</div>
							<div class="col-xs-6">
								<label for="sobrenome">Sobrenome:</label>
								<span id = "show_sobrenome"> </span>
							</div>
							<div class="col-xs-6">
								<label for="usuario">Usuário:</label>
								<span id = "show_usuario"> </span>
							</div>
							<div class="col-xs-6">
								<label for="email">E-mail:</label>
								<span id = "show_email"> </span>
							</div>
							<div class="col-xs-6">
								<label for="departamento">Departamento</label>
								<span id = "show_departamento"> </span>
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
<div class="modal fade" id = "gerSysUsuarios_import_data">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Importar dados</h4>
			</div>
			<div class="modal-body">
				<form enctype="multipart/form-data" method="post" role="form" action = "modulos/mod_telefonia/controller/ger_sysUsuarios.php?import=true">
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