<style>
    @keyframes pulseBg {
        0% {
            background-color: transparent;
        }
        50% {
            background-color: rgba(231, 145, 134, 0.271);
        }
        100% {
            background-color: transparent;
        }
    }
</style>
<form class="form" id="guardarServicioMain" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <!---------------------->
    <div class="modal-header">
        <h4 class="modal-title col-12 text-center titulomodal">Nuevo Registro</h5>
    </div>
    {{--  --}}
    <div class="modal-body">
        <div class="bodymodal">
            <label>CLIENTE:</label>
            <select class="form-control" id="clientesNRMain" name="clientesNR" onchange="deudaCliente(this.value);invitadosActivos();">
                <option value=""></option>
                @foreach ($clientes as $s)
                    <option value="{{$s->id}}">{{$s->nombre}} {{$s->apellidoP}} {{$s->apellidoM}}</option>
                @endforeach
            </select>

            <label>SERVICIO:</label>
            <select class="form-control" id="serviciosNRMain" name="serviciosNR" onchange="servicioChange(this.value);calculoPendiente();invitadosActivos();">
                <option value=""></option>
                @foreach ($servicios as $s)
                    <option value="{{$s->id}}">{{$s->tipo}}</option>
                @endforeach
            </select>

            <div class="text-center" id="labelMembresias" hidden>
                <br>
                <label style="color:rgb(132, 22, 191);cursor:pointer;" onclick="buscaMembresiasActivas();">REVISAR MEMBRESIAS</label>
            </div>
            <div class="text-center" id="labelInvitados" hidden>
                <label style="color:rgb(31, 223, 38);padding: 10px 20px; border-radius: 25px; animation: pulseBg 1.5s infinite;">DESCUENTO INVITADOS <span id="porcentajeDescuento"></span> % DESCUENTO</label>
            </div>

            <div id="divReferencias" hidden>
            <label>REFERENCIA PAGO:</label>
            <select class="form-control" id="referenciaNRMain" name="referenciaNR">
                <option value=""></option>
                @foreach ($servicios as $s)
                    @if($s->id != 4)
                        <option value="{{$s->id}}">{{$s->tipo}}</option>
                    @endif
                @endforeach
            </select>
            </div>

            <label>FECHA INICIO:</label>
            <input type="date" readonly class="form-control inputtext" id="feciniNRMain" name="feciniNR" placeholder="INICIO" autocomplete="off">

            <label>$ IMPORTE:</label>
            <input type="text" readonly class="form-control inputtext pmask2" id="importeNRMain" name="importeNR" onblur="calculoPendiente()" placeholder="IMPORTE" autocomplete="off">

            <label>$ RESTA:</label>
            <input type="text" readonly class="form-control inputtext pmask2" id="pendienteNRMain" name="pendienteNR" onblur="calculoPendiente()" placeholder="PENDIENTE" autocomplete="off">

            <label>OBSERVACION:</label>
            <textarea class="form-control" id="observacionNRMain" name="observacionNR" maxlength="250" autocomplete="off"></textarea>

            <label>$ PENDIENTE:</label>
            <input type="text" readonly class="form-control inputtext pmask2" id="deudaNRMain" name="deudaNR" placeholder="PENDIENTE" autocomplete="off">
        </div>
    </div>
    <!---------------------->
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-success btn-sm" onclick="$('#guardarServicioMain').submit();">GUARDAR</button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modalagregarServicioMain').modal('hide');">CERRAR</button>
</div>

<script>
// //////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (typeof deudaGlobalMain !== 'undefined') {
    delete deudaGlobalMain;
}
// //////////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#guardarServicioMain").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'guardarServicio',
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
                $('#modalagregarServicioMain').modal('hide');
                if(window.location.pathname == '/GMURep/public/servicios'){
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
// //////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#clientesNRMain').select2();
$('#clientesNRMain').select2({
    dropdownParent: $('#modalagregarServicioMain'),
    placeholder: 'CLIENTES',
    language: {
        noResults: function(params) {
            return 'SIN RESULTADOS';
        }
    }
});

$('#serviciosNRMain').select2();
$('#serviciosNRMain').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#modalagregarServicioMain'),
    placeholder: 'SERVICIOS',
    language: {
        noResults: function(params) {
            return 'SIN RESULTADOS';
        }
    }
});

