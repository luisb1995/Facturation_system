<div class="modal-header" style="background-color:#5063df;color:white;">
    <h5 class="modal-title" id="exampleModalLabel" style="">
        @lang("inventario.modal-title2")
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" >
    <div wire:loading.grid wire:target="update" wire:key="loadingUpdateProduct">
        <div class="row text-center" style="height:500px;">
            <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                        <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div wire:loading.remove wire:target="update" wire:key="formUpdateProduct">
        @include('dashboard.components.inventarioView.form')
    </div>


</div>
<div class="modal-footer">
    <button wire:click="update" class="btn btn-primary" wire:target="update,description,codigo,stock,cost,price,gain,dolar,iva,exchange" wire:loading.attr="disabled" wire:key="updateProductBtn">
        <i class="mdi mdi-content-save-outline"></i> @lang("inventario.modal-save")
    </button>
    <button wire:click="default" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <i class="mdi mdi-close-octagon-outline"></i> @lang("inventario.modal-close")
    </button>
</div>


