<?php
// Adiciona o arquivo de conexão
// Adiciona o arquivo de controle que ajudará a listar os dados
require_once ('./controller/controllerlaboratorio.php');
require_once ('./adminphp/verificausuario.php');
verificaLogin();
require_once ('./adminphp/conecta.php');
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

        <link href="css/multi-select.css" media="screen" rel="stylesheet" type="text/css">

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
                        <?php
            // verifica se existe alguma mensagem pra ser enviada para o usuário
            if ((isset($_SESSION['msg']))) {
                require_once('./mensagem.php');
            }
            ?>
            <div class="container-fluid"> 
                <!--Feito por Tainá :D-->
                <h2 class="sub-titulo">Laboratório</h2> 
                
                <!-- MODAL DE CADASTRAR LABORATÓRIO-->
                <fieldset style="float: right"> 
                <button data-ls-module="modal" data-target="#modalLarge"
                        class="ls-btn-dark ls-ico-plus" id="botao-modal botoes" data-append-to="body" >Novo</button>
               </fieldset>
             <form action="laboratorio.php" method="GET" class="ls-form ls-form-horizontal row" id="formulario-01">
                    <fieldset> 
                        <label class="ls-label col-md-5 col-xs-12" id="pesquisar">
                            <b class="ls-label-text">Pesquisar:</b>
                            <input type="text" name="search" id="search" placeholder="Informe o que deseja pesquisar" class="ls-field" >
                        </label>

                        <label class="ls-label col-md-4 col-xs-12" id="filtrar">

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
                                <?php
                                if ($_SESSION['PERFIL'] == 1) {
                                    $_SESSION['PERFIL'] = 1;
                                    echo "<th>Editar</th>";
                                } else {
                                    $_SESSION['PERFIL'] = 0;
                                    echo "<th>Visualizar</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                                                    <?php /*/* if(isset($_GET['insumo'])){
                            listaLaboratorioGET($_GET['insumo']);
                        }else{*/
                            listaLaboratorio();
                        //} ?>
                                               
                        </tbody>
                    </table>
                </div>
                
                <div class="ls-modal"  id="modalLarge">
                    <div class="ls-modal-large">
                        <div class="ls-modal-header">
                            <button data-dismiss="modal">&times;</button>
                            <h4 class="ls-modal-title">Cadastrar Laboratório</h4>
                        </div>
                        <div class="ls-modal-body" id="myModalBody">
                            <form action="controller/adicionaLab.php" method="post"class="ls-form ls-form-horizontal row" id="formulario-02">
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



                                        <select name="addListaInsumo[]" multiple="multiple" id="my-select" >                                               
<?php listaInsumo() ?>
                                        </select>
                                    </label>
                                </fieldset>


                                <button class="ls-btn ls-float-right" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="ls-btn-danger" data-save="Salvar">Salvar</button>
                        </div>
                    </div>
                </div><!-- /.modal -->

                </form>





   
            </div>


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

    <script src="js/jquery.multi-select.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(window).on('load', function () {
            locastyle.browserUnsupportedBar.init();
        });
        $('#my-select').multiSelect({

            selectableFooter: "<div class='custom-header'><span class='ls-ico-checkbox-unchecked' > Opções   </div>",
            selectionFooter: "<div class='custom-header'><span class='ls-ico-checkbox-checked' > Selecionados</div>"
        });

                                                $(document).ready(function () {
                $("#search").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#tbody tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
    </script>

</body>
</html>

