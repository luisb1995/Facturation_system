<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

use App\invoice;
use App\invoiceDetail;
use App\Inventario;
use App\client;
use App\Pay;
use App\User;

use Auth;
use App;
use PDF2;

class ReportComponent extends Component
{   
    public $fechaIni,$fechaFin;
    public $fechaIni2,$fechaFin2,$cedula;
    public $cajero;

    public $auth;

    public function updatedFechaIni2(){
        if($this->fechaIni2>$this->fechaFin2){
            $this->fechaIni2=$this->fechaFin2;
        }
        
        
    }
    public function updatedFechaFin2(){
        if($this->fechaFin2<$this->fechaIni2){
            $this->fechaFin2=$this->fechaIni2;
        }
    }
    public function updatedFechaIni(){
        if($this->fechaIni>$this->fechaFin){
            $this->fechaIni=$this->fechaFin;
        }
        
        
    }
    public function updatedFechaFin(){
        if($this->fechaFin<$this->fechaIni){
            $this->fechaFin=$this->fechaIni;
        }
    }

    //##################################################
    //Renderizado de componentes
    //##################################################
    public function render()
    {
        if($this->auth==""){
            $this->auth = Auth::User();
            $this->fechaIni=date('Y-m-d');
            $this->fechaFin=date('Y-m-d');
            $this->fechaIni2=date('Y-m-d');
            $this->fechaFin2=date('Y-m-d');
        }
        $users=User::get();
        return view('livewire.dashboard.report-component',compact('users'));
    }

