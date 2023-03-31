<div class="container-fluid">
    <div class="row">
          <div class="col-12">
                <div class="page-title-box">
                      <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                  <li class="breadcrumb-item active">Clientes</li>
                            </ol>
                      </div>
                      <h4 class="page-title">Administración de clientes</h4>
                </div>
          </div>
    </div>
      <div class="row">
            <div class="col-12">
                  <div class="card">
                        <div class="card-body">
                              <div class="row mb-3">
                                    <div class="col-sm-4 text-left">
                                        <div class="row">
                                            <div class="col-6">
                                                <button 
                                                type="button" 
                                                class="btn btn-primary" 
                                                data-toggle="modal" 
                                                data-target="#clientModal"
                                                data-backdrop="static" 
                                                wire:click="default"
                                                
                                                @unless($auth->can('Agregar cliente'))
                                                            disabled style="cursor:not-allowed;"
                                                @endunless
                                                >
                                                        <i class="mdi mdi-plus-circle mr-2"></i> Agregar cliente
                                                </button>
                                            </div>
                                            
                                            <div class="col-6">
                                                <div class="text-sm-right">
                                                    <!-- @unless($auth->can('Importar')) -->
                                                       <button class="btn btn-primary" type="button" aria-expanded="false" disable> Importar  </button> <!--wire:target="import, excel, importExcel,export" wire:loading.attr="disabled">
                                                            <div wire:loading.grid wire:target="import, excel, importExcel,export" wire:key="importProductsBtn2"
                                                           
                                                                      
                                                                
                                                            >
                                                                <div class="float-left">
                                                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> @lang('inventario.importingMsg')
                                                                </div>
                                                            </div>
                                                            <div wire:loading.remove wire:target="import, excel, importExcel,export" wire:key="importProductsBtn">
                                                                <i class="mdi mdi-database-import mr-2"></i>Importar
                                                            </div> -->
                                                        <!-- </button> -->
                                                    <!-- @endunless  -->
                                                        
                                                    
                                                      
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                          <div class="text-sm-right">
                                                <button type="button" class="btn btn-secondary text-center"  wire:click="report" wire:key="reportCategory" wire:loading.attr="disabled">
                                                      <div wire:loading.grid wire:target="report" wire:key="reportCategoryBtn2">
                                                            <div class="float-left">
                                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generando...                                                                  </div>
                                                           
                                                      </div>
                                                      <div wire:loading.remove wire:target="report" wire:key="reportCategoryBtn">
                                                           <i class="mdi mdi-file-pdf-outline"></i> Generar Reporte
                                                      </div>
                                                </button>
                                          </div>
                                    </div>

                              </div>
                              <div class="row mb-3">
                                    <div class="col-12 col-md-6">
                                          <input type="text" wire:model.debounce.500ms="search" class="form-control" value="" placeholder="Buscar clientes...">
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
                                                    <th wire:click="sort('id')" style="cursor:row-resize;width:80px;">
                                                        <a >Cod.</a>  
                                                      
                                                    </th>
                                                    <th wire:click="sort('nombre')" style="cursor:row-resize;width:80px;">
                                                        <a >Nombre</a>  
                                                      
                                                    </th>
                                                    <th wire:click="sort('cedula')" style="cursor:row-resize;" >
                                                        <a>Cedula</a> 
                                                      
                                                    </th>
                                                    <th wire:click="sort('telefono')" style="cursor:row-resize;" >
                                                        <a>Telefono</a> 
                                                        
                                                    </th>
                                                    <th wire:click="sort('email')" style="cursor:row-resize;" >
                                                        <a>Email</a> 
                                              
                                                    </th>
                                                      
                                                    <th>Acciones</th>
                                                      
                                                </tr>
                                          </thead>
                                          <tbody class="text-center">
                                          @foreach ($clients as $client)
                                          <tr>
                                                <td>{{ $client->id }}</td>
                                                <td>{{ $client->nombre }}</td>
                                                <td>{{ $client->cedula }}</td>
                                                <td>{{ $client->telefono }}</td>
                                                <td>{{ $client->email }}</td>
                                                
                                                <td>
                                                      <button 
                                                      type="button" 
                                                      class="btn btn-primary" 
                                                      data-toggle="modal" 
                                                      data-target="#clientModal"
                                                      data-backdrop="static" 
                                                      wire:click="edit({{ $client->id }})"
                                                      
                                                      @unless($auth->can('Editar cliente'))
                                                            disabled style="cursor:not-allowed;"
                                                      @endunless 
                                                      >
                                                            <i class="mdi mdi-pencil-box-outline"></i>
                                                      </button>
                                                
                                                      <button 
                                                      type="button" 
                                                      class="btn btn-danger" 
                                                      data-toggle="modal" 
                                                      data-target="#clientModal" 
                                                      data-backdrop="static"
                                                      wire:click="preDestroy({{ $client->id }})"
                                                      
                                                      @unless($auth->can('Eliminar cliente'))
                                                            disabled style="cursor:not-allowed;"
                                                      @endunless 
                                                      >
                                                            <i class="mdi mdi-close-box-outline"></i>
                                                      </button>
                                                </td>
                                                
                                          </tr>
                                          @endforeach
                                          
                                          </tbody>
                                    </table>
                              </div>
                              {{ $clients->links()  }}
                        </div>
                  </div>
            </div>
      </div>

 
  
    <div wire:ignore.self class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  @include("dashboard.components.clientView.$view")
                      
                </div>
          </div>
    </div>



      
