<?php

// Adiciona o arquivo de verificação
require_once('../adminphp/verificausuario.php');
verificaLogin();
// Adiciona o arquivo de conexão
require_once('../adminphp/conecta.php');

// Recebe os parametros do formulário
// Verificação contra SQLINJECTION
$id = mysqli_real_escape_string($conexao, $_POST['ID']);

if (!(isset($_POST['INFO_ADC']))) {
    $_POST['INFO_ADC'] = "Cancelado pelo usuário.";
}

//BUSCANDO INFO
$INFO = "SELECT INFO_ADC FROM AGENDAMENTO  WHERE ID = '$id'";
$INFO = mysqli_query($conexao, $INFO);
$INFO_FETCH = $INFO->fetch_assoc();
$INFO_ADC = $INFO_FETCH['INFO_ADC'];

date_default_timezone_set('America/Campo_Grande');
$INFO_ADC .= "[ Cancelamento - " . date('d/m/Y \à\s H:i:s') . "] " . "\n" . " Motivo :";

$INFO_ADC .= mysqli_real_escape_string($conexao, $_POST['INFO_ADC']);
$INFO_ADC .= "\n" .
//echo $INFO_ADC;
//QUERY que será executada no bando de dados 
        $query = "UPDATE  AGENDAMENTO SET SITUACAO_SOLIC_ID = 'C' , INFO_ADC = '$INFO_ADC' WHERE ID = '$id'";

// EXECUTA a QUERY de delete.
$select = mysqli_query($conexao, $query);
if ($select) {

    if ($_SESSION['PERFIL'] == 1) {
        // Se deletou , redireciona com mensagem de sucesso.
        $_SESSION['msg'] = "MSG22";
        header('Location: ../inicial-adm.php');
        die();
    } else {
        // Se deletou , redireciona com mensagem de sucesso.
        $_SESSION['msg'] = "MSG22";
        header('Location: ../inicial.php');
        die();
    }
}
?>