         <?php
                            include ("../conexion.php");
                    ?>
                
                    <form style="padding:10px" id="add_usuarios">
                        <div class="row g-3 align-items-center">
                                <div class="" style="margin:30px auto">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="button" onclick="listar_usuarios(1)" class="btn btn-danger">Volver</button>
                                </div>
                        </div>
                  <div class="row g-3 align-items-center">
                                            <div class="col-2">
                                                <label class="col-form-label">Usuario</label>
                                            </div>                             
                                            <div class="col-9">
                                                <input type="text" name="usuario" required  autocomplete="off"  class="form-control" placeholder="Escriba..." required>
                                            </div>
                                        </div><br><div class="row g-3 align-items-center">
                                            <div class="col-2">
                                                <label class="col-form-label">Password</label>
                                            </div>                             
                                            <div class="col-9">
                                                <input type="text" name="password" required  autocomplete="off"  class="form-control" placeholder="Escriba..." required>
                                            </div>
                                        </div><br> <div class="row g-3 align-items-center">
                                            <div class="col-2">
                                                <label class="col-form-label">Rol</label>
                                            </div>
                                        <div class="col-9">
                                            <select class="form-control" name="rol">                                                              
                                          <option value='admin'>admin</option><option value='operador'>operador</option></select>
                                        </div>
                                    </div><br></form>