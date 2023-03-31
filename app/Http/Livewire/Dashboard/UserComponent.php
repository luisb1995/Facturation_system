<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\User;
use App\Image;
use App\blackBox;
use App\Subscribers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Auth;
use App;
use PDF;
class UserComponent extends Component
{
    //#############################################
    //         Propiedades livewire
    //#############################################
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //#############################################
    //      Inicializacion de variables
    //#############################################
    
    //Variables de usuario
    public $user_id, $username, $name, $email,$password,$password_confirmation;

    //Variables de roles
    public $role_id = '';
    public $roleAssign = '';

    //Variables UI
    public $view = 'create';

    //Variables de control datatable
    public $perPage = '10';
    public $orderBy = "id";
    public $orderAsc = true;
    public $search= '';

   
    public $reportData;
    public $auth;
    //#############################################
    //          Procesos de usuarios
    //#############################################
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    
  
    //Listar usuarios
    public function render()
    {
        if($this->auth==""){
            $this->auth = Auth::User();
        }
        $users= User::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc? 'asc' : 'desc')
            ->simplePaginate($this->perPage);
        $roles = Role::all();

        return view('livewire.dashboard.user-component', compact('users','roles'));
        
    }

    //Ordenar tabla
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

    //Reiniciar el formulario para creacion de usuario
    public function default()
    {
        //restablecer todo a blanco
        $this->user_id = '';
        $this->name = '';
        $this->username = '';
        $this->email  = '';
        $this->password  = '';
        $this->password_confirmation  = '';
        
        $this->role_id = '';
        $this->roleAssign = '';

       
        
        $this->view = 'create';
    }

    //Crear usuario
    public function store()
    { 
        //resetear la bolsa de errores de validacion
        $this->resetErrorBag();

        //validar los campos del formulario
        $this->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required'],
        ]);

        //crear el usuario
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'password' => Hash::make($this->password),
        ]);

        //asignar rol
        $role = Role::find($this->role_id);
        $user->assignRole($role->name);

      
        //registro en caja negra
        $img = Image::create([
            'url' => 'default.png',
            'imageable_type' => 'App\User',
            'imageable_id' => $user->id,
        ]);
        blackBox::create([
            'action' => 'Registro',
            'type' => 'Usuario',
            'details' => 'Usuario: <strong>'.$this->username.'</strong><br>Nombre: '.$this->name.' <br> permisología: <strong>'.$role->name.'</strong>',
            'user' => $this->auth->name,            
        ]);
        //Invocar notificacion 
        //tipos de parametros: 
        //--modal ["modal a cerrar"]
        //--Type ["success","error","warning","info"]
        //--message ["el mensaje que se desee mostrar"]
        
        $this->emit('alert', ['modal' => '#addUser','type' => 'success', 'message' => 'Usuario registrado con exito!.']);

        //retornar la vista de edicion
        $this->default();
    }

    //Mostrar usuario
    public function edit($id)
    {

        //resetear la bolsa de errores de validación
       $this->resetErrorBag();
       
       //consultar el usuario
       $user = User::with('roles')->find($id);
      
        
       
       //asignar a los modelos los valores indicados
       $this->user_id = $user->id;
       $this->username = $user->username;
       $this->name = $user->name;
       $this->email  = $user->email;
       $this->password=null;
       $this->roleAssign = $user->roles->first()->name;
       $this->role_id = $user->roles->first()->id;
       //devolver la vista de edicion
       $this->view = 'edit';
       
       
    }

    //Modificar usuario
    public function update()
    {
        //validaciones
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            
            'role_id' => ['required'],
        ]);
        
        //consultas
        $user = User::with('roles')->find($this->user_id);
        
        $role = Role::find($this->role_id);
        
        if(Hash::make($this->password)==$user->password){
            //modificar usuario
            $user->update([
                'name' => $this->name,
                
            ]);
        }
        else{
            $user->update([
                'name' => $this->name,
                'password'=>Hash::make($this->password) 
            ]);
        }
        
        
       
        
        //validar si el rol es diferente lo cambia, 
        //caso contrario permanece igual
        if($user->roles->first()->name!=$role->name){
            $user->removeRole($user->roles->first()->name);
            $user->assignRole($role->name);
            
            //registro black box cambio de rol
            blackBox::create([
                'action' => 'Cambio de permisos',
                'type' => 'Usuario',
                'details' => 'Usuario: <strong>'.$this->name.'</strong> <br> Permisología asignada: <strong>'.$role->name.'</strong>',
                'user' => $this->auth->name,            
            ]);
        };
       
        //Cambio de datos de usuario
        blackBox::create([
            'action' => 'Modificación',
            'type' => 'Usuario',
            'details' => 'Usuario: <strong>'.$this->username.'</strong><br>Nombre: '.$this->name.'',
            'user' => $this->auth->name,            
        ]);
        //invocar notificacion 
        //tipos de parametros: 
        //--modal ["modal a cerrar"]
        //--Type ["success","error","warning","info"]
        //--message ["el mensaje que se desee mostrar"]
        $this->emit('alert', ['modal' => '#addUser','type' => 'success', 'message' => 'Usuario modificado con exito!.']);
        
    }

    public function preDestroy($id){
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->view = 'delete';
    }
    
    //Eliminar el usuario
    public function destroy()
    {   //Buscar el usuario
        $user = User::with('roles')->find($this->user_id);
        
        

        //Eliminar datos de usuario
        blackBox::create([
            'action' => 'Eliminación',
            'type' => 'Usuario',
            'details' => 'Usuario: <strong>'.$user->username.'</strong> <br> Nombre: <strong>'.$user->name.'</strong> <br> Permisologia: <strong>'.$user->roles->first()->name.'</strong>',
            'user' => $this->auth->name,            
        ]);

        //Quitar el rol
        if($user->hasRole($user->roles->first()->name)){
            $user->removeRole($user->roles->first()->name);
        }
        //Eliminar usuario
        User::destroy($this->user_id);
        
        
        

        //Invocar notificacion 
        //tipos de parametros: 
        //--modal ["modal a cerrar"]
        //--Type ["success","error","warning","info"]
        //--message ["el mensaje que se desee mostrar"]
        $this->emit('alert', ['modal' => '#addUser','type' => 'success', 'message' => 'Usuario eliminado con exito!.']);
    }
    public function report()
    {  
        return response()->streamDownload(function () {
            $pdf = App::make('dompdf.wrapper');
            $reportData = User::get(); 
            $hoy = date("d-m-Y");
            $pdf->loadView('reports.userReport',compact('reportData'));
            echo $pdf->stream();
        }, 'UsersReport-'.date("d-m-Y").'.pdf');
    }
    
    
}
