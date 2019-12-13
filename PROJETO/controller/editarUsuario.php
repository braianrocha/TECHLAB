<?php
// Adiciona o arquivo de verificação
require_once('../adminphp/verificausuario.php');
// Adiciona o arquivo de conexão
require_once('../adminphp/conecta.php');
$id=$_REQUEST['id'];
$action=$_REQUEST['action'];
$reserva=$_REQUEST['reserva'];

if($action=="editar"){
  //QUERY que será executada no bando de dados para atualizar os dados
$queryUpdate = "UPDATE USUARIO SET RESERVA = '$reserva' WHERE ID = '$id'";
$select=mysqli_query($conexao, $queryUpdate);
//REDIRECIONA APOS ATUALIZAR DADOS
if($select){
    // Se ATUALIZOU redireciona para pagina com a mensagem da sucesso.
    $_SESSION['msg'] = "MSG32";
}else{
  $_SESSION['msg'] = "MSG34";
}
header('Location: ../usuarios.php');
die();
}

if($action=="deletar"){
//QUERY que será executada no bando de dados para atualizar os dados
$queryUpdate = "DELETE FROM USUARIO WHERE ID = '$id'";
$select=mysqli_query($conexao, $queryUpdate);
//REDIRECIONA APOS ATUALIZAR DADOS
if($select){
    // Se DELETOU redireciona para pagina com a mensagem da sucesso.
    $_SESSION['msg'] = "MSG33";

}else{
  $_SESSION['msg'] = "MSG34";
}
header('Location: ../usuarios.php');
die();
}


function checarAlteracao(){
  // Recebe os parametros do formulário
  $perfil = mysqli_real_escape_string($conexao,$_POST['perfil']);
  if($perfil!="Selecione"){
  if($perfil=="Ativos"){
    $perfil="1";
  }else{
    $perfil="0";
  }}
  $reservar = mysqli_real_escape_string($conexao,$_POST['reservar']);
  if($reservar=="true"){
    $reservar="1";
  }else{
    $reservar="0";
  }
//Aqui é verificado se a permissão de reserva será concedida

$camposValidos=0;
  if(validacaoPerfil($perfil)){$camposValidos++;}
  if(validacaoReserva($reservar)){$camposValidos++;}



//INSERT INTO USUARIO (NOME,CPF,EMAIL,RESERVA,SENHA,PERIODO_ID,PERFIL_ID) VALUES ('jose' , '10718449655', 'email@mail', '1', 'asdfasdf', '1', '1');
  if($camposValidos==2){
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
}
  //alertaErro(nome+"<br>"+email+"<br>"+cpf+"<br>"+perfil+"<br>"+senha1+"<br>"+senha2+"<br>"+turmo+"<br>"+permisaoReserva+"<br>");















  function validacaoPerfil($perfil){
    if($perfil=="1" || $perfil=="0"){
      return (true);
    }else{
      alertaErro("MSG26");return (false);
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
