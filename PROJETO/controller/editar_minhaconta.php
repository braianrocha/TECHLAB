<?php
// Adiciona o arquivo de verificação
require_once('../adminphp/verificausuario.php');
verificaLogin();
// Adiciona o arquivo de conexão
require_once('../adminphp/conecta.php');


// variaveis recebe novos valores
$nome = mysqli_real_escape_string($conexao, $_POST['nome']);
$id = mysqli_real_escape_string($conexao, $_POST['id']);
$cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);

//QUERY que será executada no bando de dados 
$query = "UPDATE USUARIO SET NOME = '".$nome."', CPF = '".$cpf."', EMAIL = '".$email."' where ID = ".$id;

//mysqli_query -> Envia a conexão e a query para execução
// $select -> variavel com resultado da query 
$select = mysqli_query($conexao, $query);

// SE EDITOU RETORNA COM MENSAGEM DE SUCESSO
if ($select) {
    $_SESSION['msg'] = "MSG04";
    header('Location: ../minha-conta.php');
    die();
}

