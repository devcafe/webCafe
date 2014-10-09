<div class = "table-responsive col-md-6">
	<table class = "procedimentos table table-striped table-bordered">
		<tr>
			<th class="text-center"> Biblioteca </th>
		</tr>
		<?php
			include("actions/security.php"); 

			//Verifica a plataforma e cria a pasta no servidor
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				$path = 'resources\documentos\\';		
				$bar = "\\";
			} else {
				$path = '/var/www/html/webCafe/resources/documentos/';
				$bar = "/";
			}
			
			$url = 'http://'. $_SERVER['SERVER_NAME'] .'/webCafe/resources/documentos/';

			$ignoreList = array('cgi-bin', '.', '..', '._');

			$lista = '';

			//Diretório de TI
			$ti = $path.'TI'.$bar;
			$financeiro = $path.'Financeiro'.$bar;						

			$lista .= "<tr class = 'dirPdf' >";
				$lista .= "<td > TI </td>";
			 	//Exibe procedimentos TI
		        if(is_dir($ti)){					        	
		            //Se for um diretório, abre o mesmo
		            if ($dh = opendir($ti)) {
	                    //Percorre arquivos e pastas do diretório
		                while (($file = readdir($dh)) !== false) {					                	
	                		if(substr($file, -3) == 'pdf' && $file != $ignoreList[1] && $file != $ignoreList[2]){
			                 	$lista .= '<tr>';					
			                        $lista .= '<td class = "filePdf"><a href = "'. $url .'TI/'. str_replace(' ', '%20', $file) .'">'. $file .'</a></td>' ;						                        
		                        $lista .= '</tr>';
	                		}
	                    }
	                }
	            } 
	        $lista .= "</tr>";

	        $lista .= "<tr class = 'dirPdf' >";
				$lista .= "<td > Financeiro </td>";
	            if(is_dir($financeiro)){
	            	//Se for um diretório, abre o mesmo
		            if ($dh = opendir($financeiro)) {
	                    //Percorre arquivos e pastas do diretório
		                while (($file = readdir($dh)) !== false) {					                	
	                		if(substr($file, -3) == 'pdf' && $file != $ignoreList[1] && $file != $ignoreList[2]){
			                 	$lista .= '<tr>';					
			                        $lista .= '<td class = "filePdf"><a href = "'. $url .'Financeiro/'. str_replace(' ', '%20', $file) .'">'. $file .'</a></td>' ;						                        
		                        $lista .= '</tr>';
	                		}
	                    }
	                }
	            }
	        $lista .= "</tr>";

	        echo $lista;
		?>
	</table>
</div>