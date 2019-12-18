<?php
/**
 * @author Cesar Szpak - Celke - cesar@celke.com.br
 * @pagina desenvolvida usando FullCalendar e Bootstrap 4,
 * o código é aberto e o uso é free,
 * porém lembre-se de conceder os créditos ao desenvolvedor.
 */
include 'conexao.php';

$query_events = "SELECT LAB.ANDAR, LAB.SALA, SOLIC.DESCRICAO AS SOLICDESC, AGENDA.ID,AGENDA.SITUACAO_SOLIC_ID AS SIT,  AGENDA.DATA_AG , CONCAT(AGENDA.DATA_AG,' ' , PERI.INICIO) AS INICIOAGENDAMENTO , CONCAT(AGENDA.DATA_AG,' ' , PERI.FIM) AS FIMAGENDAMENTO , LAB.DESCRICAO  AS LABDESCRICAO   , PERI.DESCRICAO AS DPERI, PERI.ID AS IDPERI , PERI.INICIO , PERI.FIM
 FROM AGENDAMENTO AGENDA
INNER JOIN LABORATORIO LAB ON LAB.ID = AGENDA.LABORATORIO_ID
INNER JOIN PERIODO PERI ON PERI.ID = AGENDA.PERIODO_ID
INNER JOIN SIT_SOLICITACAO SOLIC ON SOLIC.ID = AGENDA.SITUACAO_SOLIC_ID";
$resultado_events = $conn->prepare($query_events);
$resultado_events->execute();

$eventos = [];


while($row_events = $resultado_events->fetch(PDO::FETCH_ASSOC)){
    $periodo = $row_events['DPERI'];
    $sala = $row_events['SALA'];
    $andar = $row_events['ANDAR'];
    $id = $row_events['ID'];
    $title = $row_events['LABDESCRICAO'];
    $status = $row_events['SOLICDESC'];
    if($row_events['SIT'] == "P"){
        $color = "#FFFF00";
    }else if($row_events['SIT'] == "C"){
    $color = "#cd5c5c";
    }else if($row_events['SIT'] == "A"){
        $color = "#6495ed";
    }else if($row_events['SIT'] == "R"){
    $color = "#cd5c5c";
    }
    
    
    $start = $row_events['INICIOAGENDAMENTO'];
    $end = $row_events['FIMAGENDAMENTO'];
    
    
    $eventos[] = [
        'id' => $id, 
        'title' => $title, 
        'color' => $color, 
        'start' => $start, 
        'end' => $end,
        'periodo' => $periodo,
        'sit' => $status,
        'andar' => $andar,
        'sala' => $sala
        ];
}

echo json_encode($eventos);