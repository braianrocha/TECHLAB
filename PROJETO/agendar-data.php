<?php
require_once('./adminphp/verificausuario.php');
// Adiciona o arquivo de conexão
require_once('./adminphp/conecta.php');
verificaLogin();
// Adiciona o arquivo de conexão

//$_SESSION['msg'] = "MSG01";
?>
<!DOCTYPE html>
<html>
    <head>
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href='packages/core/main.css' rel='stylesheet' />
        <link href='packages/daygrid/main.css' rel='stylesheet' />
        <link href='packages/timegrid/main.css' rel='stylesheet' />
        <link href='packages/list/main.css' rel='stylesheet' />
        <script src='packages/core/main.js'></script>
        <script src='packages/interaction/main.js'></script>
        <script src='packages/daygrid/main.js'></script>
        <script src='packages/timegrid/main.js'></script>
        <script src='packages/list/main.js'></script>
        <script src='js/core/locales/pt-br.js'></script>   
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="js/personalizado.js"></script>
        <link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/agendar-laboratorio.css">
    <body class="documentacao documentacao_exemplos documentacao_exemplos_painel1 documentacao_exemplos_painel1_pre-painel documentacao_exemplos_painel1_pre-painel_index"> 
    </head>
<body>
    <?php


    // Envia a conexão e a query para execução
    //$resultado = mysqli_query($conn, $query);

    $queryCurso = "SELECT * FROM CURSO ORDER BY ID";
    $resultadoCurso = $conn->prepare($queryCurso);
    $resultadoCurso->execute();
    $optionCurso = "";
    while ($rowCurso = $resultadoCurso->fetch(PDO::FETCH_ASSOC)) {
    $optionCurso .= "<option  value='" . $rowCurso["ID"] . "'>" . $rowCurso["DESCRICAO"] . "</option>";
    }

    $query = "SELECT * FROM PERIODO ORDER BY ID ";
    $resultado = $conn->prepare($query);
    $resultado->execute();
    $option = "";
    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $option .= "<option  value='" . $row["ID"] . "'>" . $row["DESCRICAO"] . "</option>";
    }

    $queryLab = "SELECT * FROM LABORATORIO ORDER BY ID";
    $resultadoLab = $conn->prepare($queryLab);
    $resultadoLab->execute();
    $optionLab = "";
    while ($rowLab = $resultadoLab->fetch(PDO::FETCH_ASSOC)) {
        $optionLab .= "<option  value='" . $rowLab["ID"] . "'>" . $rowLab["DESCRICAO"] . "</option>";
    }
    ?>

    <div class="ls-topbar ls-topbar-gray" id="barra">

        <!-- Barra inicial (Onde contém o titulo) -->
        <div class="ls-notification-topbar">
            <h1 class="titulo-principal">Agendamento de Laboratórios <?php// var_dump($_SESSION['msg'])  ?></h1>
        </div>
        <span class="ls-show-sidebar ls-ico-menu"></span>
    </div>
    <!--Barra Vertical de Menu (Contém a logo de usuário,logo do pitagoras e os menus para acessar)-->

    <!--Aquele é carregado o calendário-->
    <?php require_once('./model/menu.php'); ?>
    <!-- Aqui inicia o conteúdo da pagina -->
    <main class="ls-main ">

        <div class="container-fluid" > 
                                <?php
            // verifica se existe alguma mensagem pra ser enviada para o usuário
            if ((isset($_SESSION['msg']))) {
                require_once('./mensagem.php');
            }
            ?>
            <div id='calendar'></div>
            <div class="ls-modal" id="visualizar">
                <div class="ls-modal-box">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalhes do agendamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">

                            <dl class="row">
                                <dt class="col-sm-3" hidden="true">ID do evento</dt>
                                <dd class="col-sm-9" hidden="true" id="id"></dd>

                                <dt class="col-sm-3">Laboratório : </dt>
                                <dd class="col-sm-9" id="title"></dd>

                                <dt class="col-sm-3">Andar : </dt>
                                <dd class="col-sm-9" id="andar"></dd>

                                <dt class="col-sm-3">Sala : </dt>
                                <dd class="col-sm-9" id="sala"></dd>


                                <dt class="col-sm-3">Período :</dt>
                                <dd class="col-sm-9" id="periodo"></dd>

                                <dt class="col-sm-3">Situação :</dt>
                                <dd class="col-sm-9" id="sit"></dd>

                                <dt class="col-sm-3">Início :</dt>
                                <dd class="col-sm-9" id="start"></dd>

                                <dt class="col-sm-3">Fim :</dt>
                                <dd class="col-sm-9" id="end"></dd>
                            </dl>

                            <button type="button" class="btn btn-primary btn-canc-edit" data-dismiss="modal">Fechar</button>


                        </div>

                </div>
            </div>

            <div class="ls-modal" id="cadastrar">
                <div class="ls-modal-box">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cadastrar agendamento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span id="msg-cad"></span>
                                
                            <form id="formID" action="controller/agendar-data.php" method="POST" enctype="multipart/form-data">
                               <input type='hidden' name='ID' placeholder='' required  value="<?php echo idUsuarioLogado() ?>">
                                
