<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

//tablas o modelos a usar
use App\Inventario;
use App\Administration;
use App\client;
use App\invoice;
use App\invoiceDetail;
use App\blackBox;
use App\Pay;

//componentes extras
use Auth;
use App;
use PDF2;
class InvoiceComponent extends Component
{
    //#############################################
    //      Inicializacion de variables
    //#############################################

    public $view = 'client';
    public $view2='facturasGuardadas';
    public $view3='pays';

    //Variables administration
    public $ivaAdministracion,$tasaInventario,$tasaVenta,$tasaVenta2,$claveautorizacion;

    //variable de cliente
    public $client_id, $clientTitle,$cedula,$direccion,$email,$telefono,$nombre;

    //Variables de factura
    public $invoice_id;
    public $invoiceNroControl;
    public $subtotal='0.00';
    public $exento='0.00';
    public $iva='0.00';
    public $total='0.00';
    public $totalDivisa='0';
    public $totalDivisa2='0';
    public $descuentoMonto=0;
    public $descuento;
    public $cxc;


    //variables de detalles
    public $quantityEdit,$descriptionEdit,$detail_id;

    //variables de pagos
    public $pay_id,$refZelle,$refZelle2,$refDebito,$refCredito,$refTransferencia;
    public $divisa=0;
    public $zelle=0;
    public $divisa2=0;
    public $zelle2=0;
    public $bolivares=0;
    public $debito=0;
    public $credito=0;
    public $transferencia=0;

    //variables de calculo
    public $totalFactura,$totalRestante;

    //variables de productos
    public $product_id,$productCode,$productName,$cantidad;
    //variables de control
    public $cargarLista;
    public $cargarListaPresupuestos;
    public $cargarListaTemporales;
    public $tipoDoc,$docTitle,$auth,$tickera,$tickeraAdministracion;
    public $notaEntrega=1;

    //variable de clave supervisor
    public $claveSupervisor;
    //variables test
    public $date1,$date2,$variablecita;



    //#############################################
    public function updatedDivisa(){
        if($this->divisa==null || $this->divisa==''){
            $this->divisa=0;
        }
        $this->calcularPago();
    }
    public function updatedDivisa2(){
        if($this->divisa2==null || $this->divisa2==''){
            $this->divisa2=0;
        }
        $this->calcularPago();
    }

    public function updatedZelle(){
        if($this->zelle==null || $this->zelle==''){
            $this->zelle=0;
        }
        $this->calcularPago();
    }
     public function updatedZelle2(){
        if($this->zelle2==null || $this->zelle2==''){
            $this->zelle2=0;
        }
        $this->calcularPago();
    }
    public function updatedBolivares(){
        if($this->bolivares==null || $this->bolivares==''){
            $this->bolivares=0;
        }
        $this->calcularPago();
    }
    public function updatedDebito(){
        if($this->debito==null || $this->debito==''){
            $this->debito=0;
        }
        $this->calcularPago();
    }
    public function updatedCredito(){
        if($this->credito==null || $this->credito==''){
            $this->credito=0;
        }
        $this->calcularPago();
    }
    public function updatedTransferencia(){
        if($this->transferencia==null || $this->transferencia==''){
            $this->transferencia=0;
        }
        $this->calcularPago();
    }
    public function updatedProductCode()
    {
        if($this->productCode==''){
            $this->resetErrorBag();
            $this->productName=null;
            $this->product_id=null;
        }
    }

    //##################################################
    //Renderizado de componente
    //##################################################
    public function render()
    {
        if($this->auth==""){
            $this->auth = Auth::User();
        }
        //carga de datos administrativos
            $administracion=Administration::find(1);
            $this->ivaAdministracion=$administracion->ivaAdministracion;
            $this->tasaInventario=$administracion->tasaInventario;
            $this->tasaVenta=$administracion->tasaVenta;
            $this->tasaVenta2=$administracion->tasaVenta2;
            $this->claveautorizacion=$administracion->claveautorizacion;
            $this->tickeraAdministracion=$administracion->tickera;

            $invoiceDetails='';
            $saveInvoices=null;
            $presupuestos=null;
            $facturasTemporales=null;
        //carga de detalles de factura

        if($this->invoice_id!=null){
            $invoiceDetails=invoice::find($this->invoice_id);
        };

        //carga lista de facturas guardadas
        if($this->cargarLista!=null){
            $saveInvoices=invoice::where('estado','=',2)->where('tipo','=',1)->get();
        };
        //carga lista de presupuestos guardados
        if($this->cargarListaPresupuestos!=null){
            $presupuestos=invoice::where('estado','=',4)->where('tipo','=',2)->get();
        };
        if($this->cargarListaTemporales!=null){
            $facturasTemporales=invoice::where('fecha','=',now()->format("Y-m-d"))
                ->where('estado','=',0)
                ->where('tipo','=',1)
                ->where('total','>',0)->get();
        };

        $products=Inventario::get(['id','codigo','descripcion','precio','cantidad']);

        return view('livewire.dashboard.invoice-component',compact('products','invoiceDetails','saveInvoices','presupuestos','facturasTemporales'));
    }

