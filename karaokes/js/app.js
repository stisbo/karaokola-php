function listar_karaokes(pag = 1) {
  let max_pages = max_pages_server;
  $("#buscador-general").show().animate({ "opacity": "1" }, 1000);
  console.log(`Listamos en la pagina ${pag}`)
  var start = (pag - 1) * max_pages;
  var texto = $("#busqueda_karaokes").val();
  const artistas = $("#select_artistas").val()
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
    url: "../karaokes/listaKaraokes.php",
    type: "post",
    success: function (response) {
      result1 = response;
      jQuery.ajax({
        type: "POST",
        url: "../karaokes/generar_paginacion.php",
        data: parametros,
        dataType: "JSON",
        success: function (data) {
          $("#karaokes-result").html(response + data.tabla);
          $('.pagination').pagination({
            items: parseInt(data.total_pages),
            currentPage: pag,
            cssStyle: 'compact-theme'
          });

        }, beforeSend: function () {
          $("#karaokes-result").show();
          $("#karaokes-result").html(`<div style="text-align:center">
                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="spinner-border" role="status">
                                                                                <span class="visually-hidden"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>`);
        }
      });


    }, beforeSend: function () {
      $("#karaokes-result").show();
      $("#karaokes-result").html(`<div style="text-align:center">
                                                                <div class="d-flex justify-content-center">
                                                                    <div class="spinner-border" role="status">
                                                                            <span class="visually-hidden"></span>
                                                                    </div>
                                                                </div>
                                                            </div>`);
    }
  });
}

function karaokes() {
  remove();
  document.getElementById("nav_karaokes").className += " active";
  document.getElementById("carpeta-activa").value = "karaokes";
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
    url: "../karaokes/karaokes.php",
    type: "post",
    success: function (response) {
      $("#shadow").fadeOut();
      $("#spinner").html(``);
      $("#all-body").html(response);
      if(window.innerWidth < 600){
        $('.manage-movile').hide()
        $("#btn-menu-karaoke").addClass('active')
        $("#btn-menu-musical").removeClass('active')
      }
      $('.select_artistas').select2();
      listar_karaokes(1);
      console.log('listar karokae')
    }
  });
}

function add_karaokes() {
  $("#buscador-general").hide().animate({ "opacity": "0" }, 0);
  $("#karaokes-result").hide().animate({ "opacity": "0", "bottom": "-80px" }, 0);
  $.ajax({
    url: "../karaokes/add.php",
    type: "post",
    success: function (response) {
      $("#karaokes-result").show().animate({ "opacity": "1", "bottom": "-80px" }, 1000);
      $("#karaokes-result").html(response);

      let form = document.getElementById("add_karaokes");
      form.addEventListener("submit", function (event) {
        event.preventDefault();
        send_data("karaokes", "Guardado", "add_insert", "add_karaokes");
      });

    }, beforeSend: function () {
    }
  });
}

function edit_karaokes(id) {
  $("#buscador-general").hide().animate({ "opacity": "0" }, 0);
  $("#karaokes-result").hide().animate({ "opacity": "0", "bottom": "-80px" }, 0);

  var parametros = {
    "id": id
  }

  $.ajax({
    data: parametros,
    url: "../karaokes/edit.php",
    type: "post",
    success: function (response) {
      $("#karaokes-result").show().animate({ "opacity": "1", "bottom": "-80px" }, 1000);
      $("#karaokes-result").html(response);

      let form = document.getElementById("edit_karaokes");
      form.addEventListener("submit", function (event) {
        event.preventDefault();
        send_data("karaokes", "Actualizado", "edit_insert", "edit_karaokes");
      });

    }
  });
}

$("#modal_eliminar_karaokes").on("show.bs.modal", function (e) {
  var id = $(e.relatedTarget).data().id;
  var titulo = $(e.relatedTarget).data().titulo;
  var interprete = $(e.relatedTarget).data().interprete;
  var ruta = $(e.relatedTarget).data().ruta;
  console.log(ruta,titulo);
  $("#interprete_karaokes").html(interprete);
  $("#titulo_karaokes").html(titulo)
  $("#idCancion_k").val(id);
  $("#descripcion_karaoke").val(`${interprete} - ${titulo}`);
  $("#ruta_karaoke").val(ruta);
});

function enviar_karaoke(id, tuNombre, descripcion, ruta) {
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
    tipo: 'KARAOKE',
    id: parseInt(id),
    usuario: tuNombre,
    descripcion,
    ruta
  }
  console.log(parametros )
  socket.emit('addkaraokola', JSON.stringify(parametros))
  alertify.success('Agregado a la cola');
  $("#shadow").fadeOut();
  $("#spinner").html(``);
}


$(document).on('change', '#select_artistas', (e)=>{
  console.log('Se cambio', e.target.value)
  listar_karaokes(1)
})