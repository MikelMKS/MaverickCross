<form class="form" id="updateCliente" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" class="form-control inputtext" id="idCliente" name="idCliente" value="{{$cliente[0]->id}}">
    <!---------------------->
    <div class="modal-header">
        <h4 class="modal-title col-12 text-center titulomodal">Datos Cliente</h5>
    </div>
    {{--  --}}
    <div class="modal-body">
        <div class="bodymodal">
            <label>NOMBRE:</label>
            <input type="text" class="form-control inputtext" id="nombreEdit" name="nombre" placeholder="NOMBRE" maxlength="200" autocomplete="off" value="{{$cliente[0]->nombre}}">

            <label>APELLIDO PATERNO:</label>
            <input type="text" class="form-control inputtext" id="apellidoPatEdit" name="apellidoPat" placeholder="APELLIDO PAT" maxlength="200" autocomplete="off" value="{{$cliente[0]->apellidoP}}">

            <label>APELLIDO MATERNO:</label>
            <input type="text" class="form-control inputtext" id="apellidoMatEdit" name="apellidoMat" placeholder="APELLIDO MAT" maxlength="200" autocomplete="off" value="{{$cliente[0]->apellidoM}}">
            
            <label>TELEFONO:</label>
            <input type="text" class="form-control inputtext" id="telefonoEdit" name="telefono" placeholder="TELEFONO" maxlength="15" autocomplete="off" value="{{$cliente[0]->telefono}}">
            
            <label>FECHA NACIMIENTO:</label>
            <input type="date" class="form-control inputtext" id="nacimientoEdit" name="nacimiento" placeholder="NACIMIENTO" autocomplete="off" value="{{$cliente[0]->fechaNac}}">

            <label>FOTO:</label>    
            <form id="form1Edit" runat="server">
                <input type="file" class="form-control" name="foto" id="fotoEdit" accept="image/*">
                <br>
                <div class="text-center">
                    @if(existeArchivo('assets/clientes', $cliente[0]->id . '.png'))
                        <img id="blahEdit" src="assets/clientes/{{$cliente[0]->id}}.png?v={{ date('mdHis') }}" style="max-width:60%;max-height:60%;">
                    @else
                        <img id="blahEdit" src="img/usuario-vacio.png" style="max-width:60%;max-height:60%;">
                    @endif
                </div>
            </form>
        </div>
    </div>
    <!---------------------->
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-success btn-sm" onclick="$('#updateCliente').submit();">GUARDAR</button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modalverCliente').modal('hide');">CERRAR</button>
</div>

<script>
$("#updateCliente").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'updateCliente',
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

function readURLEdit(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blahEdit').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#fotoEdit").change(function(){
    readURLEdit(this);
});
</script>