<table id="Dtable" class="styled-table" style="width:100%">
    <thead>
        <tr>
            <th class="colcont tdhbottom" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;" colspan="3">GENERAL | {{$inicio}} / {{$fin}}</th>
            <th class="colcont tdhbottom" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;" colspan="3">MENSUALIDAD</th>
            <th class="colcont tdhbottom" colspan="4">SERVICIOS</th>
        </tr>
        <tr>
            <th class="colcont" id="c0"></th>
            <th class="colcont" id="c1"></th>
            <th class="colcont" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;" id="c2"></th>
            <th class="colcont" id="c3"></th>
            <th class="colcont" id="c4"></th>
            <th class="colcont" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;" id="c5"></th>
            <th class="colcont" id="c6"></th>
            <th class="colcont" id="c7"></th>
            <th class="colcont" id="c8"></th>
            <th class="colcont" id="c9"></th>
        </tr>
        <tr>
            <th class="col" style="width: 5% !important;">#</th>
            <th class="col" style="width: 10% !important;">FECHA</th>
            <th class="col" style="width: 20% !important;border-right: 5px solid rgba(236, 236, 236, 0.504) !important;">CLIENTE</th>
            <th class="col" style="width: 10% !important;">INICIO</th>
            <th class="col" style="width: 5% !important;">#</th>
            <th class="col" style="width: 10% !important;border-right: 5px solid rgba(236, 236, 236, 0.504) !important;">TOTAL</th>
            <th class="col" style="width: 10% !important;">SEMANAL</th>
            <th class="col" style="width: 10% !important;">VISITA</th>
            <th class="col" style="width: 10% !important;">HERBALIFE</th>
            <th class="col" style="width: 10% !important;">TOTAL G</th>
        </tr>
    </thead>
    <tbody>
        @php $numero = 1; @endphp
        @foreach($tabla as $t)
            <tr>
                <td>{{$numero}}</td>
                <td>{{fechaFormato($t->Fecha)}}</td>
                <td class="lefti drillin" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;" onclick="verCliente('{{$t->idCliente}}')">{{$t->Cliente}}</td>
                <td>{{fechaFormato($t->InicioGym)}}</td>
                <td>{{flotFormatoM($t->PagosGym)}}</td>
                <td style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;" class="drillin" onclick="drillSeccion('MENSUALIDAD','{{$t->idCliente}}','{{$t->Cliente}}',1)">{{flotFormatoM2Pesos($t->TotalGym)}}</td>
                <td class="drillin" onclick="drillSeccion('SEMANAL','{{$t->idCliente}}','{{$t->Cliente}}',3)">{{flotFormatoM2Pesos($t->Semanal)}}</td>
                <td class="drillin" onclick="drillSeccion('VISITA','{{$t->idCliente}}','{{$t->Cliente}}',2)">{{flotFormatoM2Pesos($t->Visita)}}</td>
                <td class="drillin" onclick="drillSeccion('HERBALIFE','{{$t->idCliente}}','{{$t->Cliente}}',4)">{{flotFormatoM2Pesos($t->Herbalife)}}</td>
                <td class="drillin" onclick="drillTotalGeneral('{{$t->idCliente}}','{{$t->Cliente}}')">{{flotFormatoM2Pesos($t->Total)}}</td>
            </tr>
            @php $numero++; @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="filtercol"><input type="text" class="thfilter" idc="0" id="i0"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="1" id="i1"></td>
            <td class="filtercol" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;"><input type="text" class="thfilter" idc="2" id="i2"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="3" id="i3"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="4" id="i4"></td>
            <td class="filtercol" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;"><input type="text" class="thfilter" idc="5" id="i5"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="6" id="i6"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="7" id="i7"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="8" id="i8"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="9" id="i9"></td>
        </tr> 
    </tfoot>
</table>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
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
{{--  --}}
<div class="modal fade" id="modaldrillSeccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            {{--  --}}
            <div id="modaldrillSeccionBody">

            </div>
            {{--  --}}
        </div>
    </div>
