<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Carbon\Carbon;

use App\Imports\InventariosImport;
use App\Exports\InventariosExport;
use Maatwebsite\Excel\Facades\Excel;


use App\Inventario;
use App\Administration;
use App\Category;
use App\blackBox;

use App\Old\Inventario as InventarioOld;

use Auth;
use App;
use PDF2;

class InventarioComponent extends Component
{
    use WithFileUploads;
    //#############################################
    //         Propiedades livewire
    //#############################################
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    //#############################################
    //      Inicializacion de variables
    //#############################################
    
    public $view = 'create';
    
    
    //Variables de producto
    public $product_id, $codigo, $description, $stock, $cost, $gain, $price, $dolar, $iva, $exchange,$category_id;
    public $codigo_old, $description_old, $stock_old, $cost_old, $gain_old, $price_old, $dolar_old, $iva_old, $exchange_old,$category_id_old;
    public $tasaInventario,$tasaVenta,$porcentajeIva,$tasaBcv;
    //variables test
    public $date1,$date2;
    //Variables de control datatable
    public $excelFile="";
    public $perPage = '10';
    public $orderBy = "id";
    public $orderAsc = true;
    public $search= '';
    public $auth;
    public $category=null;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingCategory(){
        $this->resetPage();
    }
    public function updatingPerPage()
    {
        $this->resetPage();
    }

    //////////////////////////////////////////////////////
    //Si se modifica el costo actualiza precio y ganancia
    //////////////////////////////////////////////////////
    public function updatedCost()
    {   if($this->gain<=0){
            $this->gain = 30;
            $multiplier = 1.3;
        } 
        else{
            $this->gain = $this->gain;
            $multiplier = ($this->gain/100)+1;
        }
        
        $this->price = round($this->cost*$multiplier,2);
        if($this->exchange==2){
            $this->dolar=round($this->price/$this->tasaBcv,4);
        }
        else{
            $this->dolar=round($this->price/$this->tasaInventario,4);
        }
    }
    //////////////////////////////////////////////////////
    //Si se modifica el precio actualiza precio y ganancia
    //////////////////////////////////////////////////////
    public function updatedPrice()
    {
        if($this->cost<=0){
            $this->gain=0;
            $this->price=$this->price;
        }
        else{
            $formula=($this->price/$this->cost)-1;
            $this->gain=round($formula*100,2);
            if($this->gain<=0){
                $this->gain=0;
            }
        }
        
    }
    //////////////////////////////////////////////////////
    //Si se modifica la ganancia actualiza precio
    //////////////////////////////////////////////////////
    public function updatedGain()
    {
        if($this->gain<=0){
            $this->gain = 30;
            $multiplier = 1.3;
        } 
        else{
            $this->gain = $this->gain;
            $multiplier = ($this->gain/100)+1;
        }
        if($this->cost<=0){
            $this->price=$this->price;
            $this->cost=$this->cost;
            $this->dolar=$this->dolar;
        }
        else{
            $this->price=round($this->cost*$multiplier,2);
            if($this->exchange==2){
                $this->dolar=round($this->price/$this->tasaBcv,4);
            }
            else{
            $this->dolar=round($this->price/$this->tasaInventario,4);
            }
        }

    }
    //////////////////////////////////////////////////////
    //Si se modifica la ganancia actualiza precio en dolar
    //////////////////////////////////////////////////////
    public function updatedDolar()
    {
        
            if($this->exchange==2){
                $this->price=$this->dolar*$this->tasaBcv;
            }
            else{
                $this->price=$this->dolar*$this->tasaInventario;
            }
        if($this->cost<=0){
            $this->gain = 0;
            
        } 
        else{
            $formula=($this->price/$this->cost)-1;
            $this->gain=round($formula*100,2);
            if($this->gain<=0){
                $this->gain=0;
            }
        }

    }

    //////////////////////////////////////////////////////
    //Renderizado del componente
    //////////////////////////////////////////////////////
    public function render()
    {
        
        if($this->auth==""){
            $this->auth = Auth::User();
        }

        $categories=Category::get();

        $administracion=Administration::find(1);

        $this->tasaInventario=$administracion->tasaInventario;
        $this->tasaBcv=$administracion->tasaVenta2;
        $this->tasaVenta=$administracion->tasaInventario;
        $this->porcentajeIva=$administracion->ivaAdministracion;

        
        
            $products=Inventario::search($this->search)
            ->category($this->category)
            ->orderBy($this->orderBy, $this->orderAsc? 'asc' : 'desc')
            ->simplePaginate($this->perPage);
            
      
        

        return view('livewire.dashboard.inventario-component',compact("products","categories"));
    }

