<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Inventario;
use App\Administration;
use App\blackBox;

use Auth;
use App;
class AdministrationComponent extends Component
{
    //Variables administration
    public $ivaAdministracion,$tasaInventario,$tasaVenta,$tasaVenta2,$claveautorizacion,$empresa,$direccion,$telefono,$rif,$tickera;

    public $clave;
    public $auth;
    public function render()
    {
        $administracion=Administration::find(1);
        if($this->auth==""){
            $this->auth = Auth::User();
            $this->ivaAdministracion=$administracion->ivaAdministracion;
            $this->tasaInventario=$administracion->tasaInventario;
            $this->tasaVenta=$administracion->tasaVenta;
            $this->tasaVenta2=$administracion->tasaVenta2;
            $this->claveautorizacion=$administracion->claveautorizacion;
            $this->tickera=$administracion->tickera;
            $this->empresa=$administracion->empresa;
            $this->rif=$administracion->rif;
            $this->direccion=$administracion->direccion;
            $this->telefono=$administracion->telefono;
        }
        //carga de datos administrativos
            
           

        return view('livewire.dashboard.administration-component');
    }

    public function update(){
        $this->resetErrorBag();
        $this->validate([
            'ivaAdministracion' => 'required',
            'tasaInventario' => 'required',
            'tasaVenta' => 'required',
            'claveautorizacion' => 'required',
            'tickera' => 'required',
            'empresa' => 'required',
            'rif' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
        ]);

        
            $administracion=Administration::find(1);
            $tasaInventarioOld=$administracion->tasaInventario;
        if($this->clave==$administracion->claveautorizacion){
            $administracion->update([
                'ivaAdministracion' => $this->ivaAdministracion,
                'tasaInventario' => $this->tasaInventario,
                'tasaVenta' => $this->tasaVenta,
                'tasaVenta2' => $this->tasaVenta2,
                'claveautorizacion' => $this->claveautorizacion,
                'tickera' => $this->tickera,
                'empresa' => $this->empresa,
                'rif' => $this->rif,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
            ]);

                //Caja negra
                //Creacion de categoria
                blackBox::create([
                    'action' => 'Administracion',
                    'type' => 'Actualizacion de datos',
                    'details' => 'Se actualizaron los datos administrativos',
                    'user' => $this->auth->name,            
                ]);
            if($tasaInventarioOld!=$this->tasaInventario){
                //Caja negra
                //Creacion de categoria
                blackBox::create([
                    'action' => 'Administracion',
                    'type' => 'Actualizacion de precios',
                    'details' => 'Tasa de cambio anterior: <strong>'.$tasaInventarioOld.'</strong> <br> <strong>Nueva Tasa de cambio: '.$this->tasaInventario,
                    'user' => $this->auth->name,            
                ]);
                $this->actualizarInventario();

            }
            $this->emit('alert', ['modal' => '#administrationModal','type' => 'success', 'message' => 'Datos guardados exitosamente!.']);
        }
        else{
            $this->emit('alert', ['modal' => '','type' => 'error', 'message' => 'Error de validación proceso detenido!.']);
        }
        
    }

    public function actualizarInventario(){
        $productos=Inventario::where('actualizar','=',1)->get();
        foreach($productos as $producto2){
            $producto=Inventario::find($producto2->id);
            
            $nuevoPrecio=$producto2->divisa*$this->tasaInventario;
            if($producto2->costo==0){
                $costo=0.01;
            }
            else{
                $costo=$producto2->costo;
            }
            $formula=($nuevoPrecio/$costo)-1;

            $ganancia=round($formula*100,2);

            if($ganancia<=0){
                $ganancia=0;
            }
            
            $producto->update([
                'precio' => $nuevoPrecio,
                'ganancia'=>$ganancia
            ]);
        }
        $this->emit('alert', ['modal' => '','type' => 'success', 'message' => 'Precios de inventario actualizados con exito!.']);
        
    }

    public function modalUpdate(){
        $this->clave=null;
        $this->emit('showModal', ['modal' => '#administrationModal']);
    }





}
