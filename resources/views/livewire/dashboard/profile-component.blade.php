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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Mi cuenta</a></li>
                        
                    </ol>
                </div>
                <h4 class="page-title">Mi cuenta</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 


    <div class="row">
        <div class="col-sm-12">
            <!-- Profile -->
            <div class="card bg-primary">
                <div class="card-body profile-user-box">

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="media">
                                <span class="float-left m-2 mr-4"><img src="{{ asset('storage/imgUpload/'.$user->image->url) }}" style="height: 100px;width:100px;" alt="" class="rounded-circle img-thumbnail"></span>
                                <div class="media-body">

                                    <h4 class="mt-1 mb-1 text-white">{{ $user->name }}</h4>
                                    <p class="font-13 text-white-50"> {{ $user->roles->first()->name }}</p>

                                    <ul class="mb-0 list-inline text-light">
                                        <li class="list-inline-item mr-3">
                                            <h5 class="mb-1">$ {{ $totalComprado }}</h5>
                                            <p class="mb-0 font-13 text-white-50">Total Comprado</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5 class="mb-1">{{ $user->orders->count() }}</h5>
                                            <p class="mb-0 font-13 text-white-50">Cantidad de pedidos</p>
                                        </li>
                                    </ul>
                                </div> <!-- end media-body-->
                            </div>
                        </div> <!-- end col-->

                        <div class="col-sm-4">
                            <div class="text-center mt-sm-0 mt-3 text-sm-right">
                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#profileModal" wire:click="default()">
                                    <i class="mdi mdi-account-edit mr-1"></i> Editar Perfil
                                </button>
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                </div> <!-- end card-body/ profile-user-box-->
            </div><!--end profile/ card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-4">
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class="dripicons-basket float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase mt-0">Pedidos</h6>
                    <h2 class="m-b-20">{{ $user->orders->count() }}</h2>
                    
                </div> <!-- end card-body-->
            </div> <!--end card-->
        </div><!-- end col -->

        <div class="col-sm-4">
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class="dripicons-box float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase mt-0">Total Comprado</h6>
                    <h2 class="m-b-20">$<span>{{ $totalComprado }}</span></h2>
                    
                </div> <!-- end card-body-->
            </div> <!--end card-->
        </div><!-- end col -->

        <div class="col-sm-4">
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class="dripicons-jewel float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase mt-0">Productos Comprados</h6>
                    <h2 class="m-b-20">{{ $totalArticulos }}</h2>
                    
                </div> <!-- end card-body-->
            </div> <!--end card-->
        </div><!-- end col -->

    </div>
    <div class="row">
        <div class="col-lg-4">
            <!-- Personal-Information -->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-3">Información de usuario</h4>
                    

                    <hr/>

                    <div class="text-left">
                        <p class="text-muted"><strong>Nombre :</strong> <span class="ml-2">{{ $user->name }}</span></p>

                        <p class="text-muted"><strong>Email :</strong> <span class="ml-2">{{ $user->email }}</span></p>

                        <p class="text-muted"><strong>Teléfono :</strong> <span class="ml-2">{{ $user->profile->telefono }}</span></p>

                        <p class="text-muted"><strong>Dirección :</strong> <span class="ml-2">{{ $user->profile->direccion }}</span></p>

                        <p class="text-muted mb-0"><strong>Instagram :</strong>
                            <a class="d-inline-block ml-2 text-muted" title="" data-placement="top" data-toggle="tooltip" href="{{ $user->profile->instagram }}" data-original-title="Instagram"><i class="mdi mdi-instagram"></i> {{ $user->name }}</a>
                            
                        </p>

                    </div>
                </div>
            </div>
            <!-- Personal-Information -->

            <!-- Toll free number box-->
            <div class="card text-white bg-info overflow-hidden">
                <div class="card-body">
                    <div class="toll-free-box text-center">
                        <h4> <i class="mdi mdi-deskphone"></i> Call Center : +58 424-6328437</h4>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
            <!-- End Toll free number box-->

            

        </div> <!-- end col-->

        <div class="col-lg-8">
            <!-- end row -->


            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Mis Pedidos</h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Código</th>
                                    <th class="text-center">Cant. productos</th>
                                    <th class="text-center">Monto total</th>
                                    <th class="text-center">Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center"> 
                                        @if ($order->estado==0)
                                            <a href="{{ route('dashboard-carrito') }}"> {{ $order->codigo }}</a>
                                            
                                        @else    
                                            <a href="javascript:void(0);" wire:click="comprobante({{ $order->id }})" wire:loading.attr="disabled"> {{ $order->codigo }}</a>    
                                        @endif
                                        
                                    </td>
                                    <td class="text-center">{{ $order->details->count() }}</td>
                                    <td class="text-center">$ {{ $order->total }}</td>
                                    <td class="text-center">
                                        @switch($order->estado)
                                            @case(1)
                                                <h5><span class="badge badge-warning-lighten"><i class="mdi mdi-timer-sand"></i> En proceso</span></h5>
                                            @break
                                            @case(2)
                                                <h5><span class="badge badge-info-lighten"><i class="mdi mdi-check-underline-circle-outline"></i> Pago registrado</span></h5>
                                            @break
                                            @case(3)
                                                <h5><span class="badge badge-secondary-lighten"><i class="mdi mdi-check-underline-circle-outline"></i>Procesado</span></h5>
                                            @break
                                            @case(4)
                                                <h5><span class="badge badge-danger-lighten"><i class="mdi mdi-trash-can"></i>Rechazado</span></h5>
                                            @break
                                            @default
                                                <h5><span class="badge badge-secondary-lighten"><i class="mdi mdi-timer-sand"></i> Creado</span></h5>
                                        @endswitch  
                                    </td>
                                </tr>
                                   
                               @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end table responsive-->
                </div> <!-- end col-->
            </div> <!-- end row-->

        </div>
        <!-- end col -->

    </div>
    <!-- end row -->

    <div wire:ignore.self class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
        
        <div class="modal-dialog modal-lg" role="document">
            
              <div class="modal-content">
              
                <div class="modal-header" style="background-color:#313A46;color:white;">
                    
                    <h4 class="modal-title" id="exampleModalLabel">
                           Editar perfil
                    </h4>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div wire:loading.grid wire:target="update">
                        <div class="row text-center" style="height:800px;">
                            <div 
                            style="width:100%;margin-top: auto;
                            margin-bottom: auto;">
                                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem;" role="status">
                                        <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div wire:loading.remove wire:target="update">

                        <h3>Imagen de perfil</h6>
                        <hr class="separator">
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="d-none d-md-block col-md-3"></div>
                                <div class="col-12 text-center col-md-6 profileImgContainer">
                                    <label for="image">
                                        <img id="profileImg" src="
                                    @if ($profileImage)
                                        {{ $profileImage->temporaryUrl() }}
                                    @else
                                        {{ asset('storage/imgUpload/'.$user->image->url) }}
                                    @endif
                                    " style="height: 300px;width:300px;" alt="" class="imageProfile rounded-circle img-thumbnail">
                                    <div class="middle">
                                        <div class="textImg"><i class="mdi mdi-pencil-box-outline"></i></div>
                                    </div>
                                    </label>
                                    <input type="file" id="image" wire:model="profileImage" class="form-control" style="display:none;">
                                    @error('profileImage') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                                </div>
                                <div class="d-none d-md-block col-md-3"></div>
                            </div>
                        </div>
                        
                        <h3>Datos del usuario</h3>
                        <hr class="separator">
                        <div class="form-group">
                            <label >Nombre</label>
                            <input type="text" class="form-control" wire:model="name" value="{{ $user->name }}"  wire:loading.attr="readonly">
                            @error('name') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label >Cedula / RIF</label><br>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <select class="form-control" wire:model="preCedula" >
                                        <option value="">--</option>
                                        <option value="V-">V-</option>
                                        <option value="J-">J-</option>
                                    </select>
                                </div>
                                <input type="number" class="form-control" wire:model='cedula' placeholder="Ej: 95847125">
                              </div>
                           
                            @error('cedula') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label >Teléfono</label>
                            <input type="text" class="form-control" wire:model='telefono' placeholder="Ej: +58414-5555555">
                            @error('telefono') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label >Dirección</label>
                            <input type="text" class="form-control" wire:model='direccion' placeholder="Ej: Urb Los Olivos calle 54 Av 10">
                            @error('direccion') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label >Link de Instagram</label>
                            <input type="text" class="form-control"  wire:model='instagram' placeholder="Ej: https://www.instagram.com/ejemplo1/">
                            @error('instagram') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                        </div>
                        @if ($user->roles->first()->name == "Aliado comercial")
                        <h3>Datos publicos aliado comercial</h3>
                        <hr class="separator">
                            <div class="form-group">
                                <label >Estado</label>
                                <input type="text" list="datalistEstado" id="ciudadEstado" class="form-control" wire:model.lazy='estado'  placeholder="Ej: ZULIA">
                                <datalist id="datalistEstado">
                                    @foreach ($estados as $estado)
                                    <option value="{{ $estado->estado }}">   
                                    @endforeach
                                    
                                
                                </datalist>
                                @error('ciudad') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label >Ciudad</label>
                                <input type="text" list="datalistCiudad" id="ciudadAliado" class="form-control" wire:model.lazy='ciudad'  placeholder="Ej: SAN FRANCISCO">
                                <datalist id="datalistCiudad">
                                    @foreach ($ciudades as $ciudad)
                                    <option value="{{ $ciudad->ciudad }}">    
                                    @endforeach
                                    
                                
                                </datalist>
                                @error('ciudad') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label >Sector</label>
                                <input type="text" list="datalistSector" id="sectorAliado" class="form-control" wire:model.lazy='sector'  placeholder="Ej: SIERRA MAESTRA">
                                <datalist id="datalistSector">
                                    @foreach ($sectores as $sector)
                                        <option value="{{ $sector->sector }}">    
                                    @endforeach
                                </datalist>
                                @error('sector') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label >Link del mapa</label>
                                <input type="text" class="form-control" wire:model.lazy='mapa' placeholder="Ingrese el link/URL del mapa del local" value="">
                                @error('mapa') <span style="color:red;font-weight:bold;"><i class="uil uil-times-circle"></i> {{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>
                          
                </div>
                <div class="modal-footer">
                    <button wire:click="update" class="btn btn-primary" wire:loading.attr="disabled">
                        <i class="mdi mdi-content-save-outline"></i> Guardar
                    </button>  
                </div>
                    
              </div>
        </div>
    </div>
    
    
</div> <!-- container -->



