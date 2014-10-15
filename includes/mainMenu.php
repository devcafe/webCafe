<?php 
   require_once("actions/accessController.php"); 
   require_once("actions/security.php"); 
?>

<link rel="stylesheet" href="resources/css/mainMenu.css">
<script src="resources/js/mainMenu.js"></script>

<div id='mainMenu'>
   <ul>
      <li><a href='?page=home'>Home</a></li>

      <!-- Modulo telefonia -->
      <?php if(accessModulos(1)){ ?>
      <li class='has-sub'><a href='#'>Telefonia</a>
         <ul>
            <?php if(accessPages(1)){ echo '<li><a href="?mod=mod_telefonia&page=ger_linhas" id = "ger_linhas">Gerenciar linhas</a>  </li>'; } ?>
            <?php if(accessPages(2)){ echo '<li><a href="?mod=mod_telefonia&page=ger_aparelhos" id = "ger_aparelhos">Gerenciar aparelhos</a> </li>'; } ?>
            <?php if(accessPages(3)){ echo '<li><a href="?mod=mod_telefonia&page=ger_usuarios" id = "ger_usuarios">Gerenciar usuarios</a> </li>'; } ?>
            <?php if(accessPages(4)){ echo '<li><a href="?mod=mod_telefonia&page=ger_acoes" id = "ger_acoes">Gerenciar ações</a> </li>'; } ?>
         </ul>
      </li>
      <?php } ?>

      <!-- Modulo Operacional -->
      <?php if(accessModulos(2)){ ?>
      <li class='has-sub'><a href='#'>Operacional</a>
         <ul>            
            <?php if(accessPages(5)){ echo '<li><a href="?mod=mod_operacional&page=ger_lojas" id = "ger_lojas">Gerenciar Lojas</a>  </li>'; } ?>           
         </ul>
      </li>
      <?php } ?>

      <!-- Modulo Gerencial -->
      <?php if(accessModulos(3)){ ?>
      <li class='has-sub'><a href='#'>Gerencial</a>
         <ul>            
             <?php if(accessPages(6)){ echo '<li><a href="?mod=mod_gerencial&page=ger_sysUsuarios" id = "ger_sysUsuarios">Gerenciar usuários</a>  </li>'; } ?>                      
         </ul>
      </li>
   </ul>
   <?php } ?>

   <div class = "logout"> <a href = "actions/logout.php"> <img src = "resources/img/logout.png" title = "logout"> </a> </div>
</div>

