<div class="modal-header" style="background-color:#5063df;color:white;">
    <h4 class="modal-title" id="exampleModalLabel">
            Editar rol y permisos
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
            <input type="text" class="form-control" wire:model.lazy='name' disabled>
            @error('name') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <h3>Permisos</h6>
        <hr class="separator">
        <form id="editRoleForm">
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-6">
                        <div class="custom-control custom-switch">
                            <input type="checkbox"
                            @if ($roleEdit->hasPermissionTo($permission->name))
                            checked
                            @else

                            @endif
                            class="custom-control-input" id="customSwitch{{ $permission->id }}" wire:click="swapPermission({{ $permission->id }})">
                            <label class="custom-control-label" for="customSwitch{{ $permission->id }}">{{ $permission->name }}</label>
                        </div><hr class="separator">
                    </div>
                @endforeach
            </div>
        </form>

</div>
<div class="modal-footer">
    <button  class="btn btn-primary" class="close" data-dismiss="modal">
        <i class="mdi mdi-close-octagon-outline"></i> Cerrar
    </button>

</div>
