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
                    <span class="input-group-text" id="basic-addon1"  wire:key="formClientInterfaceName" style="background-color:#727CF5;color:white;"><i class="mdi mdi-format-align-justify"></i></span>
                </div>
            <input type="text" class="form-control" wire:model.debounce.200ms='nombre'>
                
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
            <input type="text" class="form-control" wire:key="formClientInterfaceCedula" wire:model.debounce.200ms='cedula' @if ($view=='edit')
                disabled
            @endif>
                
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
            <input type="email" class="form-control" wire:key="formClientInterfaceCedula" wire:model.debounce.200ms='email'>
                
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
            <input type="number" class="form-control" wire:key="formClientInterfaceCedula" wire:model.debounce.200ms='telefono'>
                
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
            <input type="text" class="form-control" wire:key="formClientInterfaceCedula" wire:model.debounce.200ms='direccion'>
                
            </div>
            @error('direccion') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
</div>