<!--                                    <label class="col-sm-2 col-form-label">Título</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Título do evento">
                                    </div>-->
                                
                                
<!--                                    <label class="col-sm-2 col-form-label">Color</label>
                                    <div class="col-sm-10">
                                        <select name="color" class="form-control" id="color">
                                            <option value="">Selecione</option>			
                                            <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                            <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                            <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                            <option style="color:#8B4513;" value="#8B4513">Marrom</option>	
                                            <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                            <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                            <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                            <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                            <option style="color:#228B22;" value="#228B22">Verde</option>
                                            <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                        </select>
                                    </div>-->
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Data :</label>
                                    <div class="col-sm-10">
                                        <input type="text"  name="start" class="datepicker form-control" id="start" onkeypress="Data(event, this)">
                                    </div>
                                </div>
<!--                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Final do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="end" class="form-control" id="end"  onkeypress="DataHora(event, this)">
                                    </div>
                                </div>-->

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Periodo</label>
                                    <div class="col-sm-10">
                                        <select name="periodo" class="form-control" id="periodo">
                                            <?PHP echo $option ?> 
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Curso</label>
                                    <div class="col-sm-10">
                                        <select name="curso" class="form-control" id="periodo">
                                            <?PHP echo $optionCurso ?> 
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Laboratório</label>
                                    <div class="col-sm-10">

                                        <select name="lab" class="form-control" id="periodo">
                                            <?PHP echo $optionLab ?>

                                        </select>

                                    </div>
           
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Observações </label>
                                    <div class="col-sm-10">
                                <input type="text" name="obs" class="form-control" id="obs" placeholder="Se possuir alguma observação.">
                                    

                                    </div>
           
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="CadEvent" name="send" id="send" class="btn btn-success">Cadastrar</button>                                    
                                    </div>
                                </div>
                            </form>
                        </div>

                </div>
            </div>

        </div>




        <!--Essa parte é do footer, onde contém por quem é desenvolvido, a logo e o email-->
        <?php require_once('model\footer.php'); ?>
    </main>

    <!--Esses scripts são do locaweb NAO APAGUE-->

    <script src="locaweb/example.js" type="text/javascript"></script>
    <script src="locaweb/localstyle.js" type="text/javascript"></script>
    <script src="locaweb/highcharts.js" type="text/javascript"></script>
    <script src="locaweb/panel-charts.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(window).on('load', function () {
            locastyle.browserUnsupportedBar.init();
        });
        
        
        var formID = document.getElementById("formID");
var send = $("#send");

$(formID).submit(function(event){
  if (formID.checkValidity()) {
    send.attr('disabled', 'disabled');
  }
});
    </script>

</body>
</html>
