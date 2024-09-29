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
            <select class="form-control" id="clientesNRMain" name="clientesNR" onchange="deudaCliente(this.value);">
                <option value=""></option>
                @foreach ($clientes as $s)
                    <option value="{{$s->id}}">{{$s->nombre}} {{$s->apellidoP}} {{$s->apellidoM}}</option>
                @endforeach
            </select>

            <label>SERVICIO:</label>
            <select class="form-control" id="serviciosNRMain" name="serviciosNR" onchange="servicioChange(this.value);calculoPendiente();">
                <option value=""></option>
                @foreach ($servicios as $s)
                    <option value="{{$s->id}}">{{$s->tipo}}</option>
                @endforeach
            </select>

            <br><br>
            <div class="text-center" id="labelMembresias" hidden>
                <label style="color:rgb(132, 22, 191);cursor:pointer;" onclick="buscaMembresiasActivas();">REVISAR MEMBRESIAS</label>
            </div>
            
            <div id="divReferencias" hidden>
            <label>REFERENCIA PAGO:</label>
            <select class="form-control" id="referenciaNRMain" name="referenciaNR">
                <option value=""></option>
                @foreach ($servicios as $s)
                    @if($s->id != 5)
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
                globalThis.deudaGlobalMain = response;
                $("#deudaNRMain").val(response);
                $('#labelMembresias').removeAttr('hidden');
            },
            error: function(error) {
                swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
            }
    });
}

function servicioChange(servicio){

    limpiarSelect('referenciaNRMain');  
    $('#feciniNRMain').val('');

    if(servicio == '5'){
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
    var importe = $('#importeNRMain').val();
    var pendiente = $('#pendienteNRMain').val();
    var deuda = deudaGlobalMain;
    var servicio = $('#serviciosNRMain').val();

    deuda = parseFloat(deuda.replace(/,/g,''));

    if(!valIsEmpty(servicio)){
        if(servicio == '5' && !valIsEmpty(importe)){
            importe = parseFloat(importe.replace(/,/g,''));
            var total = deuda-importe;
        }else if(servicio != '5' && !valIsEmpty(pendiente)){
            pendiente = parseFloat(pendiente.replace(/,/g,''));
            var total = deuda+pendiente;
        }else{
            var total = deuda;
        }

        if(total < 0){
            total = 0;
        }

        $("#deudaNRMain").val(number_format(total,2));
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