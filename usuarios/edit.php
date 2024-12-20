        <?php
                         
                        include("../conexion.php");
                        $id = $_POST["id"];
                        $sql= "SELECT * FROM tblUsuarios WHERE idUsuarios='$id' " ;
                    $query=sqlsrv_query($con,$sql);
                    $row=sqlsrv_fetch_array($query);

     $usuario=$row["usuario"];  $password=$row["password"];  $rol=$row["rol"]; 
                        $t=time();

                       ?>
                        
                       <form style="padding:10px" id="edit_usuarios">
                            <input type="hidden" name="idUsuarios" value="<?php echo $id;?>">       
                            <div class="row g-3 align-items-center">
                                <div class="" style="margin:30px auto">
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                    <button type="button" onclick="listar_usuarios(1)" class="btn btn-danger">Volver</button>
                                </div>
                            </div>
                            
                            <div class="row g-3 align-items-center">
                                                <div class="col-2">
                                                    <label class="col-form-label">Usuario</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" name="usuario" required  autocomplete="off"  class="form-control" placeholder="Escriba..." required value="<?php echo $usuario?>">
                                                </div>
                                            </div><br><div class="row g-3 align-items-center">
                                                <div class="col-2">
                                                    <label class="col-form-label">Password</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" name="password" required  autocomplete="off"  class="form-control" placeholder="Escriba..." required value="<?php echo $password?>">
                                                </div>
                                            </div><br> <div class="row g-3 align-items-center">
                                            <div class="col-2">
                                                <label class="col-form-label">Rol</label>
                                            </div>
                                                <div class="col-9">
                                                        <select class="form-control" name="rol"> 
                                                                <?php                                                             
                                                                if($rol=='admin'){
                                                                                       echo " <option value='admin' selected='selected'>admin</option> ";
                                                                                    }else{
                                                                                       echo " <option value='admin' >admin</option> ";
                                                                                    }
                                                                                  
                                                                                if($rol=='operador'){
                                                                                       echo " <option value='operador' selected='selected'>operador</option> ";
                                                                                    }else{
                                                                                       echo " <option value='operador' >operador</option> ";
                                                                                    }
                                                                                  
                                                                                   ?>
                                                        </select>
                                                </div>
                                    </div><br>
                        </form>

    