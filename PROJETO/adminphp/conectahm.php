<?php 
define('HOST','localhost');
define('USUARIO','TECHLAB');
define('SENHA','123456');
define('DB','sisal_hm');



//Cria conexão com banco de dados
$conexao = mysqli_connect(HOST, USUARIO ,SENHA , DB) or die ('Sem conexão');

//$conexao = mysqli_connect("basemapeamento.mysql.dbaas.com.br", "basemapeamento", "A2000pwd", "basemapeamento");


//Função que retorna conexão com banco de dados
function buscaconexao(){
$conexao = mysqli_connect(HOST, USUARIO ,SENHA , DB) or die ('Sem conexão');

return $conexao;
}

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DB . ';', USUARIO, SENHA);

//basemapeamento.mysql.dbaas.com.br