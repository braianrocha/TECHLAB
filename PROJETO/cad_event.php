<?php
session_start();

include_once './conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Converter a data e hora do formato brasileiro para o formato do Banco de Dados
$data_start = str_replace('/', '-', $dados['start']);
$data_start_conv = date("Y-m-d", strtotime($data_start));

$data_end = str_replace('/', '-', $dados['end']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

$obs = $dados['obs'];

//$query_event = "INSERT INTO events (title, color, start, end) VALUES (:title, :color, :start, :end)";

$query_event = "INSERT INTO AGENDAMENTO (INFO_ADC , DATA_SOLIC , USUARIO_ID , DATA_AG, PERIODO_ID,CURSO_ID,SITUACAO_SOLIC_ID,LABORATORIO_ID)"
        . "     VALUES ('".$obs."' , '2019-11-22 00:00:00', 10, '".$data_start_conv."' , ".$dados['periodo'].", 3 ,'P' ,".$dados['lab'].")";
    
$insert_event = $conn->prepare($query_event);
$insert_event->bindParam(':title', $dados['title']);
$insert_event->bindParam(':color', $dados['color']);
$insert_event->bindParam(':periodo', $dados['periodo']);
$insert_event->bindParam(':lab', $dados['lab']);
$insert_event->bindParam(':start', $data_start_conv);
$insert_event->bindParam(':end', $data_end_conv);

if ($insert_event->execute()) {
    $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>'];
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>';
} else {
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Evento não foi cadastrado com sucesso!</div>'];
}


header('Content-Type: application/json');
echo json_encode($retorna);
