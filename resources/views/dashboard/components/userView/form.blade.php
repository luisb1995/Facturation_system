

    
    <h3>Datos del usuario</h6>
        <hr class="separator">
    <div class="form-group">
        <label ><span style="color:red;">*</span> Usuario:</label>
        <input type="text" class="form-control" wire:model.lazy='username'
        @if ($view == 'create')
            wire:keydown.enter="store"
        @else
            wire:keydown.enter="update"
        @endif
        >
        @error('name') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label ><span style="color:red;">*</span> Nombre</label>
        <input type="text" class="form-control" wire:model.lazy='name'
        @if ($view == 'create')
            wire:keydown.enter="store"
        @else
            wire:keydown.enter="update"
        @endif
        >
        @error('name') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label ><span style="color:red;">*</span> Email</label>
        <input type="text" class="form-control" wire:model.lazy='email' @if ($view == 'edit')
            disabled
        @else 
            wire:keydown.enter="store"
        @endif>
        @error('email') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label><span style="color:red;">*</span> Permisología</label>
        <select wire:model.debounce.250ms="role_id" class="form-control">
            <option value="">Seleccione una opción</option>
            @foreach ($roles as $role)
                @if($role->name!="Super Admin")
                    <option value="{{ $role->id }}">{{ $role->name }}</option>    
                @endif
            @endforeach
        </select>
        @if ($view == 'edit')
        <label>Permisología Actual: <strong>{{ $roleAssign }}</strong></label>    
        @endif
        
        @error('role_id') <br><span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> El campo permisología es obligatorio</span> @enderror
    </div>
    
        <div class="form-group">
            @if ($view == 'create')
            <label ><span style="color:red;">*</span> Contraseña</label>
            @else
            <label ><span style="color:red;">*</span>Nueva Contraseña</label>
            @endif
            <input type="text" class="form-control" wire:model.lazy='password' wire:keydown.enter="store">
            @error('password') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    @if ($view == 'create')
        <div class="form-group">
            <label >Confirme la contraseña</label>
            <input type="text" class="form-control" wire:model.debounce.250ms='password_confirmation' wire:keydown.enter="store">
            @error('password_confirmation') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    @endif
    





    




