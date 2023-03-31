<div class="modal-header" style="background-color:#5063df;color:white;">
    <h4 class="modal-title" id="exampleModalLabel">
        @lang("inventario.modal-title4")
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" >
    <div wire:loading.grid wire:target="importExcel" wire:key="loadingimportExcelProduct">
        <div class="row text-center" style="height:500px;">
            <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                        <span class="sr-only">@lang('inventario.modal-loading')</span>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div wire:loading.remove wire:target="importExcel" wire:key="formimportExcelProduct">
        <div class="col-12">
            <div class="form-group">
                <label>@lang("inventario.modal-file")</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"  wire:key="formFileInventario" style="background-color:#727CF5;color:white;"><i class="mdi mdi-format-align-justify"></i></span>
                    </div>
                <input type="file" class="form-control" wire:model='excelFile' wire:target="excelFile" wire:loading.attr="disabled">


                </div>
                <small>@lang('inventario.import-note')</small><br>
                @error('excelFile') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror

            </div>
        </div>
        <div class="col-12">

            <button class="btn btn-primary" wire:click="template"><i class="mdi mdi-cloud-download-outline"></i> @lang('inventario.template')</button>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button wire:click="importExcel" class="btn btn-primary" wire:key="importExcelProductBtn" wire:target="importExcel,excelFile" wire:loading.attr="disabled">
        <i class="mdi mdi-content-save-outline"></i> @lang("inventario.modal-import")
    </button>
    <button wire:click="default" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <i class="mdi mdi-close-octagon-outline"></i> @lang("inventario.modal-close")
    </button>

</div>





