<!-- <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 -->

<script src="modulos/mod_telefonia/view/resources/js/ger_aparelhos.js"></script>
<link rel="stylesheet" href="modulos/mod_telefonia/view/resources/css/ger_aparelhos.css" />

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
				</select>
			</div>

			<button type="button" class="btn btn-primary pull-left">
			  <span class="glyphicon glyphicon-plus"></span> Adicionar linha
			</button>
		</div>
	</div>

	<table id = "gerAparelhos_table" class="table table-striped table-hover">
		<thead> 
			<th id = "marcaAparelho"> Marca <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
			<th id = "modeloAparelho"> Modelo <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
			<th id = "imeiAparelho"> IMEI <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
			<th id = "tipo"> Tipo <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
			<th id = "statusAparelho"> Status <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
			<th id = "acessorios"> Acessorios <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
			<th id = "observacoes"> Observações <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
		</thead>

		<tbody>

		</tbody>

		<tfoot>			
			<th> Marca </th>
			<th> Modelo </th>
			<th> IMEI </th>
			<th> Tipo </th>
			<th> Status </th>
			<th> Acessorios </th>
			<th> Observações </th>

		</tfoot>
	</table>

	<div class="panel-body">
		<div id = "gerAparelhos_tableInfos" class = "pull-left pagination text-center"> 
			<p> 
				<strong> Total de registros: </strong> <span id = "gerAparelhos_tableRegTotal"> </span> 
				<strong> | Voce esta na pagina: </strong> <span id = "gerAparelhos_tableRegPage"> </span>
				<strong> de: </strong> <span id = "gerAparelhos_tableTotalPages"> </span>
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