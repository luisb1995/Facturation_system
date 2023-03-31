<div class="modal-header" style="background-color:#5063df;color:white;">
    <h4 class="modal-title" wire:key="modalLoadPresupuesto">
        Presupuestos emitidos
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" >
    <div wire:loading.grid wire:target="cargarPresupuesto" wire:key="loadingLoadPresupuesto">
        <div class="row text-center" style="height:500px;">
            <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                        <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div wire:loading.remove wire:target="cargarPresupuesto" wire:key="formLoadPresupuesto">
        <div class="row">

        </div>
        <div class="col-12 p-0">
            <table class="table table-dark table-sm table-hover table-centered">
                <thead>
                    <tr>
                        <th>N° de control</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($presupuestos!=null)
                        @foreach ($presupuestos as $invoice )
                            <tr>
                                <td>{{ $invoice->nroControl }}</td>
                                <td>{{ $invoice->client->nombre }}</td>
                                <td>{{ $invoice->fecha }}</td>
                                <td>Bs. {{ round($invoice->total,2) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success" wire:click="cargarPresupuesto({{ $invoice->id }})">Cargar</button>
                                    <button class="btn btn-sm btn-danger" wire:click="eliminarPresupuesto({{ $invoice->id }})"><i class="mdi mdi-close-box"></i></button>

                                </td>
                            </tr>
                        @endforeach
                    @endif


                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">

    <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <i class="mdi mdi-close-octagon-outline"></i> @lang("inventario.modal-close")
    </button>

</div>





