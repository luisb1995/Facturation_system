<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF2;
use App\invoice;
use App\Purchase;
use App\Administration;

class reportController extends Controller
{
    /**
     * Imprimir comprobantes
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id=base64_decode($request->id);
        $tipoDoc=base64_decode($request->tipoDoc);
        
        /*return 'id= '.$id.'<br> tipoDoc='.$tipoDoc;*/

        switch($tipoDoc){
            case 1:
                $documento="Factura";
                $factura=invoice::find($id);
                
            break;
            case 2:
                $documento="Presupuesto";
                $factura=invoice::find($id);
                
                
            break;
            case 3:
                $documento="NotaEntrega";
                $factura=invoice::find($id);
                
            break;
            case 4:
                $factura=Purchase::find($id);
                $documento="Factura de Compra-".$factura->proveedor->nombre;
                
            break;
        }
        
        $info=Administration::find(1);
        
        $data = [
            'invoice' => $factura,
            'tipoDocumento'=>$tipoDoc,
            'info'=>$info,
          ];
          $pdf = PDF2::loadView('pdf.comprobante', $data,[], [
            'title'      => ''.$documento.'-'.$factura->nroControl.'']);
          return $pdf->stream($documento.'-'.$factura->nroControl.'.pdf');
    }

    
}
