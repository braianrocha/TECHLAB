<?php
require_once ('./adminphp/conecta.php');

// Adiciona o arquivo de controle que ajudará a listar os dados

$op = "";
$query2 = "SELECT * FROM PERIODO ORDER BY ID";
$resultado2 = mysqli_query(buscaconexao(), $query2);
while ($PERI = mysqli_fetch_assoc($resultado2)) {
    $op .= "<option value='" . $PERI["ID"] . "'>" . $PERI["DESCRICAO"] . "</option>";
}

$CursoOP = "";
$queryCurso = "SELECT * FROM CURSO ORDER BY ID";
$resultadoCurso = mysqli_query(buscaconexao(), $queryCurso);
while ($Curso = mysqli_fetch_assoc($resultadoCurso)) {
    $CursoOP .= "<option value='" . $Curso["ID"] . "'>" . $Curso["DESCRICAO"] . "</option>";
}

function listaInsumo() {
    $query = "SELECT * FROM INSUMO";
    $resultado = mysqli_query(buscaconexao(), $query);
    while ($tipoInsumo = mysqli_fetch_array($resultado)) {
        echo"<option value='" . $tipoInsumo["ID"] . "'>" . $tipoInsumo["DESCRICAO"] . "</option>";
    }
}

function listaInsumoLAB($id) {
    $query = "SELECT * FROM INSUMO_LAB 
             INNER JOIN INSUMO INSU ON INSU.ID = INSUMO_LAB.INSUMO_ID
             WHERE LABORATORIO_ID = " . $id;
    $resultado = mysqli_query(buscaconexao(), $query);
    $InsumoLAB = "";

    while ($tipoInsumo = mysqli_fetch_array($resultado)) {
        $InsumoLAB .= $tipoInsumo['DESCRICAO'] . ", ";
    }
    return $InsumoLAB;
}

if (isset($_GET['insumo']) && $_GET['insumo'] == 0) {
    $query = "SELECT LABORATORIO.ID , LABORATORIO.DESCRICAO , LABORATORIO.TIPO_LAB_ID  ,TIPOLAB.DESCRICAO  AS TIPODESC  , 
LABORATORIO.SALA , LABORATORIO.ANDAR
FROM LABORATORIO
INNER JOIN TIPO_LABORATORIO TIPOLAB ON TIPOLAB.ID = LABORATORIO.TIPO_LAB_ID";
} else if (isset($_GET['insumo'])) {
    $query = "SELECT LAB.ID , LAB.DESCRICAO , LAB.TIPO_LAB_ID  ,TIPOLAB.DESCRICAO  AS TIPODESC  , 
LAB.SALA , LAB.ANDAR FROM INSUMO_LAB 
INNER JOIN LABORATORIO LAB ON LAB.ID = INSUMO_LAB.LABORATORIO_ID 
INNER JOIN TIPO_LABORATORIO  TIPOLAB ON LAB.TIPO_LAB_ID = TIPOLAB.ID WHERE INSUMO_ID =" . $_GET['insumo'];
} else {
    $query = "SELECT LABORATORIO.ID , LABORATORIO.DESCRICAO , LABORATORIO.TIPO_LAB_ID  ,TIPOLAB.DESCRICAO  AS TIPODESC , 
LABORATORIO.SALA , LABORATORIO.ANDAR
FROM LABORATORIO
INNER JOIN TIPO_LABORATORIO TIPOLAB ON TIPOLAB.ID = LABORATORIO.TIPO_LAB_ID";
}

$select = mysqli_query($conexao, $query);



