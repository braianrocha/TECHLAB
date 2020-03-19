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
  $turno = mysqli_real_escape_string($conexao,$_POST['turno']);
if(isset($_POST['agendamento'])){
//Necessário aprovação de Agendamentos?
  $reservar  = 1;    
}else{
  $reservar  = 0;
}
//============== Valida dados inseridos na inclusão de novo usuário =========================//
//========================Alterado por Viviane Santana ======================================//
//================================Em 13/03/2020==============================================//

$queryVerificaCpfUsuario = mysqli_query($conexao, "SELECT USER.CPF FROM USUARIO USER WHERE USER.CPF = ('$cpf');");
$queryVerificaEmailUsuario = mysqli_query($conexao, "SELECT USER.EMAIL FROM USUARIO USER WHERE USER.EMAIL = ('$email');");

$resultadoCpf = mysqli_fetch_assoc($queryVerificaCpfUsuario);
$resultadoEmail = mysqli_fetch_assoc($queryVerificaEmailUsuario);


  if (!empty($resultadoCpf)) {
    if (!empty($resultadoEmail)){
      $_SESSION['msg'] = "MSG28"; //Cadastro de Usuário não efetuado ! Já existe um usuário com o CPF e E-mail informados.
      header('Location: ../usuarios.php');
      die();
    }else{
      $_SESSION['msg'] = "MSG26"; //Cadastro de Usuário não efetuado ! Já existe um usuário com o CPF informado.
      header('Location: ../usuarios.php');
      die();
    }
  } else if (!empty($resultadoEmail)){
    $_SESSION['msg'] = "MSG27"; //Cadastro de Usuário não efetuado ! Já existe um usuário com o E-mail informado.
    header('Location: ../usuarios.php');
    die();
  } else {		
    $password = md5($cpf);
    // QUERY que será executada no bando de dados
    $query = "INSERT INTO USUARIO (NOME,CPF,EMAIL,RESERVA,SENHA,PERIODO_ID,PERFIL_ID) VALUES "
            . "('$nome' , '$cpf', '$email', '$reservar', '$password', '$turno', '$perfil');";

    $select=mysqli_query($conexao,$query);

    if($select){
        // Se adicionou redireciona para pagina com a mensagem da sucesso.
        $_SESSION['msg'] = "MSG04";
        header('Location: ../usuarios.php');
        die();
    }
  }

  //alertaErro(nome+"<br>"+email+"<br>"+cpf+"<br>"+perfil+"<br>"+senha1+"<br>"+senha2+"<br>"+turmo+"<br>"+permisaoReserva+"<br>");



  
//
//
//
//
//
//
//
//
//
//
//
//
//
//  function validacaoNome($nome) {
//if(preg_match("/^([a-zA-Z' ]+)$/",$nome)) {
//      return (true);
//    }else{
//      alertaErro("MSG29");return (false);
//    }
//  }
//
//
//  function validacaoEmail($email) {
//if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//       return (true);
//     }else{
//
//       alertaErro("MSG24");return (false);
//     }
//  }
//
//
//
//
//  function alertaErro ($mensagem){
//    // Se não adicionou redireciona para pagina com a mensagem do erro.
//    $_SESSION['msg'] = $mensagem ;
//    header('Location: ../usuarios.php');
//    die();
//  }
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


// // Verificando se adicionou
// if($select){
//     // Se adicionou redireciona para pagina com a mensagem da sucesso.
//     $_SESSION['msg'] = "MSG04";
//     header('Location: ../cursos.php');
//     die();
// }
?>
