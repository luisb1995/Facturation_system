<div class="container-fluid">
      <div class="row">
            <div class="col-12">
                  <div class="page-title-box">
                        <div class="page-title-right">
                              <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Usuarios</li>
                              </ol>
                        </div>
                        <h4 class="page-title">Panel administrativo de usuarios</h4>
                  </div>
            </div>
      </div>
      <div class="row">
            <div class="col-12">
                  <div class="card">
                        <div class="card-body" style="background-color:#ffffff;">
                              <div class="row mb-3">
                                    <div class="col-sm-4 text-left">

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser" data-backdrop="static" wire:click="default"
                                          @unless($auth->can('Agregar usuario'))
                                          disabled style="cursor:not-allowed;"
                                          @endunless
                                    >
                                          <i class="uil uil-user-plus"></i> Agregar Usuario
                                    </button>
                                    </div>
                                    <div class="col-sm-8">
                                          <div class="text-sm-right">
                                                <button type="button" class="btn btn-secondary text-center"  wire:click="report" wire:key="reportUsers" wire:loading.attr="disabled">
                                                      <div wire:loading.grid wire:target="report" wire:key="reportUserBtn2">
                                                            <div class="float-left">
                                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generando...                                                                  </div>

                                                      </div>
                                                      <div wire:loading.remove wire:target="report" wire:key="reportUserBtn">
                                                           <i class="mdi mdi-file-pdf-outline"></i> Generar Reporte
                                                      </div>
                                                </button>
                                          </div>
                                    </div>


                              </div>
                              <div class="row mb-3">
                                    <div class="col-12 col-md-6">
                                          <input type="text" wire:model.debounce.300ms="search" class="form-control" value="" placeholder="Buscar usuarios...">
                                    </div>
                                    <div class="col-6 col-md-2 d-none d-md-block">
                                          <!--  <select wire:model="orderBy" name="" id="" class="form-control">
                                                <option value="id">ID</option>
                                                <option value="name">Name</option>
                                                <option value="email">Email</option>
                                                <option value="created_at">Sign Up Date</option>
                                          </select>-->
                                    </div>
                                    <div class="col-6 col-md-2 d-none d-md-block">
                                          <!--<select wire:model="orderAsc" name="" id="" class="form-control">
                                                <option value="1">Ascending</option>
                                                <option value="0">Descending</option>
                                          </select>-->
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

                                                      <th wire:click="sort('id')" style="cursor:pointer;width:80px;">
                                                            <a >Id</a>
                                                            <i class="uil uil-sort"></i>
                                                      </th>
                                                      <th wire:click="sort('name')" style="cursor:pointer;" >
                                                            <a>Nombre</a>
                                                            <i class="uil uil-sort"></i>
                                                      </th>
                                                      <th wire:click="sort('email')"  class="d-none d-md-table-cell">
                                                            <a style="cursor:pointer;">Email</a>
                                                            <i class="uil uil-sort"></i>
                                                      </th>
                                                      <th class="d-none d-md-table-cell">
                                                            Permisologia
                                                      </th>
                                                      <th colspan="2">Acciones</th>

                                                </tr>
                                          </thead>
                                          <tbody class="text-center">


                                                @foreach ($users as $user)
                                               @if($user->email !="root@root.com")
                                                <tr>
                                                      <td>{{ $user->id }}</td>
                                                      <td>{{ $user->name }}</td>
                                                      <td class="d-none d-md-table-cell" >{{ $user->email }}</td>
                                                      <td class="d-none d-md-table-cell">
                                                            @foreach ($user->getRoleNames() as $role)
                                                            {{ $role }}
                                                            @endforeach


                                                      </td>
                                                      <td>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser" data-backdrop="static" wire:click="edit({{ $user->id }})"
                                                                  @unless($auth->can('Editar usuario'))
                                                                  disabled style="cursor:not-allowed;"
                                                                   @endunless

                                                                  ><i class="uil uil-user-square"></i> Editar</button>

                                                      </td>
                                                      <td>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addUser" data-backdrop="static" wire:click="preDestroy({{ $user->id }})"
                                                                  @unless($auth->can('Eliminar usuario'))
                                                                  disabled style="cursor:not-allowed;"
                                                                  @endunless

                                                                  ><i class="uil uil-user-times"></i> Eliminar</button>
                                                      </td>

                                                </tr>
                                                @endif
                                                @endforeach

                                          </tbody>
                                    </table>
                              </div>

                              {{ $users->links()  }}
                        </div>
                  </div>
            </div>
      </div>




      <div wire:ignore.self class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    @include("dashboard.components.userView.$view")

                  </div>
            </div>
      </div>




