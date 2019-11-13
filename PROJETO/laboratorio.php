<?php
// Adiciona o arquivo de conexão
require_once ('./adminphp/conecta.php');

// Adiciona o arquivo de controle que ajudará a listar os dados
require_once ('./controller/controllerlaboratorio.php');
require_once ('./adminphp/verificausuario.php');
verificaLogin();
verificaNivel();
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
        <link rel="stylesheet" type="text/css" href="css/laboratorio.css">
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
            <div class="container-fluid"> 
                <!--Feito por Tainá :D-->
                <h2 class="sub-titulo">Laboratório</h2> 
                <button type="button" class="ls-btn-dark ls-ico-close" id="botoes">Cancelar</button>
                <!-- MODAL DE CADASTRAR LABORATÓRIO-->
                <button data-ls-module="modal" data-target="#modalLarge"
                        class="ls-btn-dark ls-ico-plus" id="botao-modal botoes" data-append-to="body" >Novo</button>
            

                <div class="ls-modal"  id="modalLarge">
                    <div class="ls-modal-large">
                        <div class="ls-modal-header">
                            <button data-dismiss="modal">&times;</button>
                            <h4 class="ls-modal-title">Cadastrar Laboratório</h4>
                        </div>
                        <div class="ls-modal-body" id="myModalBody">
                            <form action="controller/adicionaLaboratorio.php" method="post"class="ls-form ls-form-horizontal row" id="formulario-02">
                                <fieldset>
                                    <label class="ls-label col-md-5 col-xs-12" id="nome-laboratorio">
                                        <b class="ls-label-text">Laboratório</b>
                                        <input name="DESC" type="text" placeholder="Informe o nome do Laboratório" class="ls-field" required>
                                    </label>

                                    <label class="ls-label col-md-4 col-xs-12" id="tipo">
                                        <b class="ls-label-text">Tipo:</b>
                                        <div class="ls-custom-select">
                                            <select name="addTipoLab" class="ls-select">
                                                <?php listaTipoLaboratorio(); ?>
                                            </select>
                                        </div>
                                    </label>

                                </fieldset>
                            <fieldset>
                           
                                <label class="ls-label col-md-5 col-xs-12" id="ANDAR">
                                    <b class="ls-label-text">Andar</b>
                                    <input name="ANDAR" type="text" placeholder="Informe o andar do Laboratório" class="ls-field" required>
                                </label>
                                <label class="ls-label col-md-5 col-xs-12" id="SALA">
                                    <b class="ls-label-text">Sala</b>
                                    <input name="SALA" type="text" placeholder="Informe o andar do Laboratório" class="ls-field" required>
                                </label>
                            </fieldset>
                               <fieldset> 
                                    <label class="ls-label col-md-5 col-xs-12" id="tipo-insumo">
                                        <b class="ls-label-text">Tipo de Insumo</b>
                                        <div class="ls-custom-select">
                                            <select name="addTipoInsumo" class="ls-select">
                                                <?php listaTipoInsumo() ?>
                                            </select>
                                        </div>
                                    </label>
                               
                               
                                <label class="ls-label col-md-5 col-xs-12" id="insumo">
                                    <b class="ls-label-text">Insumo:</b>
                                    <div class="ls-custom-select">
                                        <select name="addListaInsumo" class="ls-select">
                                            <?php listaInsumo() ?>
                                        </select>
                                    </div>
                                </label>
                               </fieldset>
                                <!--
                                <label class="ls-label col-md-5 col-xs-12" id="QUANTIDADE">
                                        <b class="ls-label-text">Quantidade</b>
                                        <input name="QUANTIDADE" type="text" placeholder="Informe o andar do Laboratório" class="ls-field" required>
                                </label>

                            <div class="ls-label col-md-4 col-xs-12">
                                <p class="ls-label-text" style="padding-top: 25px;">Possui restrição?</p>
                                <label class="ls-label-text">
                                    <input type="radio" name="plataforms" class="ls-field-radio">
                                    Sim
                                </label>
                                <label class="ls-label-text">
                                    <input type="radio" name="plataforms" class="ls-field-radio">
                                    Não
                                </label>
                            </div> 
                            !-->
                            <!--

                            <table class="ls-table .ls-table-striped.">
                                <thead>
                                    <tr>
                                        <th>Tipo de Insumo</th>
                                        <th>Insumo</th>
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="" title="" class="ls-ico-screen">Computador</a></td>
                                        <td>Acer i7, 16GB de Ram, 2TB</td>
                                        <td>35</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        !-->
                        
                        
                            <button class="ls-btn ls-float-right" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="ls-btn-danger" data-save="Salvar">Salvar</button>
                        </div>
                    </div>
                </div><!-- /.modal -->
                <button type="button" class="ls-btn-dark ls-ico-search" id="botoes">Buscar</button>
            </form>
          




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
                </form>
                <div class="tamanhoLista">
                    <table id="listaLaboratorio" class="ls-table ls-table-striped">
                        <thead>
                            <tr>
                            <th>Tipo</th>
                            <th>Laboratório</th>
                            <th>Sala</th>
                            <th>Andar</th>
                            <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php listaLaboratorio(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--

                <table class="ls-table ls-table-striped">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Laboratório</th>
                            <th>Sala</th>
                            <th>Andar</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                        
                       
                    </tbody>
                </table>
                !-->

            </div>

            <!--Essa parte é do footer, onde contém por quem é desenvolvido, a logo e o email-->
            <?php require_once ('model/footer.php'); ?>
        </main>

        <!--Esses scripts são do locaweb NAO APAGUE-->
        <script defer>
            $("#listaLaboratorio").fixedHeader(300);
        </script>
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

