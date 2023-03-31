<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Brand;
use App\Modelo;
use App\Product;
use App\Image;
use App\blackBox;
use Auth;
use App;
use PDF;


class ProductComponent extends Component
{   
    use WithFileUploads;
    //#############################################
    //         Propiedades livewire
    //#############################################
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $tab = 'datos';
    //#############################################
    //      Inicializacion de variables
    //#############################################
    
    public $view = 'create';
    
    //Variables de producto
    public $product_id, $name, $stock, $price, $price2, $smallDescription, $smallDescription_en, $description, $description_en;
    public $capacity, $longitud, $ancho, $alto, $amperaje, $reserva, $volumenAcido, $peso;
    public $category_id;
    public $brand_id;
    public $productImage=[];
    public $productImageEdit=[];
    public $productBrands=[];
    public $productModelos=[];
    
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
        $brands="";
        $modelos="";
       

        $products = Product::search($this->search)       
        ->orderBy($this->orderBy, $this->orderAsc? 'asc' : 'desc')
        ->simplePaginate($this->perPage);
        
        $categories=Category::get();

        if($this->category_id==0){
            $this->reset('category_id');
        };
        if(isset($this->category_id)){
            $category = Category::find($this->category_id);
            $brands= $category->brands()->orderBy('name', 'asc')->get();
            
            $modelos= Modelo::where('category_id',$category->id)->orderBy('name','asc')->get();
        };
        
       

       

