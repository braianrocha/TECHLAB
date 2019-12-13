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
$listaLAB = mysqli_real_escape_string($conexao, $_POST['LISTALAB']);
//$addListaInsumo = mysqli_real_escape_string($conexao,$_POST['addListaInsumo']);

$query = "DELETE FROM INSUMO_LAB WHERE LABORATORIO_ID = ".$id;
$select = mysqli_query($conexao, $query);
foreach ($_POST["addListaInsumo"] as $opcao) {
   // $query = "INSERT INTO INSUMO_LAB (LABORATORIO_ID,INSUMO_ID) VALUES (" .$id. ",'" . $opcao . "');";
   //$query = "SELECT COUNT(*) AS CONT FROM INSUMO_LAB WHERE LABORATORIO_ID = ".$id." AND INSUMO_ID = ".$opcao;
   //$select = mysqli_query($conexao, $query);
   //$select = mysqli_fetch_assoc( $select);

       $query = "INSERT INTO INSUMO_LAB (LABORATORIO_ID,INSUMO_ID) VALUES (" .$id. ",'" . $opcao . "');";
$select = mysqli_query($conexao, $query);
}



//
//$listaLaboratorio = mysqli_real_escape_string($conexao, $_POST['listaLaboratorioModal']);
//$query = "UPDATE INSUMO_LAB SET INSUMO_LAB.INSUMO_ID = '".$addListaInsumo."' WHERE LABORATORIO_ID = '$id'";
//$select = mysqli_query($conexao, $query);

//QUERY que será executada no bando de dados 
$query = "UPDATE LABORATORIO SET LABORATORIO.DESCRICAO = '".$nome."', TIPO_LAB_ID  = '".$listaLAB."', SALA = '".$sala."', ANDAR = '".$andar."' WHERE ID = '$id'";

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