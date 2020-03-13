<?php
require_once('./adminphp/conecta.php');
require_once('./adminphp/verificausuario.php');
$query = "SELECT  AGENDA.INFO_ADC AS INFO_ADC , AGENDA.ID AS ID ,AGENDA.DATA_AG,PERI.DESCRICAO AS PERIODODESCRI, AGENDA.SITUACAO_SOLIC_ID AS SOLIC ,SOLICITACAO.DESCRICAO AS SOLICITACAODESCRI, TIPOLAB.DESCRICAO AS TIPOLABDESCRI,LAB.DESCRICAO AS LABDESCRI,LAB.SALA AS LABSALA,LAB.ANDAR AS LABANDAR , TIPOLAB.ID AS IDTIPOLAB
FROM AGENDAMENTO AGENDA
INNER JOIN PERIODO PERI ON PERI.ID = AGENDA.PERIODO_ID
INNER JOIN SIT_SOLICITACAO SOLICITACAO ON SOLICITACAO.ID = AGENDA.SITUACAO_SOLIC_ID
INNER JOIN LABORATORIO LAB ON LAB.ID = AGENDA.LABORATORIO_ID
INNER JOIN TIPO_LABORATORIO TIPOLAB ON LAB.TIPO_LAB_ID = TIPOLAB.ID 
WHERE AGENDA.USUARIO_ID = " . idUsuarioLogado() . " AND AGENDA.DATA_AG > NOW()
ORDER BY AGENDA.DATA_AG;";

$resultado = mysqli_query($conexao, $query);

$queryReserva = "SELECT RESERVA FROM USUARIO WHERE ID = " . idUsuarioLogado();

$reserva = mysqli_query($conexao, $queryReserva);
$reserva = mysqli_fetch_array($reserva);

