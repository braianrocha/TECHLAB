<?php

if (empty($_SESSION['msg'])) {
//require_once('./adminphp/sessao.php');     
} else {

    $msg = $_SESSION['msg'];

    switch ($msg) {

        default :
            break;

        case "0":
            break;

        case "MSG01" :
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>[nome_do_campo] é obrigatório.</div>";
            break;

        case "MSG02" :
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>	E-mail e/ou Senha inválidos. </div>";
            break;

        case "MSG03":
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>E-mail inválido. Os endereços de e-mail devem seguir o padrão xx@xx.xx.</div>";
            break;

        case "MSG04" :
            echo "<div id='alerta-msg' class='ls-alert-success'><center><strong>Sucesso!</strong> Registro gravado com sucesso.</div> ";
            break;

        case "MSG05":
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>Confirma exclusão do registro? Essa operação não pode ser desfeita.</div>";
            break;

        case "MSG06" :
            echo "<div id='alerta-msg' class='ls-alert-success'><center><strong>Sucesso!</strong> Registro excluído com sucesso. </div> ";
            break;

        case "MSG07":
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>Não foram encontrados registros para os dados informados.</div>";
            break;

        case "MSG08":
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>Já existe um usuário cadastrado com os dados informados.</div>";
            break;

        case "MSG09":
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>E-mail não cadastrado.</div>";
            break;

        case "MSG10":
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>Cadastro pendente de aprovação.</div>";
            break;

        case "MSG11":
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>Foi gerada uma solicitação de acesso ao Administrador do sistema. Aguarde aprovação para ter o acesso liberado.</div>";
            break;

        case "MSG12":
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>[nome_do_insumo] já cadastrado no sistema.</div>";
            break;

        case "MSG13":
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>Senha deverá conter no minimo 4 caracteres.</div>";
            break;

        case "MSG14" :
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>Campo de nova senha e confirmar nova senha devem ser iguais.</div>";
            break;

        case "MSG15" :
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>E-mail e/ou Senha inválidos.</div>";
            break;

        case "MSG16" :
            echo "<div  id='alerta-msg' class='ls-alert-success'><center><strong>Sucesso!</strong> Senha alterada com sucesso!</div> ";
            break;

        case "MSG17" :
            echo "<div id='alerta-msg' class='ls-alert-success'><center><strong>Solicitação finalizada com sucesso.</div> ";
            break;

        case "MSG18" :
            echo "<div id='alerta-msg' class='ls-alert-danger'><center><strong>Não existe laboratório disponível para esse dia.</div> ";
            break;

        case "MSG19" :
            echo "<div id='alerta-msg' class='ls-alert-warning'><center> Enviamos um link para redefinição de senha no email xyz****@gmail.com. Verifique sua caixa de entrada ou de spam.</div>";
            break;



        case "MSG22" :
            echo "<div id='alerta-msg' class='ls-alert-success'><center>Agendamento de laboratório cancelado com sucesso.</div>";
            break;

        case "MSG23" :
            echo "<div id='alerta-msg' class='ls-alert-danger'><center> Senha incorreta.</div>";
            break;

        case "MSG24" :
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>O Email e/ou CPF cadastrado está incorreto.</div>";
            break;

        case "MSG25" :
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>CPF inválido. msg</div>";
            break;


        case "MSG99" :
            echo "<div id='alerta-msg' class='ls-alert-danger'><center>DESLOGADO COM SUCESSO !!</div>";
            break;


        // ========================================= MENSAGENS DOS PARÂMETROS GERAIS===========================================================

        case "ANTMIN" :
            $query = "SELECT AG_ADIANT_MIN FROM PARAM_GERAIS";
            $resultado = mysqli_query(buscaconexao(), $query);
            $resultado = mysqli_fetch_array($resultado);
            $resultado['AG_ADIANT_MIN'];
            echo "<div id='alerta-msg' class='ls-alert-danger'><center><b>Agendamento não efetuado ! </b><br>Tempo de antecedência minima para agendamento é de " . $resultado['AG_ADIANT_MIN'] . " dias.</div>";
            break;
    
    
            case "ANTMAX" :
            $query = "SELECT AG_ADIANT_MAX FROM PARAM_GERAIS";
            $resultado = mysqli_query(buscaconexao(), $query);
            $resultado = mysqli_fetch_array($resultado);
            $resultado['AG_ADIANT_MAX'];
            echo "<div id='alerta-msg' class='ls-alert-danger'><center><b>Agendamento não efetuado ! </b><br>Tempo de antecedência máxima para agendamento é de " . $resultado['AG_ADIANT_MAX'] . " dias.</div>";
            break;
        
        
        
            case "MAXAGDIA" :
            $query = "SELECT AG_MAX_DIA FROM PARAM_GERAIS";
            $resultado = mysqli_query(buscaconexao(), $query);
            $resultado = mysqli_fetch_array($resultado);
            $resultado['AG_MAX_DIA'];
            echo "<div id='alerta-msg' class='ls-alert-danger'><center><b>Agendamento não efetuado ! </b><br>O maximo de agendamentos por dia é de " . $resultado['AG_MAX_DIA'] . " agendamentos.</div>";
            break;
        
        
            case "MAXAGSIMU" :
            $query = "SELECT AG_MAX_SIMULT FROM PARAM_GERAIS";
            $resultado = mysqli_query(buscaconexao(), $query);
            $resultado = mysqli_fetch_array($resultado);
            $resultado['AG_MAX_SIMULT'];
            echo "<div id='alerta-msg' class='ls-alert-danger'><center><b>Agendamento não efetuado ! </b><br>O maximo de agendamentos simultâneos é de " . $resultado['AG_MAX_SIMULT'] . " agendamentos.</div>";
            break;
        
            case "AGENDUPLO" :
            echo "<div id='alerta-msg' class='ls-alert-danger'><center><b>Agendamento não efetuado ! </b><br>Já existe um agendamento para esse laboratório nessa data e horário.</div>";
            break;
        
            case "MSG21" :
            echo "<div id='alerta-msg' class='ls-alert-success'><center>Agendamento de laboratório realizado com sucesso.</div>";
            break;
    }



    $_SESSION['msg'] = "0";
    $msg = "0";

    unset($_SESSION['msg']);
}
?>
