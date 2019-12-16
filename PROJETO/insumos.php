<?php
// Adiciona o arquivo de conexão
require_once('./adminphp/conecta.php');

// Adiciona o arquivo de controle que ajudará a listar os dados
require_once('./controller/controllerinsumo.php');
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
  <link rel="stylesheet" href="css/insumos.css">
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

      <!--Tela Insumo-->
      <h2 class="sub-titulo">Insumos</h2>
      <div id="botaocadastro" class="">
        <button data-ls-module="modal" data-target="#modalSmall" type="button" class="ls-btn-dark ls-ico-plus" style="margin-right: 42px;">Novo </button>
      </div>

         <!--Campo de pesquisa-->
    <form action="" class="ls-form ls-form-horizontal row" id="formulario-01">
      <fieldset>
        <label class="ls-label col-md-5 col-xs-12" id="pesquisar">
          <b class="ls-label-text" >Pesquisar:</b>
          <input type="text" placeholder="Informe o que deseja pesquisar" class="ls-field-md" required>
        </label>
      </fieldset>
    </form>

    <!--Insumos-->
    <div class="table-responsive" >  
      <div style="overflow: auto;height: 400px;"> 
      <table class="ls-table ls-table-striped">
        <thead>
          <tr>
            <th><b>Tipo</b></th>
            <th id="insumo"><b>Insumo</b></th>
            <th id="editar"><b>Editar</b></th>
          </tr>
        </thead>
        <tbody>
          <?php listaInsumo(); ?>
        </tbody>
      </table>
  </div>
  </div>
    </div>
    </div>

    <!--Modal-Novo Insumo-->
    <div class="ls-modal" id="modalSmall">
      <div class="ls-modal-small">
        <div class="ls-modal-header">
          <h4 id="titulomodal" class="ls-modal-title">Novo Insumo</h4>
        </div>
        <div class="ls-modal-body">
          <form action='controller/adicionaInsumo.php' method='POST' class="ls-form row">
            <fieldset>
              <label class="ls-label col-md-12 col-xs-12">
                <b class="ls-label-text">Insumo:</b>
                <input type="text" name="nome" placeholder="" class="ls-field" required>
              </label>
              <label class="ls-label col-md-12 col-sm-8">
                <b class="ls-label-text">Tipo de insumo:</b>
                <div class="ls-custom-select">
                  <select name="listaInsumo" class="ls-select">
                    <?php listaTipoInsumo() ?>
                  </select>
                </div>
              </label>
            </fieldset>
        </div>
        <div class="ls-modal-footer">
          <button class="ls-btn ls-float-right" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="ls-btn-primary">Salvar</button>
          </form>
        </div>
      </div>
    </div>

     <!--Essa parte é do footer, onde contém por quem é desenvolvido, a logo e o email-->
    <?php require_once('model/footer.php'); ?>
  </main>


  <!--Esses scripts são do locaweb NAO APAGUE-->
  <script src="locaweb/jquery.js" type="text/javascript"></script>
  <script src="locaweb/example.js" type="text/javascript"></script>
  <script src="locaweb/localstyle.js" type="text/javascript"></script>
  <script src="locaweb/highcharts.js" type="text/javascript"></script>
  <script src="locaweb/panel-charts.js" type="text/javascript"></script>

  <script type="text/javascript">
    $(window).on('load', function() {
      locastyle.browserUnsupportedBar.init();
    });
  </script>

</body>

</html>