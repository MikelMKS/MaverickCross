@extends('Login.main')

@section('contenido')
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<h5 class="card-title">
</h5>
<p></p>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<section class="section profile">
<div class="row">
    <table id="Dtable" class="styled-table" style="width:100%">
        <thead>
            <tr>
                <th class="colcont" id="c0"></th>
                <th class="colcont" id="c1"></th>
            </tr>
            <tr>
                <th class="col" style="width: 60% !important;">CLIENTE</th>
                <th class="col" style="width: 40% !important;">PENDIENTE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tabla as $t)
                <tr>
                    <td class="lefti drillin" onclick="window.open('{{route('servicios')}}?idCliente={{$t->id}}')">{{$t->nombre}} {{$t->apellidoP}} {{$t->apellidoM}} </td>
                    <td>$ {{$t->deuda}}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="filtercol"><input type="text" class="thfilter" idc="0" id="i0"></td>
                <td class="filtercol"><input type="text" class="thfilter" idc="1" id="i1"></td>
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
var c_CLI = 0;
var c_PEN = 1;
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
    $('#c'+c_CLI).html(number_format(Dtable.column(c_CLI,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_PEN).html('$ '+number_format(Dtable.column(c_PEN,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2));
}
// ///////////////////////////////////////////////////////////////////////
</script>
@endsection