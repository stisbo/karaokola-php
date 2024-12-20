        
     
                        function listar_usuarios(pag) {
                            $("#buscador-general").show().animate({ "opacity": "1"}, 1000);
                            
                                        var start = (pag-1)*10;
                                        var texto=$("#busqueda_usuarios").val();
                                        var parametros={
                                            "start":start,
                                            "texto":texto
                                        }
                                    

                            var result1 = '';
                            $.ajax({
                                 data:parametros, 
                                url: "../usuarios/listaUsuarios.php",
                                type: "post",
                                success: function (response) {

                                    result1 = response;
                                    
                                jQuery.ajax({
                                    type: "POST",
                                    url: "../usuarios/generar_paginacion.php",
                                    data: parametros,
                                    dataType: "JSON",
                                    success: function (data) {

                                        $("#usuarios-result").html(response + data.tabla);
                                        $('.pagination').pagination({
                                            items: data.records,
                                            itemsOnPage: 10,
                                            cssStyle: 'light-theme',
                                            currentPage: pag,
                                        });
                                
                                    }, beforeSend: function () {
                                        $("#usuarios-result").show();
                                        $("#usuarios-result").html(`<div style="text-align:center">
                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="spinner-border" role="status">
                                                                                <span class="visually-hidden"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>`);
                                    }
                                });
                    

                                }, beforeSend: function () {
                                    $("#usuarios-result").show();
                                    $("#usuarios-result").html(`<div style="text-align:center">
                                                                <div class="d-flex justify-content-center">
                                                                    <div class="spinner-border" role="status">
                                                                            <span class="visually-hidden"></span>
                                                                    </div>
                                                                </div>
                                                            </div>`);
                                }
                             });                            
                        }

                        function usuarios() {
                            remove();
                            document.getElementById("nav_usuarios").className += " active";
                            document.getElementById("carpeta-activa").value = "usuarios";
                            $("#shadow").fadeIn("normal");
                            $("#spinner").html(`<div class="container">
                                                    <div class="loader-container">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    </div>
                                                </div>`);
                            $.ajax({
                                url: "../usuarios/usuarios.php",
                                type: "post",
                                success: function (response) {
                                    $("#shadow").fadeOut();
                                    $("#spinner").html(``);
                                    $("#all-body").html(response);
                                    listar_usuarios(1);
                                }
                            });
                        }

                        function add_usuarios() {
                            $("#buscador-general").hide().animate({ "opacity": "0"}, 0);
                            $("#usuarios-result").hide().animate({ "opacity": "0", "bottom": "-80px" }, 0);
                            $.ajax({
                                url: "../usuarios/add.php",
                                type: "post",
                                success: function (response) {
                                    $("#usuarios-result").show().animate({ "opacity": "1", "bottom": "-80px" }, 1000);
                                    $("#usuarios-result").html(response);
                        
                                    let form = document.getElementById("add_usuarios");
                                    form.addEventListener("submit", function (event) {
                                        event.preventDefault();
                                        send_data("usuarios", "Guardado", "add_insert", "add_usuarios");
                                    });
                        
                                }, beforeSend: function () {
                                }
                            });
                        }

                        function edit_usuarios(id) {
                            $("#buscador-general").hide().animate({ "opacity": "0"}, 0);
                            $("#usuarios-result").hide().animate({ "opacity": "0", "bottom": "-80px" }, 0);
                        
                            var parametros = {
                                "id": id
                            }
                        
                            $.ajax({
                                data: parametros,
                                url: "../usuarios/edit.php",
                                type: "post",
                                success: function (response) {
                                    $("#usuarios-result").show().animate({ "opacity": "1", "bottom": "-80px" }, 1000);
                                    $("#usuarios-result").html(response);
                        
                                    let form = document.getElementById("edit_usuarios");
                                    form.addEventListener("submit", function (event) {
                                        event.preventDefault();
                                        send_data("usuarios", "Actualizado", "edit_insert", "edit_usuarios");
                                    });
                        
                                }
                            });
                        }

                        $("#modal_eliminar_usuarios").on("show.bs.modal", function (e) {
                            var id = $(e.relatedTarget).data().id;
                            $("#id_usuarios").val(id);
                        });

                        function borrar_usuarios(id) {

                            $("#shadow").fadeIn("normal");
                            $("#spinner").html(`<div class="spinner-container">
                                                    <div class="spinner-path">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    </div>
                                                </div>`);
                        
                            var parametros = {
                                "id": id
                            }
                        
                            $.ajax({
                                data: parametros,
                                url: "../usuarios/eliminar.php",
                                type: "post",
                                success: function (response) {
                                    $("#shadow").fadeOut();
                                    $("#spinner").html(``);
                                    if (response == 1) {
                                        alertify.success("Registro eliminado");
                                        listar_usuarios(pag);
                                    } else if (response == 2) {
                                        alertify.error("Error");
                                    }
                                }
                            });
                        
                        }
            