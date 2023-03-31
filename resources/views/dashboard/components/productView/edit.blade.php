<div class="modal-header" style="background-color:#5063df;color:white;">
    <h5 class="modal-title" id="exampleModalLabel" style="">
            Editar producto
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" >
    @include('dashboard.components.productView.form')



</div>
<div class="modal-footer">
    <button wire:click="update" class="btn btn-primary" wire:loading.attr="disabled" wire:target="update" wire:key="updateProductBtn">
        <i class="mdi mdi-content-save-outline"></i> Actualizar
    </button>
    <button wire:click="default" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <i class="mdi mdi-close-octagon-outline"></i> Cerrar
    </button>
</div>


