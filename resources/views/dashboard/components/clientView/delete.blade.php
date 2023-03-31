<div class="modal-header" style="background-color:#5063df;color:white;" wire:key="DeleteRegisterClientHeader">
    <h4 class="modal-title" id="exampleModalLabel">
       Eliminar Cliente: @if ($client_id!=null)
           {{ $nombre }}
       @endif
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body"  wire:key="DeleteRegisterClient">
    <div wire:loading.grid wire:target="default,preDestroy,destroy" wire:key="loadingClientDeleteRegister">
        <div class="row text-center" style="height:500px;">
            <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                        <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div wire:loading.remove wire:target="default,preDestroy,destroy" wire:key="formClientDeleteRegister">
        <div class="alert alert-danger">¿Desea usted eliminar al cliente: <strong>@if ($client_id!=null)
            {{ $nombre }}
        @endif</strong>? </div>
    </div>
</div>
<div class="modal-footer"  wire:key="DeleteRegisterClientFooter">
    <button wire:click="destroy" class="btn btn-primary" wire:key="clientDeleteRegisterBtn" wire:target="default,preDestroy,destroy,modificarCliente,cedula,nombre,direccion,email,telefono" wire:loading.attr="disabled">
        <i class="mdi mdi-content-save-outline"></i> Eliminar
    </button>
    <button wire:click="" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <i class="mdi mdi-close-octagon-outline"></i> Cerrar
    </button>

</div>