    //########################################
    //registrar cliente y consultar de nuevo
    //########################################
    public function registrarCliente(){
        $this->resetErrorBag();

        $this->validate([
            'nombre'=>['required', 'string'],
            'cedula'=>['required','unique:clients'],
            'email' => ['required'],
            'telefono' => ['required','min:10'],
            'direccion'=> 'required'
        ]);

        //Registrar cliente
        $client = client::create([
            'nombre'=>$this->nombre,
            'cedula' => $this->cedula,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,

        ]);
        //Creacion de registro en caja negra
        blackBox::create([
            'action' => 'Venta',
            'type' => 'Registro de cliente',
            'details' => '<strong>Cliente:</strong> '.$client->nombre.'<br> <strong>Cedula:</strong> '.$client->cedula,
            'user' => $this->auth->name,
        ]);

        $this->consultarCliente($client->id);

        $this->emit('alert', ['modal' => '#invoiceModal','type' => 'success', 'message' => 'Cliente registrado con exito!.']);

    }

    //########################################
    //consultar cliente y crear factura checked
    //########################################
    public function consultarCliente($id=null){
        $this->resetErrorBag();
        $this->tickera=$this->tickeraAdministracion;
        $this->validate([
            'cedula' => ['required'],
        ]);
        if($id==null){
            $cliente=client::where("cedula",'=',$this->cedula)->first();
        }
        else{
            $cliente=client::find($id);
        }

        if($cliente!=null){
            $this->clientTitle=$cliente->nombre;
            $this->client_id=$cliente->id;


            //Validamos si el cliente tiene una factura creada pero no facturada
            $validation=invoice::where('client_id','=',$this->client_id)->where('estado','=','0')->first();

            //Validamos si hay resultados
            if($validation==null){

                $invoice=invoice::create([
                    'nroControl'=>0,
                    'client_id' => $this->client_id,
                    'fecha' => now()->format('Y-m-d'),
                    'fechaVencimiento' => now()->addDay(5)->format("Y-m-d"),
                    'subtotal' => 0.00,
                    'exento' => 0.00,
                    'iva' => 0.00,
                    'total' => 0.00,
                    'estado' => 0,
                    'tipo'=> 1,
                    'cxc'=>0,
                    'fechaCxc'=>now()->addDay(5)->format("Y-m-d"),
                    'tasaCambio'=>$this->tasaVenta,
                    'totalDolar'=>0,
                    'descuento'=>0
                ]);

                $this->invoice_id=$invoice->id;
                $this->subtotal='0.00';
                $this->exento='0.00';
                $this->iva='0.00';
                $this->total='0.00';
                $this->totalDivisa=round($invoice->total/$this->tasaVenta,4);


            }
            else{
                //si existe una factura sin procesar para ese cliente se reutiliza el registro
                $invoice=invoice::find($validation->id);
                foreach($invoice->details as $detail){
                    $detail->delete();
                }
                $invoice->update([
                    'nroControl'=>0,
                    'fecha' => now()->format('Y-m-d'),
                    'fechaVencimiento' => now()->addDay(5)->format("Y-m-d"),
                    'subtotal' => 0,
                    'exento' => 0,
                    'iva' => 0,
                    'total' => 0,
                    'fechaCxc'=>now()->addDay(5)->format("Y-m-d"),
                    'tasaCambio'=>$this->tasaVenta,
                    'totalDolar'=>0,
                    'descuento'=>0
                ]);


                $this->invoice_id=$invoice->id;
                $this->subtotal='0.00';
                $this->exento='0.00';
                $this->iva='0.00';
                $this->total='0.00';
                $this->descuento=round($invoice->descuento,2);
                $this->totalDivisa=round($invoice->total/$this->tasaVenta,4);

            }

            $this->emit('changeFocus', ['input' => '#codigoFocus']);

        }
        else{
            $this->client_id="";
            $this->clientTitle="Registre el cliente";
            $this->view='client';
            $this->emit('showModal', ['modal' => '#invoiceModal']);

        }


    }

