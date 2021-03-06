<script src = "resources/js/home.js" type = "text/javascript"> </script>
<link href = "resources/css/home.css" type = "text/css" rel = "stylesheet">
<script src="http://malsup.github.com/jquery.form.js"></script>

<h3> Biblioteca Café</h3>

<div id = "tableWrapper_doc">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="input-group pull-right col-md-4">
				<div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
				<input class="form-control" type="text" id = "doc_pagination_search" placeholder="Procurar...">
			</div>
			<div class="input-group col-md-2 pull-left">
				<select id = "doc_regs" class="form-control">
				  <option selected>5</option>
				  <option>10</option>
				  <option>20</option>
				  <option>50</option>
				</select>
			</div>
			
			<button type="button" id = "doc_addAcaoBtn" class="btn btn-primary pull-left marginLeft20" data-toggle="modal" data-target="#add_doc">
			  <span class="glyphicon glyphicon-plus"></span> Adicionar documento
			</button>
		
		</div>
	</div>

	<table id = "doc_table" class="table table-striped table-hover">
		<thead > 
			<th class = "width50"></th>
			<th id = "a.departamento"> Departamento <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
			<th id = "assunto"> Assunto <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
			<th id = "documento"> Documento <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
			<th id = "responsavel"> Responsável <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
			<!-- <th class = "width100"></th> -->
		</thead>

		<tbody>

		</tbody>

		<tfoot>
			<th class = "width50"></th>
			<th> Departamento </th>
			<th> Assunto </th>
			<th> Documento </th>
			<th> Responsável </th>
			<!-- <th class = "width100"></th> -->
		</tfoot>
	</table>

	<div class="panel-body">
		<div id = "doc_tableInfos" class = "pull-left pagination text-center"> 
			<p> 
				<strong> Total de registros: </strong> <span id = "doc_tableRegTotal"> </span> 
				<strong> | Você esta na pagina: </strong> <span id = "doc_tableRegPage"> </span>
				<strong> de: </strong> <span id = "doc_tableTotalPages"> </span>
			</p>
		</div>

		<ul class="pagination pull-right" id = "doc_pagination">
		  
		</ul>

		<!-- <button type="button" class="btn btn-primary pull-right top20 right20"> Ir</button> -->
		<div class="input-group col-md-1 pull-right top20 right20">
			<input type="text" id = "doc_pagination_goPage" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-default" id = "doc_pagination_go" type="button">Ir!</button>
			</span>
		</div>

		<input type = "hidden" id = "paginationController" value = "1">
	</div>

	<!-- See line information -->
<div class="modal fade" id = "show_doc">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title" id = "docTitle"></h4>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="row">
						<div class="form-group">
							<div class="col-xs-6" id = "docViewer">
								
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

<!-- Add/Update line -->
<div class="modal fade" id = "add_doc">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
				<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
				</button>
				<h4 class="modal-title">Adicionar documento</h4>
			</div>
			<form action="#" method="post" id="docForm" name="docForm">
			<div class="modal-body">
				
					<div class="row">
						<div class="form-group">
							<div class="col-xs-12">
								<div class="form-group has-feedback">
									<label for="AddDepartamento">Departamento:</label>
									<input type="text" name = "AddDepartamento" class="required form-control" placeholder="Nome do departamento" data-validation="required" data-validation-error-msg="Campo obrigatório">
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group has-feedback">
									<label for="addAssunto">Assunto</label>
									<input type="text" name = "addAssunto" id="addAssunto" class="required form-control" placeholder="Assunto" data-validation="required" data-validation-error-msg="Campo obrigatório">
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group has-feedback">
									<label for="addDocumento">Documento</label>
									<input type="text" name = "addDocumento" id="addDocumento" class="required form-control" placeholder="Nome do Documento" data-validation="required" data-validation-error-msg="Campo obrigatório">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<input type="file" id="arquivo" name="arquivo" class="pdf " />																									
								</div>
								<progress value="0" max="100" class=""></progress><span id="porcentagem"> 0%</span>	
								<div id="notaUpload"></div>
							</div>
						</div>
					</div>					
			</div>
			<div class="modal-footer" id = "doc_modalFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="button" id = "uploadDoc" name = "uploadDoc" class="btn btn-primary">Enviar</button>
			</div>
			</form>	
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

