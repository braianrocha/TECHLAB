<?php
// Adiciona o arquivo de verificação
require_once('../adminphp/verificausuario.php'); 
verificaLogin();
// Adiciona o arquivo de conexão
require_once('../adminphp/conecta.php');


// Recebe os parametros do formulário
$nome = mysqli_real_escape_string($conexao,$_POST['nome']);
$listaInsumo = mysqli_real_escape_string($conexao,$_POST['listaInsumo']);

//QUERY que será executada no bando de dados
$query = "INSERT INTO INSUMO (INSUMO.DESCRICAO,INSUMO.TIPO_INS_ID) VALUES ('$nome' , '".$listaInsumo."');";

//mysqli_query -> Envia a conexão e a query para execução
// $select -> variavel com resultado da query 
$select =  mysqli_query($conexao,$query);

// Verificando se adicionou
if($select){
    // Se adicionou redireciona para pagina com a mensagem da sucesso.
    $_SESSION['msg'] = "MSG04";
    header('Location: ../insumos.php');
    die();
}

?>