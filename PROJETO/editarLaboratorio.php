<?php
// Adiciona o arquivo de conexão
// Adiciona o arquivo de controle que ajudará a listar os dados
require_once ('./controller/controllerlaboratorio.php');
require_once ('./adminphp/verificausuario.php');
verificaLogin();

require_once ('./adminphp/conecta.php');

 if($_SESSION['PERFIL'] == 1){ 
     $block = " ";
 }else{
     $block = "disabled";
 }
$id = mysqli_real_escape_string($conexao, $_POST['ID']);


$query = "SELECT LAB.ID AS ID ,LAB.DESCRICAO AS DESCRILAB, LAB.SALA , LAB.ANDAR , LAB.TIPO_LAB_ID , TIPO_LAB.DESCRICAO AS DESCRITIPOLAB , TIPO_LAB.ID AS LABID FROM LABORATORIO LAB
INNER JOIN TIPO_LABORATORIO TIPO_LAB ON LAB.TIPO_LAB_ID = TIPO_LAB.ID WHERE LAB.ID = " . $id;

$laboratorio = mysqli_query($conexao, $query);


$laboratorio = mysqli_fetch_assoc($laboratorio);
//$laboratorio = mysqli_fetch_assoc($laboratorio);
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
            <div class="container-fluid">
                <h2 class="sub-titulo">Editar Laboratorio </h2> 



                <div class="ls-modal-body">
                    <form action="controller/editarLaboratorio.php"  method="post" class="ls-form-inline row" >
                        <label class="ls-label col-md-11">
                            <b class="ls-label-text">Laboratório: </b>
                            <input type="text"  name="DESC" placeholder="" required <?php echo $block ?> value="<?php echo $laboratorio['DESCRILAB'] ?>">
                            <input type="hidden" name="ID" placeholder="" required  value="<?php echo $laboratorio['ID'] ?>">
                        </label>
                        <label class="ls-label col-md-11">
                            <b class="ls-label-text">Sala: </b>
                            <input type="text"  name="SALA" placeholder="" required  <?php echo $block ?> value="<?php echo $laboratorio['SALA'] ?>">
                        </label>
                        <label class="ls-label col-md-11">
                            <b class="ls-label-text">Andar: </b>
                            <input type="text"  name="ANDAR" placeholder="" required <?php echo $block ?>  value="<?php echo $laboratorio['ANDAR'] ?>">

                        </label>
                        <label class="ls-label col-md-11  col-md-11" id="filtrar">
                            <b class="ls-label-text">Tipo de laboratorio:</b>
                            <div class="ls-custom-select">
                                <select  name="LISTALAB" class="ls-select" <?php echo $block ?>>
                                    <?php echo listaTipoLaboratorio2($laboratorio['TIPO_LAB_ID']) ?>
                                </select>
                            </div>

                        </label>
                        <label class="ls-label col-md-11  col-md-11" id="filtrar">
                            <b class="ls-label-text">Insumos:</b><br>   
                        </label>
                        <label class="ls-label col-md-11  col-md-11"">                                            
                            <select name="addListaInsumo[]" multiple="multiple" id="my-select" <?php echo $block ?>>
                                <?php echo ListaMultipla($id); ?>
                            </select>
                        </label>
                        <label class="ls-label col-md-11  col-md-11"">                                            
         <?php if($_SESSION['PERFIL'] == 1){                     
                 echo   "   <button type='submit' class='ls-btn-dark ls-ico-checkmark' style='margin: 3px;'>Salvar</button>   ";
         }                
               ?>             
                            <a type="button" class="ls-btn-dark ls-float-right ls-ico-close" href="./laboratorio.php"  style="margin: 3px;">Cancelar</a> 
                        </label>
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
        <script src="js/jquery.multi-select.js" type="text/javascript"></script>    



        <script type="text/javascript">
            $(window).on('load', function () {
                locastyle.browserUnsupportedBar.init();
            });
            $('#my-select').multiSelect({

                selectableFooter: "<div class='custom-header'><span class='ls-ico-checkbox-unchecked' > Opções   </div>",
                selectionFooter: "<div class='custom-header'><span class='ls-ico-checkbox-checked' > Selecionados</div>"
            });

        </script>

    </body>
</html>