//$reserva = mysqli_fetch_assoc($reserva);
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
        <link rel="stylesheet" type="text/css" href="css/inicial.css">
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
                <?php
                // verifica se existe alguma mensagem pra ser enviada para o usuário
                if ((isset($_SESSION['msg']))) {
                    require_once('./mensagem.php');
                }
                ?>
                <!--Feito por Tainá :D-->

                <h2 class="sub-titulo">Olá, <?php echo $_SESSION['NOME'] ?></h2> 

                <!-- MODAL DE AGENDAR LABORATÓRIO-->
                <?php
                if ($reserva['RESERVA'] == 1) {
                    echo "<button  data-ls-module='modal' data-target='#myAwesomeModal' class='ls-btn-primary' id='botao-modal'>Agendar Laboratório</button>";
                } else {
                    echo "<button disabled data-ls-module='modal' data-target='#myAwesomeModal' class='ls-btn-primary' id='botao-modal'>Agendar Laboratório</button>";
                }
                ?>
                <div class="ls-modal" id="myAwesomeModal">
                    <div class="ls-modal-box">
                        <div class="ls-modal-header">
                            <button data-dismiss="modal">&times;</button>
                            <h4 class="ls-modal-title">Agendar Laboratório</h4>
                        </div>
                        <div class="ls-modal-body" id="myModalBody">
                            <p>Escolha a melhor forma de você realizar o seu agendamento:
                                <br> Por data ou por Laboratório?</p>
                        </div>
                        <div class="ls-modal-footer">
                            <button class="ls-btn ls-float-right" data-dismiss="modal">Fechar</button>
                            <a href="agendar-data.php"><button type="submit" class="ls-btn-primary">Por Data</button></a>
                            <a href="agendar-laboratorio.php"><button type="submit" class="ls-btn-primary">Por Laboratório</button></a>
                        </div>
                    </div>
                </div>
                <!-- fim do modal -->
                <!-- Essa parte é da tabela que consta os agendamentos ativos do professor-->
                <h3 class="meus-agendamentos"> Meus Agendamentos</h3>
                <div style="overflow: auto;height: 400px; border:dotted 1px #fddce0">
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
                                <th>Cancelar </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($meusAgendamentos = mysqli_fetch_assoc($resultado)) {
                                //CONVERTENDO A DATA PARA  DIA/MES/ANO
                                $meusAgendamentos['DATA_AG'] = date("d/m/Y", strtotime($meusAgendamentos['DATA_AG']));
                                switch ($meusAgendamentos['IDTIPOLAB']) {
                                    case 1 : $icone = "ls-ico-screen";
                                        break;
                                    case 2 : $icone = "ls-ico-edit-admin";
                                        break;
                                    case 3 : $icone = "ls-ico-cog";
                                        break;
                                    default: $icone = "ls-ico-screen";
                                        break;
                                }
                                if ($meusAgendamentos['SOLIC'] == "C") {
                                    $botaoCancelar = "<button  data-ls-module='modal' data-target='#infomodalSmall" . $meusAgendamentos['ID'] . "' class='ls-btn ls-ico-info'></button> ";
                                } else {
                                    $botaoCancelar = "<button  data-ls-module='modal' data-target='#deletemodalSmall" . $meusAgendamentos['ID'] . "' class='ls-btn ls-ico-remove'></button> ";
                                }

                                echo"
                                        <tr>
                                            <td style='display: none' > " . $meusAgendamentos['ID'] . " </td>
                                            <td>" . $meusAgendamentos['DATA_AG'] . "</td>
                                            <td>" . $meusAgendamentos['SOLICITACAODESCRI'] . "</td>
                                            <td>" . $meusAgendamentos['PERIODODESCRI'] . "</td>
                                            <td class='$icone'><a href='' title=''>" . $meusAgendamentos['TIPOLABDESCRI'] . "</a></td>
                                            <td>" . $meusAgendamentos['LABDESCRI'] . "</td>
                                            <td>" . $meusAgendamentos['LABSALA'] . "</td>
                                            <td>" . $meusAgendamentos['LABANDAR'] . "</td>
                                            <td>
                                            " . $botaoCancelar . "
                                                
                                            
                                            </td>
                                                                          <!-- MODAL PARA DELETAR -->
                          <div class='ls-modal' id='deletemodalSmall" . $meusAgendamentos['ID'] . "'>
                            <div class='ls-modal-small'>
                              <div class='ls-modal-header'>
                                <button data-dismiss='modal'>&times;</button>
                                <h4 class='ls-modal-title'>Excluir curso</h4>
                              </div>
                              <div class='ls-modal-body'>
                                 <form action='controller/cancelaragendamento.php'  method='post' class='ls-form-inline row' >
                                        <input type='hidden' name='ID' placeholder='' required  value='" . $meusAgendamentos['ID'] . "'>
                                        <p><h3>Confirma exclusão do agendamento? 
                                        <br><br><center>Data do agendamento:<br>  <p style='color: red; font-size:20px'>" . $meusAgendamentos['DATA_AG'] . "<br><br>" . $meusAgendamentos['LABDESCRI'] . "</p></h3></center>
                                        <br><p> Essa operação não pode ser desfeita.</p>
                                        </div>
                                        <div class='ls-modal-footer'>
                                        <button type='submit' class='ls-btn-primary-danger ls-ico-remove'>Excluir</button>
                                 </form>                              

                              
                            <button class='ls-btn-dark ls-float-right ls-ico-close' data-dismiss='modal'>Fechar</button>
                                 </div>
                            </div>
                          </div>
                          

                          <div class='ls-modal' id='infomodalSmall" . $meusAgendamentos['ID'] . "'>
                            <div class='ls-modal-small'>
                              <div class='ls-modal-header'>
                                <button data-dismiss='modal'>&times;</button>
                                <h4 class='ls-modal-title'>Informação do agendamento</h4>
                              </div>
                              <div class='ls-modal-body'>
                                 <form  method='post' class='ls-form-inline row' >
                                        <input type='hidden' name='ID' placeholder='' required  value='" . $meusAgendamentos['ID'] . "'>
                                          <label class='ls-label'>
                                        <b class='ls-label-text'>Motivo do cancelamento :</b>
                                        <textarea rows='4' required name='INFO_ADC''>" . $meusAgendamentos['INFO_ADC'] . "</textarea>
                                      </label>
                                        </div>
                                        <div class='ls-modal-footer'>
                                              <button class='ls-btn-dark ls-float-right ls-ico-close' data-dismiss='modal' style='margin: 3px;'>Cancelar</button>
                                 </form>                              

                              
                           
                                 </div>
                            </div>
                          </div>
                          
                                        </tr>
                        ";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!--Fim da tabela-->

            <!--Essa parte é do footer, onde contém por quem é desenvolvido, a logo e o email-->
   <?php require_once('./model/footer.php'); ?>
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

        </script>

    </body>
</html>