        return view('livewire.dashboard.product-component', compact('products', 'categories', 'brands', 'modelos'));
    }
    ////////////////////////////////////////
    // Ordenar DataTable
    ////////////////////////////////////////
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
    ////////////////////////////////////////
    // Registrar
    ////////////////////////////////////////
    public function store()
    {   
        //resetear la bolsa de errores de validación
        $this->resetErrorBag();
        /*
        
        */
        //validaciones
        $this->validate([
            'name' => ['required', 'string', 'max:255','unique:products'],
            'category_id' => ['required'],
            'stock' => ['required'],
            'price' => ['required'],
            'price2' => ['required'],
            'smallDescription' => ['required'],
            'description' => ['required'],
            'capacity' => ['required'],
            'reserva' => ['required'],
            'longitud' => ['required'],
            'ancho' => ['required'],
            'alto' => ['required'],
            'amperaje' => ['required'],
            'volumenAcido' => ['required'],
            'peso' => ['required'],
            
        ]);
        
        $product = Product::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'stock' => $this->stock,
            'price' => $this->price,
            'price2' => $this->price2,
            'smallDescription' => $this->smallDescription,
            'smallDescription_en' => $this->smallDescription_en,
            'description' => $this->description,
            'description_en' => $this->description_en,
            'capacity' => $this->capacity,
            'longitud' => $this->longitud,
            'ancho' =>$this->ancho,
            'alto' => $this->alto,
            'amperaje' => $this->amperaje,
            'reserva' => $this->reserva,
            'volumenAcido' => $this->volumenAcido,
            'peso' => $this->peso,
            
            
        ]);
        $category= Category::find($this->category_id);
             //Creación de Producto
        blackBox::create([
            'action' => 'Creación',
            'type' => 'Productos',
            'details' => 'Categoría: <strong>'.$category->name.'</strong><br>Producto: <strong>'.$this->name.'</strong><br>Existencias: <strong>'.$this->stock.'</strong><br>Precio: <strong>'.$this->price.'</strong>',
            'user' => $this->auth->name,            
        ]);
        //Invocar notificacion 
        //tipos de parametros: 
        //--modal ["modal a cerrar"]
        //--Type ["success","error","warning","info"]
        //--message ["el mensaje que se desee mostrar"]
        
        $this->emit('alert', ['modal' => '#productModal','type' => 'success', 'message' => 'Producto registrado con exito!.']);
        $this->edit($product->id);
    }
    ////////////////////////////////////////
    // Consultar datos de Edición
    ////////////////////////////////////////
    public function edit($id)
    {   $this->default();
        //resetear la bolsa de errores de validación
        $this->resetErrorBag();
        $product=Product::find($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->category_id = $product->category_id;
        $this->stock = $product->stock;
        $this->price = $product->price;
        $this->price2 = $product->price2;
        $this->smallDescription = $product->smallDescription;
        $this->smallDescription_en = $product->smallDescription_en;
        $this->description = $product->description;
        $this->description_en = $product->description_en;
        $this->capacity = $product->capacity;
        $this->longitud = $product->longitud;
        $this->ancho = $product->ancho;
        $this->alto = $product->alto;
        $this->amperaje = $product->amperaje;
        $this->reserva = $product->reserva;
        $this->volumenAcido = $product->volumenAcido;
        $this->peso = $product->peso;
        $this->tab = 'datos';
        $this->view = 'edit';

        $this->productImageEdit=$product->images;
        $this->productBrands = $product->brands()->orderBy('name','asc')->get();
        $this->productModelos = $product->modelos->where('category_id', $this->category_id);

    }
   
    ////////////////////////////////////////
    // Actualizar datos
    ////////////////////////////////////////

    public function update()
    {
        //resetear la bolsa de errores de validación
        $this->resetErrorBag();
        //validaciones
        /*
        
        */
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required'],
            'stock' => ['required'],
            'price' => ['required'],
            'price2' => ['required'],
            'smallDescription' => ['required'],
            'description' => ['required'],
            'capacity' => ['required'],
            'reserva' => ['required'],
            'longitud' => ['required'],
            'ancho' => ['required'],
            'alto' => ['required'],
            'amperaje' => ['required'],
            'volumenAcido' => ['required'],
            'peso' => ['required'],
            
        ]);

        $product = Product::find($this->product_id);

        $product->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'stock' => $this->stock,
            'price' => $this->price,
            'price2' => $this->price2,
            'smallDescription' => $this->smallDescription,
            'smallDescription_en' => $this->smallDescription_en,
            'description' => $this->description,
            'description_en' => $this->description_en,
            'capacity' => $this->capacity,
            'longitud' => $this->longitud,
            'ancho' =>$this->ancho,
            'alto' => $this->alto,
            'amperaje' => $this->amperaje,
            'reserva' => $this->reserva,
            'volumenAcido' => $this->volumenAcido,
            'peso' => $this->peso,
            
            
        ]);
        $category= Category::find($this->category_id);
        //Modificación de Producto
        blackBox::create([
            'action' => 'Modificación',
            'type' => 'Productos',
            'details' => 'Categoría: <strong>'.$category->name.'</strong><br>Producto: <strong>'.$this->name.'</strong><br>Existencias: <strong>'.$this->stock.'</strong><br>Precio: <strong>'.$this->price.'</strong>',
            'user' => $this->auth->name,            
        ]);
        //Invocar notificacion 
        //tipos de parametros: 
        //--modal ["modal a cerrar"]
        //--Type ["success","error","warning","info"]
        //--message ["el mensaje que se desee mostrar"]
        $this->default();
        $this->emit('alert', ['modal' => '#productModal','type' => 'success', 'message' => 'Producto modificado exitosamente!.']);
    }
    ////////////////////////////////////////
    // Consultar registro a eliminar
    ////////////////////////////////////////
    public function preDestroy($id)
    {
        //resetear la bolsa de errores de validación
        $this->resetErrorBag();
        $product = Product::find($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->category_id = '';
        $this->brand_id = '';
        $this->stock = '';
        $this->price = '';
        $this->smallDescription = '';
        $this->smallDescription_en = '';
        $this->description = '';
        $this->description_en = '';
        $this->capacity = '';
        $this->longitud = '';
        $this->ancho = '';
        $this->alto = '';
        $this->amperaje = '';
        $this->reserva = '';
        $this->volumenAcido = '';
        $this->productImage=[];
        $this->productImageEdit=[];
        $this->peso = '';
        $this->tab = 'datos';
        $this->view = 'delete';
        $this->productBrands = [];
    }
    ////////////////////////////////////////
    // Eliminar registro
    ////////////////////////////////////////
    public function destroy()
    {
        $product = Product::find($this->product_id);
        $images = Image::get()->where('imageable_type','App\Product')->where('imageable_id',$this->product_id);
        foreach($images as $image)
        {
            $image->delete();
        }
        $category= Category::find($product->category_id);
        //Eliminación de Producto
        blackBox::create([
            'action' => 'Eliminación',
            'type' => 'Productos',
            'details' => 'Categoría: <strong>'.$category->name.'</strong><br>Producto: <strong>'.$product->name.'</strong><br>Existencias: <strong>'.$product->stock.'</strong><br>Precio: <strong>'.$product->price.'</strong>',
            'user' => $this->auth->name,            
        ]);
        $product->delete();

    }   
    public function default()
    {
        //resetear la bolsa de errores de validación
        $this->resetErrorBag();
        $this->product_id = '';
        $this->name = '';
        $this->category_id = '';
        $this->brand_id = '';
        $this->stock = '';
        $this->price = '';
        $this->price2 = '';
        $this->smallDescription = '';
        $this->smallDescription_en = '';
        $this->description = '';
        $this->description_en = '';
        $this->capacity = '';
        $this->longitud = '';
        $this->ancho = '';
        $this->alto = '';
        $this->amperaje = '';
        $this->reserva = '';
        $this->volumenAcido = '';
        $this->productImage=[];
        $this->productImageEdit=[];
        $this->peso = '';
        $this->tab = 'datos';
        $this->view = 'create';
        $this->productBrands = [];
    }

    public function swapBrand($id)
    {
        $brand=Brand::find($id);
        
        $product=Product::find($this->product_id);
        $match=$product->brands->where('id', $id)->first();
        $category= Category::find($product->category_id);               
        
        if(isset($product->brands->where('id', $brand->id)->first()->id)){
                
            $product->brands()->detach($id);
            $this->emit('alert', ['modal' => '','type' => 'success', 'message' => 'Marca eliminada exitosamente!.']);
            
            //Retirar marca de Producto
            blackBox::create([
                'action' => 'Desvincular marca',
                'type' => 'Productos',
                'details' => 'Categoría: <strong>'.$category->name.'</strong><br>Producto: <strong>'.$product->name.'</strong><br>Marca desvinculada: <strong>'.$brand->name.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        else{
            $this->emit('alert', ['modal' => '','type' => 'success', 'message' => 'Marca registrada exitosamente!.']);
            $product->brands()->attach($id);
           
            //Retirar marca de Producto
            blackBox::create([
                'action' => 'Vincular marca',
                'type' => 'Productos',
                'details' => 'Categoría: <strong>'.$category->name.'</strong><br>Producto: <strong>'.$product->name.'</strong><br>Marca vinculada: <strong>'.$brand->name.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }

        $product23=Product::find($this->product_id);
        $this->productBrands ="";
        $this->productBrands = $product23->brands;
        $this->tab="marca";
    }
    public function swapModelo($id)
    {
        $modelo= Modelo::find($id);
        $product=Product::find($this->product_id);
        $category= Category::find($product->category_id);
                
        
        if(isset($product->modelos->where('id', $modelo->id)->first()->id)){
            $product->modelos()->detach($id);
            $this->emit('alert', ['modal' => '','type' => 'success', 'message' => 'Modelo eliminado exitosamente!.']);
            
            
            //Retirar marca de Producto
            blackBox::create([
                'action' => 'Desvincular modelo',
                'type' => 'Productos',
                'details' => 'Categoría: <strong>'.$category->name.'</strong><br>Producto: <strong>'.$product->name.'</strong><br>Modelo desvinculado: <strong>'.$modelo->name.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        else{
            $product->modelos()->attach($id);
            $this->emit('alert', ['modal' => '','type' => 'success', 'message' => 'Modelo registrado exitosamente!.']);
                       
            //Retirar marca de Producto
            blackBox::create([
                'action' => 'Vincular modelo',
                'type' => 'Productos',
                'details' => 'Categoría: <strong>'.$category->name.'</strong><br>Producto: <strong>'.$product->name.'</strong><br>Modelo vinculado: <strong>'.$modelo->name.'</strong>',
                'user' => $this->auth->name,            
            ]);
        }
        $product2=Product::find($this->product_id);
        $this->productModelos="";
        $this->productModelos = $product2->modelos;
        $this->tab="marca";
    }
    public function imgUpload()
    {
        $this->validate([
        'productImage.*' => 'image|max:3072', // 1MB Max
        ]);
        
        foreach($this->productImage as $image)
        {
            $imageName = md5($image . microtime()).'.'.$image->extension();
            $image->storeAs('public/imgUpload', $imageName);
            Image::create([
                'url' => $imageName,
                'imageable_type' => 'App\Product',
                'imageable_id' => $this->product_id,
            ]);
        }    

        $product=Product::find($this->product_id);
        $this->productImageEdit=$product->images;
        reset($this->productImage);
        $this->tab='imagenes';
        
        
        

    }

    public function destroyImg($id){
        $product=Product::find($this->product_id);
        
        $img=Image::find($id);
        if($contents = Storage::get('public/imgUpload/'.$img->url)){
            if($img->url!="sinImg.jpg"){
                Storage::delete('public/imgUpload/'.$img->url);
            }
            Image::destroy($id);
            $this->emit('alert', ['modal' => '','type' => 'success', 'message' => 'Imagen eliminada con exito!.']);    
            
         }
        
        
         $this->productImageEdit=$product->images;
        
        $this->tab='imagenes';
    }
    public function report()
    {  
        return response()->streamDownload(function () {
            $pdf = App::make('dompdf.wrapper');
            $reportData = Product::get(); 
            $hoy = date("d-m-Y");
            $pdf->loadView('reports.productsReport',compact('reportData'));
            echo $pdf->stream();
        }, 'ProductsReport-'.date("d-m-Y").'.pdf');
    }
    public function report2()
    {  
        return response()->streamDownload(function () {
            $pdf = App::make('dompdf.wrapper');
            $reportData = Product::where('views', '>', 0)->orderBy('views', 'desc')->get(); 
            $hoy = date("d-m-Y");
            $pdf->loadView('reports.productsView',compact('reportData'));
            echo $pdf->stream();
        }, 'ProductsViewedReport-'.date("d-m-Y").'.pdf');
    }
    public function report3()
    {  
        return response()->streamDownload(function () {
            $pdf = App::make('dompdf.wrapper');
            $reportData = Product::where('search', '>', 0)->orderBy('search', 'desc')->get(); 
            $hoy = date("d-m-Y");
            $pdf->loadView('reports.productsSearch',compact('reportData'));
            echo $pdf->stream();
        }, 'ProductsSearchedReport-'.date("d-m-Y").'.pdf');
    }
}