     //////////////////////////////////////////////////////
    //Importacion desde Base de datos version anterior safi
    //////////////////////////////////////////////////////
    public function import(){
        $oldProducts=InventarioOld::get();
        
        foreach($oldProducts as $oldProduct){
            $validation=Inventario::where('codigo','=',$oldProduct->codigoProducto)->first();
            if($validation==null){
                $actualizar="";
                if($oldProduct->actualizarProducto==0){
                    $actualizar=1;
                }
                else{
                    $actualizar=0;
                }

                $product = Inventario::create([
                    'codigo' => $oldProduct->codigoProducto,
                    'descripcion' => $oldProduct->descripcionProducto,
                    'cantidad' => $oldProduct->cantidadProducto,
                    'costo' => $oldProduct->costoCompraProducto,
                    'ganancia' => $oldProduct->porcentajeGananciaProducto,
                    'precio' => $oldProduct->costoVentaProducto,
                    'divisa' => $oldProduct->precioDivisaProducto,
                    'iva' => $oldProduct->ivaProducto,
                    'actualizar'=>$actualizar,
                ]);
            }
            
        }
        //Creacion de categoria
        blackBox::create([
            'action' => 'Inventario',
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
    //Interfaz importacion archivo excel
    //////////////////////////////////////////////////////
    public function excel(){
        $this->resetErrorBag();
        $this->view='import';
    }

     //////////////////////////////////////////////////////
    //Importar Archivo Excel
    //////////////////////////////////////////////////////
    public function importExcel(){
        $this->validate([
            'excelFile' => ['required',' mimes:xlsx, xls'], 
        ]);

        
        Excel::import(new InventariosImport, $this->excelFile);
        //Creacion de categoria
        blackBox::create([
            'action' => 'Inventario',
            'type' => 'Importacion Excel',
            'details' => 'Importacion masiva desde archivo excel',
            'user' => $this->auth->name,            
        ]);

        //Invocar notificacion 
        //tipos de parametros: 
        //--modal ["modal a cerrar"]
        //--Type ["success","error","warning","info"]
        //--message ["el mensaje que se desee mostrar"]

        $this->emit('alert', ['modal' => '#inventarioModal','type' => 'success', 'message' => 'Importacion realizada con exito!.']);
    }

     //////////////////////////////////////////////////////
    //Exportar archivo excel
    //////////////////////////////////////////////////////
    public function export(){

        return Excel::download(new InventariosExport($this->search,$this->category), 'Inventory-'.date("d-m-Y").'.xlsx');

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
    //Reseteo del modal y variables
    //////////////////////////////////////////////////////
    public function default(){
        $this->product_id="";
        $this->codigo="";
        
        $this->description="";
        $this->stock="";
        $this->cost="";
        $this->gain="";
        $this->price="";
        $this->dolar="";
        $this->iva=0;
        $this->exchange=0;
        $this->view="create";
    }

     //////////////////////////////////////////////////////
    //Registro de producto
    //////////////////////////////////////////////////////
    public function store(){
        //resetear la bolsa de errores de validación
        $this->resetErrorBag();
        //validaciones
        $this->validate([
            
            'codigo' => ['required', 'string', 'max:255','unique:inventarios'],
            'description' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'max:255'],
            'cost' => ['required', 'max:255'],
            'gain' => ['required', 'max:255'],
            'price' => ['required', 'max:255'],
            'dolar' => ['required', 'max:255'],
                        
        ]);
        //Registrar producto
        $product = Inventario::create([
            'category_id'=>$this->category_id,
            'codigo' => $this->codigo,
            'descripcion' => $this->description,
            'cantidad' => $this->stock,
            'costo' => $this->cost,
            'ganancia' => $this->gain,
            'precio' => $this->price,
            'divisa' => $this->dolar,
            'iva' => $this->iva,
            'actualizar'=>$this->exchange,
        ]);

        //Caja negra
        //Creacion de categoria
        blackBox::create([
            'action' => 'Inventario',
            'type' => 'Registro de Producto',
            'details' => 'Producto: <strong>'.$this->description.'</strong>',
            'user' => $this->auth->name,            
        ]);

        //Invocar notificacion 
        //tipos de parametros: 
        //--modal ["modal a cerrar"]
        //--Type ["success","error","warning","info"]
        //--message ["el mensaje que se desee mostrar"]
        
        $this->emit('alert', ['modal' => '#inventarioModal','type' => 'success', 'message' => 'Producto registrado con exito!.']);
    }

     //////////////////////////////////////////////////////
    //Consulta para edicion de producto
    //////////////////////////////////////////////////////
    public function edit($id){
        $this->product_id=$id;
        $product=Inventario::find($id);
        $this->category_id=$product->category_id;
        $this->codigo=$product->codigo;
        $this->description=$product->descripcion;
        $this->stock=round($product->cantidad,3);
        $this->cost=$product->costo;
        $this->gain=$product->ganancia;
        $this->price=$product->precio;
        $this->dolar=$product->divisa;
        $this->iva=$product->iva;
        $this->exchange=$product->actualizar;

        //Guardar datos viejos
        $this->category_id_old=$product->category_id;
        $this->codigo_old=$product->codigo;
        $this->description_old=$product->descripcion;
        $this->stock_old=round($product->cantidad,3);
        $this->cost_old=$product->costo;
        $this->gain_old=$product->ganancia;
        $this->price_old=$product->precio;
        $this->dolar_old=$product->divisa;
        $this->iva_old=$product->iva;
        $this->exchange_old=$product->actualizar;
        $this->view="edit";
    }

     //////////////////////////////////////////////////////
    //Modificacion de producto
    //////////////////////////////////////////////////////
    public function update(){
        $product=Inventario::find($this->product_id);

        //resetear la bolsa de errores de validación
        $this->resetErrorBag();

        //validaciones
        $this->validate([
            
            'description' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'max:255'],
            'cost' => ['required', 'max:255'],
            'gain' => ['required', 'max:255'],
            'price' => ['required', 'max:255'],
            'dolar' => ['required', 'max:255'],
                        
        ]);

        //Modificacion
        $product->update([
            'category_id'=>$this->category_id,
            'descripcion' => $this->description,
            'cantidad' => $this->stock,
            'costo' => $this->cost,
            'ganancia' => $this->gain,
            'precio' => $this->price,
            'divisa' => $this->dolar,
            'iva' => $this->iva,
            'actualizar'=>$this->exchange,
        ]);

        //Registros de caja negra
        //Modificacion de codigo
        if($this->codigo==$this->codigo_old){ }
        else{
            
            blackBox::create([
                'action' => 'Inventario',
                'type' => 'Modificación de Producto',
                'details' => 'Producto: <strong>'.$this->description.'</strong><br>Codigo anterior:<strong>'.$this->codigo_old.'</strong><br>Código nuevo:<strong>'.$this->codigo.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        //Modificacion de descripcion
        if($this->description==$this->description_old){}
        else{
            blackBox::create([
                'action' => 'Inventario',
                'type' => 'Modificación de Producto',
                'details' => 'Producto: <strong>'.$this->description.'</strong><br>Descripción anterior:<strong>'.$this->description_old.'</strong><br>Descripción nueva:<strong>'.$this->description.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        //Modificacion de costo
        if($this->stock==$this->stock_old){}
        else{
            blackBox::create([
                'action' => 'Inventario',
                'type' => 'Modificación de Producto',
                'details' => 'Producto: <strong>'.$this->description.'</strong><br>Cantidad anterior:<strong>'.$this->stock_old.'</strong><br>Cantidad nueva:<strong>'.$this->stock.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        //Modificacion de costo
        if($this->cost==$this->cost_old){}
        else{
            blackBox::create([
                'action' => 'Inventario',
                'type' => 'Modificación de Producto',
                'details' => 'Producto: <strong>'.$this->description.'</strong><br>Costo anterior:<strong>'.$this->cost_old.'</strong><br>Costo nueva:<strong>'.$this->cost.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        //Modificacion de ganancia
        if($this->gain==$this->gain_old){}
        else{
            blackBox::create([
                'action' => 'Inventario',
                'type' => 'Modificación de Producto',
                'details' => 'Producto: <strong>'.$this->description.'</strong><br>Ganancia anterior:<strong>'.$this->gain_old.'</strong><br>Ganancia nueva:<strong>'.$this->gain.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        //Modificacion de precio venta
        if($this->price==$this->price_old){}
        else{
            blackBox::create([
                'action' => 'Inventario',
                'type' => 'Modificación de Producto',
                'details' => 'Producto: <strong>'.$this->description.'</strong><br>Precio anterior:<strong>'.$this->price_old.'</strong><br>Precio nueva:<strong>'.$this->price.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        //Modificacion de dolar
        if($this->dolar==$this->dolar_old){}
        else{
            blackBox::create([
                'action' => 'Inventario',
                'type' => 'Modificación de Producto',
                'details' => 'Producto: <strong>'.$this->description.'</strong><br>Precio divisa anterior:<strong>'.$this->dolar_old.'</strong><br>Precio divisa nuevo:<strong>'.$this->dolar.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        //Modificacion de iva
        if($this->iva==$this->iva_old){}
        else{
            if($this->iva==0){
                $iva="No";
            }
            else{
                $iva="Si";
            }
            if($this->iva_old==0){
                $iva_old="No";
            }
            else{
                $iva_old="Si";
            }
            blackBox::create([
                'action' => 'Inventario',
                'type' => 'Modificación de Producto',
                'details' => 'Producto: <strong>'.$this->description.'</strong><br>Exento de impuesto anterior:<strong>'.$iva_old.'</strong><br>Exento de impuesto nuevo:<strong>'.$iva.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        //Modificacion de actualizacion con tasa de cambio
        if($this->exchange==$this->exchange_old){}
        else{
            if($this->exchange==0){
                $exchange="No";
            }
            else{
                $exchange="Si";
            }
            if($this->exchange_old==0){
                $exchange_old="No";
            }
            else{
                $exchange_old="Si";
            }
            blackBox::create([
                'action' => 'Inventario',
                'type' => 'Modificación de Producto',
                'details' => 'Producto: <strong>'.$this->description.'</strong><br>Actualizar segun tasa antes:<strong>'.$exchange_old.'</strong><br>Exento de impuesto ahora:<strong>'.$exchange.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        if($this->category_id ==$this->category_id_old){}
        else{
            $category=Category::find($this->category_id);
            $category_old=Category::find($this->category_id_old);
            
            if($this->category_id_old==null or $this->category_id_old == ""){
                $category_old_name="";
            }
            else{
                $category_old_name=$category_old->name;
            }
            blackBox::create([
                'action' => 'Inventario',
                'type' => 'Modificación de Producto',
                'details' => 'Producto: <strong>'.$this->description.'</strong><br>Categoría anterior:<strong>'.$category_old_name.'</strong><br>Categoría nueva:<strong>'.$category->name.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        $this->emit('alert', ['modal' => '#inventarioModal','type' => 'success', 'message' => 'Producto modificado con exito!.']);
    }

     //////////////////////////////////////////////////////
    //Consulta para eliminar producto
    //////////////////////////////////////////////////////
    public function preDestroy($id){ 
        $this->product_id=$id;
        $product= Inventario::find($id);
        $this->codigo=$product->codigo;
        $this->description=$product->descripcion;
        $this->stock=round($product->cantidad,3);
        $this->cost=$product->costo;
        $this->gain=$product->ganancia;
        $this->price=$product->precio;
        $this->dolar=$product->divisa;
        $this->iva=$product->iva;
        $this->exchange=$product->actualizar;
        
        $this->view = 'delete';

    }

     //////////////////////////////////////////////////////
    //Eliminar producto
    //////////////////////////////////////////////////////
    public function destroy()
    {
        $product = Inventario::find($this->product_id);
         //Modificación de categoria
         blackBox::create([
            'action' => 'Inventario',
            'type' => 'Eliminación de Producto',
            'details' => 'Producto: <strong>'.$this->description.'</strong><br>Cantidad:<strong>'.$this->stock.'</strong><br>Costo:<strong>'.$this->cost.'</strong><br>Precio Venta:<strong>'.$this->price.'</strong><br>Precio divisa:<strong>'.$this->dolar.'</strong>',
            'user' => $this->auth->name,            
        ]);
        Inventario::destroy($this->product_id);
        
        //Invocar notificacion 
        //tipos de parametros: 
        //--modal ["modal a cerrar"]
        //--Type ["success","error","warning","info"]
        //--message ["el mensaje que se desee mostrar"]
        
        $this->emit('alert', ['modal' => '#inventarioModal','type' => 'success', 'message' => 'Producto eliminada con exito!.']);
    }
   
     //////////////////////////////////////////////////////
    //Reporte
    //////////////////////////////////////////////////////
    public function report()
    {  
        return response()->streamDownload(function () {
            $inventario=Inventario::search($this->search)
            ->category($this->category)
            ->get();
            $data = [
                'reportData' => $inventario
                ];
            $pdf = PDF2::loadView('pdf.inventoryReport', $data,[], [
                'title'      => 'Inventory Report',
                ]);
            $pdf->stream();
        }, 'InventoryReport-'.date("d-m-Y").'.pdf');
       
    }

    public function template(){
        return response()->download(storage_path('app/public/Template.xlsx'));
    }
}
