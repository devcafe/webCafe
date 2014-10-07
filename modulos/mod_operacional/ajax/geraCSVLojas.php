<?php
	include("../../../conf/conn.php");
	include("../../../actions/security.php");


	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// output the column headings
	fputcsv($output, array('CodigoPDV', 'NomePDV'), ';', " ");

	$rows = $pdo->prepare('Select * From ipsum_operacionallojas');
	$rows->execute();

	// loop over the rows, outputting them
	while ($row = $rows->fetch(PDO::FETCH_OBJ)) {
		fputcsv($output, array($row->idLoja, $row->nome . ' ' . $row->rua), ';', " ");
	}
?>