    //###############################################
    //consultar producto y cambiar al campo cantidad
    //###############################################
    public function consultarProducto(){
        $this->resetErrorBag();
        $this->validate([
            'productCode' => ['required'],
        ]);
        usleep(300);
        $product=Inventario::where('codigo','=',$this->productCode)->first();

        /*$this->emit('alert', ['modal' => '','type' => 'success', 'message' => 'consulta exito!.']);*/

        if($product!=null){
            $this->product_id=$product->id;
            $this->productName=$product->descripcion;
            $this->emit('changeFocus', ['input' => '#cantidadFocus']);
        }
        else{
            $this->product_id=null;
            $this->productName='El producto no existe';
        }
    }

    //##############################################
    //Actualizar monto de factura
    //##############################################
    public function actualizarMontos(){

        $this->totalDivisa=0;
        $this->totalDivisa2=0;
        $invoice=invoice::find($this->invoice_id);

        if($invoice->descuento==0 || $invoice->descuento==null){
            $porcentajeDescuento=0;
        }
        else{
            $porcentajeDescuento=$invoice->descuento/100;
        }

        $subtotal=0;
        $exento=0;
        $iva=0;
        $total=0;

        foreach($invoice->details as $detail){

            $productoTasa= Inventario::where('codigo','=',$detail->codigo)->first();

            $tasa=$productoTasa->actualizar;

            $subtotal=$subtotal+$detail->total;
            if($detail->iva==0){
                $porcentaje=$this->ivaAdministracion/100;
                $resultado=$detail->total*$porcentaje;
                $iva=$iva+$resultado;
            }
            else{
                $resultado=0;
                $exento=$exento+$detail->total;
            }

            $sumatoriaDetalle=$detail->total+round($resultado,2);
            $total=$total+$sumatoriaDetalle;
            $divisa=0;
            if($tasa==1){
                $divisa=$sumatoriaDetalle/$this->tasaVenta;
            }
            else if($tasa==2){
                $divisa=$sumatoriaDetalle/$this->tasaVenta2;
            }
            else if($tasa==0){
                $divisa=$sumatoriaDetalle/$this->tasaVenta;
            }

            $this->totalDivisa2=round($this->totalDivisa2+$divisa,4);

        }

        $this->subtotal=round($subtotal,2);
        $this->exento=round($exento,2);
        $this->iva=round($iva,2);
        $this->descuentoMonto=round($total*$porcentajeDescuento,2);
        $this->total=round($total-$this->descuentoMonto,2);
        $descuentoDolar=round($this->totalDivisa2*$porcentajeDescuento,4);
        $this->totalDivisa=round($this->totalDivisa2-$descuentoDolar,4);


        $invoice->update([
            'subtotal'=>round($subtotal,2),
            'exento'=>round($exento,2),
            'iva'=>round($iva,2),
            'total'=>round($total-$this->descuentoMonto,2),
            'totalDolar'=>round($this->totalDivisa,2)
        ]);


    }