//FUNCAO VAI RECEBER O ID DO LAB E LISTAR SOMENTE OS INSUMOS LABS DELE
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
        <link rel="stylesheet" type="text/css" href="css/agendar-laboratorio.css">
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
                <!--Aqui aparece o sub-titulo e o botao buscar-->
                <h2 class="sub-titulo">Laboratório </h2> 


                <!--Aqui aparece o formulario de buscar para o usuario inserir o que deseja pesquisar-->
                <form action="agendar-laboratorio.php" method="GET" class="ls-form ls-form-horizontal row" id="formulario-01">
                    <fieldset>
                        <label class="ls-label col-md-5 col-xs-12" id="pesquisar">
                            <b class="ls-label-text">Pesquisar:</b>
                            <input type="text" placeholder="Informe o que deseja pesquisar" class="ls-field" >
                        </label>

                        <label class="ls-label col-md-4 col-xs-12">
                            <b class="ls-label-text">Filtrar por:</b>
                            <div class="ls-custom-select">
                                <select name="insumo" class="ls-select">
                                    <option value='0'>Selecione o filtro</option>
                                    <?php listaInsumo(); ?>
                                </select>

                            </div>
                        </label>
                        <button type="submit" class="ls-btn-dark ls-ico-search" id="botao-buscar">Buscar</button>
                    </fieldset>
                </form>
                <!--Fim do formulario-->
                <!--Nesta tabela aparecerá os resultados da pesquisa realizada pelo usuario e o botao para selecionar o laboratorio desejado-->
                <?php
                while ($lab = mysqli_fetch_array($select)) {
                    echo "   <div data-ls-module='collapse' data-target='#" . $lab['ID'] . "' class='ls-collapse '>
                                <a href='#' class='ls-collapse-header'>
                                  <h3 class='ls-collapse-title'>" . $lab['DESCRICAO'] . " </h3>
                                </a>
                                <div class='ls-collapse-body' id='" . $lab['ID'] . "'>
                                    <button  style='float:right' data-ls-module='modal' class='ls-btn-primary ls-ico-plus' data-target='#modalSmall" . $lab['ID'] . "'>Agendar</button><br>   
                                     
                                  <p>
                                      <b>TIPO</b> : INFORMÁTICA <br>
                                    <b>SALA </b> : " . $lab['SALA'] . "<br>
                                    <b>ANDAR </b>: " . $lab['ANDAR'] . " <br>
                                    <b>Insumos </b>: " . listaInsumoLAB($lab['ID']) . " 
                                
                                  </p>
                                </div>
                        <!-- MODAL PARA EDITAR -->
                          <div class='ls-modal' id='modalSmall" . $lab['ID'] . "'>
                            <div class='ls-modal-small'>
                              <div class='ls-modal-header'>
                                <button data-dismiss='modal'>&times;</button>
                                <h4 class='ls-modal-title'>Agendar laboratório</h4>
                                </div>
                                <div class='ls-modal-body'>
                                    <form action='controller/agendar.php'  method='post' class='ls-form row' >
                                    <input type='hidden' name='ID' placeholder='' required  value='" . $lab['ID'] . "'>
                                        <input type='hidden' name='IDUSER' placeholder='' required  value='" . idUsuarioLogado() . "'>
                                        <label class='ls-label col-md-11'>
                                          <div class='ls-prefix-group'>
                                            <b class='ls-label-text'>Data</b>
                                            <input type='text' name='DATA' class='datepicker' id='datepickerExample' placeholder='dd/mm/aaaa' required>
                                            <a class='ls-label-text-prefix ls-ico-calendar' data-trigger-calendar='#datepickerExample' href='#'></a>
                                          </div>
                                        </label>
                                        <label class='ls-label col-md-11' id='filtrar'>
                                            <b class='ls-label-text'>PERIODO:</b>
                                                <div class='ls-custom-select ls-fiel-md'>
                                                  <select name='PERIODO' class='ls-select'>" . $op . "</select>
                                                </div>  
                                        </label>
                                        
                                        <label class='ls-label col-md-11' id='filtrar'>
                                            <b class='ls-label-text'>Cursos :</b>
                                                <div class='ls-custom-select ls-fiel-md'>
                                                  <select name='CURSO' class='ls-select'>" . $CursoOP . "</select>
                                                </div>  
                                        </label>
                                        

                                        <label class='ls-label col-md-11'>
                                                <b class='ls-label-text'>Observação: </b>
                                                <input type='text'  name='OBS' placeholder=''>
                                              
                                        </label>
                                        
                                        <div class='ls-modal-footer'>
                                              <button class='ls-btn-dark ls-float-right ls-ico-close' data-dismiss='modal' style='margin: 3px;'>Cancelar</button>
                                              <button type='submit' class='ls-btn-dark ls-ico-checkmark' style='margin: 3px;'>Salvar</button>   
                                        </div>
                                    </form>
                              </div>
                            </div>
                          </div>  
                            </div>";
                }
                ?>       

                <!--Fim da tabela-->
            </div>

            <!--Essa parte é do footer, onde contém por quem é desenvolvido, a logo e o email-->
            <?php require_once ('model/footer.php'); ?>
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


