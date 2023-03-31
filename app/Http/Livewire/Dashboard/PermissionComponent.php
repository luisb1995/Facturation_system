<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\blackBox;
use Auth;
class PermissionComponent extends Component
{
    //#############################################
    //         Propiedades livewire
    //#############################################
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Variables de roles
    public $role_id,$name;
    //Variables de control datatable
    public $perPage = '10';
    public $orderBy = "id";
    public $orderAsc = true;
    public $search= '';
    public $view='create';
    public $auth;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    public function render()
    {
        if($this->auth==""){
            $this->auth = Auth::User();
        }
            $roles = Role::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc? 'asc' : 'desc')
            ->simplePaginate($this->perPage);
            $permissions = Permission::all();

            //#########################################################################
            //--Detecta si se esta editando los permisos de un rol y pasa los datos del 
            //--rol para deteccion de permisos activos durante edición.
            //#########################################################################

            if($this->role_id!=''){
                $roleEdit = Role::find($this->role_id);

                //#########################################
                //reestablecer switches de permisos activos
                //#########################################

                $this->emit('editFormReset');

                //#########################################
            }
            else{
                $roleEdit='';
            }
            //#########################################################################

            return view('livewire.dashboard.permission-component', compact('roles','permissions','roleEdit'));    
        
    }
    public function sort($col)
    {
        $this->orderBy = $col;
        if($this->orderAsc == true){
            $this->orderAsc = false;
        }
        else{
            $this->orderAsc = true;
        }
    }
    public function store(){
        $this->resetErrorBag();
        $this->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
        ]);
        $role = Role::create(['name' => $this->name]);
        
        //Creacion de permisología
        blackBox::create([
            'action' => 'Creación',
            'type' => 'Permisología',
            'details' => 'Rol: <strong>'.$this->name.'</strong>',
            'user' => $this->auth->name,            
        ]);

        $this->emit('alert', ['modal' => '#permissionModal','type' => 'success', 'message' => 'Rol registrado exitosamente!.']);
        
    }
    public function edit($id)
    {
        $this->resetErrorBag();
        $role=Role::find($id);
        $this->role_id=$role->id;
        $this->name = $role->name;
        $this->view = 'edit';
        

    }
    public function swapPermission($permissionid)
    {
        $permission= Permission::find($permissionid);
        $role=Role::find($this->role_id);
        if($role->hasPermissionTo($permission->name)){
            $role->revokePermissionTo($permission);
            $this->emit('alert', ['modal' => '','type' => 'success', 'message' => 'Permiso retirado exitosamente!.']);
            //modificación de permisología
            blackBox::create([
                'action' => 'Modificación',
                'type' => 'Permisología',
                'details' => 'Rol: <strong>'.$role->name.'</strong><br>Permiso retirado: <strong>'.$permission->name.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        else{
            $role->givePermissionTo($permission);
            //modificación de permisología
            blackBox::create([
                'action' => 'Modificación',
                'type' => 'Permisología',
                'details' => 'Rol: <strong>'.$role->name.'</strong><br>Permiso concedido: <strong>'.$permission->name.'</strong>',
                'user' => $this->auth->name,            
            ]);
            $this->emit('alert', ['modal' => '','type' => 'success', 'message' => 'Permiso agregado exitosamente!.']);
        }
    }
    public function preDestroy($id)
    {
        $role = Role::find($id);
        $this->role_id = $role->id;
        $this->name = $role->name;
        $this->view = 'delete';
        
    }
    public function destroy(){
        $role=Role::find($this->role_id);
        
        //eliminar de permisología
        blackBox::create([
            'action' => 'Eliminación',
            'type' => 'Permisología',
            'details' => 'Rol: <strong>'.$role->name.'</strong>',
            'user' => $this->auth->name,            
        ]);

        $role="";

        Role::destroy($this->role_id);

        $this->emit('alert', ['modal' => '#permissionModal','type' => 'success', 'message' => 'Rol eliminado exitosamente!.']);

    }
    public function default(){
        $this->resetErrorBag();
        $this->name = '';
        $this->role_id='';
        $this->view = 'create';
    }
}