$('#referenciaNRMain').select2();
$('#referenciaNRMain').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#modalagregarServicioMain'),
    placeholder: 'REFERENCIAS',
    language: {
        noResults: function(params) {
            return 'SIN RESULTADOS';
        }
    }
});
// //////////////////////////////////////////////////////////////////////////////////////////////////////////////
function deudaCliente(cliente){
    $.ajax({
            data: { 'cliente':cliente, _token: "{{ csrf_token() }}" },
            type : "GET",
            url : "{{route('deudaCliente')}}",
            beforeSend : function () {
                // $("#deudaCliente").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
            },
            success:  function (response) {
                globalThis.deudaGlobalMain = parseFloat(response);
                $("#deudaNRMain").val(response);
                $('#labelMembresias').removeAttr('hidden');
            },
            error: function(error) {
                swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
            }
    });
}

function invitadosActivos(){
    var cliente = $('#clientesNRMain').val();
    var servicio = $('#serviciosNRMain').val();

    if(!valIsEmpty(cliente) && !valIsEmpty(servicio) && servicio == 1){
        $.ajax({
            data: { 'cliente':cliente, _token: "{{ csrf_token() }}" },
            type : "GET",
            url : "{{route('invitadosActivos')}}",
            beforeSend : function () {
                // $("#invitadosActivos").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
            },
            success:  function (response) {
                if(!valIsEmpty(response)){
                    $('#labelInvitados').removeAttr('hidden');
                    $('#porcentajeDescuento').html(response);
                }else{
                    $('#labelInvitados').attr('hidden',true);
                }
            },
            error: function(error) {
                swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
            }
        });
    }else{
        $('#labelInvitados').attr('hidden',true);
        $('#porcentajeDescuento').html('');
    }
}

function servicioChange(servicio){

    limpiarSelect('referenciaNRMain');
    $('#feciniNRMain').val('');

    if(servicio == '4'){
        $('#importeNRMain').removeAttr('readonly');
        $('#importeNRMain').val('');

        $('#pendienteNRMain').attr('readonly','true');
        $('#pendienteNRMain').val('');

        $('#divReferencias').removeAttr('hidden');
    }else{
        $('#divReferencias').attr('hidden','true');

        $('#importeNRMain').removeAttr('readonly');
        $('#importeNRMain').val('');

        $('#pendienteNRMain').removeAttr('readonly');
        $('#pendienteNRMain').val('');
    }

    if(servicio == '1' || servicio == '2' || servicio == '3'){
        $('#feciniNRMain').removeAttr('readonly');
    }else{
        $('#feciniNRMain').attr('readonly','true');
    }
}

function calculoPendiente(){
    if(typeof deudaGlobalMain !== 'undefined'){
        var importe = $('#importeNRMain').val();
        var pendiente = $('#pendienteNRMain').val();
        var servicio = $('#serviciosNRMain').val();

        var importeSum = 0;
        var pendienteSum = 0;

        if(!valIsEmpty(servicio)){
            if(servicio != '4' && !valIsEmpty(importe) && deudaGlobalMain < 0){
                importeSum = parseFloat(importe.replace(/,/g,''));
            }
            if(servicio != '4' && !valIsEmpty(pendiente)){
                pendienteSum = parseFloat(pendiente.replace(/,/g,''));
            }

            var total = deudaGlobalMain+importeSum+pendienteSum;

            $("#deudaNRMain").val(number_format(total,2));
        }
    }
}

function buscaMembresiasActivas(){
    var cliente = $('#clientesNRMain').val();

    $.ajax({
        data: { 'cliente':cliente, _token: "{{ csrf_token() }}" },
        type : "GET",
        url : "{{route('buscaMembresiasActivas')}}",
        beforeSend : function () {
            $("#modalrevisarMembresiasBody").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
        },
        success:  function (response) {
            $('#modalrevisarMembresias').modal({backdrop: 'static',keyboard: false});
            $('#modalrevisarMembresias').modal('show');
            $("#modalrevisarMembresiasBody").html(response);
        },
        error: function(error) {
            swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
        }
    });
}
// //////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>
