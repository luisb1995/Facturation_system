<div class="modal-header" style="background-color:#5063df;color:white;">
    <h5 class="modal-title" id="exampleModalLabel" style="">
            Editar Usuario
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div wire:loading.grid wire:target="default,edit,update,destroy,preDestroy,store" wire:key="loadingUpdateUser">
        <div class="row text-center" style="height:700px;">
              <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                    <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                          <span class="sr-only">Loading...</span>
                    </div>

              </div>
        </div>
        <br>
    </div>
    <div wire:loading.remove wire:target="default,edit,update,destroy,preDestroy,store" wire:key="updateUserForm">

            @include('dashboard.components.userView.form')



    </div>
</div>
<div class="modal-footer">
    <button wire:click="update" class="btn btn-primary" wire:loading.attr="disabled" wire:key="updateUser">
        <i class="mdi mdi-content-save-outline"></i> Actualizar
    </button>
    <button wire:click="default" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <i class="mdi mdi-close-octagon-outline"></i> Cerrar
    </button>
</div>


