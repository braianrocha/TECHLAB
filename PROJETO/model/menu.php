<?php
// Adiciona o arquivo de verificação
require_once('./adminphp/verificausuario.php'); 


verificaLogin();
function perfilMenu(){
    $queryMenu = "SELECT PERFIL_ID FROM USUARIO WHERE ID =".$_SESSION['ID'];
    $resultadoMenu = mysqli_query(buscaconexao(),$queryMenu);
    $resultadoMenu = mysqli_fetch_assoc($resultadoMenu);
    return $resultadoMenu['PERFIL_ID'];
}


// CONFIGURAÇÃO DO MENU PARA QUE APAREÇA SOMENTE AS OPÇÕES QUE O USUÁRIO TEM ACESSO.
// TROCA PARA O PERFIL ADMINNISTRADOR !!!!!!!!!!!!!
if(perfilMenu() == 1){
// Caso seja um administrador imprimi o menu do administrador
  echo '<aside class="ls-sidebar">
            <div class="ls-sidebar-inner" id="menu">
              <img src="img/logo-pitagoras.png" class="logo-pitagoras">
              <h1 class="ls-brand-name"  id="menu">
              <img src="img/logo-usuario.png" class="logo-usuario"><br><a href="">'.nomeUsuarioLogado().'</a></h1>
              <nav class="ls-menu" style="overflow-y:hidden; height: 400px;">
                <ul style="overflow: hidden">
                      <li class="altmenu"><a href="inicial-adm.php" class="ls-ico-home linkmenu">Home</a></li>
                      <li class="altmenu"><a href="minha-conta.php" class=" ls-ico-user linkmenu">Minha Conta</a></li>
                      <li class="altmenu"><a href="agendamentos-adm.php" class="linkmenu ls-ico-edit-admin" >Agendamentos</a></li>      
                      <li class="altmenu"><a href="cursos.php" class="linkmenu ls-ico-pencil" role="menuitem">Cursos</a></li>
                      <li class="altmenu"><a href="usuarios.php" class="ls-ico-user-add" role="menuitem">Usuários</a></li>
                      <li class="altmenu"><a href="insumos.php" class="linkmenu ls-ico-info" role="menuitem">Insumos</a></li>
                      <li class="altmenu"><a href="laboratorio.php" class=" linkmenu ls-ico-screen" role="menuitem">Laboratórios</a></li>
                      <li class="altmenu"><a href="parametros-gerais.php" class="linkmenu ls-ico-cog" role="menuitem">Parâmetros Gerais</a></li>
                      <li class="altmenu"><a href="controller/logout.php" class="linkmenu ui-icon-power" role="menuitem">Sair</a></li> 
                </ul>
              </nav>
             </div>
         </aside>';
}else{
    // Caso seja um usuário normal imprimi o menu do usuário normal
  echo '<aside class="ls-sidebar">
          <div class="ls-sidebar-inner" id="menu">
              <img src="img/logo-pitagoras.png" class="logo-pitagoras">
              <h1 class="ls-brand-name"  id="menu">
              <img src="img/logo-usuario.png" class="logo-usuario"><br><a href="#">'.nomeUsuarioLogado().'</a></h1>
              <nav class="ls-menu" style="overflow-y:hidden; height: 400px;">
                  <ul>
                      <li class="altmenu"><a href="inicial.php" class="ls-ico-home linkmenu">Home</a></li>
                      <li class="altmenu"><a href="agendar-data.php" class=" ls-ico-plus linkmenu">Agendar por data </a></li>
                      <li class="altmenu"><a href="minha-conta.php" class=" ls-ico-user linkmenu">Minha Conta</a></li>
                      <li class="altmenu"><a href="agendamentos.php" class="linkmenu ls-ico-edit-admin" >Agendamentos</a></li>      
                        <li class="altmenu"><a href="laboratorio.php" class=" linkmenu ls-ico-screen" role="menuitem">Laboratórios</a></li>
                      <li class="altmenu"><a href="controller/logout.php" class="linkmenu ui-icon-power" role="menuitem">Sair</a></li> 
                  </ul>
              </nav>
          </div>
        </aside>';
}
  ?>

