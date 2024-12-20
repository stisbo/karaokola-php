        
      <?php
                
                include("../conexion.php");
                $texto=$_POST['texto'];
                $start_from=$_POST['start'];
                $search_in_sql="";
                if(!empty($texto)){
                    $search_in_sql=" WHERE (usuario like '%".$texto."%'  OR password like '%".$texto."%'  OR rol like '%".$texto."%' )";
                }
                $sql=" SELECT * FROM tblUsuarios $search_in_sql ORDER BY idUsuario DESC offset $start_from ROWS FETCH NEXT 10 ROWS ONLY";
                $query=sqlsrv_query($con,$sql);      
                $count_row=sqlsrv_has_rows($query);
                if($count_row===false){
                    echo "<div style='text-align:center'><h2>Lista de Usuarios vacia!</h2></div>";
                }else{       

                    $resultado="<div >
                    <table style='text-align:center' class='table table-hover'>
                            <tr>
                                <th>
                                    Información      
                                </th>
                                  
                                    <th>
                                        rol
                                    </th>
                                
                                <th>
                                    Opciones
                                </th>
                            </tr>
                    ";

                $t=time();
                while($row=sqlsrv_fetch_array($query)){ 

                    $id=$row['idUsuario'];
                    $expand="expand";
                    $sector="sector".$id;
                      $url="";  
                    $otro="    
                                    <div id='sector".$id."' class='email' onclick='this.classList.add(\"$expand\")'>
                                        <div class='from'>
                                            <div class='from-contents'>
                                            <div class='avatar me' style='background-image: url($url)'></div>
                                            <div class='name'>".$row['usuario']."</div>
                                            </div>
                                        </div>
                                        <div class='to'>
                                            <div class='to-contents'>
                                            <div class='top'>
                                                <div class='avatar-large me' style='background-image: url()'></div>
                                                <div class='name-large'>".$row['usuario']."</div>
                                                <div class='x-touch' onclick='document.getElementById(\"$sector\").classList.remove(\"$expand\");event.stopPropagation();'>
                                                <div class='x'>
                                                    <div class='line1'></div>
                                                    <div class='line2'></div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class='bottom'>
                                                <div class='row2'>

                                                        

                                                        <div class='table-responsive'>
                                                                <table style='margin:5px auto; width: 85%; border-collapse: separate;border:hidden;' class='table tdstyle' border='1' >  
                                                                                 
                                    <tr>
                                        <td >Usuario</td>
                                        <td >".$row["usuario"]."</td>
                                    </tr>
                             
                                    <tr>
                                        <td >Password</td>
                                        <td >".$row["password"]."</td>
                                    </tr>
                             
                                    <tr>
                                        <td >Rol</td>
                                        <td >".$row["rol"]."</td>
                                    </tr>
                                                                                                        
                                                                </table>  
                                                            </div> 
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    ";


                    $resultado.=" <tr style='cursor:pointer'>
                                            <td>
                                                ".$otro."
                                            </td>
                                            
                                    <td>                                    
                                        " . $row["rol"] . "
                                    </td>
                                
                                            <td>
                                                <button class='btn btn-danger' data-toggle='modal' data-target='#modal_eliminar_usuarios' data-id='".$row['idUsuario']."'> <i class='fas fa-trash'></i></button>
                                                <button class='btn btn-primary' onclick='edit_usuarios(".$row['idUsuario'].")'> <i class='fas fa-edit'></i></button>
                                            </td>
                                      </tr>
                            ";

                    }

                    $resultado.="
                                </table>
                            </div>
                            
                    ";
    
                    echo $resultado;          
            }

        ?>
