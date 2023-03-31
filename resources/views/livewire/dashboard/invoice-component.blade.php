<div class="container-fluid">
    <div class="row">
        <div class="col-12">
              <div class="page-title-box">
                    <div class="page-title-right">
                          <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang("inventario.breadcum")</a></li>
                                <li class="breadcrumb-item active">@lang("inventario.breadcum1")</li>
                          </ol>
                    </div>
                    <h4 class="page-title">Modulo de caja y facturación</h4> 
                    <button class="btn btn-sm btn-primary" wire:click="default">Limpiar</button>
                   
                    
              </div>
        </div>
  </div>
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-body p-2">
                <div class="row">
                    <!--#########################################-->
                    <!--Formulario-->
                    <!--#########################################-->
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-group">
                                    <label>Cedula: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"  wire:key="invoiceClient" style="background-color:#727CF5;color:white;"><i class="mdi mdi-id-card"></i></span>
                                        </div>
                                    <input type="text" id="cedulaFocus" wire:model.debounce.300ms="cedula" wire:keydown.enter="consultarCliente" class="form-control" autocomplete="nope"
                                    @if($variablecita==1)
                                    @else
                                        @if ($client_id!='')
                                            disabled
                                        @endif
                                    @endif
                                    >
                                        
                                    </div>
                                    
                                    <span>Cliente: {{ $clientTitle }} @error('cedula') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-group">
                                    <label>Producto: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"  wire:key="productIconInvoice" style="background-color:#727CF5;color:white;"><i class="mdi mdi-barcode"></i></span>
                                        </div>

                                        <input type="text" id="codigoFocus" class="form-control" wire:model.debounce.300ms="productCode"  wire:keydown.F4="listaProductos" wire:keydown.enter="consultarProducto" wire:keydown.F2="procesarDocumento"  list="productos"
                                        @if($variablecita==1)
                                        @else
                                            @if ($client_id=='')
                                                disabled
                                            @endif
                                        @endif
                                        >
                                        <datalist id="productos" wire:click="prueba" style="width: 800px;">
                                             
                                            @foreach ($products as $product)
                                                <option value="{{ $product->codigo }}" ><label style="font-size:4px;">{{ $product->descripcion }}</label> Cant: <strong>{{ round($product->cantidad,3) }}</strong> / <strong>Bs. {{ $product->precio }}</strong></option>    
                                            @endforeach
                                            
                                            
                                        </datalist>
                                        
                                    </div>
                                    
                                    <span>Descripcion: {{ $productName }}@error('productCode') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-group">
                                    <label>Cantidad: @error('cantidad') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"  wire:key="invoiceClient" style="background-color:#727CF5;color:white;"><i class=" mdi mdi-pound-box-outline"></i></span>
                                        </div>
                                    <input id="cantidadFocus" step="0.001" type="number" class="form-control" wire:model.debounce.300ms="cantidad" wire:keydown.F2="procesarDocumento"  wire:keydown.enter="registrarDetalle"
                                    @if ($product_id=='')
                                        disabled
                                    @endif>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!--#########################################-->
                    <!--listado de productos en la factura-->
                    <!--#########################################-->
                    <div class="col-12 col-md-8 p-0" style="height:310px;
                    overflow-y: auto;background-color:#313A46;">
                        <table class="table table-sm table-dark table-hover table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody >
                                @if($invoice_id!=null)
                                    @foreach ($invoiceDetails->details as $detail)
                                    <tr>
                                        <td>{{ $detail->descripcion }}</td>
                                        <td>Bs. {{ $detail->precio }}</td>
                                        <td class="text-center" ><span class="badge badge-primary" style="font-size:14px;">{{ round($detail->cantidad,3) }}</span></td>
                                        <td>Bs. {{ $detail->total }}</td>
                                        <td>
                                            <span class="btn btn-sm btn-primary" wire:click="detailEdit({{ $detail->id }})"><i class="mdi mdi-pencil-box-outline"></i></span>
                                            <span class="btn btn-sm btn-danger" wire:click="eliminarDetalle({{ $detail->id }})"><i class="mdi mdi-close-box"></i></span>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                               
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
                    <!--#########################################-->
                    <!--Marco de totales y botones de facturacion-->
                    <!--#########################################-->
                <div class="row">
                    <!--######################-->
                    <!--Botones de facturacion-->
                    <!--######################-->
                    <div class="col-12 col-md-4  d-none d-md-block">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <button class="col-12 btn btn-success mb-1" wire:click="procesarDocumento" wire:key="procesarDocumentoPC"

                                    @if($invoice_id==null  )
                                        disabled style="cursor:not-allowed;"
                                    
                                    @elseif ($invoiceDetails->details->count()==0)
                                        disabled style="cursor:not-allowed;"
                                    @endif
                                >
                                    Facturar (F2)
                                </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button class="col-12 btn btn-danger mb-1" disable> Descarte </button>
                            </div>
                    

                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <button class="col-12 btn btn-warning mb-1" disable> Guardar </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button class="col-12 btn btn-info mb-1" disable>Documentos Guardados 
                                </button>
                            </div>
                    

                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <button class="col-12 btn btn-primary mb-1" disable> Presupuestar 
                                </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button class="col-12 btn btn-primary mb-1" disable>  Consultar presupuesto
                                </button>
                            </div>
                    

                        </div>
                        <div class="row mb-0">
                            <div class="col-12">
                                <div class="form-group">
                                    
                                    <div class="input-group">
                                    
                                        <input type="number" class="form-control" placeholder="(%) Porcentaje de Descuento " wire:model.debounce.200ms="descuento" wire:keydown.enter="descuento" wire:key="descuentoPC"
                                            @if($invoice_id==null  )
                                                disabled style="cursor:not-allowed;"
                                            
                                            @elseif ($invoiceDetails->details->count()==0)
                                                disabled style="cursor:not-allowed;"
                                            @endif
                                        >
                                        <div class="input-group-prepend">
                                            <button class="btn btn-primary btn-sm" id="basic-addon1"  disable>        Aplicar</button>
                                        </div>    
                                    </div>
                                    @error('descuento') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                    
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    <!--#########################-->
                    <!--Marco de datos economicos-->
                    <!--#########################-->
                    <div class="col-12 col-md-8 mb-1">
                        <div class="row">
                            <div class="col-8  table-dark" >
                                <div class="col-12">
                                    <h3 class="d-none d-md-block">Subtotal: Bs. {{ $subtotal }}  </h3>
                                    <h5 class="d-block d-md-none">Subtotal: Bs. {{ $subtotal }} </h5>
                                </div>
                                <div class="col-12"> 
                                    <h3  class="d-none d-md-block">Exento: Bs. {{ $exento }}</h3>
                                    <h5  class="d-block d-md-none">Exento: Bs. {{ $exento }}</h5>
                                </div>
                                <div class="col-12"> 
                                    <h3 class="d-none d-md-block">IVA: Bs. {{ $iva }}</h3>
                                    <h5 class="d-block d-md-none">IVA: Bs. {{ $iva }}</h5>
                                </div>
                                <div class="col-12"> 
                                    <h3 class="d-none d-md-block">Descuento: Bs. {{ $descuentoMonto }}</h3>
                                    <h5 class="d-block d-md-none">Descuento: Bs. {{ $descuentoMonto }}</h5>
                                </div>

                            </div>
                            <div class="col-4 text-center table-dark" >
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="d-none d-md-block">
                                            Total:<br>
                                            Bs. {{ $total }}
                                        </h2>
                                        <h4 class="d-block d-md-none">
                                            Total:<br>
                                            Bs. {{ $total }}
                                        </h4>
                                    </div>
                                    <div class="col-12">
                                        <h2 class="d-none d-md-block">
                                            Total $:<br>
                                            $ {{ $totalDivisa }}
                                        </h2>
                                        <h4 class="d-block d-md-none">
                                            Total $:<br>
                                            $ {{ $totalDivisa }}
                                        </h4>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                       
                        
                    </div>
                    <!--######################-->
                    <!--Botones de movil-->
                    <!--######################-->
                    <div class="col-12 col-md-4 d-block d-md-none">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <button class="col-12 btn btn-success mb-1" wire:click="procesarDocumento" wire:key="procesarDocumentoMovil"
                                    @if($invoice_id==null  )
                                        disabled style="cursor:not-allowed;"
                                    
                                    @elseif ($invoiceDetails->details->count()==0)
                                        disabled style="cursor:not-allowed;"
                                    @endif
                                >
                                    Facturar (F2)
                                </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button class="col-12 btn btn-danger mb-1" disable> Descarte </button>
                            </div>
                    

                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <button class="col-12 btn btn-warning mb-1" disable>Guardar </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button class="col-12 btn btn-info mb-1" disable> Documentos guardados </button>
                            </div>
                    

                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <button class="col-12 btn btn-primary mb-1" wire:click="emitirDocumento(2)" disable>Presupuestar </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button class="col-12 btn btn-primary mb-1" disable>Consultar presupuesto
                                </button>
                            </div>
                    

                        </div>
                        <div class="row mb-0">
                            <div class="col-12">
                                <div class="form-group">
                                    
                                    <div class="input-group">
                                    
                                        <input type="number" class="form-control" placeholder="Descuento" wire:model.debounce.200ms="descuento" wire:keydown.enter="aplicarDescuento" wire:key="descuentoMovil"
                                            @if($invoice_id==null  )
                                                disabled style="cursor:not-allowed;"
                                            
                                            @elseif ($invoiceDetails->details->count()==0)
                                                disabled style="cursor:not-allowed;"
                                            @endif
                                        >
                                        <div class="input-group-prepend">
                                            <button class="btn btn-primary btn-sm" id="basic-addon1"  wire:key="invoiceDiscountBtn" 
                                            style="background-color:#727CF5;color:white;"
                                            wire:click="aplicarDescuento" wire:target="descuento" wire:loading.attr="disabled"
                                            
                                            >Aplicar</button>
                                        </div>    
                                    </div>
                                    @error('descuento') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                    
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="inventarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  @include("dashboard.components.invoiceView.$view")
                  
                    
              </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="descarteModal" tabindex="-1" role="dialog" aria-labelledby="inventarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  @include("dashboard.components.invoiceView.descarte")
                  
                    
              </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="descuentoModal" tabindex="-1" role="dialog" aria-labelledby="inventarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  @include("dashboard.components.invoiceView.descuento")
                  
                    
              </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="paysModal" tabindex="-1" role="dialog" aria-labelledby="paysModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
              <div class="modal-content">
                  @include("dashboard.components.invoiceView.pays")
                  
                    
              </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="utilityModal" tabindex="-1" role="dialog" aria-labelledby="utilityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  @include("dashboard.components.invoiceView.$view2")
                  
                    
              </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="productEditModal" tabindex="-1" role="dialog" aria-labelledby="productEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  @include("dashboard.components.invoiceView.$view")
                  
                    
              </div>
        </div>
    </div>
</div>
