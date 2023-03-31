    <!--header del modal-->

    <div class="modal-header" style="background-color:#5063df;color:white;">

        <h4><strong>Procesar pagos de factura</strong></h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>


    <div class="modal-body" style="font-weight:bold;">
        <div wire:loading.grid wire:target="calcularPago,emitirDocumento" wire:key="loadingPaysInvoiceRegister">
            <div class="row text-center" style="height:500px;">
                <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                    <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                            <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <div wire:loading.remove wire:target="calcularPago,emitirDocumento" wire:key="formPaysInvoiceRegister">

            <div class="row">
                <div class="col-4 text-left">Total:</div>
                <div class="col-8 text-right">{{ number_format($totalFactura,2,',','.') }} Bs</div>

            </div>
            <div class="row">
                <div class="col-4 text-left">Total divisa:</div>
                <div class="col-8 text-right">$.{{  number_format($totalDivisa,4,',','.') }}</div>

            </div>

            <div class="row">
                <div class="col-4 text-left">Restante:</div>
                <div class="col-8 text-right" id="labelRestante">{{ number_format($totalRestante,2,',','.') }} Bs</div>
            </div>

            <div class="row">
                <div class="form-group col-12 col-md-6 text-center">
                    <label>
                        Tipo documento
                    </label>
                    <select  wire:model.debounce.500ms="notaEntrega" class="form form-control">
                        <option value="1">Factura de Venta</option>
                        <option value="3">Nota Entrega</option>
                    </select>
                </div>
                <div class="form-group col-12 col-md-6 text-center">
                    <label>
                        Tipo Impresion
                    </label>
                    <select  wire:model.debounce.500ms="tickera" class="form form-control">
                        <option value="0">Forma Libre</option>
                        <option value="1">Tickera</option>
                    </select>
                </div>
            </div>
            @if($notaEntrega!=3)
            <div class="col-12 text-center mt-2 mb-3">
                <label class="col-12">Registrar pagos</label>
            </div>

            <!--FORMULARIO CON CAMPOS-->
            <div class="form-group col-12">
                    <label for="pagoDebito">
                        Monto tarjeta de debito.
                    </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color:#727CF5;color:white;">
                        Bs.
                        </span>
                    </div>
                    <input type="number" wire:model.debounce.500ms="debito" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" value="0" step="1" min="0" class="form-control">
                    <div class="input-group-prepend" style="background-color:#727CF5;color:white;">
                        <span class="input-group-text" style="background-color:#727CF5;color:white;">
                            Ref:
                        </span>
                    </div>
                    <input type="text" placeholder="#Referencia" wire:model.debounce.500ms="refDebito" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" class="form-control">
                    </div>
            </div>
            <div class="form-group col-12">
                    <label for="pagoBolivar">
                        Monto bolivares en efectivo.
                    </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color:#727CF5;color:white;">
                        Bs.
                        </span>
                    </div>
                    <input type="number"  wire:model.debounce.500ms="bolivares" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" value="0" step="1" min="0" class="form-control">
                    </div>
            </div>
            <!--<div class="form-group col-12">
                    <label for="pagoDivisa2">
                        Monto divisa BCV
                    </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color:#727CF5;color:white;">
                        $
                        </span>
                    </div>
                    <input type="number" wire:model.debounce.500ms="divisa2" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" value="0" step="1" min="0" class="form-control" >
                    </div>
                </div>-->

                <div class="form-group col-12">
                    <label for="pagoDivisa">
                        Monto divisa
                    </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color:#727CF5;color:white;">
                        $
                        </span>
                    </div>
                    <input type="number" wire:model.debounce.500ms="divisa" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" value="0" step="1" min="0" class="form-control" >
                    </div>
                </div>
                <!--<div class="form-group col-12">
                        <label for="pagoDivisa">
                            Monto transferencia zelle BCV.
                        </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" style="background-color:#727CF5;color:white;">
                            $
                            </span>
                        </div>
                        <input type="number"  wire:model.debounce.500ms="zelle2" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" value="0" step="1" min="0" class="form-control">
                        <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color:#727CF5;color:white;">
                            Ref:
                        </span>
                        </div>
                            <input type="text" placeholder="# Referencia" wire:model.debounce.500ms="refZelle2" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" class="form-control">
                        </div>
                </div>-->
                <div class="form-group col-12">
                        <label for="pagoDivisa">
                            Monto transferencia zelle.
                        </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" style="background-color:#727CF5;color:white;">
                            $
                            </span>
                        </div>
                        <input type="number"  wire:model.debounce.500ms="zelle" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" value="0" step="1" min="0" class="form-control">
                        <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color:#727CF5;color:white;">
                            Ref:
                        </span>
                        </div>
                            <input type="text" placeholder="# Referencia" wire:model.debounce.500ms="refZelle" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" class="form-control">
                        </div>
                </div>


                <div class="form-group col-12">
                    <label for="pagoCredito">
                        Monto tarjeta de credito.
                    </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color:#727CF5;color:white;">
                        Bs.
                        </span>
                    </div>
                    <input type="number" wire:model.debounce.500ms="credito" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" value="0" step="1" min="0" class="form-control">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color:#727CF5;color:white;">
                            Ref:
                        </span>
                    </div>
                    <input type="text" placeholder="# Referencia"  wire:model.debounce.500ms="refCredito" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" class="form-control">
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="pagoTransferencia">
                        Monto transferencia bancaria.
                    </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="background-color:#727CF5;color:white;">
                            Bs.
                            </span>
                        </div>
                    <input type="number" wire:model.debounce.500ms="transferencia" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" value="0" step="1" min="0" class="form-control">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color:#727CF5;color:white;">
                            Ref:
                        </span>
                    </div>
                    <input type="text" placeholder="# Referencia"  wire:model.debounce.500ms="refTransferencia" wire:keydown.enter="emitirDocumento({{ $notaEntrega }})" class="form-control">
                    </div>

                </div>
            @endif
        </div>


    </div>

    <div class="modal-footer">
        <button class="btn btn-success" title="Procesar." wire:click="emitirDocumento({{ $notaEntrega }})">
            <span style="color:white;cursor:pointer;">
            <i class="fa fa-check-square"></i>
            </span>
            <span class="d-none d-md-inline">Procesar</span>
        </button>
        <button class="btn btn-danger" title="Cancelar." data-dismiss="modal">
            <span style="color:white;cursor:pointer;">
            <i class="fa fa-times-circle"></i>
            </span>
            <span class="d-none d-md-inline">Cerrar</span>
        </button>

    </div>
