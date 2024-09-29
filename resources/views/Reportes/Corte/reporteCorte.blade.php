@extends('Login.main')

@section('contenido')
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<h5 class="card-title">
    <div ng-repeat="param in plugin.wsdlURLs track by $index" class="row">
        <div class="col-sm-2">
            <input type="date" class="form-control inputtext" id="fecIniFiltro" name="fecIniFiltro" placeholder="INICIO" autocomplete="off">
        </div>
        <div class="col-sm-2">
            <input type="date" class="form-control inputtext" id="fecFinFiltro" name="fecFinFiltro" placeholder="FIN" autocomplete="off">
        </div>
        <div class="col-sm-8">
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
    let inicio = $('#fecIniFiltro').val();
    let fin = $('#fecFinFiltro').val();
    if(valIsEmpty(inicio) || valIsEmpty(fin)){
        swalTimer('warning','COLOCA AMBAS FECHAS',2000);
    }else if(inicio > fin){
        swalTimer('warning','FECHAS INCORRECTAS',2000);
    }else{
        $.ajax({
            data: { 'inicio':inicio,'fin':fin,_token: "{{ csrf_token() }}" },
            type : "GET",
            url : "{{route('reporteCorteTabla')}}",
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
</script>
@endsection