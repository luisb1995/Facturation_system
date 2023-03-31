<div class="modal-header" style="background-color:#5063df;color:white;" wire:key="HeadInvoiceDescarte">
    <h4 class="modal-title" id="InvoiceDescarteModalLabel">
       Aplicar descuento
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" wire:key="InvoiceDescarte">
    <div wire:loading.grid wire:target="procesarDescuento" wire:key="loadingInvoiceDescuento">
        <div class="row text-center" style="height:200px;">
            <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                        <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div wire:loading.remove wire:target="procesarDescuento" wire:key="formInvoiceDescuento">
        <div class="row">
            <div class="col-12">
                <h4>Clave de autorizacion de descuento</h4>
                <hr/>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label>Cantidad:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"  wire:key="formClaveSupervisor" style="background-color:#727CF5;color:white;"><i class="mdi mdi-format-align-justify"></i></span>
                        </div>
                    <input type="password" class="form-control" wire:model.debounce.200ms='claveSupervisor'>

                    </div>
                    @error('claveSupervisor') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                </div>
            </div>


        </div>
    </div>
</div>
<div class="modal-footer" wire:key="InvoiceDescuentoFooter">
    <button wire:click="aplicarDescuento" class="btn btn-primary" wire:key="InvoiceDescuentoBtn" wire:target="procesarDescarte,claveSupervisor" wire:loading.attr="disabled">
        <i class="mdi mdi-content-save-outline"></i> Procesar
    </button>
    <button wire:click="" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <i class="mdi mdi-close-octagon-outline"></i> Cerrar
    </button>

</div>





