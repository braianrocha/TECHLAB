<?php
// Adiciona o arquivo de verificação
require_once('../adminphp/verificausuario.php');
verificaLogin();
// Adiciona o arquivo de conexão
require_once('../adminphp/conecta.php');

// Recebe os parametros do formulário
// Verificação contra SQLINJECTION
$id = mysqli_real_escape_string($conexao, $_POST['ID']);
$nome = mysqli_real_escape_string($conexao, $_POST['DESC']);
$listaInsumo = mysqli_real_escape_string($conexao, $_POST['listaInsumoModal']);

//QUERY que será executada no bando de dados 
$query = "UPDATE INSUMO SET INSUMO.DESCRICAO = '".$nome."', TIPO_INS_ID  = '".$listaInsumo."' where ID = '$id'";

//mysqli_query -> Envia a conexão e a query para execução
// $select -> variavel com resultado da query 
$select = mysqli_query($conexao, $query);

// SE EDITOU RETORNA COM MENSAGEM DE SUCESSO
if ($select) {
    $_SESSION['msg'] = "MSG04";
    header('Location: ../insumos.php');
    die();
}
?>