    //##############################################
    //Registrar detalle de factura
    //##############################################
    public function registrarDetalle(){
        $this->resetErrorBag();
        $this->validate([
            'cantidad' => ['required'],
        ]);
        $product=Inventario::find($this->product_id);
        $total=$this->cantidad*$product->precio;

        $validation=invoiceDetail::where('invoice_id','=',$this->invoice_id)->where('codigo','=',$this->productCode)->first();

        if($validation==null){
            $product=Inventario::find($this->product_id);
            if($product->precio>=0.01){
                $detail=invoiceDetail::create([
                    "invoice_id"=>$this->invoice_id,
                    "codigo"=>$product->codigo,
                    "descripcion"=>$this->productName,
                    "cantidad"=>$this->cantidad,
                    "precio"=>$product->precio,
                    "iva"=>$product->iva,
                    "total"=>$total,
                ]);
                $this->productName=null;
                $this->productCode=null;
                $this->cantidad=null;
                $this->product_id=null;
                $this->actualizarMontos();
                $this->emit('changeFocus', ['input' => '#codigoFocus']);
                $this->emit('alert', ['modal' => '','type' => 'success', 'message' => 'Producto agregado con exito!.']);
            }
            else{
                $this->productName=null;
                $this->productCode=null;
                $this->cantidad=null;
                $this->product_id=null;
                $this->emit('changeFocus', ['input' => '#codigoFocus']);
                $this->emit('alert', ['modal' => '','type' => 'warning', 'message' => 'El producto no esta habilitado para la venta!.']);
            }
        }
        else{
            $this->productName=null;
            $this->productCode=null;
            $this->cantidad=null;
            $this->product_id=null;
            $this->emit('changeFocus', ['input' => '#codigoFocus']);
            $this->emit('alert', ['modal' => '','type' => 'warning', 'message' => 'El producto ya está registrado!.']);
        }

    }

    //##################################################
    //Consultar detalle de factura para editar cantidad
    //##################################################
    public function detailEdit($id){
        $detail=invoiceDetail::find($id);
        $this->detail_id=$detail->id;
        $this->quantityEdit=$detail->cantidad;
        $this->descriptionEdit=$detail->descripcion;
        $this->view='productEdit';

        $this->emit('showModal', ['modal' => '#productEditModal']);

    }

    //##################################################
    //Modificar detalle y asignar nueva cantidad y total
    //##################################################
    public function detailUpdate(){
        $this->resetErrorBag();
        $this->validate([
            'quantityEdit' =>['required','min:1'],
        ]);

        $detail=invoiceDetail::find($this->detail_id);
        $total=$this->quantityEdit*$detail->precio;
        $detail->update([
            'cantidad'=>$this->quantityEdit,
            'total'=>round($total,2),

        ]);
        $this->actualizarMontos();
        $this->emit('alert', ['modal' => '#productEditModal','type' => 'info', 'message' => 'Detalle modificado con exito!.']);

    }

    //##################################################
    //Eliminar detalle de factura
    //##################################################
    public function eliminarDetalle($id){
        $detail=invoiceDetail::find($id);
        $detail->delete();
        $this->actualizarMontos();
        $this->emit('alert', ['modal' => '','type' => 'warning', 'message' => 'Producto eliminado con exito!.']);
    }

