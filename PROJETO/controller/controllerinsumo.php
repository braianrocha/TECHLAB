<?php

// Cria as linhas com os dados do Insumo
function listaInsumo(){
     
//QUERY que será executada no bando de dados
    $query = "SELECT C.ID AS ID ,C.DESCRICAO AS 'DESC' ,C.TIPO_INS_ID AS TIPO_INSUMO_ID , T.DESCRICAO AS DESCTIPO FROM INSUMO AS C LEFT JOIN TIPO_INSUMO AS T ON  C.TIPO_INS_ID = T.ID ORDER BY  C.ID;";
    $resultado = mysqli_query(buscaconexao(),$query);
//Resultado da QUERY executada no bando de dados
    while($insumo = mysqli_fetch_assoc($resultado)){
    // mysqli_fetch_assoc Transforma o resultado do select em um conjunto onde o dado que busta na tabela pode ser referênciado pelo nome da coluna.
        // Cria a LINHA  
        echo "<!-- LINHA DO insumo -->
            <tr>
                
                <td><a href='' title='' class='ls-ico-screen'>".$insumo["DESCTIPO"]."</a></td>
                <td>".$insumo["DESC"]."</td>
                  <td>
                        <button  data-ls-module='modal' data-target='#modalSmall".$insumo['ID']."' class='ls-btn ls-ico-pencil'></button>
                        <button  data-ls-module='modal' data-target='#deletemodalSmall".$insumo['ID']."' class='ls-btn ls-ico-remove'></button>
                            
                        <!-- MODAL PARA EDITAR -->
                          <div class='ls-modal' id='modalSmall".$insumo['ID']."'>
                            <div class='ls-modal-small'>
                              <div class='ls-modal-header'>
                                <button data-dismiss='modal'>&times;</button>
                                <h4 class='ls-modal-title'>Editar insumo</h4>
                                </div>
                                <div class='ls-modal-body'>
                                    <form action='controller/editarInsumo.php'  method='post' class='ls-form row' >
                                        <label class='ls-label col-md-11'>
                                                <b class='ls-label-text'>Insumo: </b>
                                                <input type='text'  name='DESC' placeholder='' required  value='".$insumo['DESC']."'>
                                                <input type='hidden' name='ID' placeholder='' required  value='".$insumo['ID']."'>
                                        </label>
                                        <label class='ls-label col-md-11' id='filtrar'>
                                            <b class='ls-label-text'>Tipo do Insumo:</b>
                                                <div class='ls-custom-select ls-fiel-md'>
                                                  <select name='listaInsumoModal' class='ls-select'>".listaInsumo2($insumo["TIPO_INSUMO_ID"])."</select>
                                                </div>  
                                        </label>
                                        <div class='ls-modal-footer'>
                                              <button class='ls-btn-dark ls-float-right ls-ico-close' data-dismiss='modal' style='margin: 3px;'>Cancelar</button>
                                              <button type='submit' class='ls-btn-dark ls-ico-checkmark' style='margin: 3px;'>Salvar</button>   
                                        </div>
                                    </form>
                              </div>
                            </div>
                          </div>    
                          <!-- MODAL PARA DELETAR -->
                          <div class='ls-modal' id='deletemodalSmall".$insumo['ID']."'>
                            <div class='ls-modal-small'>
                              <div class='ls-modal-header'>
                                <button data-dismiss='modal'>&times;</button>
                                <h4 class='ls-modal-title'>Excluir Insumo</h4>
                              </div>
                              <div class='ls-modal-body'>
                                 <form action='controller/excluirInsumo.php'  method='post' class='ls-form-inline row' >
                                  <input type='hidden' name='ID' placeholder='' required  value='".$insumo['ID']."'>
                                <p><h3>Confirma exclusão do registro? 
                                <br><br><center><p style='color: red; font-size:20px'>".$insumo["DESC"]."</p></h3></center>
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
             </tr>  "; 
        
    }
 
}

//FUNÇÂO PARA LISTAR OS TIPOS DE INSUMO
function listaTipoInsumo(){
    $query = "select * from TIPO_INSUMO";
    $resultado = mysqli_query(buscaconexao(),$query);
    while($tipoInsumo = mysqli_fetch_assoc($resultado)){
          echo"<option value='".$tipoInsumo["ID"]."'>".$tipoInsumo["DESCRICAO"]."</option>";
    }
    
}

//FUNÇÂO PARA LISTAR OS TIPOS DE INSUMO NOS CAMPOS DE SELEÇÃO 
function listaInsumo2($idSelecionado){
    $op="";
    $query2 = "select * from TIPO_INSUMO";
    $resultado2 = mysqli_query(buscaconexao(),$query2);
    while($tipoInsumo2 = mysqli_fetch_assoc($resultado2)){
        if($idSelecionado==$tipoInsumo2["ID"] ) {
            $op .= "<option selected value='".$tipoInsumo2["ID"]."'>".$tipoInsumo2["DESCRICAO"]."</option>";
        }else{
            $op .= "<option value='".$tipoInsumo2["ID"]."'>".$tipoInsumo2["DESCRICAO"]."</option>";
        }
        
    }
    return $op;
    
}
