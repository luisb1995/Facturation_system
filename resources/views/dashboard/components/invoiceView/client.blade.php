<div class="modal-header" style="background-color:#5063df;color:white;" wire:key="InvoiceRegisterClientHeader">
    <h4 class="modal-title" id="exampleModalLabel">
       Registrar Cliente
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body"  wire:key="InvoiceRegisterClient">
    <div wire:loading.grid wire:target="registrarCliente" wire:key="loadingClientInvoiceRegister">
        <div class="row text-center" style="height:500px;">
            <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                        <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div wire:loading.remove wire:target="registrarCliente" wire:key="formClientInvoiceRegister">
        <div class="row">
            <div class="col-12">
                <h4>Datos del cliente</h4>
                <hr/>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label><span style="color:red;">*</span> Nombre:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"  wire:key="formClientInvoiceName" style="background-color:#727CF5;color:white;"><i class="mdi mdi-format-align-justify"></i></span>
                        </div>
                    <input type="text" class="form-control" wire:model.debounce.lazy='nombre'>

                    </div>
                    @error('nombre') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label><span style="color:red;">*</span> Cedula:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class="mdi mdi-wallet"></i></span>
                        </div>
                    <input type="text" class="form-control" wire:key="formClientInvoiceCedula" wire:model.debounce.200ms='cedula'>

                    </div>
                    @error('cedula') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label><span style="color:red;">*</span> Email:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class="mdi mdi-wallet"></i></span>
                        </div>
                    <input type="email" class="form-control" wire:key="formClientInvoiceCedula" wire:model.debounce.lazy='email' value=".@.com">

                    </div>
                    @error('email') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label><span style="color:red;">*</span> Telefono:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class="mdi mdi-wallet"></i></span>
                        </div>
                    <input type="number" class="form-control" wire:key="formClientInvoiceCedula" wire:model.debounce.lazy='telefono'>

                    </div>
                    @error('telefono') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label><span style="color:red;">*</span> Direccion:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class="mdi mdi-wallet"></i></span>
                        </div>
                    <input type="text" class="form-control" wire:key="formClientInvoiceCedula" wire:model.debounce.200ms='direccion'>

                    </div>
                    @error('direccion') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer"  wire:key="InvoiceRegisterClientFooter">
    <button wire:click="registrarCliente" class="btn btn-primary" wire:key="clientInvoiceRegisterBtn" wire:target="registerClient,cedula,nombre,direccion,email,telefono" wire:loading.attr="disabled">
        <i class="mdi mdi-content-save-outline"></i> Registrar
    </button>
    <button wire:click="" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <i class="mdi mdi-close-octagon-outline"></i> Cerrar
    </button>

</div>





