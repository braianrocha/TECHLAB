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
$sala = mysqli_real_escape_string($conexao, $_POST['SALA']);
$andar = mysqli_real_escape_string($conexao, $_POST['ANDAR']);
$addListaInsumo = mysqli_real_escape_string($conexao,$_POST['addListaInsumo']);

$listaLaboratorio = mysqli_real_escape_string($conexao, $_POST['listaLaboratorioModal']);
$query = "UPDATE INSUMO_LAB SET INSUMO_LAB.INSUMO_ID = '".$addListaInsumo."' WHERE LABORATORIO_ID = '$id'";
$select = mysqli_query($conexao, $query);

//QUERY que será executada no bando de dados 
$query = "UPDATE LABORATORIO SET LABORATORIO.DESCRICAO = '".$nome."', TIPO_LAB_ID  = '".$listaLaboratorio."', SALA = '".$sala."', ANDAR = '".$andar."' WHERE ID = '$id'";

//mysqli_query -> Envia a conexão e a query para execução
// $select -> variavel com resultado da query 
$select = mysqli_query($conexao, $query);

// SE EDITOU RETORNA COM MENSAGEM DE SUCESSO
if ($select) {
    $_SESSION['msg'] = "MSG04";
    header('Location: ../laboratorio.php');
    die();
}
?>