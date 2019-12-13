<?php
require_once('./adminphp/verificausuario.php');
verificaLogin();
require_once('./adminphp/conecta.php');

$query = "SELECT AGENDA.ID AS ID , PROF.NOME AS USUARIO ,PER.DESCRICAO AS PERFIL ,AGENDA.DATA_AG,PERI.DESCRICAO AS PERIODODESCRI,SOLICITACAO.DESCRICAO AS SOLICITACAODESCRI, TIPOLAB.DESCRICAO AS TIPOLABDESCRI,LAB.DESCRICAO AS LABDESCRI,LAB.SALA AS LABSALA,LAB.ANDAR AS LABANDAR , TIPOLAB.ID AS IDTIPOLAB
FROM AGENDAMENTO AGENDA
INNER JOIN PERIODO PERI ON PERI.ID = AGENDA.PERIODO_ID
INNER JOIN SIT_SOLICITACAO SOLICITACAO ON SOLICITACAO.ID = AGENDA.SITUACAO_SOLIC_ID
INNER JOIN LABORATORIO LAB ON LAB.ID = AGENDA.LABORATORIO_ID
INNER JOIN TIPO_LABORATORIO TIPOLAB ON LAB.TIPO_LAB_ID = TIPOLAB.ID 
INNER JOIN USUARIO PROF ON PROF.ID = AGENDA.USUARIO_ID
INNER JOIN PERFIL PER ON PROF.PERFIL_ID = PER.ID
WHERE AGENDA.DATA_AG > NOW() AND AGENDA.SITUACAO_SOLIC_ID = 'P'
ORDER BY AGENDA.DATA_AG";

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
        <link rel="stylesheet" type="text/css" href="css/inicial-adm.css">
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

                <h2 class="sub-titulo"> Olá , <?php echo nomeUsuarioLogado(); ?></h2>

                <h3 class="h3">Agendamentos Pendentes</h3> 
                <table class="ls-table ls-table-striped">
                    <thead>
                        <tr>
                            <th style="display: none" >ID</th>
                            <th>Usuário</th>
                            <th>Perfil</th>
                            <th>Tipo</th>
                            <th>Laboratório</th>
                            <th>Data</th>
                            <th>Período</th>
                            <th colspan="2" style="text-align: center;">Ação</th>
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

                            echo"
                                        <tr>
                                            <td style='display: none' > " . $meusAgendamentos['ID'] . " </td>
                                            <td>" . $meusAgendamentos['USUARIO'] . "</td>
                                            <td>" . $meusAgendamentos['PERFIL'] . "</td>
                                            <td class='$icone'>" . $meusAgendamentos['TIPOLABDESCRI'] . "</td>
                                            <td>" . $meusAgendamentos['LABDESCRI'] . "</td>
                                            <td>" . $meusAgendamentos['DATA_AG'] . "</td>
                                            <td>" . $meusAgendamentos['PERIODODESCRI'] . "</td>
                                            <td><a href='#' data-ls-module='modal' data-target='#aprovamodalSmall".$meusAgendamentos['ID']."' class='ls-btn-aprovar ls-ico-checkmark' style='margin: 3px; '>Aprovar</a> </td>
                                            <td><button type='button' data-ls-module='modal' data-target='#deletemodalSmall".$meusAgendamentos['ID']."' class='ls-btn-primary-danger ls-ico-close' style='margin: 3px; '>Recusar</button></td>
      
                                                       
                                                                          <!-- MODAL PARA DELETAR -->
                          <div class='ls-modal' id='deletemodalSmall".$meusAgendamentos['ID']."'>
                            <div class='ls-modal-small'>
                              <div class='ls-modal-header'>
                                <button data-dismiss='modal'>&times;</button>
                                <h4 class='ls-modal-title'>Recusar agendamento</h4>
                              </div>
                              <div class='ls-modal-body'>
                                 <form action='controller/cancelaragendamento.php'  method='post' class='ls-form-inline row' >
                                        <input type='hidden' name='ID' placeholder='' required  value='".$meusAgendamentos['ID']."'>
                                        <p><h3>Confirma exclusão do agendamento? 
                                        
                                        <br><p> Essa operação não pode ser desfeita.</p>
                                          <label class='ls-label'>
                                        <b class='ls-label-text'>Motivo do cancelamento :</b>
                                        <textarea rows='4' required name='INFO_ADC'></textarea>
                                      </label>
                                        </div>
                                        <div class='ls-modal-footer'>
                                              <button class='ls-btn-dark ls-float-right ls-ico-close' data-dismiss='modal' style='margin: 3px;'>Cancelar</button>
                                              <button type='submit' class='ls-btn-dark ls-ico-checkmark' style='margin: 3px;'>Salvar</button>  
                                 </form>                              

                              
                           
                                 </div>
                            </div>
                          </div>
                                             
                                                            
                         
                        <div class='ls-modal' id='aprovamodalSmall".$meusAgendamentos['ID']."''>
                          <div class='ls-modal-box'>
                            <div class='ls-modal-header'>
                              <button data-dismiss='modal'>&times;</button>
                              <h4 class='ls-modal-title'>Confirmar agendamento</h4>
                            </div>
                            <div class='ls-modal-body' id='myModalBody'>
                                        <form action='controller/confirmaragendamento.php'  method='post' class='ls-form-inline row' >
                                        <input type='hidden' name='ID' placeholder='' required  value='".$meusAgendamentos['ID']."'>
                                        <p><h3>Confirma à aprovação do agendamento? 
                                        
                                        <br><br><p> Essa operação não pode ser desfeita.</p>
                                        </div>
                                        <div class='ls-modal-footer'>
                                                                                                               <button class='ls-btn-dark ls-float-right ls-ico-close' data-dismiss='modal' style='margin: 3px;'>Cancelar</button>
                                              <button type='submit' class='ls-btn-dark ls-ico-checkmark' style='margin: 3px;'>Salvar</button>  
          
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

            <!--Essa parte é do footer, onde contém por quem é desenvolvido, a logo e o email-->
            <?php require_once('model\footer.php'); ?>
        </main>

        <!--Esses scripts são do locaweb NAO APAGUE-->

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
