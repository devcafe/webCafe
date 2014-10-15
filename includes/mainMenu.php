
<link rel="stylesheet" href="resources/css/mainMenu.css">
<script src="resources/js/mainMenu.js"></script>

<div id='mainMenu'>
   <ul>
      <li><a href='?page=home'>Home</a></li>
      <li class='has-sub'><a href='#'>Telefonia</a>
         <ul>
            <li><a href='?mod=mod_telefonia&page=ger_linhas' id = "ger_linhas">Gerenciar linhas</a>  </li>
            <li><a href='?mod=mod_telefonia&page=ger_aparelhos' id = "ger_aparelhos">Gerenciar aparelhos</a> </li>
            <li><a href='?mod=mod_telefonia&page=ger_usuarios' id = "ger_usuarios">Gerenciar usuarios</a> </li>
            <li><a href='?mod=mod_telefonia&page=ger_acoes' id = "ger_acoes">Gerenciar ações</a> </li>
         </ul>
      </li>
      <li class='has-sub'><a href='#'>Operacional</a>
         <ul>            
            <li><a href='?mod=mod_operacional&page=ger_lojas' id = "ger_lojas">Gerenciar Lojas</a>  </li>           
         </ul>
      </li>
      <li class='has-sub'><a href='#'>Gerencial</a>
         <ul>            
            <li><a href='?mod=mod_gerencial&page=ger_sysUsuarios' id = "ger_sysUsuarios">Gerenciar usuários</a>  </li>           
         </ul>
      </li>
   </ul>

   <div class = "logout"> <a href = "actions/logout.php"> <img src = "resources/img/logout.png" title = "logout"> </a> </div>
</div>

