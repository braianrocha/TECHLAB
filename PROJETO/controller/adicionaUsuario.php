<?php
// Adiciona o arquivo de verificação
require_once('../adminphp/verificausuario.php');
// Adiciona o arquivo de conexão
require_once('../adminphp/conecta.php');





  // Recebe os parametros do formulário
  $nome = mysqli_real_escape_string($conexao,$_POST['nome']);
  $email = mysqli_real_escape_string($conexao,$_POST['email']);
  $cpf = mysqli_real_escape_string($conexao,$_POST['cpf']);
  $perfil = mysqli_real_escape_string($conexao,$_POST['perfil']);
  if($perfil!="Selecione"){
  if($perfil=="Ativos"){
    $perfil="1";
  }else{
    $perfil="0";
  }}
  $password = mysqli_real_escape_string($conexao,$_POST['password']);
  $con_password = mysqli_real_escape_string($conexao,$_POST['con_password']);
  $turno = mysqli_real_escape_string($conexao,$_POST['turno']);
  if($perfil!="Selecione"){
  if($turno=="Noite"){
    $turno="2";
  }else{
    $turno="1";
  }}
  $reservar = mysqli_real_escape_string($conexao,$_POST['reservar']);
  if($reservar=="true"){
    $reservar="1";
  }else{
    $reservar="0";
  }
//Aqui é verificado se a permissão de reserva será concedida

$camposValidos=0;
if(validacaoNome($nome)){$camposValidos++;}
 if(validacaoEmail($email)){$camposValidos++;}
 if(validacaoCPF($cpf)){$camposValidos++;}
  if(validacaoPerfil($perfil)){$camposValidos++;}
  if(validacaoSenha($password,$con_password)){$camposValidos++;}
  if(validacaoTurno($turno)){$camposValidos++;}
  if(validacaoReserva($reservar)){$camposValidos++;}

  $sql="select * from USUARIO where (CPF='$cpf' or email='$email');";
              $res=mysqli_query($conexao,$sql);
              if (mysqli_num_rows($res) > 0) {
              // output data of each row
              $row = mysqli_fetch_assoc($res);
              if ($cpf==$row['CPF'])
              {
                  alertaErro("MSG31");
              }
              elseif($email==$row['EMAIL'])
              {
                  alertaErro("MSG30");
              }
}

//INSERT INTO USUARIO (NOME,CPF,EMAIL,RESERVA,SENHA,PERIODO_ID,PERFIL_ID) VALUES ('jose' , '10718449655', 'email@mail', '1', 'asdfasdf', '1', '1');
  if($camposValidos==7){
    echo "Funfou os campos <BR>";
    // QUERY que será executada no bando de dados
    $query = "INSERT INTO USUARIO (NOME,CPF,EMAIL,RESERVA,SENHA,PERIODO_ID,PERFIL_ID) VALUES ('$nome' , '$cpf', '$email', '$reservar', '$password', '$turno', '$perfil');";

    $select=mysqli_query($conexao,$query);

    if($select){
        // Se adicionou redireciona para pagina com a mensagem da sucesso.
        $_SESSION['msg'] = "MSG04";
        header('Location: ../usuarios.php');
        die();
    }
  }
  //alertaErro(nome+"<br>"+email+"<br>"+cpf+"<br>"+perfil+"<br>"+senha1+"<br>"+senha2+"<br>"+turmo+"<br>"+permisaoReserva+"<br>");














  function validacaoNome($nome) {
if(preg_match("/^([a-zA-Z' ]+)$/",$nome)) {
      return (true);
    }else{
      alertaErro("MSG29");return (false);
    }
  }


  function validacaoEmail($email) {
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
       return (true);
     }else{

       alertaErro("MSG24");return (false);
     }
  }

  function validacaoCPF($cpf) {
    preg_match_all('!\d+!', $cpf, $matches);
    $number = implode('', $matches[0]);
    //Converte string para somente numeros e dps para string dnv
      if(strlen ($number)==11){
        return (true);
      }else{
        alertaErro("MSG25");return (false);
      }
  }

  function validacaoPerfil($perfil){
    if($perfil=="1" || $perfil=="0"){
      return (true);
    }else{
      alertaErro("MSG26");return (false);
    }
  }

  function validacaoSenha($senha1,$senha2){
    if($senha1!="" && $senha1!=null && strlen($senha1)>4){
      if($senha1==$senha2){
        return (true);
      }else{
        alertaErro("MSG13");return (false);
      }
    }else{
      alertaErro("MSG14");return (false);
    }
  }

  function validacaoTurno($turno){
    if($turno=="1" || $turno=="0"){
      return (true);
    }else{
    alertaErro("MSG27");  return (false);
    }
  }

  function validacaoReserva($permisaoReserva){
    if($permisaoReserva=="1" || $permisaoReserva=="0"){
      return (true);
    }else{
      alertaErro("MSG28");return (false);
    }
  }

  function alertaErro ($mensagem){
    // Se não adicionou redireciona para pagina com a mensagem do erro.
    $_SESSION['msg'] = $mensagem ;
    header('Location: ../usuarios.php');
    die();
  }




















// // Verificando se adicionou
// if($select){
//     // Se adicionou redireciona para pagina com a mensagem da sucesso.
//     $_SESSION['msg'] = "MSG04";
//     header('Location: ../cursos.php');
//     die();
// }
?>
