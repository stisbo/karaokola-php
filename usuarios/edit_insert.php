        <?php  
                                
                                include("../conexion.php");
                                $id= $_POST["idUsuarios"];  
                                
                                 $usuario= $_POST["usuario"];  $password= $_POST["password"];  $rol= $_POST["rol"];  $update=" UPDATE tblUsuarios set  usuario = '$usuario' , password = '$password' , rol = '$rol'  WHERE idUsuarios=$id " ; 
                                
                                    $query=sqlsrv_query($con,$update);
                                    if($query){ 
                                        
                                        

                                        echo 1;
                                    }else{
                                        echo 2;
                                    }
                                

                            ?>