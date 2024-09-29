@extends('Login.main')

@section('contenido')
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<h5 class="card-title">
    <div ng-repeat="param in plugin.wsdlURLs track by $index" class="row">
        <div class="col-sm-4">
            <select class="form-control" id="clientesFiltro" name="clientesFiltro">
                <option value=""></option>
                @foreach ($clientes as $s)
                    <option value="{{$s->id}}" @if($idCliente == $s->id) selected @endif>{{$s->nombre}} {{$s->apellidoP}} {{$s->apellidoM}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-1">
            <select class="form-control" id="serviciosFiltro" name="serviciosFiltro">
                <option value=""></option>
                <option value="0">Todos</option>
                @foreach ($servicios as $s)
                    <option value="{{$s->id}}">{{$s->tipo}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-1">
            <input type="date" class="form-control inputtext" id="fecIniFiltro" name="fecIniFiltro" placeholder="INICIO" autocomplete="off">
        </div>
        <div class="col-sm-1">
            <input type="date" class="form-control inputtext" id="fecFinFiltro" name="fecFinFiltro" placeholder="INICIO" autocomplete="off">
        </div>
        <div class="col-sm-4">
            <button type="button" class="btn btn-primary" onclick="tablaShow();">Buscar</button>
            <button type="button" class="btn btn-success" onclick="agregarServicioMain();">Agregar</button>
            <span class="colvisBut"></span>
        </div>
    </div>
</h5>
<p></p>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<section class="section profile">
<div class="row" id="tablaShow"></div>
</section>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
{{--  --}}
<div class="modal fade" id="modalagregarCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            {{--  --}}
            <div id="modalagregarClienteBody">

            </div>
            {{--  --}}
        </div>
    </div>
</div>
{{--  --}}
{{--  --}}
<div class="modal fade" id="modalverCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            {{--  --}}
            <div id="modalverClienteBody">

            </div>
            {{--  --}}
        </div>
    </div>
</div>
{{--  --}}
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<script type="text/javascript">
// ///////////////////////////////////////////////////////////////////////
var idCliente = '{{$idCliente}}';
// ///////////////////////////////////////////////////////////////////////
if(!valIsEmpty(idCliente)){
    tablaShow();
}
// ///////////////////////////////////////////////////////////////////////
function tablaShow(){
    $('.colvisBut').html('');
    let cliente = $('#clientesFiltro').val();
    let servicio = $('#serviciosFiltro').val();
    let inicio = $('#fecIniFiltro').val();
    let fin = $('#fecFinFiltro').val();
    if(valIsEmpty(cliente)){
        swalTimer('warning','SELECCIONA UN CLIENTE',2000);
    }else{
        $.ajax({
            data: { 'cliente':cliente,'servicio':servicio,'inicio':inicio,'fin':fin,_token: "{{ csrf_token() }}" },
            type : "GET",
            url : "{{route('serviciosTabla')}}",
            beforeSend : function () {
                $("#tablaShow").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block-tabla'])}}');
            },
            success:  function (response) {
                $("#tablaShow").html(response);
            },
            error: function(error) {
                swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
            }
        });
    }
}
// ///////////////////////////////////////////////////////////////////////
$('#clientesFiltro').select2();
$('#clientesFiltro').select2({
    placeholder: 'CLIENTES',
    language: {
        noResults: function(params) {
            return 'SIN RESULTADOS';
        }
    }
});

$('#serviciosFiltro').select2();
$('#serviciosFiltro').select2({
    placeholder: 'SERVICIOS',
    language: {
        noResults: function(params) {
            return 'SIN RESULTADOS';
        }
    }
});
// ///////////////////////////////////////////////////////////////////////
</script>
@endsection