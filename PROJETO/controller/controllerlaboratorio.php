<?php



// Cria as linhas com os dados do laboratorio
function listaLaboratorio(){
    
    
//QUERY que será executada no bando de dados
    $query = "SELECT C.ID AS ID ,C.DESCRICAO AS 'DESC' ,C.SALA AS SALA, C.ANDAR AS ANDAR, C.TIPO_LAB_ID AS TIPO_LABORATORIO_ID , T.DESCRICAO AS DESCTIPO "
            . "FROM LABORATORIO AS C INNER JOIN TIPO_LABORATORIO AS T ON  C.TIPO_LAB_ID = T.ID    ORDER BY  C.ID;";
    $resultado = mysqli_query(buscaconexao(),$query);
    
//Resultado da QUERY executada no bando de dados
    while($laboratorio = mysqli_fetch_assoc($resultado)){
      
    // mysqli_fetch_assoc Transforma o resultado do select em um conjunto onde o dado que busta na tabela pode ser referênciado pelo nome da coluna.
        // Cria a LINHA  
   if($_SESSION['PERFIL'] == 1){ 
        echo "<!-- LINHA DO LABORATORIO -->
            <tr>
                <td><a href='' title='' class='ls-ico-screen'>".$laboratorio["DESCTIPO"]."</a></td>
                <td>".$laboratorio["DESC"]."</td>
                <td>".$laboratorio["SALA"]."</td>
                <td>".$laboratorio["ANDAR"]."</td>
                  <td><form action='editarLaboratorio.php'  method='POST' class='ls-form-inline row' >
<input type='hidden' name='ID' placeholder='' required  value='".$laboratorio['ID']."'>                         
<button  type='submit' class='ls-btn ls-ico-pencil'></button>
                      <form>
                        <button  data-ls-module='modal' data-target='#deletemodalSmall".$laboratorio['ID']."' class='ls-btn ls-ico-remove'></button>
   
   
                          <!-- MODAL PARA DELETAR -->
                          <div class='ls-modal' id='deletemodalSmall".$laboratorio['ID']."'>
                            <div class='ls-modal-small'>
                              <div class='ls-modal-header'>
                                <button data-dismiss='modal'>&times;</button>
                                <h4 class='ls-modal-title'>Excluir curso</h4>
                              </div>
                              <div class='ls-modal-body'>
                                 <form action='controller/excluirLaboratorio.php'  method='post' class='ls-form-inline row' >
                                  <input type='hidden' name='ID' placeholder='' required  value='".$laboratorio['ID']."'> 
                                <p><h3>Confirma exclusão do registro? 
                                <br><br><center><p style='color: red; font-size:20px'>".$laboratorio["DESC"]."</p></h3></center>
                                  <br><p> Essa operação não pode ser desfeita.</p>
                              </div>
                              <div class='ls-modal-footer'>
                                
                                <button type='submit' class='ls-btn-primary-danger ls-ico-remove'>Excluir</button>
</form>                              

                              
<button class='ls-btn-dark ls-float-right ls-ico-close' data-dismiss='modal'>Fechar</button>
                                 </div>
                            </div>
                          </div>
                    </td>
             </tr> ";    
        
    }else{
        echo "<!-- LINHA DO LABORATORIO -->
            <tr>
                <td><a href='' title='' class='ls-ico-screen'>".$laboratorio["DESCTIPO"]."</a></td>
                <td>".$laboratorio["DESC"]."</td>
                <td>".$laboratorio["SALA"]."</td>
                <td>".$laboratorio["ANDAR"]."</td>
                  <td><form action='editarLaboratorio.php'  method='POST' class='ls-form-inline row' >
<input type='hidden' name='ID' placeholder='' required  value='".$laboratorio['ID']."'>                         
<button  type='submit' class='ls-btn ls-ico-eye'></button>
                      
</form>                              

                                 </div>
                            </div>
                          </div>
                    </td>
             </tr> "; 
    }
    }
  }
 
function ListaMultipla($idLAB){
  $op="";
  $queryinsumo = "SELECT ID , DESCRICAO FROM INSUMO";
  $queryinsumo = mysqli_query(buscaconexao(),$queryinsumo);

  while($selec = mysqli_fetch_assoc($queryinsumo)){

        $query2 = "SELECT COUNT(*) AS CONT FROM INSUMO_LAB WHERE LABORATORIO_ID = ".$idLAB." AND INSUMO_ID = ".$selec["ID"].";";
        $resultado2 = mysqli_query(buscaconexao(),$query2);
        $resultado2 = mysqli_fetch_assoc($resultado2);
            if($resultado2['CONT'] > 0){
                $op .= "<option value='".$selec["ID"]."' selected >".$selec["DESCRICAO"]."</option>";
            }else{
                $op .= "<option value='".$selec["ID"]."' >".$selec["DESCRICAO"]."</option>";
            }
        
     
      
    
  }
  return $op;
  
}
  
  
function listaInsumo2($idSelecionado2){
  $op="";
  $query2 = "select * from INSUMO";
  $resultado2 = mysqli_query(buscaconexao(),$query2);
  while($insumo2 = mysqli_fetch_assoc($resultado2)){
      if($idSelecionado2==$insumo2["ID"] ) {
          $op .= "<option selected value='".$insumo2["ID"]."'>".$insumo2["DESCRICAO"]."</option>";
      }else{
          $op .= "<option value='".$insumo2["ID"]."'>".$insumo2["DESCRICAO"]."</option>";
      }
      
  }
  return $op;
  
}


//FUNÇÂO PARA LISTAR OS TIPOS DE LABORATORIO
function listaTipoLaboratorio(){
    $query = "select * from TIPO_LABORATORIO";
    $resultado = mysqli_query(buscaconexao(),$query);
    while($tipoLaboratorio = mysqli_fetch_assoc($resultado)){
          echo"<option value='".$tipoLaboratorio["ID"]."'>".$tipoLaboratorio["DESCRICAO"]."</option>";
    }
}





//FUNÇÂO PARA LISTAR OS TIPOS DE INSUMOS
function listaTipoInsumo(){
    $query = "select * from TIPO_INSUMO";
    $resultado = mysqli_query(buscaconexao(),$query);
    while($tipoInsumo = mysqli_fetch_assoc($resultado)){
          echo"<option value='".$tipoInsumo["ID"]."'>".$tipoInsumo["DESCRICAO"]."</option>";
    }
    
}
//FUNÇÂO PARA LISTAR OS INSUMOS
function listaInsumo(){
    $query = "select * from INSUMO";
    $resultado = mysqli_query(buscaconexao(),$query);
    while($insumo = mysqli_fetch_assoc($resultado)){
          echo"<option value='".$insumo["ID"]."'>".$insumo["DESCRICAO"]."</option>";
    }
    
}


//FUNÇÂO PARA LISTAR OS TIPOS DE CURSO NOS CAMPOS DE SELEÇÃO 
function listaTipoLaboratorio2($idSelecionado){
    $op="";
    $query2 = "SELECT * FROM TIPO_LABORATORIO";
    $resultado2 = mysqli_query(buscaconexao(),$query2);
    while($tipoLaboratorio2 = mysqli_fetch_assoc($resultado2)){
        if($idSelecionado == $tipoLaboratorio2["ID"] ) {
            $op .= "<option selected value='".$tipoLaboratorio2["ID"]."'>".$tipoLaboratorio2["DESCRICAO"]."</option>";
        }else{
            $op .= "<option value='".$tipoLaboratorio2["ID"]."'>".$tipoLaboratorio2["DESCRICAO"]."</option>";
        }
        
    }
    return $op;
    
}

