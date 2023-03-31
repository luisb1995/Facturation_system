<div class="modal-header" style="background-color:#5063df;color:white;" wire:key="administrationAutorizationHeader">
    <h4 class="modal-title" id="exampleModalLabel">
       Ingrese la clave de autorización para proceder
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body"  wire:key="administrationAutorization">
    <div wire:loading.grid wire:target="update,modalUpdate" wire:key="loadingadministrationAutorization">
        <div class="row text-center" style="height:500px;">
            <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                        <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div wire:loading.remove wire:target="update,modalUpdate" wire:key="formadministrationAutorization">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>Clave autorización:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionClave" style="background-color:#727CF5;color:white;"><i class="mdi mdi-key-outline"></i></span>
                    </div>
                <input type="password" class="form-control" wire:model.debounce.250ms='clave'  placeholder="Clave de supervisor">

                </div>
                @error('clave') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
            </div>
        </div>
    </div>
</div>
<div class="modal-footer"  wire:key="administrationAutorizationFooter">
    <button wire:click="update" class="btn btn-primary" wire:key="clientDeleteRegisterBtn" wire:target="clave,update,modalUpdate" wire:loading.attr="disabled">
        <i class="mdi mdi-content-save-outline"></i> Guardar
    </button>
    <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <i class="mdi mdi-close-octagon-outline"></i> Cerrar
    </button>

</div>





