<div class="container-fluid">
    <style>
        .profileImgContainer {
          position: relative;
          width:100%;
        }
        
        .imageProfile {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }
        
        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }
        
        .profileImgContainer:hover .imageProfile {
            opacity: 0.3;
            cursor:pointer;
         }

        .profileImgContainer:hover .middle {
         opacity: 1;
         cursor:pointer;
        }

        .textImg {
          color: #727CF5;
          font-size: 78px;
          padding: 16px 32px;
        }
    </style>                
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Productos</li>
                    </ol>
                </div>
                <h4 class="page-title">Administración de productos</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <button 
                            type="button" 
                            class="btn btn-primary" 
                            data-toggle="modal" 
                            data-target="#productModal" 
                            data-backdrop="static" 
                            wire:click="default"
                                  
                            @unless($auth->can('Agregar productos'))
                                disabled style="cursor:not-allowed;"
                            @endunless      
                            >
                                    <i class="mdi mdi-plus-circle mr-2"></i> Agregar producto
                            </button>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <div class="dropdown">
                                    <button class="btn btn-secondary"  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" wire:loading.attr="disabled">
                                        <div wire:loading.grid wire:target="report, report2, report3" wire:key="reportProductsBtn2">
                                            <div class="float-left">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generando...
                                            </div>
                                        </div>
                                        <div wire:loading.remove wire:target="report, report2, report3" wire:key="reportProductsBtn">
                                             Generar Reporte <i class="mdi mdi-arrow-down-drop-circle-outline"></i>
                                        </div>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="javascript:void(0)" wire:click="report" wire:key="reportProducts"><i class="mdi mdi-file-pdf-outline"></i> Productos</a>
                                      <a class="dropdown-item" href="javascript:void(0)" wire:click="report2" wire:key="reportProducts2"><i class="mdi mdi-file-pdf-outline"></i> Productos mas vistos</a>
                                      <a class="dropdown-item" href="javascript:void(0)" wire:click="report3" wire:key="reportProducts3"><i class="mdi mdi-file-pdf-outline"></i> Productos mas buscados</a>
                                    </div>
                                  </div>
                                  
                            </div>
                      </div><!-- end col-->
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                              <input type="text" wire:model.debounce.500ms="search" class="form-control" value="" placeholder="Buscar productos...">
                        </div>
                        <div class="col-6 col-md-2 d-none d-md-block">
                        
                        </div>
                        <div class="col-6 col-md-2 d-none d-md-block">
                              
                        </div>
                        <div wire:model="perPage" class="col-6 col-md-2">
                              <select name="" id="" class="form-control">
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                                <option>100</option>
                              </select>
                        </div>

                  </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead  class="thead-dark text-center" >
                                <tr>
                                        
                                        <th wire:click="sort('name')" style="cursor:pointer;" >
                                            <a>Producto</a> 
                                            <i class="uil uil-sort"></i>
                                        </th>
                                        <th wire:click="sort('category_id')" style="cursor:pointer;" >
                                            <a>Categoría</a> 
                                            <i class="uil uil-sort"></i>
                                        </th>
                                        <th wire:click="sort('price')" style="cursor:pointer;" class="d-none d-md-table-cell">
                                            <a>Precio</a> 
                                            <i class="uil uil-sort"></i>
                                        </th>
                                        <th wire:click="sort('stock')" style="cursor:pointer;" class="d-none d-md-table-cell">
                                            <a>Cantidad</a> 
                                            <i class="uil uil-sort"></i>
                                        </th>
                                        <th wire:click="sort('created_at')" style="cursor:pointer;" class="d-none d-md-table-cell">
                                            <a>Fecha agregada</a> 
                                            <i class="uil uil-sort"></i>
                                        </th>
                                        <th colspan="2">Acciones</th>
                                        
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            @foreach ($products as $product)
                            <tr>
                                
                                <td style="text-align:left;" class="align-middle">
                                    @if ($product->images->count()>0)
                                    <img src="{{ asset('storage/imgUpload/'.$product->images->first()->url) }}" class="rounded mr-3"  height="48" alt="" srcset="">
                                    @else 
                                    <img src="{{ asset('storage/imgUpload/sinImg.jpg') }}" class="rounded mr-3"  height="48" alt="" srcset="">
                                    @endif
                                    
                                    {{ $product->name }}</td>
                                <td class="align-middle">{{ $product->category->name }}</td>
                                <td class="d-none d-md-table-cell align-middle">{{ $product->price }}</td>
                                <td class="d-none d-md-table-cell align-middle">{{ $product->stock }}</td>
                                <td class="d-none d-md-table-cell align-middle">{{ $product->created_at }}</td>
                                <td class="align-middle">
                                        <button 
                                        type="button" 
                                        class="btn btn-primary" 
                                        data-toggle="modal" 
                                        data-target="#productModal" 
                                        data-backdrop="static" 
                                        wire:click="edit({{ $product->id }})"
                                        
                                        @unless($auth->can('Editar productos'))
                                            disabled style="cursor:not-allowed;"
                                        @endunless
                                        ><i class="mdi mdi-pencil-box-outline"></i> Editar</button>
                                </td>
                                <td class="align-middle">
                                <button 
                                type="button" 
                                class="btn btn-danger"
                                data-toggle="modal" 
                                data-target="#productModal" 
                                data-backdrop="static" 
                                wire:click="preDestroy({{ $product->id }})"
                                    @unless($auth->can('Eliminar productos'))
                                        disabled style="cursor:not-allowed;"
                                    @endunless
                                    ><i class="mdi mdi-close-box-outline"></i> Eliminar</button>
                                </td>
                                
                            </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                  {{ $products->links()  }}
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->        
    <div wire:ignore.self class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="width:90%">
              <div class="modal-content" >
                @include("dashboard.components.productView.$view")
                    
              </div>
        </div>
  </div>

</div> <!-- container -->