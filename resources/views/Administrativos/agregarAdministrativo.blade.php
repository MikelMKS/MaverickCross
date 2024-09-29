<form class="form" id="guardarAdministrativo" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <!---------------------->
    <div class="modal-header">
        <h4 class="modal-title col-12 text-center titulomodal">Crear Administrativo</h5>
    </div>
    {{--  --}}
    <div class="modal-body">
        <div class="bodymodal">
            <label>USUARIO:</label>
            <input type="text" class="form-control inputtext" id="usuario" name="usuario" placeholder="USUARIO" maxlength="20" autocomplete="off">

            <label>CONTRASEÑA:</label>
            <input type="password" class="form-control inputtext" id="contraseña" name="contraseña" placeholder="CONTRASEÑA" maxlength="20" autocomplete="new-password">

            <label>NOMBRE:</label>
            <input type="text" class="form-control inputtext" id="nombre" name="nombre" placeholder="NOMBRE" maxlength="100" autocomplete="off">
            
            <label>IMAGEN:</label>
            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*">
        </div>
    </div>
    <!---------------------->
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-success btn-sm" onclick="$('#guardarAdministrativo').submit();">GUARDAR</button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modalagregarAdministrativo').modal('hide');">CERRAR</button>
</div>

<script>
$("#guardarAdministrativo").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'guardarAdministrativo',
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