<div class="modal-header" style="background-color:#5063df;color:white;">
    <h4 class="modal-title" id="exampleModalLabel">
            Agregar Rol
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <h3>Datos del rol</h6>
        <hr class="separator">
    <div class="form-group">
        <label >Nombre del rol</label>
        <input type="text" class="form-control" wire:model.lazy='name'>
        @error('name') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
    </div>
</div>
<div class="modal-footer">
    <button wire:click="store()" class="btn btn-primary">
        Guardar
    </button>

</div>