</div>
{{--  --}}
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<script type="text/javascript">
// ///////////////////////////////////////////////////////////////////////
var c_NUM = 0;
var c_FEC = 1;
var c_CLI = 2;
var c_INI = 3;
var c_PAG = 4;
var c_TOG = 5;
var c_SEM = 6;
var c_VIS = 7;
var c_HER = 8;
var c_TOT = 9;
// ///////////////////////////////////////////////////////////////////////
Dtable();
function Dtable(){
    var Dtable = $('#Dtable').DataTable({
        "sDom": "tp",
        scrollY: "500px",
        scrollX: true,
        order: [[c_NUM,'asc']],
        paging: false,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "# REG _MENU_ ",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "_START_ - _END_",
            "sInfoEmpty": "",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "<i class='fa fa-search'></i>",
            "sUrl": "",
            "sInfoThousands": ","
        },
        buttons: [{
            text: 'COLUMNAS',
            extend: 'colvis',
        }],
    })
    Dtable.buttons().container().appendTo($('.colvisBut'));

    contador(Dtable);

    $('.thfilter').on('keyup change blur',function () {let idc = this.getAttribute("idc");Dtable.columns(idc).search( this.value ).draw();contador(Dtable);});
}

function contador(Dtable) {
    $('#c'+c_NUM).html(number_format(Dtable.column(c_NUM,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_FEC).html(number_format(Dtable.column(c_FEC,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_CLI).html(number_format(Dtable.column(c_CLI,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_INI).html(number_format(Dtable.column(c_INI,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_PAG).html(
                        number_format(Dtable.column(c_PAG,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum())+' '+
                        '('+number_format(Dtable.column(c_PAG,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'
    );
    $('#c'+c_TOG).html(
                        '$'+number_format(Dtable.column(c_TOG,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2)+' '+
                        '('+number_format(Dtable.column(c_TOG,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'    
    );
    $('#c'+c_SEM).html(
                        '$'+number_format(Dtable.column(c_SEM,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2)+' '+
                        '('+number_format(Dtable.column(c_SEM,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'    
    );
    $('#c'+c_VIS).html(
                        '$'+number_format(Dtable.column(c_VIS,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2)+' '+
                        '('+number_format(Dtable.column(c_VIS,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'    
    );
    $('#c'+c_HER).html(
                        '$'+number_format(Dtable.column(c_HER,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2)+' '+
                        '('+number_format(Dtable.column(c_HER,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'    
    );
    $('#c'+c_TOT).html(
                        '$'+number_format(Dtable.column(c_TOT,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2)+' '+
                        '('+number_format(Dtable.column(c_TOT,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'    
    );
}
// ///////////////////////////////////////////////////////////////////////
function verCliente(id){
    $.ajax({
        data: { 'id':id, _token: "{{ csrf_token() }}" },
        type : "GET",
        url : "{{route('verCliente')}}",
        beforeSend : function () {
            $("#modalverClienteBody").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
        },
        success:  function (response) {
            $('#modalverCliente').modal({backdrop: 'static',keyboard: false});
            $('#modalverCliente').modal('show');
            $("#modalverClienteBody").html(response);
        },
        error: function(error) {
            swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
        }
    });
}

function drillSeccion(seccion,idCliente,cliente,idTipo){
    let inicio = '{{$inicio}}'; 
    let fin = '{{$fin}}';
    $.ajax({
        data: { 'seccion':seccion,'idCliente':idCliente,'cliente':cliente,'idTipo':idTipo,'inicio':inicio,'fin':fin, _token: "{{ csrf_token() }}" },
        type : "GET",
        url : "{{route('drillSeccion')}}",
        beforeSend : function () {
            $("#modaldrillSeccionBody").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
        },
        success:  function (response) {
            $('#modaldrillSeccion').modal({backdrop: 'static',keyboard: false});
            $('#modaldrillSeccion').modal('show');
            $("#modaldrillSeccionBody").html(response);
        },
        error: function(error) {
            swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
        }
    });
}

function drillTotalGeneral(idCliente,cliente){
    let inicio = '{{$inicio}}'; 
    let fin = '{{$fin}}';
    $.ajax({
        data: { 'idCliente':idCliente,'cliente':cliente,'inicio':inicio,'fin':fin, _token: "{{ csrf_token() }}" },
        type : "GET",
        url : "{{route('drillTotalGeneral')}}",
        beforeSend : function () {
            $("#modaldrillSeccionBody").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
        },
        success:  function (response) {
            $('#modaldrillSeccion').modal({backdrop: 'static',keyboard: false});
            $('#modaldrillSeccion').modal('show');
            $("#modaldrillSeccionBody").html(response);
        },
        error: function(error) {
            swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
        }
    });
}
// ///////////////////////////////////////////////////////////////////////
</script>