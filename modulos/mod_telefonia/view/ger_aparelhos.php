<?php require_once("../../../actions/security.php"); ?>

<script src="modulos/mod_telefonia/view/resources/js/ger_aparelhos.js"></script>
<link rel="stylesheet" href="modulos/mod_telefonia/view/resources/css/ger_aparelhos.css" />

<h3> Gerenciar Aparelhos </h3>
<div id = "tableWrapper_gerAparelhos">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="input-group pull-right col-md-4">
				<div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
				<input class="form-control" type="text" id = "gerAparelhos_pagination_search" placeholder="Procurar...">
			</div>
			<div class="input-group col-md-2 pull-left">
				<select id = "gerAparelhos_regs" class="form-control">
				  <option>5</option>
				  <option>10</option>
				  <option>20</option>
				</select>
			</div>

			<button type="button" id = "gerAparelhos_addAparelhoBtn" class="btn btn-primary pull-left marginLeft20" data-toggle="modal" data-target="#add_aparelho">
			  <span class="glyphicon glyphicon-plus"></span> Adicionar aparelho
			</button>

			<button type="button" id = "gerAparelhos_exportExcel" class="btn btn-success pull-left marginLeft20">
			  <span class="glyphicon glyphicon-export"></span> Exportar para excel
			</button>

			<button type="button" id = "gerAparelhos_importExcel" class="btn btn-success pull-left marginLeft20" data-toggle="modal" data-target="#gerAparelhos_import_data">
			  <span class="glyphicon glyphicon-import"></span> Importar dados
			</button>
		</div>
	</div>

	<div id="gerAparelhos_tabelWrapperExport">
		<table id = "gerAparelhos_table" class="table table-striped table-condensed table-hover">
			<thead> 
				<th class = "width50"></th>
				<th id = "marca"> Marca <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "modelo"> Modelo <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "imei"> IMEI <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "tipo"> Tipo <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "status"> Status <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th class = "width100"></th>
			</thead>

			<tbody>

			</tbody>

			<tfoot>
				<th class = "width50"></th>
				<th> Marca </th>
				<th> Modelo </th>
				<th> IMEI </th>
				<th> Tipo </th>
				<th> Status </th>
				<th class = "width100"></th>
			</tfoot>
		</table>
	</div>

	<div class="panel-body">
		<div id = "gerAparelhos_tableInfos" class = "pull-left pagination text-center"> 
			<p> 
				<strong> Voce esta na pagina: </strong> <span id = "gerAparelhos_tableRegPage"> </span>
				<strong> de: </strong> <span id = "gerAparelhos_tableTotalPages"> </span>
				<strong> | Total de registros: </strong> <span id = "gerAparelhos_tableRegTotal"> </span> 
			</p>
		</div>

		<ul class="pagination pull-right" id = "gerAparelhos_pagination">
		  
		</ul>

		<!-- <button type="button" class="btn btn-primary pull-right top20 right20"> Ir</button> -->
		<div class="input-group col-md-1 pull-right top20 right20">
			<input type="text" id = "gerAparelhos_pagination_goPage" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-default" id = "gerAparelhos_pagination_go" type="button">Ir!</button>
			</span>
		</div>

		<input type = "hidden" id = "paginationController" value = "1">
	</div>

</div>

<!-- Modals -->
<!-- Add/Update line -->
<div class="modal fade" id = "add_aparelho">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Adicionar aparelho</h4>
			</div>
			<div class="modal-body">
				<form role="form" id = "gerAparelhos_form">
					<div class="row">
						<div id = "error-message-wrapper" class="col-xs-12"> </div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="marca">Marca:</label>
									<input type="text" name = "marca" class="form-control" placeholder="Marca do aparelho">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label for="modelo">Modelo:</label>
									<input type="text" name = "modelo" id="modelo" class="form-control" placeholder="Modelo">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="imei">IMEI</label>
									<input type="text" name = "imei" id="imei" class="form-control" placeholder="IMEI">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="operadora">Tipo</label>
									<select name = "tipo" id = "tipo" class="form-control">
										<option value = "Smartphone">Smartphone</option>
										<option value = "Tablet">Tablet</option>
										<option value = "Modem">Modem</option>
									</select>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="status">Status</label>
									<select name = "status" id = "status" class="form-control">
										<option value = "Uso">Uso</option>
										<option value = "Disponivel">Disponivel</option>
										<option value = "Manutencao">Manutenção</option>
										<option value = "Furtado">Furtado</option>
									</select>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="dataEnvioManutencao">Data de envio p/ Manutenção:</label>
									<input type="text" name = "dataEnvioManutencao" id="dataEnvioManutencao" class="form-control" placeholder="Data de envio">
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group has-feedback">
									<label for="acessorios">Acessórios</label>
									<textarea class="form-control" name = "acessorios" id = "acessorios" rows="3"></textarea>	
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group has-feedback">
									<label for="observacoes">Observações</label>
									<textarea class="form-control" name = "observacoes" id = "observacoes" rows="3"></textarea>	
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer" id = "gerAparelhos_modalFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="button" id = "gerAparelhos_save" name = "gerAparelhos_save" class="btn btn-primary">Salvar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- See line information -->
<div class="modal fade" id = "show_aparelho">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Dados do aparelho</h4>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="row">
						<div class="form-group">
							<div class="col-xs-4">
								<label for="marca">Marca:</label>
								<span id = "show_marca"> </span>
							</div>
							<div class="col-xs-6">
								<label for="modelo">Modelo:</label>
								<span id = "show_modelo"> </span>
							</div>
							<div class="col-xs-4">
								<label for="imei">IMEI:</label>
								<span id = "show_imei"> </span>
							</div>
							<div class="col-xs-4">
								<label for="tipo">Tipo:</label>
								<span id = "show_tipo"> </span>
							</div>
							<div class="col-xs-4">
								<label for="status">Status:</label>
								<span id = "show_status"> </span>
							</div>
							<div class="col-xs-12">
								<label for="acessorios">Acessórios:</label>
								<span id = "show_acessorios"> </span>
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
<div class="modal fade" id = "gerAparelhos_import_data">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Importar dados</h4>
			</div>
			<div class="modal-body">
				<form enctype="multipart/form-data" method="post" role="form" action = "modulos/mod_telefonia/controller/ger_aparelhos.php?import=true">
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