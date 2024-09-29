<table id="Dtable" class="styled-table" style="width:100%">
    <thead>
        <tr>
            <th class="colcont" id="c0"></th>
            <th class="colcont" id="c1"></th>
            <th class="colcont" id="c2"></th>
            <th class="colcont" id="c3"></th>
            <th class="colcont" id="c4"></th>
            <th class="colcont" id="c5"></th>
            <th class="colcont" id="c6"></th>
        </tr>
        <tr>
            <th class="col" style="width: 5% !important;">#</th>
            <th class="col" style="width: 25% !important;">CLIENTE</th>
            <th class="col" style="width: 10% !important;">TIPO</th>
            <th class="col" style="width: 10% !important;">FEC INI</th>
            <th class="col" style="width: 10% !important;">FEC FIN</th>
            <th class="col" style="width: 30% !important;">OBSERVACIONES</th>
            <th class="col" style="width: 10% !important;">ESTATUS</th>
        </tr>
    </thead>
    <tbody>
        @php $numero = 1; @endphp
        @foreach($tabla as $t)
            <tr>
                <td>{{$numero}}</td>
                <td class="lefti drillin" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;" onclick="verCliente('{{$t->idCliente}}')">{{$t->cliente}}</td>
                <td>{{$t->tipo}}</td>
                <td>{{fechaFormato($t->fechaInicio)}}</td>
                <td>{{fechaFormato($t->fechaFin)}}</td>
                <td>{{$t->observacion}}</td>
                <td>{{$t->estatus}}</td>
            </tr>
            @php $numero++; @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="filtercol"><input type="text" class="thfilter" idc="0" id="i0"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="1" id="i1"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="2" id="i2"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="3" id="i3"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="4" id="i4"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="5" id="i5"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="6" id="i6"></td>
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
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<script type="text/javascript">
// ///////////////////////////////////////////////////////////////////////
var c_NUM = 0;
var c_CLI = 1;
var c_TIP = 2;
var c_FIN = 3;
var c_FFI = 4;
var c_OBS = 5;
var c_STA = 6;
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
    $('#c'+c_CLI).html(number_format(Dtable.column(c_CLI,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_TIP).html(number_format(Dtable.column(c_TIP,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_FIN).html(number_format(Dtable.column(c_FIN,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_FFI).html(number_format(Dtable.column(c_FFI,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_OBS).html(number_format(Dtable.column(c_OBS,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_STA).html(number_format(Dtable.column(c_STA,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
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
// ///////////////////////////////////////////////////////////////////////
</script>