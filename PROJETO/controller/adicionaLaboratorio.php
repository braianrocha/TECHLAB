<?php
// Adiciona o arquivo de verificação
require_once('../adminphp/verificausuario.php'); 
verificaLogin();
// Adiciona o arquivo de conexão
require_once('../adminphp/conecta.php');


// Recebe os parametros do formulário
$nome = mysqli_real_escape_string($conexao,$_POST['DESC']);
$addTipoLab = mysqli_real_escape_string($conexao,$_POST['addTipoLab']);
$addListaInsumo = mysqli_real_escape_string($conexao,$_POST['addListaInsumo']);
$andar = mysqli_real_escape_string($conexao,$_POST['ANDAR']);
$sala = mysqli_real_escape_string($conexao,$_POST['SALA']);
//$quantidade = mysqli_real_escape_string($conexao,$_POST['QUANTIDADE']);
//$restricao = mysqli_real_escape_string($conexao,$_POST['plataforms']);


//QUERY que será executada no bando de dados
$query = "INSERT INTO LABORATORIO (LABORATORIO.DESCRICAO,LABORATORIO.SALA,LABORATORIO.ANDAR,LABORATORIO.TIPO_LAB_ID) VALUES ('$nome','$sala','$andar', '".$addTipoLab."');";

//mysqli_query -> Envia a conexão e a query para execução
// $select -> variavel com resultado da query 
$select =  mysqli_query($conexao,$query);
$insertID = mysqli_insert_id($conexao);
$query = "INSERT INTO INSUMO_LAB (LABORATORIO_ID,INSUMO_ID) VALUES (". $insertID. ",'".$addListaInsumo."');";
$select =  mysqli_query($conexao,$query);

// Verificando se adicionou
if($select){
    // Se adicionou redireciona para pagina com a mensagem da sucesso.
    $_SESSION['msg'] = "MSG04";
    header('Location: ../laboratorio.php');
    die();
}

?>