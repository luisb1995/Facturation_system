<div class="row">
    <div class="col-12">
        <h4>@lang("inventario.modal-section1")</h4>
        <hr/>
    </div>
    
    <div class="col-6">
        <div class="form-group">
            <label><span style="color:red;">*</span> @lang("inventario.modal-descripcion")</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"  wire:key="formDescriptionInventario" style="background-color:#727CF5;color:white;"><i class="mdi mdi-format-align-justify"></i></span>
                </div>
            <input type="text" class="form-control" wire:model.lazy='description' wire:target="description"
            

            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
                wire:loading.attr="disabled"
            @endif
            >
                
            </div>
            @error('description') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>@lang("inventario.modal-category")</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class="mdi mdi-wallet"></i></span>
                </div>
            <select class="form-control" wire:key="formCategoriaInventario" wire:model.debounce.350ms='category_id' wire:target="category_id" wire:loading.attr="disabled">
                <option value="">@lang("inventario.modal-select")</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
                

            </select>
            </div>
            @error('iva') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label><span style="color:red;">*</span> @lang("inventario.modal-code")</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class="mdi mdi-barcode"></i></span>
                </div>
                <input type="text" class="form-control "  wire:key="formCodigoInventario" wire:model.lazy='codigo'  wire:target="codigo"
                    @if ($view=="create")
                        wire:keydown.enter="store"
                    @else 
                        wire:keydown.enter="update" 
                        wire:loading.attr="disabled"       
                    @endif
                    
                    >
            </div>
            @error('codigo') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
    
    <div class="col-6">
        <div class="form-group">
            <label><span style="color:red;">*</span> @lang("inventario.modal-stock")</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class=" mdi mdi-pound-box-outline"></i></span>
                </div>
                <input type="number" step="0.001" wire:key="formStockInventario" class="form-control" wire:model.lazy='stock' wire:target="stock" 
                    @if ($view=="create")
                        wire:keydown.enter="store"
                    @else 
                        wire:keydown.enter="update"  
                        wire:loading.attr="disabled"      
                    @endif
                    >
            </div>
            @error('stock') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-12">
        <h4>@lang("inventario.modal-section2")</h4>
        <hr/>
    </div>
    
    <div class="col-6">
        <div class="form-group">
            <label><span style="color:red;">*</span> @lang("inventario.modal-cost")</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class="mdi mdi-coin-outline"></i></span>
                </div>
            
            <input type="number" step="0.01" 
            wire:key="formCostInventario" 
            class="form-control" 
            wire:model.lazy='cost' 
            wire:target="cost,gain,price,dolar"
                
                wire:loading.attr="disabled"     
            
            >
            </div>
            @error('cost') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label><span style="color:red;">*</span> @lang("inventario.modal-gain")</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class=" mdi mdi-percent"></i></span>
                </div>
            <input type="number" step="0.01" 
            wire:key="formGainInventario"
             class="form-control" 
             wire:model.lazy='gain' 
             wire:target="cost,gain,price,dolar"
             
                wire:loading.attr="disabled"      
           
            >
            </div>
            @error('gain') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label><span style="color:red;">*</span> @lang("inventario.modal-price")</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class="mdi mdi-account-cash"></i></span>
                </div>
                <input type="number" step="0.01" class="form-control" 
                wire:key="formPriceInventario"
                wire:model.lazy='price' 
                wire:target="cost,gain,price,dolar"  
               
                    wire:loading.attr="disabled"    
                
                >
            </div>
            @error('price') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label><span style="color:red;">*</span> @lang("inventario.modal-dolar")</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class="mdi mdi-cash-usd"></i></span>
                </div>
                <input type="number" step="0.01" class="form-control" 
                wire:key="formDolarInventario"
                wire:model.lazy='dolar' 
                wire:target="cost,gain,price,dolar"
               
               
                    wire:loading.attr="disabled"        
                
                >
            </div>
            @error('dolar') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-12">
        <h4>@lang("inventario.modal-section3")</h4>
        <hr/>
    </div>
    
    <div class="col-6">
        <div class="form-group">
            <label>@lang("inventario.modal-iva")</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class="mdi mdi-wallet"></i></span>
                </div>
            <select class="form-control" wire:key="formIvaInventario" wire:model.debounce.350ms='iva' wire:target="iva" wire:loading.attr="disabled">
                <option  value="0">@lang("inventario.modal-iva0")</option>
                <option  value="1">@lang("inventario.modal-iva1")</option>

            </select>
            </div>
            @error('iva') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>@lang("inventario.modal-update")</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="background-color:#727CF5;color:white;"><i class="mdi mdi-update"></i></span>
                </div>
                
                <select class="form-control" wire:key="formExchangeInventario" wire:model.debounce.350ms='exchange' wire:target="exchange" wire:loading.attr="disabled">
                    <option  value="0">No</option>
                    <option  value="1">Si</option>
                    <option  value="2">Tasa Venta 2</option>

                </select>
            </div>
            @error('exchange') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
    
</div>