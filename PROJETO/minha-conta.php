<?php require_once('./adminphp/verificausuario.php'); 
 verificaLogin();
require_once ('./adminphp/conecta.php');


$query = "SELECT U.ID, U.NOME, U.CPF, U.EMAIL, P.DESCRICAO FROM USUARIO U  LEFT JOIN PERIODO P ON U.PERIODO_ID = P.ID WHERE U.ID =".$_SESSION['ID'];
$resultado = mysqli_query(buscaconexao(),$query);
$resultado = mysqli_fetch_assoc($resultado);

$_SESSION['NOME'] = $resultado['NOME'];
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
  
      <link rel="stylesheet" type="text/css" href="/reset.css">
      <link rel="icon" sizes="192x192" href="/ocawebstyle/assets/images/ico-painel1.png">
      <link rel="apple-touch-icon" href="/locawebstyle/assets/images/ico-painel1.png">
      <meta name="apple-mobile-web-app-title" content="Painel 1">
      <script src="/locaweb/mediaqueries-ie.js" type="text/javascript"></script>
      <script src="/locaweb/html5shiv.js" type="text/javascript"></script>
      <link href="http://assets.locaweb.com.br/locastyle/3.10.1/stylesheets/locastyle.css" rel="stylesheet" type="text/css">
      
      <link rel="stylesheet" type="text/css" href="css/index.css">
      <link rel="stylesheet" type="text/css" href="css/minha-conta.css">
      
  </head>
  <body class="documentacao documentacao_exemplos documentacao_exemplos_painel1 documentacao_exemplos_painel1_pre-painel documentacao_exemplos_painel1_pre-painel_index">
  
    <div class="ls-topbar ls-topbar-gray" id="barra">
  
    <!-- Barra inicial (Onde contém o titulo) -->
      <div class="ls-notification-topbar">
        <h1 class="titulo-principal">Agendamento de Laboratórios </h1>
      </div>
      <span class="ls-show-sidebar ls-ico-menu"></span>
    </div>
    <!--Barra Vertical de Menu (Contém a logo de usuário,logo do pitagoras e os menus para acessar)-->
    <?php require_once('./model/menu.php'); ?>
 
<main class="ls-main ">
     <?php
            if ((isset($_SESSION['msg']))) {
                require_once('./mensagem.php');
            }
            ?>
  <div class="container-fluid">
                        <!--Feito Pelo Sander-->
      <!--Contém o sub-titulo e os botoes-->
      <h2 class="sub-titulo">Minha Conta</h2> 
        <div class="botoes-minha-conta">
        <a href="alterar-senha.php"><button type="button" value="teste" class="ls-btn-dark ls-ico-cog ls-ico-left">Alterar Senha</button></a>
              <button data-ls-module="modal" data-target="#modalsmall"class="ls-btn-dark ls-ico-pencil" data-append-to="body">Editar Dados</button>
       <div class="ls-modal" id="modalsmall">
        <div class="ls-modal-large">
            <div class="ls-modal-header">
                <button data-dismiss="modal">&times;</button>
                <h4 class="ls-modal-title">Editar meus dados</h4>
    </div>
    <form action="controller/editar_minhaconta.php" method="post" class="ls-form ls-form-horizontal row" id="formulario-01">
  <fieldset>
    <label class="ls-label col-md-5 col-xs-12" >
      <b class="ls-label-text">Nome:</b>
      <input type="text" name="nome" value="<?php echo $resultado["NOME"]?>" class="ls-field" required> 
      <input type="hidden" name="id" value="<?php echo $resultado["ID"]?>" class="ls-field" required>
    </label>
      <label class="ls-label col-md-5 col-xs-12">
      <b class="ls-label-text">CPF:</b>
      <input type="text" name="cpf"  placeholder="" class="ls-field" required value="<?php echo $resultado["CPF"]?>" >
    </label>
      <label class="ls-label col-md-5 col-xs-12">
      <b class="ls-label-text">E-mail:</b>
      <input type="text" name="email" value="<?php echo $resultado["EMAIL"]?>" class="ls-field" required>
    </label>
      <label class="ls-label col-md-5 col-xs-12" >
      <b class="ls-label-text">Período de Aula:</b>
      <input type="text" name="descricao" value="<?php echo $resultado["DESCRICAO"]?>" class="ls-field" required>
    </label>
      
        </fieldset>
        <div class="ls-modal-footer">
      <button class="ls-btn-dark ls-float-right ls-ico-close" style="margin: 3px;" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="ls-btn-dark ls-ico-checkmark" style="margin: 3px; float: left;">Salvar</button>
    </div>
    </form>
      
    
  </div>
</div>
            
        
        </div>
        <!--Aqui aparece a imagem de perfil (icone) e o nome do usuario-->
        <div class="cabecalho-perfil">
                <img class="img-responsive" src="img/logo-usuario.png" alt="logo-usuario" id="foto-usuario">
                <h2 class="nome-usuario"><?php echo $resultado['NOME']?></h2>
        </div>
        <!--Aqui está o formulario desabilitado, onde contém as informações da conta do usuario-->
        <form action="" method="post" id="campos" class="ls-form ls-form-inline row">
                <fieldset>
                    <label class="ls-label col-md-12 col-xs-12">
                        <b class="ls-label-text">Nome:</b>
                        <input type="text" name="nome" placeholder="<?php echo $resultado["NOME"]?>" class="ls-field ls-no-style-input" required disabled readonly="true" >
                    </label>
                    
                    <label class="ls-label col-md-12 col-xs-12">
                        <b class="ls-label-text">Email:</b>
                        <input type="email" name="email" placeholder="<?php echo $resultado["EMAIL"]?>" class="ls-field ls-no-style-input" required disabled readonly="true">
                    </label>  
                    
                    <label class="ls-label col-md-12 col-xs-12">
                        <b class="ls-label-text">CPF:</b>
                        <input type="number" name="cpf" placeholder="<?php echo $resultado["CPF"]?>" class="ls-field ls-no-style-input" required disabled readonly="true"> 
                    </label>
                    
                    <label class="ls-label col-md-12 col-xs-12">
                        <b class="ls-label-text">Período de Aula:</b>
                        <input type="text" name="periodo" placeholder="<?php echo $resultado["DESCRICAO"]?>" class="ls-field ls-no-style-input" required disabled readonly="true">
                    </label>
                </fieldset>        
            </form>
      <!--Fim do formulario-->
      <!--Botao de sair, para o usuario encerrar sessão-->
      <a href="controller/logout.php"> <button id="sair" type="button" value="teste" class="ls-btn-dark ls-ico-shaft-right ls-ico-left">Sair</button></a>
            
           
    
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
    $(window).on('load', function() {
      locastyle.browserUnsupportedBar.init();
    });
  </script>

</body>
</html>
