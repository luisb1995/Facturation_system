<div class="modal-header" style="background-color:#5063df;color:white;">
    <h4 class="modal-title" id="exampleModalLabel">
        @lang("inventario.modal-title1")
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" >
    <div wire:loading.grid wire:target="store" wire:key="loadingStoreProduct">
        <div class="row text-center" style="height:500px;">
            <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                        <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div wire:loading.remove wire:target="store" wire:key="formStoreProduct">
        @include('dashboard.components.inventarioView.form')
    </div>
</div>
<div class="modal-footer">
    <button wire:click="store" class="btn btn-primary" wire:key="storeProductBtn" wire:target="store,description,codigo,stock,cost,price,gain,dolar,iva,exchange" wire:loading.attr="disabled">
        <i class="mdi mdi-content-save-outline"></i> @lang("inventario.modal-add")
    </button>
    <button wire:click="default" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <i class="mdi mdi-close-octagon-outline"></i> @lang("inventario.modal-close")
    </button>

</div>





