<form class="form" id="updateAdministrativo" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" id="idEdit" name="idEdit" value="{{$datos[0]->id}}">
    <!---------------------->
    <div class="modal-header">
        <h4 class="modal-title col-12 text-center titulomodal">{{$datos[0]->user}}</h5>
    </div>
    {{--  --}} 
    <div class="modal-body">
        <div class="bodymodal text-center">
            @if(existeArchivo('assets/administrativos', $datos[0]->id . '.png'))
                <img src="assets/administrativos/{{$datos[0]->id}}.png?v={{ date('mdHis') }}" style="max-width:20%;max-height:20%;" alt="Profile" class="rounded-circle">
            @else
                <img src="img/usuario-vacio.png" alt="Profile" style="max-width:20%;max-height:20%;" class="rounded-circle">
            @endif
        </div>
    </div>
    {{--  --}} 
    @if($datos[0]->idTipo == 1)
        <div class="modal-body">
            <div class="bodymodal">
                <input type="hidden" class="form-control inputtext" id="usuarioEdit" name="usuarioEdit" placeholder="USUARIO" maxlength="20" autocomplete="off" value="{{$datos[0]->user}}">
                @if($datos[0]->id == Session::get('Sid'))
                <label>CONTRASEÑA:</label>
                <input type="password" class="form-control inputtext" id="contraseñaEdit" name="contraseñaEdit" placeholder="CONTRASEÑA" maxlength="20" autocomplete="new-password" value="{{$datos[0]->pass}}">
                @else
                <input type="hidden" class="form-control inputtext" id="contraseñaEdit" name="contraseñaEdit" placeholder="CONTRASEÑA" maxlength="20" autocomplete="new-password" value="{{$datos[0]->pass}}">
                @endif

                <label>NOMBRE:</label>
                <input type="text" class="form-control inputtext" id="nombreEdit" name="nombreEdit" placeholder="NOMBRE" maxlength="100" autocomplete="off" value="{{$datos[0]->nombre}}">
                
                <label>IMAGEN:</label>
                <input type="file" class="form-control" name="imagenEdit" id="imagenEdit" accept="image/*">
            </div>
        </div>
    @else
        <div class="modal-body">
            <div class="bodymodal">
                <label>USUARIO:</label>
                <input type="text" class="form-control inputtext" id="usuarioEdit" name="usuarioEdit" placeholder="USUARIO" maxlength="20" autocomplete="off" value="{{$datos[0]->user}}">

                <label>CONTRASEÑA:</label>
                <input type="password" class="form-control inputtext" id="contraseñaEdit" name="contraseñaEdit" placeholder="CONTRASEÑA" maxlength="20" autocomplete="new-password" value="{{$datos[0]->pass}}">

                <label>NOMBRE:</label>
                <input type="text" class="form-control inputtext" id="nombreEdit" name="nombreEdit" placeholder="NOMBRE" maxlength="100" autocomplete="off" value="{{$datos[0]->nombre}}">
                
                <label>IMAGEN:</label>
                <input type="file" class="form-control" name="imagenEdit" id="imagenEdit" accept="image/*">
            </div>
        </div>
    @endif
    <!---------------------->
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-success btn-sm" onclick="$('#updateAdministrativo').submit();">GUARDAR</button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modaleditarAdministrativo').modal('hide');">CERRAR</button>
</div>

<script>
$("#updateAdministrativo").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'updateAdministrativo',
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
</script>