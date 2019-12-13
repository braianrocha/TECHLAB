<?php


// Cria as linhas com os dados do Usuario
function listaModal($resultado){
    
    
//QUERY que será executada no bando de dados
//    $query = "SELECT PERI.ID  AS PERIID , PERFIL.ID AS PERFILID , USER.ID , USER.NOME , USER.EMAIL , USER.RESERVA , PERI.DESCRICAO AS DESCRIPERIODO , PERFIL.DESCRICAO AS DESCRIPERFIL FROM USUARIO USER
//INNER JOIN PERIODO PERI ON PERI.ID = USER.PERIODO_ID
//INNER JOIN PERFIL  ON PERFIL.ID = USER.PERFIL_ID ORDER BY USER.ID";
//    
//$resultado = mysqli_query(buscaconexao(),$query);
//Resultado da QUERY executada no bando de dados
    while($Usuario = mysqli_fetch_assoc($resultado)){
    // mysqli_fetch_assoc Transforma o resultado do select em um conjunto onde o dado que busta na tabela pode ser referênciado pelo nome da coluna.
        // Cria a LINHA  
        if($Usuario['RESERVA']==1){
            $reservar = "<div class='ls-label col-md-12 col-xs-12'>
                          <p class='ls-label-text'>Pode reservar?</p>
                          <label class='ls-label-text'>
                            <input type='radio' checked name='plataforms' class='ls-field-radio'>
                            Sim
                          </label>
                          <label class='ls-label-text'>
                            <input type='radio'  name='plataforms' class='ls-field-radio'>
                            Não
                          </label>
                          </div> </fieldset>";
        }else{
                        $reservar = "<div class='ls-label col-md-12 col-xs-12'>
                          <p class='ls-label-text'>Pode reservar?</p>
                          <label class='ls-label-text'>
                            <input type='radio'  name='plataforms' class='ls-field-radio'>
                            Sim
                          </label>
                          <label class='ls-label-text'>
                            <input type='radio'  checked name='plataforms' class='ls-field-radio'>
                            Não
                          </label>
                          </div> </fieldset>";
        }
        echo " <!--Modal de edição/exclusão-->

      
      <div class='ls-modal' id='modaledicao".$Usuario['ID']."'>
        <div class='ls-modal-small'>
          <div class='ls-modal-header'>
             <h4 id='titulomodal' class='ls-modal-title'>Editar usuário</h4>
          </div>
          <div class='ls-modal-body'>
              <form id='' action='' class='ls-form row'>
                  <fieldset>
                    <label class='ls-label col-md-12 col-xs-12'>
                      <b class='ls-label-text'>Nome*</b>
                      <input type='text' name='NOME' value='".$Usuario['NOME']."' placeholder='Digite seu nome' class='ls-field' required>
                    </label>
                    <label class='ls-label col-md-12 col-xs-12'>
                      <b class='ls-label-text'>E-mail*</b>
                        <input type='text' name='EMAIL' value='".$Usuario['EMAIL']."' placeholder='Digite seu e-mail' class='ls-field' required> </label>          
                  </fieldset>
                  
                  <fieldset>

                                       
                            <label class='ls-label col-md-12 col-xs-12'>
                              <b class='ls-label-text'>Perfil</b>
                              <div class='ls-custom-select'>
                                <select name='PERFIL' class='ls-select'>
                                ".listaTipoUsuario2($Usuario['PERFILID'])."
                                </select>
                              </div>
                            </label>                
                  </fieldset>
        

        
                      <fieldset>
                         <label class='ls-label col-md-12 col-xs-12'>
                             <b class='ls-label-text'>Período de aula</b>
                             <div class='ls-custom-select'>
                               <select name='PERIODO' class='ls-select'>
                        ".listaTipoPeriodo($Usuario['PERIID'])."
                               </select>
                             </div>
                           </label>               
                        ". $reservar ."              
                               
              </form>
          </div>
          <div class='ls-modal-footer'>
            <div id='botoes-edicao'>
              <button type='submit' class='ls-btn-primary'>Salvar</button>
              <button class='ls-btn-primary'>Excluir</button>
              <button class='ls-btn-primary' data-dismiss='modal'>Cancelar</button>             
            </div>
          </div>
        </div>
      </div>
";    
        
    }
 
}


//FUNÇÂO PARA LISTAR OS TIPOS DE Usuario
function listaTipoUsuario(){
    $query = "select * from TIPO_Usuario";
    $resultado = mysqli_query(buscaconexao(),$query);
    while($tipoUsuario = mysqli_fetch_assoc($resultado)){
          echo"<option value='".$tipoUsuario["TIPO"]."'>".$tipoUsuario["DESCRICAO"]."</option>";
    }
    
}

//FUNÇÂO PARA LISTAR OS TIPOS DE Usuario NOS CAMPOS DE SELEÇÃO 
function listaTipoUsuario2($idSelecionado){
    $op="";
    $query2 = "select * from PERFIL";
    $resultado2 = mysqli_query(buscaconexao(),$query2);
    while($PERFIL = mysqli_fetch_assoc($resultado2)){
        if($idSelecionado==$PERFIL["ID"] ) {
            $op .= "<option selected value='".$PERFIL["ID"]."'>".$PERFIL["DESCRICAO"]."</option>";
        }else{
            $op .= "<option value='".$PERFIL["ID"]."'>".$PERFIL["DESCRICAO"]."</option>";
        }
        
    }
    return $op;
    
}




function listaTipoPeriodoTESTE($idSelecionado,$LISTA){
    $op="";
  //  $query2 = "select * from PERIODO";
   // $resultado2 = mysqli_query(buscaconexao(),$query2);
    $resultado2 = $LISTA;
    while($PERFIL2 = mysqli_fetch_assoc($resultado2)){
        if($idSelecionado==$PERFIL2["ID"] ) {
            $op .= "<option selected value='".$PERFIL2["ID"]."'>".$PERFIL2["DESCRICAO"]."</option>";
        }else{
            $op .= "<option value='".$PERFIL2["ID"]."'>".$PERFIL2["DESCRICAO"]."</option>";
        }
        
    }
    return $op;
    
}

function listaTipoPeriodo($idSelecionado){
    $op="";
    $query2 = "select * from PERIODO";
    $resultado2 = mysqli_query(buscaconexao(),$query2);
    while($PERFIL2 = mysqli_fetch_assoc($resultado2)){
        if($idSelecionado==$PERFIL2["ID"] ) {
            $op .= "<option selected value='".$PERFIL2["ID"]."'>".$PERFIL2["DESCRICAO"]."</option>";
        }else{
            $op .= "<option value='".$PERFIL2["ID"]."'>".$PERFIL2["DESCRICAO"]."</option>";
        }
        
    }
    return $op;
    
}