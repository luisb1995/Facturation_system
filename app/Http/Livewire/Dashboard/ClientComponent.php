<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\client;
use App\blackBox;
use App\Old\Clientes as clientesOld;
use Auth;
use App;
use PDF2;
class ClientComponent extends Component
{   
    //#############################################
    //         Propiedades livewire
    //#############################################
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //#############################################
    //      Inicializacion de variables
    //#############################################
    
    public $view = 'create';
    
    //Variable de cliente
    public $client_id,$cedula,$direccion,$email,$telefono,$nombre;

    //Variables de control datatable
    public $perPage = '10';
    public $orderBy = "id";
    public $orderAsc = true;
    public $search= '';
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

        $clients=client::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc? 'asc' : 'desc')
            ->simplePaginate($this->perPage);

        return view('livewire.dashboard.client-component',compact('clients'));
    }

    //////////////////////////////////////////////////////
    //Funcion de orden de columna
    //////////////////////////////////////////////////////
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
    
    //////////////////////////////////////////////////////
    //Funcion de registrar cliente
    //////////////////////////////////////////////////////
    public function store(){
        $this->resetErrorBag();
        $this->validate([
            'nombre'=>['required'],
            'cedula'=>['required','unique:clients'],
            'telefono'=>['required','min:10'],
            'direccion' => ['required'],
            'email' => ['required'],
            
        ]);
        $client=client::create([
            'nombre'=>$this->nombre,
            'cedula'=>$this->cedula,
            'telefono'=>$this->telefono,
            'direccion'=>$this->direccion,
            'email'=>$this->email
        ]);
        //Creacion de registro en caja negra
        blackBox::create([
            'action' => 'Clientes',
            'type' => 'Registro de cliente',
            'details' => '<strong>Cliente:</strong> '.$client->nombre.'<br> <strong>Cedula:</strong> '.$client->cedula,
            'user' => $this->auth->name,            
        ]);
        $this->default();
        $this->emit('alert', ['modal' => '#clientModal','type' => 'success', 'message' => 'Cliente registrado con exito!.']);
    }

    //////////////////////////////////////////////////////
    //Funcion de consultar cliente a modificar
    //////////////////////////////////////////////////////
    public function edit($id){
        $client=client::find($id);
        $this->client_id=$id;
        $this->nombre=$client->nombre;
        $this->cedula=$client->cedula;
        $this->telefono=$client->telefono;
        $this->email=$client->email;
        $this->direccion=$client->direccion;
        $this->view="edit";


    }

    //////////////////////////////////////////////////////
    //Funcion de guardar modificacion de cliente
    //////////////////////////////////////////////////////
    public function update(){
        $this->resetErrorBag();
        $this->validate([
            'nombre'=>['required'],
            'telefono'=>['required','min:10'],
            'direccion' => ['required'],
            'email' => ['required'],
            
        ]);

        $client=client::find($this->client_id);
        $client->update([
            'nombre'=>$this->nombre,
            'cedula'=>$this->cedula,
            'telefono'=>$this->telefono,
            'direccion'=>$this->direccion,
            'email'=>$this->email
        ]);

        //Creacion de registro en caja negra
        blackBox::create([
            'action' => 'Clientes',
            'type' => 'Modificacion de cliente',
            'details' => '<strong>Cliente:</strong> '.$client->nombre.'<br> <strong>Cedula:</strong> '.$client->cedula,
            'user' => $this->auth->name,            
        ]);
        $this->default();
        $this->emit('alert', ['modal' => '#clientModal','type' => 'success', 'message' => 'Cliente modificado con exito!.']);
    }

    //////////////////////////////////////////////////////
    //Funcion de consultar cliente a eliminar
    //////////////////////////////////////////////////////
    public function preDestroy($id){
        $client=client::find($id);
        $this->client_id=$id;
        $this->nombre=$client->nombre;
        $this->cedula=$client->cedula;
        $this->telefono=$client->telefono;
        $this->email=$client->email;
        $this->direccion=$client->direccion;
        $this->view="delete";


    }

    //////////////////////////////////////////////////////
    //Funcion de eliminar cliente
    //////////////////////////////////////////////////////
    public function destroy(){
        $client=client::find($this->client_id);
        //Creacion de registro en caja negra
        blackBox::create([
            'action' => 'Clientes',
            'type' => 'Eliminación de cliente',
            'details' => '<strong>Cliente:</strong> '.$client->nombre.'<br> <strong>Cedula:</strong> '.$client->cedula,
            'user' => $this->auth->name,            
        ]);
        $client->delete();
        $this->default();
        $this->emit('alert', ['modal' => '#clientModal','type' => 'error', 'message' => 'Cliente eliminado con exito!.']);
    }
 //////////////////////////////////////////////////////
    //Importacion desde Base de datos version anterior safi
    //////////////////////////////////////////////////////
    public function import(){
        $oldClients=clientesOld::get();
        
        foreach($oldClients as $oldClient){
            

            $product = client::create([
                'nombre'=>$oldClient->nombreCliente,
                'cedula'=>$oldClient->cedulaCliente,
                'telefono'=>'.',
                'direccion'=>$oldClient->direccionCliente,
                'email'=>'.'
            ]);
        }
        //Creacion de categoria
        blackBox::create([
            'action' => 'Clientes',
            'type' => 'Importacion',
            'details' => 'Importacion masiva desde version anterior SAFI',
            'user' => $this->auth->name,            
        ]);

        //Invocar notificacion 
        //tipos de parametros: 
        //--modal ["modal a cerrar"]
        //--Type ["success","error","warning","info"]
        //--message ["el mensaje que se desee mostrar"]

        $this->emit('alert', ['modal' => '','type' => 'success', 'message' => 'Importacion realizada con exito!.']);
    }
    //////////////////////////////////////////////////////
    //Reset de variables
    //////////////////////////////////////////////////////
    public function default(){
        $this->client_id=null;
        $this->nombre=null;
        $this->cedula=null;
        $this->telefono=null;
        $this->email=null;
        $this->direccion=null;
        $this->view="create";
    }

    //////////////////////////////////////////////////////
    //Reporte
    //////////////////////////////////////////////////////
    public function report()
    {  
        return response()->streamDownload(function () {
            $clients=client::search($this->search)->get();
            $data = [
                'reportData' => $clients
                ];
            $pdf = PDF2::loadView('pdf.clientReport', $data,[], [
                'title'      => 'Client Report',
                ]);
            $pdf->stream();
        }, 'ClientReport-'.date("d-m-Y").'.pdf');
       
    }
}
