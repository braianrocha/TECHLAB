<?php

require_once ('./controller/controllerusuario.php');
require_once ('./adminphp/verificausuario.php');
verificaLogin();
require_once ('./adminphp/conecta.php');


$query = "SELECT PERI.ID  AS PERIODO , PERFIL.ID AS PERFILID , USER.ID , USER.NOME , USER.EMAIL , USER.RESERVA , PERI.DESCRICAO AS DESCRIPERIODO , PERFIL.DESCRICAO AS DESCRIPERFIL FROM USUARIO USER
INNER JOIN PERIODO PERI ON PERI.ID = USER.PERIODO_ID
INNER JOIN PERFIL  ON PERFIL.ID = USER.PERFIL_ID ORDER BY USER.ID";

$resultado = mysqli_query(buscaconexao(), $query);


$queryBuscaPeriodo = "SELECT * FROM PERIODO";
$queryPeriodo = mysqli_query(buscaconexao(), $queryBuscaPeriodo);
?>




<!DOCTYPE html>
<html class="ls-pre-panel">
    <head>
        <title>Agendamento de Laboratórios</title>

        <meta charset="utf-8">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link rel="stylesheet" type="text/css" href="reset.css">
        <link rel="icon" sizes="192x192" href="/locawebstyle/assets/images/ico-painel1.png">
        <link rel="apple-touch-icon" href="/locawebstyle/assets/images/ico-painel1.png">
        <meta name="apple-mobile-web-app-title" content="Painel 1">
        <script src="locaweb/mediaqueries-ie.js" type="text/javascript"></script>
        <script src="locaweb/html5shiv.js" type="text/javascript"></script>
        <link href="http://assets.locaweb.com.br/locastyle/3.10.1/stylesheets/locastyle.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" href="css/usuarios.css">
    </head>
    <body class="documentacao documentacao_exemplos documentacao_exemplos_painel1 documentacao_exemplos_painel1_pre-painel documentacao_exemplos_painel1_pre-painel_index">

        <div class="ls-topbar ls-topbar-gray" id="barra">

            <!-- Barra inicial (Onde contém o titulo) -->
            <div class="ls-notification-topbar">
                <h1 class="titulo-principal">Agendamento de Laboratórios</h1>
            </div>
            <span class="ls-show-sidebar ls-ico-menu"></span>
        </div>
        <!--Barra Vertical de Menu (Contém a logo de usuário,logo do pitagoras e os menus para acessar)-->
        <?php require_once('./model/menu.php'); ?>

        <!-- Aqui inicia o conteúdo da pagina -->
        <main class="ls-main ">
            <div class="wrapper">
                <div class="container-fluid">

                    <!--Feito por Henrique-->
                    <?php
                    // verifica se existe alguma mensagem pra ser enviada para o usuário
                    if ((isset($_SESSION['msg']))) {
                        require_once('./mensagem.php');
                    }
                    ?>
                    <h2 class="sub-titulo">Usuários</h2>

                    <div id="botaocadastro" class="">
                        <button type="button" class="ls-btn-dark ls-ico-search" style="margin:2px;">Buscar</button>
                        <button data-ls-module="modal" data-target="#modalSmall" data-append-to="body" type="button" class="ls-btn-dark ls-ico-plus" style="margin: 2px;">Novo </button>
                        <button type="button" class="ls-btn-dark ls-ico-close" style="margin:2px;">Cancelar</button>
                    </div>

                    <br>
                    <br>

                    <!--Modal de cadastro - Novo curso-->

                    <div class="ls-modal" id="modalSmall">
                        <div class="ls-modal-small">
                            <div class="ls-modal-header">
                                <h4 id="titulomodal" class="ls-modal-title">Novo usuário</h4>
                            </div>
                            <div class="ls-modal-body">
                                <form id="formAddUser" action="/controller/adicionaUsuario.php" class="ls-form row" method="post">
                                    <fieldset>
                                        <label class="ls-label col-md-12 col-xs-12">
                                            <b class="ls-label-text">Nome*</b>
                                            <input type="text" id="inputAddNome" name="nome" placeholder="Digite seu nome" class="ls-field" required>
                                        </label>
                                        <label class="ls-label col-md-12 col-xs-12">
                                            <b class="ls-label-text">E-mail*</b>
                                            <input type="text" id="inputAddEmail" name="email" placeholder="Digite seu e-mail" class="ls-field" required>    </label>
                                    </fieldset>

                                    <fieldset>
                                        <label class="ls-label col-md-12 col-xs-12">
                                            <b class="ls-label-text">CPF*</b>
                                            <input type="text" id="inputAddCpf" name="cpf" placeholder="000.000.000-00" class="ls-field ls-mask-cpf" required>
                                        </label>

                                        <label class="ls-label col-md-12 col-xs-12">
                                            <b class="ls-label-text">Perfil</b>
                                            <div class="ls-custom-select">
                                                <select name="perfil" id="inputAddPerfil" class="ls-select">
                                                    <option>Selecione</option>
                                                    <option>Ativos</option>
                                                    <option>Desativados</option>
                                                </select>
                                            </div>
                                        </label>
                                    </fieldset>

                                    <fieldset>
                                        <label class="ls-label col-md-12">
                                            <b class="ls-label-text">Senha</b>
                                            <div class="ls-prefix-group">
                                                <input type="password" id="inputAddPassword_1" name="password" value="" >
                                                <a class="ls-label-text-prefix ls-toggle-pass ls-ico-eye" data-toggle-class="ls-ico-eye, ls-ico-eye-blocked" data-target="#password_field" href="#">
                                                </a>
                                            </div>
                                        </label>

                                        <label class="ls-label col-md-12">
                                            <b class="ls-label-text">Confirme sua senha</b>
                                            <div class="ls-prefix-group">
                                                <input type="password"  id="inputAddPassword_2" name="con_password" value="" >
                                                <a class="ls-label-text-prefix ls-toggle-pass ls-ico-eye" data-toggle-class="ls-ico-eye, ls-ico-eye-blocked" data-target="#password_field2" href="#">
                                                </a>
                                            </div>
                                        </label>
                                    </fieldset>

                                    <fieldset>
                                        <label class="ls-label col-md-12 col-xs-12">
                                            <b class="ls-label-text">Período de aula</b>
                                            <div class="ls-custom-select">
                                                <select name="turno" id="inputAddTurno" class="ls-select">
                                                    <option>Selecione</option>
                                                    <option>Manhã</option>
                                                    <option>Noite</option>
                                                </select>
                                            </div>
                                        </label>

                                        <div class="ls-label col-md-12 col-xs-12">
                                            <p class="ls-label-text">Pode reservar?</p>
                                            <div class="form-check-inline">
                                                <input class="form-check-input-inline" id="inputAddReservaTrue" type="radio" name="reservar" id="gridRadios1" value="true" checked>
                                                Sim
                                                <label class="form-check-label-inline" for="gridRadios1">
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input-inline" id="inputAddReservaFalse" type="radio" name="reservar" id="gridRadios2" value="false">
                                                Não
                                                <label class="form-check-label-inline" for="gridRadios2">
                                                </label>
                                            </div>
                                        </div>     </fieldset>

                                </form>
                            </div>
                            <div class="ls-modal-footer">
                                <button class="ls-btn ls-float-right" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="ls-btn-primary" onclick="preSubmit()">Salvar</button>
                            </div>
                        </div>
                    </div>







                    <form action="" class="ls-form ls-form-horizontal row" id="formulario-01">
                        <fieldset>
                            <label class="ls-label col-md-5 col-xs-12" id="pesquisar">
                                <b class="ls-label-text">Pesquisar:</b>
                                <input type="text" placeholder="Informe o que deseja pesquisar" class="ls-field" required>
                            </label>

                            <label class="ls-label col-md-4 col-xs-12" id="filtrar">
                                <b class="ls-label-text">Filtrar por:</b>
                                <div class="ls-custom-select">
                                    <select name="" class="ls-select">
                                        <option>Selecione o filtro</option>
                                        <option>Tipo 01</option>
                                        <option>Tipo 02</option>
                                        <option>Tipo 03</option>
                                        <option>Tipo 04</option>
                                        <option>Tipo 05</option>
                                    </select>
                                </div>
                            </label>

                        </fieldset>
                        <!--           LISTA               -->
                    </form>
                    <div class="table-responsive" >  
                    <div style="overflow: auto;height: 400px;"> 
                    <table class="ls-table ls-table-striped">
                        <thead>
                            <tr>
                                <th hidden="true"><b>ID</b></th>
                                <th><b>Nome</b></th>
                                <th><b>E-mail</b></th>
                                <th><b>Período de Aula</b></th>
                                <th><b>Perfil</b></th>
                                <th><b>Permissão</b></th>
                                <th><b>Editar</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($usuario = mysqli_fetch_assoc($resultado)) {
                                $idSelecionado = $usuario['PERIODO'];
                                $op = "";
                                while($PERIODO = mysqli_fetch_assoc($queryPeriodo)) {
                                    if ($idSelecionado == $PERIODO['ID']) {
                                        $op .= "<option selected value='" . $PERIODO['ID'] . "'>" . $PERIODO['DESCRICAO'] . "</option>";
                                    }else {
                                        $op .= "<option value='" . $PERIODO['ID'] . "'>" . $PERIODO['DESCRICAO'] . "</option>";
                                    }
                                }
                               // mysql_free_result($queryPeriodo);
                                if ($usuario['RESERVA'] == 1) {
                                    $usuario['RESERVA'] = "SIM";
                                    $reservar = "<div class='ls-label col-md-12 col-xs-12'>
                          <p class='ls-label-text'>Pode reservar?</p>
                          <label class='ls-label-text'>
                            <input type='radio' checked name='plataforms' class='ls-field-radio'>
                            Sim
                          </label>
                          <label class='ls-label-text'>
                            <input type='radio'  name='plataforms' class='ls-field-radio'>
                            Não
                          </label>
                          </div> </fieldset>";
                                } else {
                                    $usuario['RESERVA'] = "NÃO";
                                    $reservar = "<div class='ls-label col-md-12 col-xs-12'>
                          <p class='ls-label-text'>Pode reservar?</p>
                          <label class='ls-label-text'>
                            <input type='radio'  name='plataforms' class='ls-field-radio'>
                            Sim
                          </label>
                          <label class='ls-label-text'>
                            <input type='radio'  checked name='plataforms' class='ls-field-radio'>
                            Não
                          </label>
                          </div> </fieldset>";
                                }


                                echo"      <tr>
                                    <td hidden='true'>" . $usuario['ID'] . "</td>
                                    <td>" . $usuario['NOME'] . "</td>
                                    <td>" . $usuario['EMAIL'] . "</td>
                                    <td>" . $usuario['DESCRIPERIODO'] . "</td>
                                    <td>" . $usuario['DESCRIPERFIL'] . "</td>
                                    <td>" . $usuario['RESERVA'] . "</td>
                                    <td><button data-ls-module='modal' data-target='#modaledicao" . $usuario['ID'] . "' type='button' onclick='setUser()' class='ls-btn ls-ico-pencil'></button>
                                    <button data-ls-module='modal' data-target='#modalExcluir" . $usuario['ID'] . "' type='button' onclick='setUser()' class='ls-btn ls-ico-remove' ></button></td>
                                  
<!--Modal de edição/exclusão-->

      
      <div class='ls-modal' id='modaledicao" . $usuario['ID'] . "'>
        <div class='ls-modal-small'>
          <div class='ls-modal-header'>
             <h4 id='titulomodal' class='ls-modal-title'>Editar usuário</h4>
          </div>
          <div class='ls-modal-body'>
              <form id='' action='' class='ls-form row'>
                  <fieldset>
                    <label class='ls-label col-md-12 col-xs-12'>
                      <b class='ls-label-text'>Nome*</b>
                      <input type='text' name='NOME' value='" . $usuario['NOME'] . "' placeholder='Digite seu nome' class='ls-field' required>
                    </label>
                    <label class='ls-label col-md-12 col-xs-12'>
                      <b class='ls-label-text'>E-mail*</b>
                        <input type='text' name='EMAIL' value='" . $usuario['EMAIL'] . "' placeholder='Digite seu e-mail' class='ls-field' required> </label>          
                  </fieldset>
                  
                  <fieldset>

                                       
                            <label class='ls-label col-md-12 col-xs-12'>
                              <b class='ls-label-text'>Perfil</b>
                              <div class='ls-custom-select'>
                                <select name='PERFIL' class='ls-select'>
                                " . listaTipoUsuario2($usuario['PERFILID']) . "
                                </select>
                              </div>
                            </label>                
                  </fieldset>
        

        
                      <fieldset>
                         <label class='ls-label col-md-12 col-xs-12'>
                             <b class='ls-label-text'>Período de aula</b>
                             <div class='ls-custom-select'>
                               <select name='PERIODO' class='ls-select'>
                                " . $op . "
                               </select>
                             </div>
                           </label>               
                        " . $reservar . "              
                               
              </form>
          </div>
          <div class='ls-modal-footer'>
            <div id='botoes-edicao'>
              <button type='submit' class='ls-btn-primary'>Salvar</button>
              <button class='ls-btn-primary'>Excluir</button>
              <button class='ls-btn-primary' data-dismiss='modal'>Cancelar</button>             
            </div>
          </div>
        </div>
      </div>
      



</tr>
                                  ";
                            }
                            //  listaModal($usuario);
                            ?>
                        </tbody>
                    </table>
                    </form>
                    </div>
              </div>
                </div>

            </div>


            <!--Essa parte é do footer, onde contém por quem é desenvolvido, a logo e o email-->
            <footer class="ls-footer" role="contentinfo">
                <nav class="ls-footer-menu">
                    <h2 class="ls-title-footer">Desenvolvido por TechLab - Unidade Raja Gabáglia <br>
                        <img src="img/logo-techlab.png" class="logo-techlab"></h2>
                    <h2 class="ls-title-footer"> E-mail: techlab@pitagorasraja.net.br</h2>
                </nav>
            </footer>
        </main>

        <script src="javascript/cadastro-usuario.js" type="text/javascript"></script>


        <!--Esses scripts são do locaweb NAO APAGUE-->
        <script src="javascript/modal.js"></script>
        <script src="locaweb/jquery.js" type="text/javascript"></script>
        <script src="locaweb/example.js" type="text/javascript"></script>
        <script src="locaweb/localstyle.js" type="text/javascript"></script>
        <script src="locaweb/highcharts.js" type="text/javascript"></script>
        <script src="locaweb/panel-charts.js" type="text/javascript"></script>

        <script type="text/javascript">
                                    $(window).on('load', function () {
                                        locastyle.browserUnsupportedBar.init();
                                    });
        </script>

    </body>
</html>
