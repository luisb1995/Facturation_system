<div class="container-fluid">
    <div class="row">
          <div class="col-12">
                <div class="page-title-box">
                      <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                  <li class="breadcrumb-item active">Permisos</li>
                            </ol>
                      </div>
                      <h4 class="page-title">Administración de permisos</h4>
                </div>
          </div>
    </div>


      <div class="row">
            <div class="col-12">
                  <div class="card" style="background-color:#ffffff;">
                        <div class="card-body">
                              <div class="row mb-3">
                                    <div class="col-12 text-left">

                                    <button
                                    type="button"
                                    class="btn btn-primary" disable> Agregar Rol
                                    <!-- data-toggle="modal"
                                    data-target="#permissionModal"
                                    Disable="disable"
                                    wire:click="default"
                                    @unless($auth->can('Agregar roles'))
                                          disabled style="cursor:not-allowed;"
                                    @endunless
                                    >
                                    <i class="mdi mdi-plus-circle mr-2"></i></i> Agregar Rol -->
                                    </button>
                                    </div>

                              </div>
                              <div class="row mb-3">
                                    <div class="col-12 col-md-6">
                                          <input type="text" wire:model.debounce.300ms="search" class="form-control" value="" placeholder="Buscar roles...">
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

                                                      <th wire:click="sort('id')" style="cursor:pointer;width:80px;">
                                                      <a >Id</a>
                                                      <i class="uil uil-sort"></i>
                                                      </th>
                                                      <th wire:click="sort('name')" style="cursor:pointer;" >
                                                      <a>Roles</a>
                                                      <i class="uil uil-sort"></i>
                                                      </th>
                                                      <th>Actions</th>

                                                </tr>
                                          </thead>
                                          <tbody class="text-center" style="color:#7FAC45">
                                          @foreach ($roles as $role)
                                           @if ($role->name != "Super Admin")
                                          <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                      @if ($role->name == "Super Admin")
                                                      @else
                                                            <button
                                                            type="button"
                                                            class="btn btn-primary" disable> Editar
                                                            <!-- data-toggle="modal"
                                                            data-target="#permissionModal"
                                                            wire:click="edit({{ $role->id }})"

                                                            @unless($auth->can('Editar roles'))
                                                                  disabled style="cursor:not-allowed;"
                                                            @endunless
                                                            >

                                                                  <i class="mdi mdi-pencil-box-outline"></i> Edit -->
                                                            </button>
                                                      @endif
                                                      @if ($role->name == "Administrador" or $role->name == "Aliado comercial" or $role->name=="Cliente" or $role->name=="Super Admin" or $role->name == "Centro de servicio")
                                                      @else
                                                      <button
                                                      type="button"
                                                      class="btn btn-danger"  disable> Delete
                                                      <!-- data-toggle="modal"
                                                      data-target="#permissionModal"
                                                      wire:click="preDestroy({{ $role->id }})"

                                                      @unless($auth->can('Eliminar roles'))
                                                            disabled style="cursor:not-allowed;"
                                                      @endunless
                                                      >
                                                            <i class="mdi mdi-close-box-outline"></i> Delete -->
                                                      </button>
                                                      @endif
                                                </td>


                                          </tr>
                                            @endif
                                          @endforeach

                                          </tbody>
                                    </table>
                              </div>
                              {{ $roles->links()  }}
                        </div>
                  </div>
            </div>
      </div>



    <div wire:ignore.self class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    @include("dashboard.components.permissionView.$view")

                </div>
          </div>
    </div>
<script>

</script>



