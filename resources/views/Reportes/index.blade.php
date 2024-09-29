@extends('Login.main')

@section('contenido')
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<h5 class="card-title">
    <button type="button" class="btn btn-success" onclick="agregarServicioMain();">Agregar</button>
</h5>
<p></p>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<section class="section profile">
<div class="row">
    <table id="Dtable" class="styled-table" style="width:100%">
        <thead>
            <tr>
                <th class="col" style="width: 2% !important;">ID</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td></td>
                </tr>
        </tbody>
        <tfoot>
            <tr>
                <td class="filtercol"><input type="text" class="thfilter" idc="0" id="i0"></td>
            </tr> 
        </tfoot>
    </table>
</div>
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
var c_CID = 0;
// ///////////////////////////////////////////////////////////////////////
Dtable();
function Dtable(){
var Dtable = $('#Dtable').DataTable({
    "sDom": "tp",
    scrollY: "500px",
    scrollX: true,
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
})
Dtable.buttons().container().appendTo($('.colvisBut'));

contador(Dtable);

$('.thfilter').on('keyup change blur',function () {let idc = this.getAttribute("idc");Dtable.columns(idc).search( this.value ).draw();contador(Dtable);});
}

function contador(Dtable) {
    $('#c'+c_CID).html(number_format(Dtable.column(c_CID,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
}
// ///////////////////////////////////////////////////////////////////////
</script>
@endsection