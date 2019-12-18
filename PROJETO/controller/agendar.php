<?php
require_once('../adminphp/verificausuario.php');


// Adiciona o arquivo de conexão
require_once('../adminphp/conecta.php');
date_default_timezone_set('America/Campo_Grande');
$id = mysqli_real_escape_string($conexao,$_POST['ID']);
$idUser = mysqli_real_escape_string($conexao,$_POST['IDUSER']);
$periodo = mysqli_real_escape_string($conexao,$_POST['PERIODO']);
$curso = mysqli_real_escape_string($conexao,$_POST['CURSO']);
$dataAgendamento = mysqli_real_escape_string($conexao,$_POST['DATA']);
$obs = mysqli_real_escape_string($conexao,$_POST['OBS']);
$dataAtual = date('d-m-Y');


require_once('../parametros.php');




//antecedenciaMIN($dataAgendamento);
//ECHO "antecedenciaMax".antecedenciaMax($dataAgendamento);
//ECHO "<br>maxAgendamentosDia".maxAgendamentosDia($dataAgendamento,$idUser);
//ECHO "<br>maxAgendamentosSimultaneo".maxAgendamentosSimultaneo($idUser);
//ECHO "<br>antecedenciaMIN".antecedenciaMIN($dataAgendamento);

 $dataAgendamentoQuery = date("Y/m/d", strtotime(str_replace("/", '-', $dataAgendamento)));
$dataAtualQuery = date("Y/m/d", strtotime(str_replace("/", '-', $dataAtual)));
        
$query = "INSERT INTO AGENDAMENTO (DATA_SOLIC , USUARIO_ID , DATA_AG, PERIODO_ID,CURSO_ID,SITUACAO_SOLIC_ID,LABORATORIO_ID)"
       . "VALUES ('".$dataAtualQuery."', ".$idUser." , '".$dataAgendamentoQuery."' , ".$periodo.", ".$curso." ,'".aprovacaoAgendamento()."' ,".$id.")";


 if(antecedenciaMax($dataAgendamento) == FALSE || 
    maxAgendamentosDia($dataAgendamento,$idUser) == FALSE ||
    maxAgendamentosSimultaneo($idUser) == FALSE ||
    antecedenciaMIN($dataAgendamento) == FALSE  ||
    verificaAgendamento($dataAgendamento,$periodo,$id) == FALSE
         ){
     
//     echo "antecedenciaMax".antecedenciaMax($dataAgendamento);
//     echo "<BR>maxAgendamentosDia".maxAgendamentosDia($dataAgendamento,$idUser);
//     echo "<BR>maxAgendamentosSimultaneo".maxAgendamentosSimultaneo($idUser);
//     echo  "<BR>antecedenciaMIN".antecedenciaMIN($dataAgendamento);
//     echo  "<BR>verificaAgendamento".verificaAgendamento($dataAgendamento,$periodo,$id);
//     
//     echo("deu ruim<br>");
     echo $query;
     
//     header('Location: ../agendar-laboratorio.php');
//     exit();
 }else{
     
     gravaAgendamento($query);
         
     //echo $query;
 }
 
$query = "INSERT INTO AGENDAMENTO (DATA_SOLIC , USUARIO_ID , DATA_AG, PERIODO_ID,CURSO_ID,SITUACAO_SOLIC_ID,LABORATORIO_ID)"
       . "VALUES ('".$dataAtual."', ".$idUser." , '".$dataAgendamento."' , ".$periodo.", ".$curso." ,".aprovacaoAgendamento()." ,".$id.")";

//echo $query;