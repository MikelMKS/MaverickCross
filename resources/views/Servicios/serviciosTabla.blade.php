<table id="Dtable" class="styled-table" style="width:100%">
    <thead>
        <tr>
            <th class="colcont" colspan="9" style="font-size: 1.5em !important;border-bottom: 1px solid rgba(236, 236, 236, 0.504) !important;">TOTAL PENDIENTE DEL CLIENTE: $ {{flotFormatoM2($datosCliente[0]->deuda)}}</th>
        </tr>
        <tr>
            <th class="colcont" id="c0"></th>
            <th class="colcont" id="c1"></th>
            <th class="colcont" id="c2"></th>
            <th class="colcont" id="c3"></th>
            <th class="colcont" id="c4"></th>
            <th class="colcont" id="c5"></th>
            <th class="colcont" id="c6"></th>
            <th class="colcont" id="c7"></th>
            <th class="colcont" id="c8"></th>
        </tr>
        <tr>
            <th class="col" style="width: 5% !important;">#</th>
            <th class="col" style="width: 10% !important;">TIPO</th>
            <th class="col" style="width: 10% !important;">REFERENCIA</th>
            <th class="col" style="width: 25% !important;">OBSERVACIONES</th>
            <th class="col" style="width: 10% !important;">IMPORTE</th>
            <th class="col" style="width: 10% !important;">PENDIENTE</th>
            <th class="col" style="width: 10% !important;">REGISTRO</th>
            <th class="col" style="width: 10% !important;">FEC REG</th>
            <th class="col" style="width: 10% !important;">FEC INI</th>
        </tr>
    </thead>
    <tbody>
        @php $numero = 1; @endphp
        @foreach($tabla as $t)
            <tr>
                <td>{{$numero}}</td>
                <td>{{$t->tipo}}</td>
                <td>{{$t->referencia}}</td>
                <td>{{$t->observacion}}</td>
                <td>{{$t->importe}}</td>
                <td>{{$t->pendiente}}</td>
                <td>{{$t->registro}}</td>
                <td>{{fechaFormato($t->fechaRegistro)}}</td>
                <td @if($t->fechaInicio != null) class="drillin" onclick="cambiarFecIni('{{$t->id}}')" @endif>{{fechaFormato($t->fechaInicio)}}</td>
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
            <td class="filtercol"><input type="text" class="thfilter" idc="7" id="i7"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="8" id="i8"></td>
        </tr> 
    </tfoot>
</table>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
{{--  --}}
<div class="modal fade" id="modalCambiarFecIni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            {{--  --}}
            <div id="modalCambiarFecIniBody">

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
var c_TIP = 1;
var c_REF = 2;
var c_OBS = 3;
var c_IMP = 4;
var c_PEN = 5;
var c_REG = 6;
var c_FRE = 7;
var c_FIN = 8;
// ///////////////////////////////////////////////////////////////////////
Dtable();
function Dtable(){
    var Dtable = $('#Dtable').DataTable({
        "sDom": "tp",
        scrollY: "500px",
        scrollX: true,
        order: [[c_NUM,'desc']],
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
    $('#c'+c_TIP).html(number_format(Dtable.column(c_TIP,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_REF).html(number_format(Dtable.column(c_REF,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_OBS).html(number_format(Dtable.column(c_OBS,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_IMP).html('$'+number_format(Dtable.column(c_IMP,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2));
    $('#c'+c_PEN).html(
                        '$'+number_format(Dtable.column(c_PEN,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2)+' '+
                        '('+number_format(Dtable.column(c_PEN,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'
    );
    $('#c'+c_REG).html(number_format(Dtable.column(c_REG,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_FRE).html(number_format(Dtable.column(c_FRE,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_FIN).html(number_format(Dtable.column(c_FIN,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
}
// ///////////////////////////////////////////////////////////////////////
function cambiarFecIni(id){
    $.ajax({
        data: { 'id':id, _token: "{{ csrf_token() }}" },
        type : "GET",
        url : "{{route('cambiarFecIni')}}",
        beforeSend : function () {
            $("#modalCambiarFecIniBody").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
        },
        success:  function (response) {
            $('#modalCambiarFecIni').modal({backdrop: 'static',keyboard: false});
            $('#modalCambiarFecIni').modal('show');
            $("#modalCambiarFecIniBody").html(response);
        },
        error: function(error) {
            swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
        }
    });
}
// ///////////////////////////////////////////////////////////////////////
</script>