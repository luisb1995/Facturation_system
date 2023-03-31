<div class="modal-header" style="background-color:#5063df;color:white;">
    <h4 class="modal-title" id="exampleModalLabel">
            Eliminar rol
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <h3><strong>¿Desea usted eliminar el rol: {{ $name }}?</strong></h3>
</div>
<div class="modal-footer">
    <button  class="btn btn-danger" wire:click="destroy" class="close" data-dismiss="modal">
        Eliminar
    </button>
    <button  class="btn btn-primary" class="close" data-dismiss="modal">
        Cerrar
    </button>
</div>
