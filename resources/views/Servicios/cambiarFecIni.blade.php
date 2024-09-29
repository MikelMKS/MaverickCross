<form class="form" id="guardarEdicionMembresia" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="idMembresiaEditar" value="{{$datos[0]->id}}">
    <!---------------------->
    <div class="modal-header">
        <h4 class="modal-title col-12 text-center"><strong class="titulomodal">EDITAR MEMBRESIA</strong><br><span class="subtitulomodal">TIPO: {{$datos[0]->tipo}}</span></h4>
    </div>
    {{--  --}}
    <div class="modal-body">
        <div class="bodymodal">
            <label>FECHA INICIO:</label>
            <input type="date" class="form-control inputtext" id="feciniEMemb" name="feciniEMemb" placeholder="INICIO" autocomplete="off" value="{{$datos[0]->fechaInicio}}">

            <label>OBSERVACION:</label>
            <textarea class="form-control" id="observacionEMemb" name="observacionEMemb" maxlength="250" autocomplete="off">{{$datos[0]->observacion}}</textarea>
        </div>
    </div>
    <!---------------------->
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-success btn-sm" onclick="$('#guardarEdicionMembresia').submit();">GUARDAR</button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modalCambiarFecIni').modal('hide');">CERRAR</button>
</div>

<script>
// //////////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#guardarEdicionMembresia").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'guardarEdicionMembresia',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
            swalLoading();
        },
        success: function(response){
            if(response.sta == 0){
                swalTimer('success','ACTUALIZANDO',1000);
                $('#modalCambiarFecIni').modal('hide'); 
                tablaShow();
            }else{
                swalTimer('warning',response.msg,2000);
            }
        },
        error: function (error){
            swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
        }
    });
});
// //////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>