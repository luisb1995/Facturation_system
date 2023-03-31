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
                      <h4 class="page-title">@lang("inventario.title")</h4>
                </div>
          </div>
    </div>

      <div class="row">
            <div class="col-12">
                  <div class="card">
                        <div class="card-body">
                              <div class="row mb-3">
                                    <div class="col-4 text-left">
                                          <div class="row">
                                                <div class="col-6">
                                                      <button
                                                      type="button"
                                                      class="btn btn-primary text-center"
                                                      data-toggle="modal"
                                                      data-target="#inventarioModal"
                                                      data-backdrop="static"
                                                      wire:click="default"
                                                      title="@lang("inventario.add")"
                                                      @unless($auth->can('Agregar producto'))
                                                                  disabled style="cursor:not-allowed;"
                                                      @endunless
                                                      >
                                                            <span><i class="mdi mdi-plus-circle"></i> <span class="d-none d-md-block">@lang("inventario.add")</span></span>
                                                      </button>
                                                </div>
                                                <div class="col-6">

                                                      <div class="text-sm-right">
                                                            <div class="dropdown">

                                                                <button class="btn btn-primary"  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" wire:target="import, excel, importExcel,export" wire:loading.attr="disabled">
                                                                    <div wire:loading.grid wire:target="import, excel, importExcel,export" wire:key="importProductsBtn2"

                                                                    >
                                                                        <div class="float-left">
                                                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> @lang('inventario.importingMsg')
                                                                        </div>
                                                                    </div>
                                                                    <div wire:loading.remove wire:target="import, excel, importExcel,export" wire:key="importProductsBtn">
                                                                        <span><i class="mdi mdi-database-import"></i><span class="d-none d-md-block">@lang("inventario.import2") <i class="mdi mdi-arrow-down-drop-circle-outline"></i></span></span>
                                                                    </div>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                                        <a class="dropdown-item" href="javascript:void(0)" wire:click="excel" wire:key="importExcelBtn"
                                                                              data-toggle="modal"
                                                                              data-target="#inventarioModal"
                                                                              data-backdrop="static">
                                                                              <i class="mdi mdi-file-excel-outline"></i> @lang('inventario.importExcel')
                                                                        </a>
                                                                        <a class="dropdown-item" href="javascript:void(0)" wire:click="export" wire:key="exportExcelBtn">
                                                                              <i class="mdi mdi-file-download-outline"></i> @lang('inventario.exportExcel')
                                                                        </a>
                                                                </div>
                                                              </div>

                                                        </div>

                                                </div>
                                          </div>

                                    </div>
                                    <div class="col-8">
                                          <div class="row">
                                                <div class="col-8 col-md-8">
                                                      <input type="text" wire:model.debounce.500ms="search" class="form-control" value="" placeholder="@lang("inventario.search")">
                                                </div>
                                                <div class="col-4 col-md-4 text-sm-right">

                                                            <button type="button" class="btn btn-secondary text-center"  wire:click="report" wire:key="reportCategory" wire:loading.attr="disabled">
                                                                  <div wire:loading.grid wire:target="report" wire:key="reportCategoryBtn2">
                                                                        <div class="float-left">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generando...                                                                  </div>

                                                                  </div>
                                                                  <div wire:loading.remove wire:target="report" wire:key="reportCategoryBtn">
                                                                  <span><i class="mdi mdi-file-pdf-outline"></i> <span class="d-none d-md-block">@lang("inventario.report")</span></span>
                                                                  </div>
                                                            </button>

                                                </div>
                                          </div>
                                    </div>

                              </div>
                              <div class="row mb-3">
                                    <div class="col-12 col-md-3 mb-3">
                                          <div class="col-12">

                                                <select name="" id="" class="form-control" wire:model="category" >
                                                      <option value="0">@lang('inventario.category-filter')</option>
                                                      @foreach ($categories as $category)
                                                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                      @endforeach
                                                </select>

                                          </div>
                                      </div>
                                    <div class="col-12 col-md-3  mb-3">
                                          <div class="col-12" >

                                                <select name="" id="" class="form-control" wire:model="perPage" >
                                                      <option value="10">@lang('inventario.page-filter')</option>
                                                      <option value="10">10</option>
                                                      <option value="25">25</option>
                                                      <option value="50">50</option>
                                                      <option value="100">100</option>
                                                </select>

                                          </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3 text-right" >

                                    </div>

                                    <br>

                              </div>
                              <div class="table-responsive">
                                    <table class="table table-striped">
                                          <thead  class="thead-dark text-center" >
                                                <tr>
                                                    <th class="d-none d-md-table-cell" wire:click="sort('id')" style="cursor:row-resize;width:80px;">
                                                        <a >Nro</a>

                                                    </th>
                                                    <th class="d-none d-md-table-cell" wire:click="sort('codigo')" style="cursor:row-resize;" >
                                                        <a>Código</a>

                                                    </th>
                                                    <th wire:click="sort('descripcion')" style="cursor:row-resize;" >
                                                        <a>Descripción</a>

                                                    </th>
                                                    <th wire:click="sort('cantidad')" style="cursor:row-resize;" >
                                                        <a>Stock</a>

                                                    </th>
                                                    <th  class="d-none d-md-table-cell" wire:click="sort('costo')" style="cursor:row-resize;" >
                                                        <a>Costo</a>

                                                    </th>
                                                    <th class="d-none d-lg-table-cell" wire:click="sort('ganancia')" style="cursor:row-resize;" >
                                                        <a>Ganancia</a>

                                                    </th>
                                                    <th wire:click="sort('precio')" style="cursor:row-resize;" >
                                                        <a>Precio</a>

                                                    </th>
                                                    <th class="d-none d-lg-table-cell" wire:click="sort('divisa')" style="cursor:row-resize;" >
                                                        <a>Divisa</a>

                                                    </th>
                                                    <th >Acciones</th>
                                                </tr>
                                          </thead>
                                          <tbody class="text-center">
                                          @foreach ($products as $product)
                                          <tr>
                                                <td class="d-none d-md-table-cell">{{ $product->id }}</td>
                                                <td class="d-none d-md-table-cell">{{ $product->codigo }}</td>
                                                <td class="text-left">{{ $product->descripcion }}</td>
                                                <td class="">{{ round($product->cantidad,3) }}</td>
                                                <td class="d-none d-md-table-cell">Bs. {{ round($product->costo,2) }}</td>
                                                <td class="d-none d-lg-table-cell">{{ round($product->ganancia,2) }}%</td>
                                                <td class="">Bs. {{ round($product->precio,2) }}</td>
                                                <td class="d-none d-lg-table-cell">$ {{ round($product->divisa, 4) }}</td>
                                                <td>
                                                      <button
                                                      type="button"
                                                      class="btn  btn-sm btn-primary"
                                                      data-toggle="modal"
                                                      data-target="#inventarioModal"
                                                      data-backdrop="static"
                                                      wire:click="edit({{ $product->id }})"

                                                      @unless($auth->can('Editar producto'))
                                                            disabled style="cursor:not-allowed;"
                                                      @endunless
                                                      >
                                                            <i class="mdi mdi-pencil-box-outline"></i>
                                                      </button>
                                                      <button
                                                      type="button"
                                                      class="btn btn-sm btn-danger"
                                                      data-toggle="modal"
                                                      data-target="#inventarioModal"
                                                      data-backdrop="static"
                                                      wire:click="preDestroy({{ $product->id }})"

                                                      @unless($auth->can('Eliminar producto'))
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
                                    <div class="row mb-3">

                                          <div class="col-10 col-md-10">
                                                {{ $products->links() }}
                                          </div>

                                          <div class="col-2 col-md-2">
                                              <select name="" id="" class="form-control" wire:model="perPage" >
                                                  <option>10</option>
                                                  <option>25</option>
                                                  <option>50</option>
                                                  <option>100</option>
                                              </select>
                                          </div>
                                          <br>

                                    </div>

                              </div>

                        </div>
                  </div>
            </div>
      </div>



    <div wire:ignore.self class="modal fade" id="inventarioModal" tabindex="-1" role="dialog" aria-labelledby="inventarioModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    @include("dashboard.components.inventarioView.$view")


                </div>
          </div>
    </div>
</div>



