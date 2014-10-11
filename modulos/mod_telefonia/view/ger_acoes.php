<?php require_once("../../../actions/security.php"); ?>

<script src="modulos/mod_telefonia/view/resources/js/ger_acoes.js"></script>
<link rel="stylesheet" href="modulos/mod_telefonia/view/resources/css/ger_acoes.css" />

<h3> Gerenciar Ação </h3>
<div id = "tableWrapper_gerAcoes">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="input-group pull-right col-md-4">
				<div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
				<input class="form-control" type="text" id = "gerAcoes_pagination_search" placeholder="Procurar...">
			</div>
			<div class="input-group col-md-2 pull-left">
				<select id = "gerAcoes_regs" class="form-control">
				  <option>5</option>
				  <option>10</option>
				  <option>20</option>
				</select>
			</div>

			<button type="button" id = "gerAcoes_addAcaoBtn" class="btn btn-primary pull-left marginLeft20" data-toggle="modal" data-target="#add_acao">
			  <span class="glyphicon glyphicon-plus"></span> Adicionar ação
			</button>

			<button type="button" id = "gerAcoes_exportExcel" class="btn btn-success pull-left marginLeft20">
			  <span class="glyphicon glyphicon-export"></span> Exportar para excel
			</button>

			<button type="button" id = "gerAcoes_importExcel" class="btn btn-success pull-left marginLeft20" data-toggle="modal" data-target="#gerAcoes_import_data">
			  <span class="glyphicon glyphicon-import"></span> Importar dados
			</button>
		</div>
	</div>

	<div id="gerAcoes_tabelWrapperExport">
		<table id = "gerAcoes_table" class="table table-striped table-condensed table-hover">
			<thead> 
				<th class = "width50"></th>
				<th id = "nome"> Ação <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "cnpj"> CNPJ <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "razaoSocial"> Razão social <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th class = "width100"></th>
			</thead>

			<tbody>

			</tbody>

			<tfoot>
				<th class = "width50"></th>
				<th> Ação </th>
				<th> CNPJ </th>
				<th> Razão social </th>
				<th class = "width100"></th>
			</tfoot>
		</table>
	</div>

	<div class="panel-body">
		<div id = "gerAcoes_tableInfos" class = "pull-left pagination text-center"> 
			<p> 
				<strong> Voce esta na pagina: </strong> <span id = "gerAcoes_tableRegPage"> </span>
				<strong> de: </strong> <span id = "gerAcoes_tableTotalPages"> </span>
				<strong> | Total de registros: </strong> <span id = "gerAcoes_tableRegTotal"> </span> 
			</p>
		</div>

		<ul class="pagination pull-right" id = "gerAcoes_pagination">
		  
		</ul>

		<!-- <button type="button" class="btn btn-primary pull-right top20 right20"> Ir</button> -->
		<div class="input-group col-md-1 pull-right top20 right20">
			<input type="text" id = "gerAcoes_pagination_goPage" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-default" id = "gerAcoes_pagination_go" type="button">Ir!</button>
			</span>
		</div>

		<input type = "hidden" id = "paginationController" value = "1">
	</div>

</div>

<!-- Modals -->
<!-- Add/Update line -->
<div class="modal fade" id = "add_acao">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Adicionar ação</h4>
			</div>
			<div class="modal-body">
				<form role="form" id = "gerAcoes_form">
					<div class="row">
						<div id = "error-message-wrapper" class="col-xs-12"> </div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="nome">Ação:</label>
									<input type="text" name = "nome" class="form-control" placeholder="Nome da ação">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label for="cnpj">CNPJ</label>
									<input type="text" name = "cnpj" id="cnpj" class="form-control" placeholder="CNPJ">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label for="razaoSocial">Razão social</label>
									<input type="text" name = "razaoSocial" id="razaoSocial" class="form-control" placeholder="Razão social">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer" id = "gerAcoes_modalFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="button" id = "gerAcoes_save" name = "gerAcoes_save" class="btn btn-primary">Salvar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- See line information -->
<div class="modal fade" id = "show_acao">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Dados da ação</h4>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="row">
						<div class="form-group">
							<div class="col-xs-6">
								<label for="nome">Ação:</label>
								<span id = "show_nome"> </span>
							</div>
							<div class="col-xs-6">
								<label for="cnpj">CNPJ</label>
								<span id = "show_cnpj"> </span>
							</div>
							<div class="col-xs-6">
								<label for="razaoSocial">Razão social</label>
								<span id = "show_razaoSocial"> </span>
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
<div class="modal fade" id = "gerAcoes_import_data">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Importar dados</h4>
			</div>
			<div class="modal-body">
				<form enctype="multipart/form-data" method="post" role="form" action = "modulos/mod_telefonia/controller/ger_acoes.php?import=true">
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