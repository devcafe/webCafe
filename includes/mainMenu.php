
<link rel="stylesheet" href="resources/css/mainMenu.css">
<script src="resources/js/mainMenu.js"></script>

<div id='mainMenu'>
   <ul>
      <li><a href='?page=home'>Home</a></li>
      <li class='has-sub'><a href='#'>Telefonia</a>
         <ul>
            <li><a href='#' id = "ger_linhas">Gerenciar linhas</a>  </li>
            <li><a href='#' id = "ger_aparelhos">Gerenciar aparelhos</a> </li>
         </ul>
      </li>
       <li class='has-sub'><a href='#'>Operacional</a>
         <ul>
            <li><a href='#' id = "cadLoja" class = "mod_operacional">Cadastrar Loja</a>  </li>
            <li><a href='#' id = "gerAcoes" class = "mod_operacional">Gerenciar Ações</a> </li>
            <li><a href='#' id = "gerLojas" class = "mod_operacional">Gerenciar Lojas</a>  </li>
            <li><a href='#' id = "gerRoteiro" class = "mod_operacional">Gerenciar Roteiro</a> </li>            
            <li><a href='#' id = "listLojas" class = "mod_operacional">Listar Loja</a> </li>
         </ul>
      </li>
   </ul>

   <div class = "logout"> <a href = "actions/logout.php"> <img src = "resources/img/logout.png" title = "logout"> </a> </div>
</div>

