<div class="modal-header" style="background-color:#5063df;color:white;">
    <h5 class="modal-title" id="exampleModalLabel" style="">
            Eliminar Usuario
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div wire:loading.grid wire:target="default,edit,update,destroy,preDestroy,store" wire:key="loadingDeleteUser">
        <div class="row text-center" style="height:515px;">
              <div
              style="width:100%;margin-top: auto;
              margin-bottom: auto;">
                    <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                          <span class="sr-only">Loading...</span>
                    </div>

              </div>
        </div>
        <br>
    </div>

    <div wire:loading.remove wire:target="default,edit,update,destroy,preDestroy,store" wire:key="formDeleteUser">
        <div class="alert alert-danger">
            <h5><strong>¿Desea usted eliminar el usuario: {{ $name }}?</strong></h5>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button wire:click="destroy({{ $user_id }})" class="btn btn-primary" wire:loading.attr="disabled" wire:target="destroy">
        <i class="mdi mdi-trash-can-outline"></i> Eliminar
    </button>
    <button wire:click="default" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <i class="mdi mdi-close-octagon-outline"></i> Cancelar
    </button>
</div>
