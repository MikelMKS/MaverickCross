<!---------------------->
<div class="modal-header">
    <h4 class="modal-title col-12 text-center titulomodal">CUMPLEAÑOS</h5>
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
                        <h5 class="card-title">{{strtoupper($d->nombre)}} {{strtoupper($d->apellidoP)}} {{strtoupper($d->apellidoM)}}</h5>
                        <p class="card-text">Cumpliendo {{$d->edad}} años</p>
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
        <button type="button" class="btn btn-success btn-sm" onclick="enteradoCumpleaños('{{$visto[0]->id}}')">ENTERADO</button>
    @endif
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modalverNotificacion').modal('hide');">CERRAR</button>
</div>

<script>
    function enteradoCumpleaños(id){
        $.ajax({
            data: { 'id':id, _token: "{{ csrf_token() }}" },
            type : "GET",
            url : "{{route('enteradoCumpleaños')}}",
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