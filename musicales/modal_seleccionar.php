<div class="modal fade" id="modal_seleccionar_musica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <h2 class="text-center text-muted">Elegir</h2>
      <p class="lead text-muted text-center" style="display: block;margin:10px"> <output id="interprete_musica"></output>:
        <output id="titulo_musica"></output>
      </p>
      <input type="text" id="tuNombre_m" name="tuNombre_m" placeholder="Escribe tu nombre" minlength="2" autocomplete="true">
      <input type="hidden" id="idCancion_m">
      <input type="hidden" id="descripcion_m">
      <input type="hidden" id="ruta_m">
      <div class="modal-footer">
        <button type="submit" class="btn btn-lg btn-primary" data-dismiss="modal" onclick="enviar_musica($('#idCancion_m').val(),$('#tuNombre_m').val(),$('#descripcion_m').val(),$('#ruta_m').val())">Aceptar</button>
        <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>