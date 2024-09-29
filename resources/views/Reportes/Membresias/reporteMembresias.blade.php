@extends('Login.main')

@section('contenido')
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<h5 class="card-title">
    <div ng-repeat="param in plugin.wsdlURLs track by $index" class="row">
        <div class="col-sm-4">
            <select id='clientesS' name="clientesS" class="multiSelect" multiple>
                @foreach($clientes as $s)
                <option value="'{{$s->id}}'">{{$s->cliente}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-1">
            <select id='tipoS' name="tipoS" class="multiSelect" multiple>
                @foreach($tipos as $s)
                <option value="'{{$s->id}}'">{{$s->tipo}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-1">
            <select id='estatusS' name="estatusS" class="multiSelect" multiple>
                <option value="'F'">FINALIZADO</option>
                <option value="'A'">ACTIVO</option>
                <option value="'P'">PENDIENTE</option>
            </select>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-primary" onclick="tablaShow();">Buscar</button>
        </div>
    </div>
</h5>
<p></p>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<section class="section profile">
<div class="row" id="tablaShow"></div>
</section>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<script type="text/javascript">
// ///////////////////////////////////////////////////////////////////////
function tablaShow(){
    let cliente = $('#clientesS').val();
    let tipo = $('#tipoS').val();
    let estatus = $('#estatusS').val();
    if(valIsEmpty(cliente) || valIsEmpty(tipo) || valIsEmpty(estatus)){
        swalTimer('warning','LLENA TODOS LOS FILTROS',2000);
    }else{
        $.ajax({
            data: { 'cliente':cliente,'tipo':tipo,'estatus':estatus,_token: "{{ csrf_token() }}" },
            type : "GET",
            url : "{{route('reporteMembresiasTabla')}}",
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
$('#clientesS').multipleSelect({
    width: '100%',
    countSelected: false,
    placeholder: "CLIENTES",
    filter :true,
});
$('#tipoS').multipleSelect({
    width: '100%',
    countSelected: false,
    placeholder: "TIPOS",
    filter :true,
});
$('#estatusS').multipleSelect({
    width: '100%',
    countSelected: false,
    placeholder: "ESTATUS",
    filter :true,
});
// ///////////////////////////////////////////////////////////////////////
</script>
@endsection