<form class="form" id="guardarClienteMain" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <!---------------------->
    <div class="modal-header">
        <h4 class="modal-title col-12 text-center titulomodal">Crear Cliente</h5>
    </div>
    {{--  --}}
    <div class="modal-body">
        <div class="bodymodal">
            <label>NOMBRE:</label>
            <input type="text" class="form-control inputtext" id="nombreMain" name="nombre" placeholder="NOMBRE" maxlength="200" autocomplete="off">

            <label>APELLIDO PATERNO:</label>
            <input type="text" class="form-control inputtext" id="apellidoPatMain" name="apellidoPat" placeholder="APELLIDO PAT" maxlength="200" autocomplete="off">

            <label>APELLIDO MATERNO:</label>
            <input type="text" class="form-control inputtext" id="apellidoMatMain" name="apellidoMat" placeholder="APELLIDO MAT" maxlength="200" autocomplete="off">
            
            <label>TELEFONO:</label>
            <input type="text" class="form-control inputtext" id="telefonoMain" name="telefono" placeholder="TELEFONO" maxlength="15" autocomplete="off">
            
            <label>FECHA NACIMIENTO:</label>
            <input type="date" class="form-control inputtext" id="nacimientoMain" name="nacimiento" placeholder="NACIMIENTO" autocomplete="off">

            <label>FOTO:</label>    
            <form id="form1Main" runat="server">
                <input type="file" class="form-control" name="foto" id="fotoMain" accept="image/*">
                <br>
                <div class="text-center">
                    <img id="blahMain" src="img/usuario-vacio.png" style="max-width:60%;max-height:60%;"/>
                </div>
            </form>
        </div>
    </div>
    <!---------------------->
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-success btn-sm" onclick="$('#guardarClienteMain').submit();">GUARDAR</button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modalagregarClienteMain').modal('hide');">CERRAR</button>
</div>

<script>
$("#guardarClienteMain").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'guardarCliente',
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
                $('#modalagregarClienteMain').modal('hide'); 
                if(window.location.pathname == '/GMURep/public/clientes'){
                    location.reload();
                }
            }else{
                swalTimer('warning',response.msg,2000);
            }
        },
        error: function (error){
            swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
        }
    });
});

function readURLMain(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blahMain').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#fotoMain").change(function(){
    readURLMain(this);
});
</script>