    public function descuento(){
        $this->emit('showModal', ['modal' => '#descuentoModal']);
    }
    //##################################################
    //Aplicar descuento y actualizar montos
    //##################################################
    public function aplicarDescuento(){
        $this->resetErrorBag();
        $this->validate([
            'claveSupervisor' => ['required'],
        ]);
        if($this->claveautorizacion==$this->claveSupervisor){
            $invoice=invoice::find($this->invoice_id);
            if($this->descuento=='' || $this->descuento==null){
                $this->descuento=0;
            }

            $invoice->update([
                'descuento'=>$this->descuento,
            ]);

            $this->actualizarMontos();
            $this->emit('alert', ['modal' => '#descuentoModal','type' => 'success', 'message' => '
            Descuento aplicado exitosamente!.']);
        }
        else{
            //Se emite mensaje de error
            $this->emit('alert', ['modal' => '','type' => 'error', 'message' => 'Error de validación proceso detenido!.']);
        }
    }

    //##################################################
    //Guardar factura del cliente
    //##################################################
    public function guardarFactura(){
        $validation=invoice::where('client_id','=',$this->client_id)->where('estado','=',2)->first();
        if($validation==null){
            $invoice=invoice::find($this->invoice_id);
            $invoice->update([
                'estado'=>2
            ]);
            $this->default();
            $this->emit('alert', ['modal' => '','type' => 'warning', 'message' => 'Factura guardada con exito!.']);
        }
        else{
            $this->emit('alert', ['modal' => '','type' => 'warning', 'message' => 'El cliente ya posee una factura guardada!.']);
        }
    }

    //##################################################
    //Listar facturas guardadas
    //##################################################
    public function listaFacturaGuardadas(){
        $this->view2='facturasGuardadas';
        usleep(250);
        $this->cargarLista=1;

        $this->emit('showModal', ['modal' => '#utilityModal']);
    }

    //##################################################
    //Cargar factura guardada
    //##################################################
    public function cargarFactura($id){
        $this->invoice_id=$id;
        $invoice=invoice::find($this->invoice_id);

        $this->cargarLista=null;
        $this->cedula=$invoice->client->cedula;
        $this->client_id=$invoice->client_id;
        $this->clientTitle=$invoice->client->nombre;

        $invoice->update([
            'fecha' => now()->format('Y-m-d'),
            'fechaVencimiento' => now()->addDay(5)->format("Y-m-d"),
            'estado'=>0,
            'fechaCxc'=>now()->addDay(5)->format("Y-m-d"),
            'tasaCambio'=>$this->tasaVenta,

            'descuento'=>0
        ]);

        $this->actualizarMontos();
        $this->emit('changeFocus', ['input' => '#codigoFocus']);
        $this->emit('alert', ['modal' => '#utilityModal','type' => 'success', 'message' => 'Factura cargada con exito!.']);
    }

    //##################################################
    //Lista de presupuestos
    //##################################################
    public function listaPresupuestosGuardados(){
        $this->view2='presupuestosGuardados';
        usleep(250);
        $this->cargarListaPresupuestos=1;

        $this->emit('showModal', ['modal' => '#utilityModal']);
    }

    //##################################################
    //Cargar presupuesto
    //##################################################
    public function cargarPresupuesto($id){
        $this->invoice_id=$id;
        $invoice=invoice::find($this->invoice_id);

        $this->cargarLista=null;
        $this->cedula=$invoice->client->cedula;
        $this->client_id=$invoice->client_id;
        $this->clientTitle=$invoice->client->nombre;

        $invoice->update([
            'fecha' => now()->format('Y-m-d'),
            'fechaVencimiento' => now()->addDay(5)->format("Y-m-d"),
            'estado'=>0,
            'fechaCxc'=>now()->addDay(5)->format("Y-m-d"),
            'tasaCambio'=>$this->tasaVenta,

            'descuento'=>0,
            'tipo'=>1
        ]);

        $this->actualizarMontos();
        $this->emit('changeFocus', ['input' => '#codigoFocus']);
        $this->emit('alert', ['modal' => '#utilityModal','type' => 'success', 'message' => 'Presupuesto cargada con exito!.']);
    }

    //##################################################
    //Eliminar presupuesto
    //##################################################
    public function eliminarPresupuesto($id){

        $invoice=invoice::find($id);

        $invoice->delete();

        $this->emit('alert', ['modal' => '#utilityModal','type' => 'success', 'message' => 'Presupuesto eliminado con exito!.']);
    }
    //##################################################
    //Lista de  Factura Temporal
    //##################################################
    public function listaFacturasTemporales(){
        $this->view2='facturasTemporales';
        usleep(250);
        $this->cargarListaTemporales=1;

        $this->emit('showModal', ['modal' => '#utilityModal']);
    }

    //##################################################
    //Cargar Factura Temporal
    //##################################################
    public function cargarFacturaTemporal($id){
        $this->invoice_id=$id;
        $invoice=invoice::find($this->invoice_id);

        $this->cargarLista=null;
        $this->cedula=$invoice->client->cedula;
        $this->client_id=$invoice->client_id;
        $this->clientTitle=$invoice->client->nombre;

        $invoice->update([
            'fecha' => now()->format('Y-m-d'),
            'fechaVencimiento' => now()->addDay(5)->format("Y-m-d"),
            'estado'=>0,
            'fechaCxc'=>now()->addDay(5)->format("Y-m-d"),
            'tasaCambio'=>$this->tasaVenta,
            'descuento'=>0,
            'tipo'=>1
        ]);

        $this->actualizarMontos();
        $this->emit('changeFocus', ['input' => '#codigoFocus']);
        $this->emit('alert', ['modal' => '#utilityModal','type' => 'success', 'message' => 'Factura cargada con exito!.']);
    }

    //##################################################
    //guardar Pagos
    //##################################################
    public function procesarDocumento(){
        $this->totalFactura=$this->total;
        $this->totalRestante=$this->total;
        $this->view="pays";
        $this->calcularPago();
        $this->emit('showModal', ['modal' => '#paysModal']);
    }

    //##################################################
    //Calculo de pagos registrados y restante de factura
    //##################################################
    public function calcularPago(){
        $totalBs=$this->debito+$this->bolivares+$this->credito+$this->transferencia;

        $totalDolar=$this->divisa+$this->zelle;
        $dolarBolivares=$totalDolar*$this->tasaVenta;
        $totalDolar2=$this->divisa2+$this->zelle2;
        $dolarBolivares2=$totalDolar2*$this->tasaVenta2;
        $totalGeneral=$totalBs+$dolarBolivares+$dolarBolivares2;
        $this->totalRestante=$this->total-$totalGeneral;
    }

    //##################################################
    //Mostrar el modal de descarte de confirmacion
    //##################################################
    public function descarte(){

        $this->emit('showModal', ['modal' => '#descarteModal']);
    }

    //##################################################
    //Procesar el descarte con la observacion y
    //peticion de clave supervisor
    //##################################################
    public function procesarDescarte(){
        $this->resetErrorBag();
        $this->validate([
            'claveSupervisor' => ['required'],
        ]);
        if($this->claveautorizacion==$this->claveSupervisor){
            $invoice=invoice::find($this->invoice_id);
            foreach($invoice->details as $detail){
                $product=Inventario::where('codigo','=',$detail->codigo)->first();
                $stock=$product->cantidad-$detail->cantidad;
                $product->update([
                    'cantidad' => $stock,
                ]);

                //Creacion de registro en caja negra
                blackBox::create([
                    'action' => 'Descarte',
                    'type' => 'Descarte de producto',
                    'details' => '<strong>Producto:</strong> '.$detail->descripcion.'<br> <strong>Cantidad:</strong> '.$detail->cantidad,
                    'user' => $this->auth->name,
                ]);
            };

            //se descartan los productos
            $this->emit('alert', ['modal' => '#descarteModal','type' => 'success', 'message' => 'Descarte procesado exitosamente!.']);
            $this->default();
        }
        else{
            //Se emite mensaje de error
            $this->emit('alert', ['modal' => '','type' => 'error', 'message' => 'Error de validación proceso detenido!.']);
        }
    }
    //##################################################
    //Reestablecer todo
    //##################################################
    public function default(){

        $this->view = 'client';


        //variable de cliente
        $this->client_id=null;
        $this->clientTitle=null;
        $this->cedula=null;
        $this->direccion=null;
        $this->email=null;
        $this->telefono=null;
        $this->nombre=null;

        //Variables de factura
        $this->invoice_id=null;
        $this->subtotal='0.00';
        $this->exento='0.00';
        $this->iva='0.00';
        $this->total='0.00';
        $this->totalDivisa='0';
        $this->descuentoMonto=0;

        //variables de pagos
        $this->pay_id=null;
        $this->divisa=0;
        $this->divisa2=0;
        $this->bolivares=0;
        $this->zelle=0;
        $this->refZelle=null;
        $this->debito=0;
        $this->refDebito=null;
        $this->credito=0;
        $this->refCredito=null;
        $this->transferencia=0;
        $this->refTransferencia=null;
        //variables de detalles
        $this->quantityEdit=null;
        $this->descriptionEdit=null;
        $this->detail_id=null;

        //variables de productos
        $this->product_id=null;
        $this->productCode=null;
        $this->productName=null;
        $this->cantidad=null;
        $this->descuento=null;

        $this->notaEntrega=1;
        $this->tickera=$this->tickeraAdministracion;
        $this->emit('changeFocus', ['input' => '#cedulaFocus']);

    }

    //##################################################
    //Emitir presupuesto / factura / nota entrega
    //##################################################
    public function emitirDocumento($tipoDocumento)
    {

        switch($tipoDocumento){
            case 1:
                //factura
                $invoiceLast=invoice::where('tipo','=',1)->where('estado','=',1)->orderBy('nroControl','DESC')->first();
                if($invoiceLast==null){
                    $nroControl=1;
                }
                else{
                    $nroControl=$invoiceLast->nroControl+1;
                }

                if($this->totalRestante>=0.01){
                    $cxc=1;
                }
                else{
                    $cxc=0;
                }
                //cambiar estado y tipo de documento
                $invoice2=invoice::find($this->invoice_id);
                $pago=Pay::create([
                    'invoice_id'=>$invoice2->id,
                    'divisa'=>$this->divisa+$this->divisa2,
                    'zelle'=>$this->zelle+$this->zelle2,
                    'refZelle'=>$this->refZelle.'/'.$this->refZelle2,
                    'Bolivares'=>$this->bolivares,
                    'Debito'=>$this->debito,
                    'refDebito'=>$this->refDebito,
                    'Credito'=>$this->credito,
                    'refCredito'=>$this->refCredito,
                    'Transferencia'=>$this->transferencia,
                    'refTransferencia'=>$this->refTransferencia
                ]);

                $totalAbonado=$this->total-$this->totalRestante;

                $invoice2->update([
                    'nroControl'=>$nroControl,
                    'estado'=>1,
                    'tipo'=>1,
                    'cxc'=>$cxc,
                    'abonado'=>$totalAbonado,
                    'user_id'=>$this->auth->id


                ]);


                foreach($invoice2->details as $detail){
                    //consulta de producto y deduccion de inventario
                        $producto=Inventario::where('codigo','=',$detail->codigo)->first();

                        $stock=$producto->cantidad-$detail->cantidad;

                        $producto->update([
                            'cantidad'=>$stock
                        ]);

                    //Creacion de registro en caja negra
                        blackBox::create([
                            'action' => 'Venta',
                            'type' => 'Venta de producto',
                            'details' => '<strong>Producto:</strong> '.$detail->descripcion.'<br> <strong>Cantidad:</strong> '.$detail->cantidad.'<br> <strong>Precio:</strong> '.$detail->precio.'<br> <strong>Total:</strong> '.$detail->total,
                            'user' => $this->auth->name,
                        ]);
                }
                $this->emit('alert', ['modal' => '#paysModal','type' => 'success', 'message' => 'Factura generada con exito!.']);
            break;
            case 2:
                //presupuesto
                $invoiceLast=invoice::where('tipo','=',2)->where('estado','=',4)->orderBy('nroControl','DESC')->first();
                if($invoiceLast==null){
                    $nroControl=1;
                }
                else{
                    $nroControl=$invoiceLast->nroControl+1;
                }
                $invoice2=invoice::find($this->invoice_id);
                $invoice2->update([
                    'nroControl'=>$nroControl,
                    'estado'=>4,
                    'tipo'=>2,
                    'user_id'=>$this->auth->id

                ]);

                $this->emit('alert', ['modal' => '#utilityModal','type' => 'success', 'message' => 'Presupuesto emitido con exito!.']);

            break;
            case 3:
                //Nota de Entrega
                $invoiceLast=invoice::where('tipo','=',3)->where('estado','=',1)->orderBy('nroControl','DESC')->first();
                if($invoiceLast==null){
                    $nroControl=1;
                }
                else{
                    $nroControl=$invoiceLast->nroControl+1;
                }
                $invoice2=invoice::find($this->invoice_id);
                $invoice2->update([
                    'nroControl'=>$nroControl,
                    'estado'=>1,
                    'tipo'=>3,
                    'user_id'=>$this->auth->id

                ]);

                foreach($invoice2->details as $detail){
                     //consulta de producto y deduccion de inventario
                        $producto=Inventario::where('codigo','=',$detail->codigo)->first();

                        $stock=$producto->cantidad-$detail->cantidad;

                        $producto->update([
                            'cantidad'=>$stock
                        ]);
                    //Creacion de venta
                        blackBox::create([
                            'action' => 'Nota de Entrega',
                            'type' => 'Salida de producto',
                            'details' => '<strong>Producto:</strong> '.$detail->descripcion.'<br> <strong>Cantidad:</strong> '.$detail->cantidad.'<br> <strong>Precio:</strong> '.$detail->precio.'<br> <strong>Total:</strong> '.$detail->total,
                            'user' => $this->auth->name,
                        ]);
                }
                $this->emit('alert', ['modal' => '#paysModal','type' => 'success', 'message' => 'Nota de entrega generada con exito!.']);
            break;
        }

        $id=base64_encode($this->invoice_id);
        $tipoDoc=base64_encode($tipoDocumento);

        if($this->tickera==0){
            $url=url(route('comprobante-invoice',['id'=>$id,'tipoDoc'=>$tipoDoc]));
        }
        else{
            $url='http://127.0.0.1/tickera/index.php?token='.$id.'&tipoDoc='.$tipoDoc;
        }

        $this->emit('testing', ['url' => $url]);

        $this->default();


    }

}
