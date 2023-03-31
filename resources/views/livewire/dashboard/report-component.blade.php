<div class="container-fluid">
    <div class="row">
          <div class="col-12">
                <div class="page-title-box">
                      <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang("inventario.breadcum")</a></li>
                                  <li class="breadcrumb-item active">Reportes</li>
                            </ol>
                      </div>
                      <h4 class="page-title">Reportes</h4>
                </div>
          </div>
    </div>

      <div class="row">
            <div class="col-12">
                  <div class="card">
                        <div class="card-header" style="background-color: #1b44b9;color:white;">
                            <h4>Reporte de ventas</h4>
                        </div>
                        <div class="card-body">
                            <div wire:loading.grid wire:target="reporteVentas" wire:key="loadingreporteVentas">
                                <div class="row text-center" style="height:150px;">
                                    <div style="width:100%;margin-top: auto;margin-bottom: auto;">
                                        <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                                                <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div wire:loading.remove wire:target="reporteVentas" wire:key="formreporteVentas">
                                <div class="row">
                                    <div class="d-none col-md-4"></div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>Seleccione un cajero: </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"  wire:key="cajeroReport" style="background-color:#727CF5;color:white;"><i class="uil-user"></i></span>
                                                </div>
                                                <select class="form-control" wire:model.debounce.250ms='cajero' >
                                                    <option value="">Reporte general</option>
                                                    @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>

                                                    @endforeach
                                                </select>

                                            </div>
                                            @error('cajero') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="d-none col-md-4"></div>

                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Fecha Inicio: </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionNro" style="background-color:#727CF5;color:white;"><i class="mdi mdi-calendar-arrow-right"></i></span>
                                                </div>
                                            <input type="date" class="form-control" wire:model.debounce.250ms='fechaIni' >

                                            </div>
                                            @error('fechaIni') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Fecha Fin:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"  wire:key="formDevolucionClave" style="background-color:#727CF5;color:white;"><i class="mdi mdi-calendar-arrow-right"></i></span>
                                                </div>
                                            <input type="date" class="form-control" wire:model.debounce.250ms='fechaFin'>

                                            </div>
                                            @error('fechaFin') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary" wire:click="reporteVentas" wire:target="reporteVentas"  wire:key="generarReporteVentaCliente" wire:loading.attr="disabled">Generar reporte</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
            </div>
      </div>
</div>
