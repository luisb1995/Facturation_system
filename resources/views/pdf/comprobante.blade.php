

<body>
    <style>
        @page {
           
            margin-top: 60px; margin-bottom: 60px;
        }
        body{font-family:serif;}
        #header { position:fixed;left: 0px; top: -90px; right: 0px; height: 250px; text-align: left; }
        #footer { position:fixed;left: 0px; bottom: -60px; right: 0px; height: 150px; }
        .table{
            width:100%;
            margin-bottom: 1rem;
            border-collapse: collapse;
            border-spacing: 2px;
            border-color: grey;
            border-left: 0.01em solid #ccc;
            border-right:0.01em solid #ccc;
            border-top: 0.01em solid #ccc;
            border-bottom: 0.01em solid #ccc;
            
        }
        table td,
        table th {
            
            border-left: 0.01em solid #ccc;
            border-right:0.01em solid #ccc;
            border-top: 0.01em solid #ccc;
            border-bottom: 0.01em solid #ccc;
        }
                
        .table tr:nth-child(2n+1)  {
            background-color: #DFE6F0;  
            
        }
        
        
    </style>
    
    <table style="width: 100%;border-collapse: collapse;border-bottom:none;">
        @if($tipoDocumento==1)
            <tr style="border:none;">
                <td style="text-align:left;border-bottom:none;border:none;"></td>
                <td style="text-align:right;font-weight:bold;color:red;text-align:right;font-size:14px;border:none;" rowspan="4"></td>
            </tr>
            <tr style="border-bottom:none;border-top:none;border:none;">
                <td style="border-bottom:none;border-top:none;border:none;"></td>
            </tr>
            <tr style="border-bottom:none;border-top:none;border:none;">
                <td style="border-bottom:none;border-top:none;border:none;"></td>
            </tr>
            <tr style="border-top:none;border:none;">
                <td style="border-top:none;border:none;"><br><br><br><br><br><br><br><br><br><br><br></td>
                
            </tr>
        @elseif($tipoDocumento!=4)
            <tr style="border-bottom:none;">
            <td style="text-align:left;border-bottom:none;"><strong>{{ $info->empresa }}</strong></td>
            <td style="text-align:right;font-weight:bold;color:red;text-align:right;font-size:14px;" rowspan="4">Nro Control: {{ str_pad($invoice->nroControl, 10, "0", STR_PAD_LEFT) }}</td>
            </tr>
            <tr style="border-bottom:none;border-top:none;">
                <td style="border-bottom:none;border-top:none;"><strong>RIF:</strong> {{ $info->rif }}</td>
            </tr>
            <tr style="border-bottom:none;border-top:none;">
                <td style="border-bottom:none;border-top:none;"><strong>Direccion:</strong> {{ $info->direccion }}</td>
            </tr>
            <tr style="border-top:none;">
                <td style="border-top:none;"><strong>Telefono:</strong> {{ $info->telefono }}</td>
                
            </tr>
        @else
        <tr style="border-bottom:none;">
            <td style="text-align:left;border-bottom:none;"><strong>{{ $invoice->proveedor->nombre }}</strong></td>
            <td style="text-align:right;font-weight:bold;color:red;text-align:right;font-size:14px;" rowspan="4">Nro Control: {{ str_pad($invoice->nroControl, 10, "0", STR_PAD_LEFT) }}<br>Nro Factura: {{ str_pad($invoice->nroFactura, 10, "0", STR_PAD_LEFT) }}</td>
        </tr>
        <tr style="border-bottom:none;border-top:none;">
            <td style="border-bottom:none;border-top:none;"><strong>RIF:</strong> {{ $invoice->proveedor->cedula }}</td>
        </tr>
        <tr style="border-bottom:none;border-top:none;">
            <td style="border-bottom:none;border-top:none;"><strong>Direccion:</strong> {{ $invoice->proveedor->direccion }}</td>
        </tr>
        <tr style="border-top:none;">
            <td style="border-top:none;"><strong>Telefono:</strong> {{ $invoice->proveedor->telefono }}</td>
            
        </tr>
        @endif
        
    </table>
    @if($tipoDocumento==1)
        <table style="border:none;width:100%;">
            <tr style="border:none;">
                <td style="text-align:right;font-size:20px;font-weight:bold;border:none;">
                    <strong> Nro. Factura: {{ str_pad($invoice->nroControl, 10, "0", STR_PAD_LEFT) }}</strong>
                </td>

            </tr>

        </table>
    @endif
    <table style="border:none;width:100%;">
        @if($tipoDocumento!=4)
        <tr style="border:none;width:50%;">
            <td style="border:none;"><strong> Cliente:</strong> @if($invoice->client)
                        {{ $invoice->client->nombre}}
                    @else
                        N/A
                    @endif</td>
            <td rowspan="3" style="border:none;text-align:right;"> <strong>Fecha:</strong> {{ $invoice->fecha }}</td>
        </tr>
        <tr style="border:none;width:50%;">
            <td style="border:none;"><strong>C.I/R.I.F:</strong> @if($invoice->client)
                        {{ $invoice->client->cedula}}
                    @else
                        N/A
                    @endif</td>
        </tr>
        @else
        <tr style="border:none;width:50%;">
            <td style="border:none;"><strong> Cliente:</strong> {{ $info->empresa }}</td>
            <td rowspan="3" style="border:none;text-align:right;"> <strong>Fecha:</strong> {{ $invoice->fecha }}</td>
        </tr>
        <tr style="border:none;width:50%;">
            <td style="border:none;"><strong>C.I/R.I.F:</strong> {{ $info->rif }}</td>
        </tr>
        @endif
        <tr style="border:none;">
            @switch($tipoDocumento)
                @case(1)
                <td colspan="2" style="text-align:center;font-size:20px;font-weight:bold;border:none;">Factura<br></td>
                

                    @break
                    @case(2)
                    <td colspan="2" style="text-align:center;font-size:20px;font-weight:bold;border:none;">Presupuesto</td>
                    @break
                    @case(3)
                    <td colspan="2" style="text-align:center;font-size:20px;font-weight:bold;border:none;">Nota de Entrega</td>        
                    @break
                    @case(4)
                    <td colspan="2" style="text-align:center;font-size:20px;font-weight:bold;border:none;">Factura de Compra</td>        
                    @break
                @default
                    
            @endswitch
            
            
        </tr>
    </table>
    <div style="height:500px;">
        <table class="table table-striped">
            <thead  class="thead-dark">
                <tr  style="color: white;
                background-color: #002E6B;
                border-color: #002E6B;">
                        
                        <th style="color: white;font-family:serif;">
                            <strong> Codigo</strong>
                            
                        </th>
                        <th style="color: white;">
                            <strong> Descripcion</strong>
                            
                        </th>
                        <th style="color: white;">
                            <strong>Precio</strong>
                            
                        </th>
                        <th style="color: white;">
                            <strong>Cantidad</strong>
                        </th>
                        <th style="color: white;">
                            <strong>Total</strong>
                        </th>
                        
                        
                </tr>
            </thead>
            <tbody class="text-center" style="height:500px;">
                
            
                @foreach ($invoice->details as $detail)
                    <tr style="border-color:black;">
                        <td>{{ $detail->codigo }}</td>
                        <td>{{ $detail->descripcion }} @if($detail->iva==1)(E)@endif</td>
                        <td>Bs. {{ round($detail->precio,2) }}</td>
                        <td style="text-align:center;">{{ round($detail->cantidad,3) }}</td>
                        <td>Bs. {{ round($detail->total,2) }}</td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    <table style="width:100%" class="table">@switch($tipoDocumento)
        @case(1)
        {{ $descuento=$invoice->descuento/100 }}
        {{ $totalDescuento=($invoice->subtotal+$invoice->iva)*$descuento }}
                <tr>
                    <td  style="text-align:right;width:70%;"><strong>Sub-total</strong></td>
                    <td style="width:30%;text-align:right;">Bs. {{ round($invoice->subtotal,2) }}</td>
                </tr>
                <tr>
                    <td  style="text-align:right;width:70%;"><strong>Exento</strong></td>
                    <td style="width:30%;text-align:right;">Bs. {{ round($invoice->exento,2) }}</td>
                </tr>
                <tr>
                    <td  style="text-align:right;width:70%;"><strong>IVA</strong></td>
                    <td style="width:30%;text-align:right;">Bs. {{ round($invoice->iva,2) }}</td>
                </tr>
                <tr>
                    <td style="text-align:right;width:70%;"><strong>Descuento({{ round($invoice->descuento,2) }}%)</strong></td>
                    <td style="width:30%;text-align:right;">Bs. {{ round($totalDescuento,2) }}</td>
                </tr>
                <tr>
                    <td style="text-align:right;width:70%;"><strong>Total</strong></td>
                    <td style="width:30%;text-align:right;">Bs. {{ round($invoice->total,2) }}</td>
                </tr>
            @break
            @case(2)
                <tr>
                    <td  style="text-align:right;width:70%;"><strong>Sub-total</strong></td>
                    <td style="width:30%;text-align:right;">Bs. {{ round($invoice->subtotal,2) }}</td>
                </tr>
                <tr>
                    <td style="text-align:right;width:70%;"><strong>Total</strong></td>
                    <td style="width:30%;text-align:right;">Bs. {{ round($invoice->total,2) }}</td>
                </tr>
            @break
            @case(3)
                <tr>
                    <td style="text-align:right;width:70%;"><strong>Total</strong></td>
                    <td style="width:30%;text-align:right;">Bs. {{ round($invoice->total,2) }}</td>
                </tr>
            @break
            @case(4)
                <tr>
                    <td  style="text-align:right;width:70%;"><strong>Sub-total</strong></td>
                    <td style="width:30%;text-align:right;">Bs. {{ round($invoice->subtotal,2) }}</td>
                </tr>
                <tr>
                    <td  style="text-align:right;width:70%;"><strong>Exento</strong></td>
                    <td style="width:30%;text-align:right;">Bs. {{ round($invoice->exento,2) }}</td>
                </tr>
                <tr>
                    <td  style="text-align:right;width:70%;"><strong>IVA</strong></td>
                    <td style="width:30%;text-align:right;">Bs. {{ round($invoice->iva,2) }}</td>
                </tr>
                
                <tr>
                    <td style="text-align:right;width:70%;"><strong>Total</strong></td>
                    <td style="width:30%;text-align:right;">Bs. {{ round($invoice->total,2) }}</td>
                </tr>
            @break
        @default
            
    @endswitch
        
    </table>
    
   
  
</body>
