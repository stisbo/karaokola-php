        <?php
                         
                        include("../conexion.php");

                            
                                 $usuario= $_POST["usuario"];  $password= $_POST["password"];  $rol= $_POST["rol"];  $sql= "  INSERT INTO tblUsuarios (usuario,password,rol) VALUES ('$usuario','$password','$rol')" ; 
                                $query=sqlsrv_query($con,$sql);

                                if($query){
                                        
                                        echo 1;   
                                }else{
                                    echo 2;
                                }
                            

                                
                        ?>
                        