
<script src="resources/ger_linhas.js"></script>
<link rel="stylesheet" href="resources/ger_linhas.css" />

<script src="table.js"></script>
<style>
.top20{
	margin-top: 20px;
}
.left20{
	margin-left: 20px;
}
.right20{
	margin-right:20px;
}
#gerLinhas_table thead th span{
	cursor:pointer;
}
</style>

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
				</select>
			</div>

			<button type="button" class="btn btn-primary pull-left">
			  <span class="glyphicon glyphicon-plus"></span> Adicionar linha
			</button>
		</div>
	</div>

	<table id = "gerLinhas_table" class="table table-striped table-hover">
		<thead> 
			<th id = "numLinha"> Numero <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
			<th id = "plano"> Plano <span class="pull-right glyphicon glyphicon-chevron-down"></span></th>
		</thead>

		<tbody>

		</tbody>

		<tfoot>
			<th> Numero </th>
			<th> Plano </th>
		</tfoot>
	</table>

	<div class="panel-body">
		<div id = "gerLinhas_tableInfos" class = "pull-left pagination text-center"> 
			<p> 
				<strong> Total de registros: </strong> <span id = "gerLinhas_tableRegTotal"> </span> 
				<strong> | Voce esta na pagina: </strong> <span id = "gerLinhas_tableRegPage"> </span>
				<strong> de: </strong> <span id = "gerLinhas_tableTotalPages"> </span>
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