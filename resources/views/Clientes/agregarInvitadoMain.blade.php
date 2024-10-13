<form class="form" id="guardarInvitadoMain" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <!---------------------->
    <div class="modal-header">
        <h4 class="modal-title col-12 text-center titulomodal">Guardar Invitado</h5>
    </div>
    {{--  --}}
    <div class="modal-body">
        <div class="bodymodal">
            <label>CLIENTE:</label>
            <select class="form-control" id="clienteInvitadoMain" name="clienteInvitadoMain">
                <option value=""></option>
                @foreach ($clientes as $s)
                    <option value="{{$s->id}}">{{$s->nombre}} {{$s->apellidoP}} {{$s->apellidoM}}</option>
                @endforeach
            </select>

            <label>NOMBRE INVITADO:</label>
            <input type="text" class="form-control inputtext" name="invitadoMain" placeholder="NOMBRE" maxlength="200" autocomplete="off">
        </div>
    </div>
    <!---------------------->
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-success btn-sm" onclick="$('#guardarInvitadoMain').submit();">GUARDAR</button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modalagregarInvitadoMain').modal('hide');">CERRAR</button>
</div>

<script>
$("#guardarInvitadoMain").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'guardarInvitado',
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
                $('#modalagregarInvitadoMain').modal('hide');
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

$('#clienteInvitadoMain').select2();
$('#clienteInvitadoMain').select2({
    dropdownParent: $('#modalagregarInvitadoMain'),
    placeholder: 'CLIENTES',
    language: {
        noResults: function(params) {
            return 'SIN RESULTADOS';
        }
    }
});
</script>
