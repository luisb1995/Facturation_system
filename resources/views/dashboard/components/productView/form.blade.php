<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link {{ $tab == 'datos' ? 'active' : '' }}" wire:click="$set('tab', 'datos')" id="nav-datos-tab" data-toggle="tab" href="#nav-datos" role="tab" aria-controls="nav-datos" aria-selected="true" wire:key="tabdatos"> <i class="mdi mdi-pencil-lock-outline"></i> Datos</a>
      <a class="nav-item nav-link {{ $tab == 'especificaciones' ? 'active' : '' }}" wire:click="$set('tab', 'especificaciones')" id="nav-especificaciones-tab" data-toggle="tab" href="#nav-especificaciones" role="tab" wire:key="tabEspecificaciones" aria-controls="nav-especificaciones" aria-selected="false"><i class="mdi mdi-file-document-edit-outline"></i> Especificaciones</a>
      <a class="nav-item nav-link 
      @if ($view=="create")
      disabled" 
      @else 
      {{ $tab == 'imagenes' ? 'active' : '' }}" wire:click="$set('tab', 'imagenes')"
      @endif
      
       wire:key="tabImagenes" id="nav-imagenes-tab" data-toggle="tab" href="#nav-imagenes" role="tab" aria-controls="nav-imagenes" aria-selected="false"><i class="mdi mdi-image-size-select-actual"></i> Imagenes</a>
      <a class="nav-item nav-link 
      @if ($view=="create")
      disabled" 
      @else 
      {{ $tab == 'marca' ? 'active' : '' }}" wire:click="$set('tab', 'marca')"
      @endif
       wire:key="tabMarcas" id="nav-marca-tab" data-toggle="tab" href="#nav-marca" role="tab" aria-controls="nav-marca" aria-selected="false"><i class="mdi mdi-car-back"></i> Marcas y modelos</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent" style="max-height:500px;overflow-y:auto;">
    <!--########################-->
    <!--Seccion Datos-->
    <!--########################-->
    <div 
        @if($tab == 'datos')
            class="tab-pane fade show active" 
        @else 
            class="tab-pane fade"
        @endif
        id="nav-datos" role="tabpanel" aria-labelledby="nav-datos-tab">
        <h3>Datos del producto</h6>
            <hr class="separator">
        <div class="form-group">
            <label >Producto</label>
            <input type="text" class="form-control" wire:model.lazy='name'
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('name') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Categoría:</label>
            <select wire:model.debounce.250ms="category_id" class="form-control">
                <option value="">Seleccione una opción</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>    
                @endforeach

            </select>
            @error('category_id') <br><span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> El campo categoría es obligatorio</span> @enderror
        </div>
        <div class="form-group">
            <label>Cantidad:</label>
            <input type="number" class="form-control" wire:model.lazy='stock'
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('stock') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Precio:</label>
            <input type="number" class="form-control" wire:model.lazy='price' 
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('price') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Precio para aliados comerciales:</label>
            <input type="number" class="form-control" wire:model.lazy='price2' 
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('price2') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Descripcion breve:</label>
            <input type="text" class="form-control" wire:model.lazy='smallDescription' 
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('smallDescription') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Descripcion breve ingles:</label>
            <input type="text" class="form-control" wire:model.lazy='smallDescription_en' 
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('smallDescription_en') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Descripcion:</label>
            <textarea type="text" class="form-control" wire:model.lazy='description'>
            </textarea>
            @error('description') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Descripcion ingles:</label>
            <textarea type="text" class="form-control" wire:model.debounce.350ms='description_en'>
            </textarea>
            @error('description_en') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
    
    <!--########################-->
    <!--Seccion Especificaciones-->
    <!--########################-->
    <div 
        @if($tab == 'especificaciones')
            class="tab-pane fade show active" 
        @else 
            class="tab-pane fade"
        @endif 
        id="nav-especificaciones" role="tabpanel" aria-labelledby="nav-especificaciones-tab" >
        <h3>Especificaciones del producto</h6>
            <hr class="separator">
        <div class="form-group">
            <label>Capacidad:</label>
            <input type="text" class="form-control" wire:model.lazy='capacity' 
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('capacity') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Longitud:</label>
            <input type="text" class="form-control" wire:model.lazy='longitud' 
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('longitud') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Ancho:</label>
            <input type="text" class="form-control" wire:model.lazy='ancho' 
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('ancho') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Alto:</label>
            <input type="text" class="form-control" wire:model.lazy='alto' 
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('alto') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Amperaje:</label>
            <input type="text" class="form-control" wire:model.lazy='amperaje' 
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('amperaje') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Reserva:</label>
            <input type="text" class="form-control" wire:model.lazy='reserva' 
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('reserva') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Volumen de Acido:</label>
            <input type="text" class="form-control" wire:model.lazy='volumenAcido' 
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('volumenAcido') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Peso:</label>
            <input type="text" class="form-control" wire:model.debounce.350ms='peso' 
            @if ($view=="create")
                wire:keydown.enter="store"
            @else 
                wire:keydown.enter="update"        
            @endif
            >
            @error('peso') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
        </div>
    </div>
    <!--########################-->
    <!-----Seccion Imagenes------->
    <!--########################-->
    <div 
        @if($tab == 'imagenes')
            class="tab-pane fade show active" 
        @else 
            class="tab-pane fade"
        @endif 
        id="nav-imagenes" role="tabpanel" aria-labelledby="nav-imagenes-tab" >
        <div wire:loading.grid wire:target="imgUpload" wire:key="loadingImgProduct">
            <div class="row text-center" style="height:500px;">
                <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                    <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                            <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <div wire:loading.remove wire:target="store" wire:key="formImgProduct">
            
            
            <h3>Cargar imagenes:</h6>
            <hr class="separator">
            <div class="form-group">
                
                    <div class="col-12">
                        
                        <div class="input-group mb-3">
                            <input type="file" wire:model="productImage" wire:change="$set('tab', 'imagenes')" class="form-control" wire:key="imgInputProduct" multiple>
                            
                            <div class="input-group-append">
                                <button class="btn btn-primary" wire:click="imgUpload" wire:key="AgregarFotos" wire:dirty.attr="disabled" wire:target="productImage">Agregar fotos</button>
                            </div>
                        </div>
                        @error('productImage') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                    </div>
                
            </div>
            <h3>Imagenes del producto:</h3>
            <hr class="separator">
            <div class="container-fluid overflow-y:scroll;max-height:480px;">
                <div class="row">
                    <input type="hidden" wire:model="productImageEdit">
                    @foreach ($productImageEdit as $img)
                    
                        <div class="col-6 col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ asset('storage/imgUpload/'.$img->url) }}"  style="max-width:263px; max-height:280px;" alt="" srcset="" class="card-img-top">
                                <div class="card-body">
                                    <button type="button" class="btn btn-danger stretched-link" wire:click="destroyImg({{ $img->id }})" wire:key="destroyImg{{ $img->id }}"  title="Eliminar Imagen">
                                        <i class="mdi mdi-window-close"></i> Borrar
                                    </button><br>
                                </div>
                            </div>
                            
                        </div>
                    @endforeach 
                </div>
            </div>
        </div>
    </div>
    <!--########################-->
    <!--Seccion Marcas y modelos-->
    <!--########################-->
    <div 
        @if($tab == 'marca')
            class="tab-pane fade show active" 
        @else 
            class="tab-pane fade"
        @endif 
        id="nav-marca" role="tabpanel" aria-labelledby="nav-marca-tab">
            <input type="hidden" wire:model="productBrands">
            <h3>Marcas compatibles</h6>
            <hr class="separator">
            
                <div class="row">
                    @if (isset($category_id) && $view=="edit")
                        @foreach($brands as $brand)
                            <div class="col-6">    
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" 
                                        
                                        @if (isset($productBrands->where('id',$brand->id)->first()->id))
                                            checked 
                                        @else
                                        @endif    
                                    class="custom-control-input" 
                                    id="customSwitchBrand{{ $brand->id }}" 
                                    wire:click="swapBrand({{ $brand->id }})" 
                                    wire:loading.attr="disabled" 
                                    wire:target="swapBrand" 
                                    wire:key="swapBrand{{ $brand->id }}">
                                    <label class="custom-control-label" for="customSwitchBrand{{ $brand->id }}">{{ $brand->name }}</label>
                                </div><hr class="separator">
                            </div>
                        @endforeach    
                    @endif
                    
                </div>
            
        
            <h3>Modelos disponibles</h6>
            <hr class="separator">
            <div class="row">
            @if (isset($category_id) && $view=="edit")
                @foreach ($productBrands as $brand2)
                    <div class="col-12 text-center">
                        <hr class="separator" style="border-color:#6C757D">
                        <h5>{{ $brand2->name }}</h5>
                        <hr class="separator" style="border-color:#6C757D">
                    
                        @foreach($modelos->where('brand_id',$brand2->id) as $modelo)
                            <div class="col-6 col-md-3 text-left float-left mb-1">    
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" 
                                        
                                        @if (isset($productModelos->where('id',$modelo->id)->first()->id))
                                            checked 
                                        @else
                                        @endif    
                                    class="custom-control-input" 
                                    id="customSwitchModelo{{ $brand2->id.$modelo->id }}" 
                                    wire:click="swapModelo({{ $modelo->id }})" 
                                    wire:loading.attr="disabled" 
                                    wire:target="swapModelo"
                                    wire:key="swapModelo{{ $brand2->id.$modelo->id }}">
                                    <label class="custom-control-label" style="font-size:10px;" for="customSwitchModelo{{ $brand2->id.$modelo->id }}">{{ $modelo->name.' '.$modelo->year }}</label>
                                </div>
                            </div>
                        @endforeach  
                        
                    </div>
                    
                @endforeach
            
            @endif
            </div>
        
    </div>
    
</div>






