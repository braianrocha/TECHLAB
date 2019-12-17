<?php

require_once('../adminphp/verificausuario.php');
verificaLogin();
// Adiciona o arquivo de conexão
require_once('../adminphp/conecta.php');
session_start();
//
//Antecedência mínima para agendamento: 
//2
//SE A DATA DO AGENDAMENTO É MAIOR QUE A DATA MINIMA DE AGENDAMENTO
//
//Antecedência máxima para agendamento: 
//30
//
//SE A DATA DO AGENDAMENTO É MENOR QUE A DATA MAXIMA DE AGENDAMENTO
//
//Máximo de agendamentos por dia: 
//
//SELECT COUNT(*) FROM AGENDAMENTO WHERE DATA_AG = '2019-11-22'
//SELECT AG_MAX_DIA FROM PARAM_GERAIS;
//
//Máximo de agendamentos Simultâneos: 
//
//SELECT COUNT(*) FROM AGENDAMENTO WHERE AGENDAMENTO.USUARIO_ID = 10
//SELECT AG_MAX_SIMULT FROM PARAM_GERAIS;
//
//
//Necessário aprovação de Agendamentos? 
//
//     


function antecedenciaMAX($data) {
    $timeStamp = strtotime(str_replace("/", '-', $data));
    $timeStampHoje = strtotime(date("Y/m/d"));
    $dias = "+" . pgADIANTMAX() . "day";
    $timeStampMax = date('d-m-Y', strtotime($dias));
    $timeStampMax = strtotime($timeStampMax);
    if ($timeStamp > $timeStampMax) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function antecedenciaMIN($data) {
    $timeStamp = strtotime(str_replace("/", '-', $data));
    $timeStampHoje = strtotime(date("Y/m/d"));
    $dias = "+" . pgADIANTMIN() . "day";
    $timeStampMin = date('d-m-Y', strtotime($dias));
    $timeStampMin = strtotime($timeStampMin);
    if ($timeStamp < $timeStampHoje || $timeStamp < $timeStampMin) {
       $_SESSION['msg'] = "MSG01";
          header('Location: ../agendar-data.php');
        return FALSE;
    } else {
        return TRUE;
    }
}

function maxAgendamentosDia($data, $id) {
    $Where = date("Y/m/d", strtotime(str_replace("/", '-', $data)));
    $timeStamp = strtotime(str_replace("/", '-', $data));
    $query = "SELECT COUNT(*) AS QNT FROM AGENDAMENTO WHERE DATA_AG ='" . $Where . "' AND USUARIO_ID =" . $id;
    $resultado = mysqli_query(buscaconexao(), $query);
    $quantidade = mysqli_fetch_assoc($resultado);
    if ($quantidade['QNT'] >= pgMAXAGEDIA()) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function maxAgendamentosSimultaneo($id) {
    $query = "SELECT COUNT(*) AS QNT FROM AGENDAMENTO WHERE USUARIO_ID =" . $id . "AND DATA_AG > CURDATE()";
    $resultado = mysqli_query(buscaconexao(), $query);
    $quantidade = mysqli_fetch_assoc($resultado);
    if ($quantidade['QNT'] >= pgMAXAGESIMULTANEO()) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function aprovacaoAgendamento() {
    $query = "SELECT AG_APROVA FROM PARAM_GERAIS";
    $resultado = mysqli_query(buscaconexao(), $query);
    $resultado = mysqli_fetch_array($resultado);

    if ($resultado['AG_APROVA'] == "S") {
        return "P";
    } else {
        return "A";
    }
}

function pgMAXAGEDIA() {

    $query = "SELECT AG_MAX_DIA AS MAX FROM PARAM_GERAIS";
    $resultado = mysqli_query(buscaconexao(), $query);
    $quantidade = mysqli_fetch_assoc($resultado);
    return $quantidade['MAX'];
}

function pgMAXAGESIMULTANEO() {
    $query = "SELECT AG_MAX_SIMULT AS MAX FROM PARAM_GERAIS";
    $resultado = mysqli_query(buscaconexao(), $query);
    $quantidade = mysqli_fetch_assoc($resultado);
    return $quantidade['MAX'];
}

function pgADIANTMAX() {

    $query = "SELECT AG_ADIANT_MAX AS MAX FROM PARAM_GERAIS";
    $resultado = mysqli_query(buscaconexao(), $query);
    $dias = mysqli_fetch_assoc($resultado);
    return $dias['MAX'];
}

function pgADIANTMIN() {

    $query = "SELECT AG_ADIANT_MIN AS MIN FROM PARAM_GERAIS";
    $resultado = mysqli_query(buscaconexao(), $query);
    $dias = mysqli_fetch_assoc($resultado);
    return $dias['MIN'];
}

function verificaAgendamento($dataVerif, $idVerif, $IDLABO) {
    $Where = date("Y-m-d", strtotime(str_replace("/", '-', $dataVerif)));
    $query = "SELECT AGENDAMENTO.LABORATORIO_ID AS IDAGEN , AGENDAMENTO.DATA_AG , AGENDAMENTO.PERIODO_ID , PERI.FIM , PERI.INICIO FROM AGENDAMENTO 
        INNER JOIN PERIODO PERI ON AGENDAMENTO.PERIODO_ID = PERI.ID
        WHERE DATA_AG ='" . $Where . "' AND LABORATORIO_ID =" . $IDLABO;
    $resultad0 = mysqli_query(buscaconexao(), $query);
    $queryPeri = "SELECT * FROM PERIODO WHERE ID =" . $idVerif;
    $resultadoPeri = mysqli_query(buscaconexao(), $queryPeri);
    //$resultadoPeri =  mysqli_fetch_assoc($resultadoPeri);
    //var_dump($resultadoPeri);
    while ($peri = mysqli_fetch_assoc($resultadoPeri)) {
        $INICIO = $peri['INICIO'];
        $FIM = $peri['FIM'];
    }
    while ($AGENDAMENTOS = mysqli_fetch_assoc($resultad0)) {
        if ($AGENDAMENTOS['DATA_AG'] == $Where && $AGENDAMENTOS['IDAGEN'] == $IDLABO) {
            if (($AGENDAMENTOS['PERIODO_ID'] == $idVerif)) {
                return FALSE;
            }
            if ($INICIO == $AGENDAMENTOS['INICIO'] || $FIM == $AGENDAMENTOS['FIM']) {
                return FALSE;
            }

// ($AGENDAMENTOS['PERIODO_ID'] == $idVerif || $INICIO == $AGENDAMENTOS['INICIO'] || $FIM  == $AGENDAMENTOS['FIM'] ) //
        }
    }
    return TRUE;
}



function gravaAgendamento($query){

    $resultado = mysqli_query(buscaconexao(), $query);
    If($resultado){
       $_SESSION['msg'] = "TESTE";
          header('Location: ../agendar-data.php');
    }else{
        
    }
}