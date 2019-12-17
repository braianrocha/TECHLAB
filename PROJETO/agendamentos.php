<?php
require_once('./adminphp/conecta.php');
require_once('./adminphp/verificausuario.php');
$query = "SELECT AGENDA.ID AS ID ,AGENDA.DATA_AG,PERI.DESCRICAO AS PERIODODESCRI,SOLICITACAO.DESCRICAO AS SOLICITACAODESCRI, TIPOLAB.DESCRICAO AS TIPOLABDESCRI,LAB.DESCRICAO AS LABDESCRI,LAB.SALA AS LABSALA,LAB.ANDAR AS LABANDAR , TIPOLAB.ID AS IDTIPOLAB
FROM AGENDAMENTO AGENDA
INNER JOIN PERIODO PERI ON PERI.ID = AGENDA.PERIODO_ID
INNER JOIN SIT_SOLICITACAO SOLICITACAO ON SOLICITACAO.ID = AGENDA.SITUACAO_SOLIC_ID
INNER JOIN LABORATORIO LAB ON LAB.ID = AGENDA.LABORATORIO_ID
INNER JOIN TIPO_LABORATORIO TIPOLAB ON LAB.TIPO_LAB_ID = TIPOLAB.ID 
WHERE AGENDA.USUARIO_ID = " . idUsuarioLogado() . " AND AGENDA.DATA_AG < NOW()
ORDER BY AGENDA.DATA_AG LIMIT 40;";
// LIMITANDO A 40 linhas exibidas no historico
$resultado = mysqli_query($conexao, $query);
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
        <link rel="icon" sizes="192x192" href="locawebstyle/assets/images/ico-painel1.png">
        <link rel="apple-touch-icon" href="locawebstyle/assets/images/ico-painel1.png">
        <meta name="apple-mobile-web-app-title" content="Painel 1">
        <script src="locaweb/mediaqueries-ie.js" type="text/javascript"></script>
        <script src="locaweb/html5shiv.js" type="text/javascript"></script>
        <link href="http://assets.locaweb.com.br/locastyle/3.10.1/stylesheets/locastyle.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" href="css/agendamentos.css">
    </head>
    <body class="documentacao documentacao_exemplos documentacao_exemplos_painel1 documentacao_exemplos_painel1_pre-painel documentacao_exemplos_painel1_pre-painel_index">

        <div class="ls-topbar ls-topbar-gray" id="barra">

            <!-- Barra inicial (Onde contém o titulo) -->
            <div class="ls-notification-topbar">
                <h1 class="titulo-principal" >Agendamentos de Laboratórios</h1>
            </div>
            <span class="ls-show-sidebar ls-ico-menu"></span>
        </div>
        <!--Barra Vertical de Menu (Contém a logo de usuário,logo do pitagoras e os menus para acessar)-->
<?php require_once('./model/menu.php'); ?>


        <!-- Aqui inicia o conteúdo da pagina -->
        <main class="ls-main ">
            <div class="container-fluid"> 

                <h2 class="sub-titulo hist">Histórico dos Agendamentos</h2>



                <form action="" class="ls-form ls-form-horizontal row" id="formulario-01">

                    <fieldset>
                        <label class="ls-label col-md-5 col-xs-12" id="pesquisar">
                            <b class="ls-label-text">Pesquisar:</b>
                            <input type="text" name="search" id="search" placeholder="Informe o que deseja pesquisar" class="ls-field" required>
                        </label>


<!--                        <label class="ls-label col-md-4 col-xs-12" id="filtrar">
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
                        </label>-->

                        <fieldset>
                 
                        </fieldset>  

                    </fieldset>
                </form>
                <table class="ls-table ls-table-striped">
                    <thead>
                        <tr>
                            <th style="display: none" >ID</th>
                            <th>Data</th>
                            <th>Situação</th>
                            <th>Período</th>
                            <th>Tipo</th>
                            <th>Laboratório</th>
                            <th>Sala</th>
                            <th>Andar</th>
                           
                        </tr>
                    </thead>
                    <tbody id="agendam">
                        <?php
                            while($meusAgendamentos = mysqli_fetch_assoc($resultado)){
                               //CONVERTENDO A DATA PARA  DIA/MES/ANO
                                $meusAgendamentos['DATA_AG'] = date("d/m/Y", strtotime($meusAgendamentos['DATA_AG']));
                                switch($meusAgendamentos['IDTIPOLAB']){
                                    case 1 : $icone = "ls-ico-screen";
                                        break;
                                    case 2 : $icone = "ls-ico-edit-admin";
                                        break;
                                    case 3 : $icone = "ls-ico-cog";
                                        break;
                                    default: $icone = "ls-ico-screen";
                                        break;
                                }
                                
                                
                                    echo"
                                        <tr>
                                            <td style='display: none' > ".$meusAgendamentos['ID']." </td>
                                            <td>".$meusAgendamentos['DATA_AG']."</td>
                                            <td>".$meusAgendamentos['SOLICITACAODESCRI']."</td>
                                            <td>".$meusAgendamentos['PERIODODESCRI']."</td>
                                            <td class='$icone'><a href='' title=''>".$meusAgendamentos['TIPOLABDESCRI']."</a></td>
                                            <td>".$meusAgendamentos['LABDESCRI']."</td>
                                            <td>".$meusAgendamentos['LABSALA']."</td>
                                            <td>".$meusAgendamentos['LABANDAR']."</td>
                                            

                        ";      
                              }
            ?>

                    </tbody>
                </table>
            </div>

            <!--Essa parte é do footer, onde contém por quem é desenvolvido, a logo e o email-->
<?php require_once('model\footer.php'); ?>
        </main>

        <!--Esses scripts são do locaweb NAO APAGUE-->
        <script src="locaweb/jquery.js" type="text/javascript"></script>
        <script src="locaweb/example.js" type="text/javascript"></script>
        <script src="locaweb/localstyle.js" type="text/javascript"></script>
        <script src="locaweb/highcharts.js" type="text/javascript"></script>
        <script src="locaweb/panel-charts.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(window).on('load', function () {
                locastyle.browserUnsupportedBar.init();
            });
            
            
                                                $(document).ready(function () {
                $("#search").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#agendam tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>

    </body>
</html>
