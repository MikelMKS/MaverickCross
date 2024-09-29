<form class="form" id="updatePerfil" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" id="idEditPerfil" name="idEditPerfil" value="{{$datos[0]->id}}">
    <!---------------------->
    <div class="modal-header">
        <h4 class="modal-title col-12 text-center titulomodal">{{$datos[0]->user}}</h5>
    </div>
    {{--  --}} 
    <div class="modal-body">
        <div class="bodymodal text-center">
            @if(existeArchivo('assets/administrativos', $datos[0]->id . '.png'))
                <img src="assets/administrativos/{{$datos[0]->id}}.png?v={{ date('mdHis') }}" id="blahEditPerf" style="max-width:20%;max-height:20%;" alt="Profile" class="rounded-circle">
            @else
                <img src="img/usuario-vacio.png" id="blahEditPerf" alt="Profile" style="max-width:20%;max-height:20%;" class="rounded-circle">
            @endif
        </div>
    </div>
    {{--  --}} 
    @if($datos[0]->idTipo == 1)
        <div class="modal-body">
            <div class="bodymodal">
                <input type="hidden" class="form-control inputtext" id="usuarioEditPerfil" name="usuarioEditPerfil" placeholder="USUARIO" maxlength="20" autocomplete="off" value="{{$datos[0]->user}}">
                <label>CONTRASEÑA:</label>
                <input type="password" class="form-control inputtext" id="contraseñaEditPerfil" name="contraseñaEditPerfil" placeholder="CONTRASEÑA" maxlength="20" autocomplete="new-password" value="{{$datos[0]->pass}}">

                <label>NOMBRE:</label>
                <input type="text" class="form-control inputtext" id="nombreEditPerfil" name="nombreEditPerfil" placeholder="NOMBRE" maxlength="100" autocomplete="off" value="{{$datos[0]->nombre}}">
                
                <label>IMAGEN:</label>
                <input type="file" class="form-control" name="imagenEditPerfil" id="imagenEditPerfil" accept="image/*">
            </div>
        </div>
    @else
        <div class="modal-body">
            <div class="bodymodal">
                <label>USUARIO:</label>
                <input type="text" class="form-control inputtext" id="usuarioEditPerfil" name="usuarioEditPerfil" placeholder="USUARIO" maxlength="20" autocomplete="off" value="{{$datos[0]->user}}">

                <label>CONTRASEÑA:</label>
                <input type="password" class="form-control inputtext" id="contraseñaEditPerfil" name="contraseñaEditPerfil" placeholder="CONTRASEÑA" maxlength="20" autocomplete="new-password" value="{{$datos[0]->pass}}">

                <label>NOMBRE:</label>
                <input type="text" class="form-control inputtext" id="nombreEditPerfil" name="nombreEditPerfil" placeholder="NOMBRE" maxlength="100" autocomplete="off" value="{{$datos[0]->nombre}}">
                
                <label>IMAGEN:</label>
                <input type="file" class="form-control" name="imagenEditPerfil" id="imagenEditPerfil" accept="image/*">
            </div>
        </div>
    @endif
    <!---------------------->
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-success btn-sm" onclick="$('#updatePerfil').submit();">GUARDAR</button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modaleditarPerfil').modal('hide');">CERRAR</button>
</div>

<script>
$("#updatePerfil").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'updatePerfil',
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
                swalTimer('success','ACTUALIZANDO','');
                window.location.reload(); 
            }else{
                swalTimer('warning',response.msg,2000);
            }
        },
        error: function (error){
            swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
        }
    });
});


function readURLEditPerf(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blahEditPerf').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imagenEditPerfil").change(function(){
    readURLEditPerf(this);
});
</script>