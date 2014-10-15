<?php require_once("../../../actions/security.php"); ?>

<script src="modulos/mod_telefonia/view/resources/js/ger_linhas.js"></script>
<link rel="stylesheet" href="modulos/mod_telefonia/view/resources/css/ger_linhas.css" />

<h3> Gerenciar Linhas </h3>
<div id = "tableWrapper_gerLinhas">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="input-group pull-right col-md-4">
				<div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
				<input class="form-control" type="text" id = "gerLinhas_pagination_search" placeholder="Procurar...">
			</div>
			<div class="input-group col-md-2 pull-left">
				<select id = "gerLinhas_regs" class="form-control">
				  <option>5</option>
				  <option>10</option>
				  <option>20</option>
				</select>
			</div>

			<button type="button" id = "gerLinhas_addLinhaBtn" class="btn btn-primary pull-left marginLeft20" data-toggle="modal" data-target="#add_linha">
			  <span class="glyphicon glyphicon-plus"></span> Adicionar linha
			</button>

			<button type="button" id = "gerLinhas_exportExcel" class="btn btn-success pull-left marginLeft20">
			  <span class="glyphicon glyphicon-export"></span> Exportar para excel
			</button>

			<button type="button" id = "gerLinhas_importExcel" class="btn btn-success pull-left marginLeft20" data-toggle="modal" data-target="#gerLinhas_import_data">
			  <span class="glyphicon glyphicon-import"></span> Importar dados
			</button>
		</div>
	</div>

	<div id="gerLinhas_tabelWrapperExport">
		<table id = "gerLinhas_table" class="table table-striped table-condensed table-hover">
			<thead> 
				<th class = "width50"></th>
				<th id = "a.numLinha"> Numero <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "b.marca"> Aparelho <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "a.linhaStatus"> Status da linha  <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th id = "c.nome"> Usuario <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
				<th class = "width100"></th>
			</thead>

			<tbody>

			</tbody>

			<tfoot>
				<th class = "width50"></th>
				<th> Numero </th>
				<th> Aparelho </th>
				<th> Status da linha </th>
				<th> Usuario </th>
				<th class = "width100"></th>
			</tfoot>
		</table>
	</div>

	<div class="panel-body">
		<div id = "gerLinhas_tableInfos" class = "pull-left pagination text-center"> 
			<p> 
				<strong> Voce esta na pagina: </strong> <span id = "gerLinhas_tableRegPage"> </span>
				<strong> de: </strong> <span id = "gerLinhas_tableTotalPages"> </span>
				<strong> | Total de registros: </strong> <span id = "gerLinhas_tableRegTotal"> </span> 
			</p>
		</div>

		<ul class="pagination pull-right" id = "gerLinhas_pagination">
		  
		</ul>

		<!-- <button type="button" class="btn btn-primary pull-right top20 right20"> Ir</button> -->
		<div class="input-group col-md-1 pull-right top20 right20">
			<input type="text" id = "gerLinhas_pagination_goPage" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-default" id = "gerLinhas_pagination_go" type="button">Ir!</button>
			</span>
		</div>

		<input type = "hidden" id = "paginationController" value = "1">
	</div>

</div>

<!-- Modals -->
<!-- Add/Update line -->
<div class="modal fade" id = "add_linha">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Adicionar linha</h4>
			</div>
			<div class="modal-body">
				<form role="form" id = "gerLinhas_form">
					<div class="row">
						<div id = "error-message-wrapper" class="col-xs-12"> </div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="numLinha">Linha:</label>
									<input type="text" name = "numLinha" class="form-control" placeholder="Número da linha">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label for="plano">Plano</label>
									<input type="text" name = "plano" id="plano" class="form-control" placeholder="Plano">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="iccid">ICCID</label>
									<input type="text" name = "iccid" id="iccid" class="form-control" placeholder="ICCID">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="operadora">Operadora</label>
									<select name = "operadora" id = "operadora" class="form-control">
										<option value = "Vivo">Vivo</option>
										<option value = "TIM">TIM</option>
										<option value = "OI">OI</option>
										<option value = "Nextel">Nextel</option>
										<option value = "Claro">Claro</option>
									</select>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group has-feedback">
									<label for="status">Status</label>
									<select name = "status" id = "status" class="form-control">
										<option value = "Uso">Uso</option>
										<option value = "Disponivel">Disponivel</option>
										<option value = "Bloqueado">Bloqueado</option>
										<option value = "Furtado">Furtado</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12" id = "aparelhoGroup">
								<div class="form-group has-feedback">
									<label for="aparelhos">Aparelho:</label>
									<select id="aparelhos" name = "idAparelho"> </select>	
								</div>
							</div>
							<div class="col-xs-12" id = "usuarioGroup">
								<div class="form-group has-feedback">
									<label for="usuarios">Usuario:</label>
									<select id="usuarios" name = "idUsuario"> </select>	
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
			<div class="modal-footer" id = "gerLinhas_modalFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="button" id = "gerLinhas_save" name = "gerLinhas_save" class="btn btn-primary">Salvar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- See line information -->
<div class="modal fade" id = "show_linha">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Dados da linha</h4>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="row">
						<div class="form-group">
							<div class="col-xs-4">
								<label for="numLinha">Linha:</label>
								<span id = "show_numLinha"> </span>
							</div>
							<div class="col-xs-6">
								<label for="plano">Plano:</label>
								<span id = "show_plano"> </span>
							</div>
							<div class="col-xs-4">
								<label for="iccid">ICCID:</label>
								<span id = "show_iccid"> </span>
							</div>
							<div class="col-xs-4">
								<label for="operadora">Operadora:</label>
								<span id = "show_operadora"> </span>
							</div>
							<div class="col-xs-4">
								<label for="status">Status:</label>
								<span id = "show_linhaStatus"> </span>
							</div>
							<div class="col-xs-8">
								<label for="aparelho">Aparelho:</label>
								<span id = "show_aparelho"> </span>
							</div>
							<div class="col-xs-8">
								<label for="usuario">Usuário:</label>
								<span id = "show_usuario"> </span>
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
<div class="modal fade" id = "gerLinhas_import_data">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Importar dados</h4>
			</div>
			<div class="modal-body">
				<form enctype="multipart/form-data" method="post" role="form" action = "modulos/mod_telefonia/controller/ger_linhas.php?import=true">
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