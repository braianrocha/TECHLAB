<?php 
// Adiciona o arquivo de conexão
require_once ('./adminphp/conecta.php');

function buscaAgendamento(){
$query = "SELECT * FROM AGENDAMENTO
          INNER JOIN LABORATORIO LAB ON AGENDAMENTO.LABORATORIO_ID = LAB.ID
          WHERE USUARIO_ID =".$_SESSION['PERFIL'];

$resultado = mysqli_query(buscaconexao(),$query);
    $evento ="[";
    while($agendamento = mysqli_fetch_assoc($resultado)){

            $ID = $agendamento['ID'];
            $TITLE = $agendamento['DESCRICAO']."  ".$agendamento['SALA'];

            $COR = "#CECECE";
            $START = $agendamento['DATA_AG'];
            $END = $agendamento['DATA_AG'];
            
            $evento .= "
              {
                        id:'$ID',
                        title:'$TITLE',
                        color:'$COR ',
                        start:'$START',
                        end:'$END'
              }
          ,";
    }
    $evento = substr($evento,0,-1);
    $evento .="]";
    return $evento;
    
}


 
    

  ?>