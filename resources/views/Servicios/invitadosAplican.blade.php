<!---------------------->
<div class="modal-header">
    <h4 class="modal-title col-12 text-center titulomodal">MEMBRESIAS CLIENTE</h5>
</div>
{{--  --}}
<div class="modal-body">
    <div class="bodymodal">
        <table id="tablaMembresiasActivas" class="styled-table" style="width:100%">
            <thead>
                <tr>
                    <th class="col" style="width: 10% !important;">INICIO</th>
                    <th class="col" style="width: 10% !important;">FIN</th>
                    <th class="col" style="width: 10% !important;">C</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tabla as $t)
                    <tr>
                        <td class="lefti">{{$t->invitado}}</td>
                        <td>{{fechaFormato($t->fechaRegistro)}}</td>
                        <td>{{$t->sta}}</td>
                    </tr>
                @endforeach
            </tbody>
            {{-- <tfoot>
                <tr>
                    <td class="filtercol"><input type="text" class="thfilter" idc="0" id="i0"></td>
                </tr>
            </tfoot> --}}
        </table>
    </div>
</div>
<!---------------------->
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modalainvitadosAplican').modal('hide');">CERRAR</button>
</div>

<script>
$( "#modalainvitadosAplican" ).on('shown.bs.modal', function (e) {
// ///////////////////////////////////////////////////////////////////////
if(!$.fn.dataTable.isDataTable("#tablaMembresiasActivas")){
tablaMembresiasActivas();
}
function tablaMembresiasActivas(){
var tablaMembresiasActivas = $('#tablaMembresiasActivas').DataTable({
    "sDom": "tp",
    scrollY: "350px",
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
}
// ///////////////////////////////////////////////////////////////////////
});
</script>
