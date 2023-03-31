<div class="modal-header" style="background-color:#5063df;color:white;" wire:key="EditRegisterClientHeader">
    <h4 class="modal-title" id="exampleModalLabel">
       Modificar Cliente
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body"  wire:key="EditRegisterClient">
    <div wire:loading.grid wire:target="default,edit,update" wire:key="loadingClientEditRegister">
        <div class="row text-center" style="height:500px;">
            <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                        <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div wire:loading.remove wire:target="default,edit,update" wire:key="formClientEditRegister">
        @include('dashboard.components.clientView.form')
    </div>
</div>
<div class="modal-footer"  wire:key="EditRegisterClientFooter">
    <button wire:click="update" class="btn btn-primary" wire:key="clientEditRegisterBtn" wire:target="default,update,edit,modificarCliente,cedula,nombre,direccion,email,telefono" wire:loading.attr="disabled">
        <i class="mdi mdi-content-save-outline"></i> Guardar
    </button>
    <button wire:click="" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <i class="mdi mdi-close-octagon-outline"></i> Cerrar
    </button>

</div>





