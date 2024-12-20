
function listar_musicales(pag = 1) {
  let max_pages = max_pages_server;
  $("#buscador-general").show().animate({ "opacity": "1" }, 1000);

  var start = (pag - 1) * max_pages;
  var texto = $("#busqueda_musicales").val();
  const artistas = $("#select_artistas_music").val()
  let exacto = '';
  if(artistas == ''){
    exacto = 'NO';
  }else{
    exacto = 'SI';
    texto = artistas;
  }
  var parametros = {
    start,
    texto,
    exacto,
    max: max_pages
  }
  console.log(parametros)

  var result1 = '';
  $.ajax({
    data: parametros,
    url: "../musicales/listaMusicales.php",
    type: "post",
    success: function (response) {

      result1 = response;

      jQuery.ajax({
        type: "POST",
        url: "../musicales/generar_paginacion.php",
        data: parametros,
        dataType: "JSON",
        success: function (data) {

          $("#musicales-result").html(response + data.tabla);
          $('.pagination').pagination({
            items: parseInt(data.total_pages),
            currentPage: pag,
            cssStyle: 'compact-theme'
          });

        }, beforeSend: function () {
          $("#musicales-result").show();
          $("#musicales-result").html(`<div style="text-align:center">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                        <span class="visually-hidden"></span>
                                </div>
                            </div>
                        </div>`);
        }
      });


    }, beforeSend: function () {
      $("#musicales-result").show();
      $("#musicales-result").html(`<div style="text-align:center">
                      <div class="d-flex justify-content-center">
                          <div class="spinner-border" role="status">
                                  <span class="visually-hidden"></span>
                          </div>
                      </div>
                  </div>`);
    }
  });
}

function musicales() {
  remove();
  document.getElementById("nav_musicales").className += " active";
  document.getElementById("carpeta-activa").value = "musicales";
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
    url: "../musicales/musicales.php",
    type: "post",
    success: function (response) {
      $("#shadow").fadeOut();
      $("#spinner").html(``);
      $("#all-body").html(response);
      $('.select_artistas').select2();
      if(window.innerWidth < 600){
        $('.manage-movile').hide()
        $("#btn-menu-karaoke").removeClass('active')
        $("#btn-menu-musical").addClass('active')
      }
      listar_musicales(1);
    }
  });
}

$("#modal_seleccionar_musica").on("show.bs.modal", function (e) {
  var id = $(e.relatedTarget).data().id;
  var titulo = $(e.relatedTarget).data().titulo;
  var interprete = $(e.relatedTarget).data().interprete;
  var ruta = $(e.relatedTarget).data().ruta;
  console.log(ruta,titulo);
  $("#interprete_musica").html(interprete);
  $("#titulo_musica").html(titulo)
  $("#idCancion_m").val(id);
  $("#descripcion_m").val(`${interprete} - ${titulo}`);
  $("#ruta_m").val(ruta);
});

function enviar_musica(id, tuNombre, descripcion, ruta) {
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
    tipo: 'MUSICA',
    id: parseInt(id),
    usuario: tuNombre,
    descripcion,
    ruta
  }
  console.log(parametros)
  socket.emit('addkaraokola', JSON.stringify(parametros))
  $("#shadow").fadeOut();
  $("#spinner").html(``);
}

function edit_musicales(id) {
  $("#buscador-general").hide().animate({ "opacity": "0" }, 0);
  $("#musicales-result").hide().animate({ "opacity": "0", "bottom": "-80px" }, 0);

  var parametros = {
    "id": id
  }

  $.ajax({
    data: parametros,
    url: "../musicales/edit.php",
    type: "post",
    success: function (response) {
      $("#musicales-result").show().animate({ "opacity": "1", "bottom": "-80px" }, 1000);
      $("#musicales-result").html(response);

      let form = document.getElementById("edit_musicales");
      form.addEventListener("submit", function (event) {
        event.preventDefault();
        send_data("musicales", "Actualizado", "edit_insert", "edit_musicales");
      });

    }
  });
}

$("#modal_eliminar_musicales").on("show.bs.modal", function (e) {
  var id = $(e.relatedTarget).data().id;
  $("#id_musicales").val(id);
});

function borrar_musicales(id) {

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
    url: "../musicales/eliminar.php",
    type: "post",
    success: function (response) {
      $("#shadow").fadeOut();
      $("#spinner").html(``);
      if (response == 1) {
        alertify.success("Registro eliminado");
        listar_musicales(pag);
      } else if (response == 2) {
        alertify.error("Error");
      }
    }
  });

}


$(document).on('change', '#select_artistas_music', (e)=>{
  console.log('Se cambio', e.target.value)
  listar_musicales(1)
})