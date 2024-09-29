<!---------------------->
<div class="modal-header">
    <h4 class="modal-title col-12 text-center"><strong class="titulomodal">TOTAL GENERAL</strong><br><span class="titulomodal">{{$inicio}} / {{$fin}}</span><br><span class="subtitulomodal">{{$cliente}}</span></h4>
</div>
{{--  --}}
<div class="modal-body">
    <div class="bodymodal">
        <table id="tablaSeccion" class="styled-table" style="width:100%">
            <thead>
                <tr>
                    <th class="colcont" id="cS0"></th>
                    <th class="colcont" id="cS1"></th>
                    <th class="colcont" id="cS2"></th>
                    <th class="colcont" id="cS3"></th>
                    <th class="colcont" id="cS4"></th>
                    <th class="colcont" id="cS5"></th>
                    <th class="colcont" id="cS6"></th>
                </tr>
                <tr>
                    <th class="col" style="width: 4% !important;">#</th>
                    <th class="col" style="width: 10% !important;">FECHA</th>
                    <th class="col" style="width: 10% !important;">TIPO</th>
                    <th class="col" style="width: 10% !important;">REFE</th>
                    <th class="col" style="width: 30% !important;">OBSERVACION</th>
                    <th class="col" style="width: 18% !important;">IMPORTE</th>
                    <th class="col" style="width: 18% !important;">PENDIENTE</th>
                </tr>
            </thead>
            <tbody>
                @php $numero = 1; @endphp
                @foreach($tabla as $t)
                    <tr>
                        <td>{{$numero}}</td>
                        <td>{{fechaFormato($t->fecha)}}</td>
                        <td>{{$t->tipo}}</td>
                        <td>{{$t->referencia}}</td>
                        <td class="lefti">{{$t->observacion}}</td>
                        <td>{{flotFormatoM2Pesos($t->importe)}}</td>
                        <td>{{flotFormatoM2Pesos($t->pendiente)}}</td>
                    </tr>
                    @php $numero++; @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="filtercol"><input type="text" class="thfilter thfilterS" idc="0" id="iS0"></td>
                    <td class="filtercol"><input type="text" class="thfilter thfilterS" idc="1" id="iS1"></td>
                    <td class="filtercol"><input type="text" class="thfilter thfilterS" idc="2" id="iS2"></td>
                    <td class="filtercol"><input type="text" class="thfilter thfilterS" idc="3" id="iS3"></td>
                    <td class="filtercol"><input type="text" class="thfilter thfilterS" idc="4" id="iS4"></td>
                    <td class="filtercol"><input type="text" class="thfilter thfilterS" idc="5" id="iS5"></td>
                    <td class="filtercol"><input type="text" class="thfilter thfilterS" idc="6" id="iS6"></td>
                </tr> 
            </tfoot>
        </table>
    </div>
</div>
<!---------------------->
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modaldrillSeccion').modal('hide');">CERRAR</button>
</div>

<script>
$( "#modaldrillSeccion" ).on('shown.bs.modal', function (e) {
// ///////////////////////////////////////////////////////////////////////
var cS_NUM = 0;
var cS_FEC = 1;
var cS_TIP = 2;
var cS_REF = 3;
var cS_OBS = 4;
var cS_IMP = 5;
var cS_PEN = 6;
// ///////////////////////////////////////////////////////////////////////
if(!$.fn.dataTable.isDataTable("#tablaSeccion")){
tablaSeccion();
}
function tablaSeccion(){
    var tablaSeccion = $('#tablaSeccion').DataTable({
        "sDom": "tp",
        scrollY: "350px",
        scrollX: true,
        paging: false,
        oder: [[cS_NUM,'asc']],
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
    })

    contadorS(tablaSeccion);
    $('.thfilterS').on('keyup change blur',function () {let idc = this.getAttribute("idc");tablaSeccion.columns(idc).search( this.value ).draw();contadorS(tablaSeccion);});
}

function contadorS(tablaSeccion) {
    $('#cS'+cS_NUM).html(number_format(tablaSeccion.column(cS_NUM,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#cS'+cS_FEC).html(number_format(tablaSeccion.column(cS_FEC,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#cS'+cS_TIP).html(number_format(tablaSeccion.column(cS_TIP,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#cS'+cS_REF).html(number_format(tablaSeccion.column(cS_REF,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#cS'+cS_OBS).html(number_format(tablaSeccion.column(cS_OBS,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#cS'+cS_IMP).html('$'+number_format(tablaSeccion.column(cS_IMP,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2));
    $('#cS'+cS_PEN).html(
                        '$'+number_format(tablaSeccion.column(cS_PEN,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2)+' '+
                        '('+number_format(tablaSeccion.column(cS_PEN,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'    
    );
}
// ///////////////////////////////////////////////////////////////////////
});
</script>