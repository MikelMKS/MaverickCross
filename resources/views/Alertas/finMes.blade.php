<!---------------------->
<div class="modal-header">
    <h4 class="modal-title col-12 text-center titulomodal">FIN MENSUALIDAD</h5>
</div>
{{--  --}} 
<div class="modal-body">
    <div class="bodymodal">
        {{--  --}}
        @foreach($datos as $d)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if(existeArchivo('assets/clientes', $d->id . '.png'))
                            <img id="blahEdit" src="assets/clientes/{{$d->id}}.png?v={{ date('mdHis') }}" class="img-fluid rounded-start">
                        @else
                            <img id="blahEdit" src="img/usuario-vacio.png" class="img-fluid rounded-start">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                        <h5 class="card-title">{{strtoupper($d->cliente)}}</h5>
                        <p class="card-text">Inicio: {{$d->inicio}} / Fin: {{$d->fin}}</p>
                        <p class="card-text2">@if($d->dias_transcurridos == 0) Finaliza Hoy @elseif($d->dias_transcurridos == 1) Finalizo Ayer @else Finalizo hace {{$d->dias_transcurridos}} días @endif</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{--  --}}
    </div>
</div>
<!---------------------->
<div class="modal-footer">
    @if($visto[0]->visto == 0)
        <button type="button" class="btn btn-success btn-sm" onclick="enteradoFinMes('{{$visto[0]->id}}')">ENTERADO</button>
    @endif
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modalverNotificacion').modal('hide');">CERRAR</button>
</div>

<script>
    function enteradoFinMes(id){
        $.ajax({
            data: { 'id':id, _token: "{{ csrf_token() }}" },
            type : "GET",
            url : "{{route('enteradoFinMes')}}",
            beforeSend : function () {
                swalLoading();
            },
            success:  function (response) {
                swalTimer('success','ACTUALIZANDO','');
                window.location.reload(); 
            },
            error: function(error) {
                swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
            }
        });
    }
</script>