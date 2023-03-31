<div class="container-fluid">
    <div class="row">
          <div class="col-12">
                <div class="page-title-box">
                      <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang("inventario.breadcum")</a></li>
                                  <li class="breadcrumb-item active">Administración</li>
                            </ol>
                      </div>
                      <h4 class="page-title">Administración</h4>
                </div>
          </div>
    </div>

    <div class="row">
        <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color:#1b44b9;color:white;">
                        <h4>Datos administrativos</h4>
                    </div>
                    <div class="card-body">
                        <div wire:loading.grid wire:target="update" wire:key="loadingAdministracion">
                            <div class="row text-center" style="height:150px;">
                                <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                                    <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                                            <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div wire:loading.remove wire:target="update" wire:key="formAdministracion">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Tasa Inventario:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionNro" style="background-color:#727CF5;color:white;"><i class="mdi mdi-format-align-justify"></i></span>
                                            </div>
                                        <input type="number" class="form-control" wire:model.lazy='tasaInventario'  placeholder="Número de factura ( sin los ceros) ej: 154">

                                        </div>
                                        @error('tasaInventario') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>IVA:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionClave" style="background-color:#727CF5;color:white;"><i class="mdi mdi-key-outline"></i></span>
                                            </div>
                                        <input type="number" class="form-control" wire:model.lazy='ivaAdministracion'  placeholder="Clave de supervisor">

                                        </div>
                                        @error('ivaAdministracion') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Tasa Venta:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionNro" style="background-color:#727CF5;color:white;"><i class="mdi mdi-format-align-justify"></i></span>
                                            </div>
                                        <input type="number" class="form-control" wire:model.lazy='tasaVenta'  placeholder="Número de factura ( sin los ceros) ej: 154">

                                        </div>
                                        @error('tasaVenta') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <!--<div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Tasa Venta BCV:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionNro" style="background-color:#727CF5;color:white;"><i class="mdi mdi-format-align-justify"></i></span>
                                            </div>
                                        <input type="number" class="form-control" wire:model.lazy='tasaVenta2'  placeholder="Número de factura ( sin los ceros) ej: 154">

                                        </div>
                                        @error('tasaVenta2') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                    </div>
                                </div>-->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Clave autorización:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionClave" style="background-color:#727CF5;color:white;"><i class="mdi mdi-key-outline"></i></span>
                                            </div>
                                        <input type="password" class="form-control" wire:model.lazy='claveautorizacion'  placeholder="Clave de supervisor">

                                        </div>
                                        @error('claveautorizacion') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Empresa:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionNro" style="background-color:#727CF5;color:white;"><i class="mdi mdi-format-align-justify"></i></span>
                                            </div>
                                        <input type="text" class="form-control" wire:model.lazy='empresa'  placeholder="Número de factura ( sin los ceros) ej: 154">

                                        </div>
                                        @error('empresa') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Cedula/Rif:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionClave" style="background-color:#727CF5;color:white;"><i class="mdi mdi-key-outline"></i></span>
                                            </div>
                                        <input type="text" class="form-control" wire:model.lazy='rif'  placeholder="Clave de supervisor">

                                        </div>
                                        @error('rif') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Dirección:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionNro" style="background-color:#727CF5;color:white;"><i class="mdi mdi-format-align-justify"></i></span>
                                            </div>
                                        <input type="text" class="form-control" wire:model.lazy='direccion'  placeholder="Número de factura ( sin los ceros) ej: 154">

                                        </div>
                                        @error('direccion') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Telefonos:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionClave" style="background-color:#727CF5;color:white;"><i class="mdi mdi-key-outline"></i></span>
                                            </div>
                                        <input type="number" class="form-control" wire:model.lazy='telefono'  placeholder="Clave de supervisor">

                                        </div>
                                        @error('telefono') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Tipo Impresión:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionClave" style="background-color:#727CF5;color:white;"><i class="mdi mdi-key-outline"></i></span>
                                            </div>
                                        <select class="form-control" wire:model.lazy='tickera' >

                                        </select>


                                        </div>
                                        @error('tickera') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary" wire:click="modalUpdate" wire:target="update,modalUpdate,tasaInventario,tasaVenta,ivaAdministracion,claveautorizacion,empresa,rif,direccion,telefono" wire:loading.attr="disabled">Guardar Cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </div>
    <div wire:ignore.self class="modal fade" id="administrationModal" tabindex="-1" role="dialog" aria-labelledby="administrationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
              <div class="modal-content">
                  @include("dashboard.components.administrationView.autorization")


              </div>
        </div>
  </div>
</div>