    //##################################################
    //Reporte de ventas
    //##################################################
    public function reporteVentas(){
        $this->resetErrorBag();
        $this->validate([
            'fechaIni'=>'required',
            'fechaFin'=>'required'
        ]);

        return response()->streamDownload(function () {

            $totalDivisa=0;
            $totalZelle=0;
            $totalBs=0;
            $totalDebito=0;
            $totalCredito=0;
            $totalTransferencia=0;

            $devoluciones=invoice::where('estado','=',3)
            ->where('tipo','=',1)
            ->caja($this->cajero)
            ->whereBetween('fecha',[$this->fechaIni,$this->fechaFin])
            ->get();

            $invoices=invoice::where('estado','=',1)
            ->where('tipo','=',1)
            ->caja($this->cajero)
            ->whereBetween('fecha',[$this->fechaIni,$this->fechaFin])
            ->orderBy('nroControl','DESC')->get();

            foreach($invoices as $invoice){
                $totalDivisa=$totalDivisa+$invoice->pay->divisa;
                $totalZelle=$totalZelle+$invoice->pay->zelle;
                $totalBs=$totalBs+$invoice->pay->Bolivares;
                $totalDebito=$totalDebito+$invoice->pay->Debito;
                $totalCredito=$totalCredito+$invoice->pay->Credito;
                $totalTransferencia=$totalTransferencia+$invoice->pay->Transferencia;
            }

            //$abonos=Abono::whereBetween('fecha',[$this->fechaIni,$this->fechaFin])->get();
            $productosInventario=Inventario::get();
            $vendidos='';
            foreach($productosInventario as $key => $producto){
                                
                                $totalCantidad=invoiceDetail::where('codigo','=',$producto->codigo)->whereBetween('created_at',[$this->fechaIni." 00:00:00",$this->fechaFin." 23:59:59"])->sum('cantidad');
                                $totalMonto=invoiceDetail::where('codigo','=',$producto->codigo)->whereBetween('created_at',[$this->fechaIni." 00:00:00",$this->fechaFin." 23:59:59"])->sum('total');
                                if($totalCantidad>0){
                                 $vendidos = $vendidos.'
                                
                                <tr>
                <td style="text-align:center;font-size:14px;">'.$producto->codigo.'</td>
                <td style="text-align:center;font-size:14px;">'.$producto->descripcion.'</td>
                <td style="text-align:center;font-size:14px;">'.number_format($totalCantidad,2,',','.').'</td>
                
                
            </tr>';}
                                
                }

            $data = [
                'reportData' => $invoices,
                
                'devoluciones' =>$devoluciones,
                'totalDivisa'=>$totalDivisa,
                'totalZelle'=>$totalZelle,
                'totalBs'=>$totalBs,
                'totalDebito'=>$totalDebito,
                'totalCredito'=>$totalCredito,
                'totalTransferencia'=>$totalTransferencia,
                'vendidos'=>$vendidos
            ];

            $pdf = PDF2::loadView('pdf.salesReport', $data,[], [
                'title'      => 'Sales Report',
                ]);

            $pdf->stream();

        }, 'salesReport-'.date("d-m-Y").'.pdf');
       
    }

    //##################################################
    //Reporte de ventas por cliente
    //##################################################
    public function clientReporteVentas(){
        $this->resetErrorBag();
        $this->validate([
            'cedula'=>'required',
            'fechaIni2'=>'required',
            'fechaFin2'=>'required'
        ]);
        return response()->streamDownload(function () {
            $totalDivisa=0;
            $totalZelle=0;
            $totalBs=0;
            $totalDebito=0;
            $totalCredito=0;
            $totalTransferencia=0;
            
            $cliente=client::where('cedula','=',$this->cedula)->first();
            $idCliente=$cliente->id;
            $this->cedula=null;
            $invoices=invoice::where('estado','=',1)
            ->where('tipo','=',1)
            ->where('client_id','=',$idCliente)
            ->whereBetween('fecha',[$this->fechaIni2,$this->fechaFin2])
            ->orderBy('nroControl','DESC')->get();

            foreach($invoices as $invoice){
                $totalDivisa=$totalDivisa+$invoice->pay->divisa;
                $totalZelle=$totalZelle+$invoice->pay->zelle;
                $totalBs=$totalBs+$invoice->pay->Bolivares;
                $totalDebito=$totalDebito+$invoice->pay->Debito;
                $totalCredito=$totalCredito+$invoice->pay->Credito;
                $totalTransferencia=$totalTransferencia+$invoice->pay->Transferencia;
                
                
            }
            
            
            $data = [
                'reportData' => $invoices,
                'totalDivisa'=>$totalDivisa,
                'totalZelle'=>$totalZelle,
                'totalBs'=>$totalBs,
                'totalDebito'=>$totalDebito,
                'totalCredito'=>$totalCredito,
                'totalTransferencia'=>$totalTransferencia,
                ];
            $pdf = PDF2::loadView('pdf.clientSalesReport', $data,[], [
                'title'      => 'Client Sales Report',
                ]);
            $pdf->stream();
        }, 'ClientSalesReport-'.date("d-m-Y").'.pdf');
       
    }
    

    //##################################################
    //Reporte de cuentas por cobrar
    //##################################################
    public function reporteCxc(){
        return response()->streamDownload(function () {
            $invoices=invoice::where('cxc','=',1)
            ->where('estado','=',1)            
            ->get();
            $data = [
                'reportData' => $invoices
                ];
            $pdf = PDF2::loadView('pdf.cxcReport', $data,[], [
                'title'      => 'CXC Report',
                ]);
            $pdf->stream();
        }, 'CxcReport-'.date("d-m-Y").'.pdf');
       
    }

    //##################################################
    //Reporte de cuentas por pagar
    //##################################################
    public function reporteCxp(){
        return response()->streamDownload(function () {
            $invoices=Purchase::where('cxp','=',1)
            ->where('estado','=',1)
            ->get();
            $data = [
                'reportData' => $invoices
                ];
            $pdf = PDF2::loadView('pdf.cxpReport', $data,[], [
                'title'      => 'CXP Report',
                ]);
            $pdf->stream();
        }, 'CxpReport-'.date("d-m-Y").'.pdf');
       
    }

    //##################################################
    //Reporte de inventario
    //##################################################
    public function reporteInventario(){
        return response()->streamDownload(function () {
            $inventario=Inventario::get();
            $data = [
                'reportData' => $inventario
                ];
            $pdf = PDF2::loadView('pdf.inventoryReport', $data,[], [
                'title'      => 'Inventory Report',
                ]);
            $pdf->stream();
        }, 'InventoryReport-'.date("d-m-Y").'.pdf');
    }

}
