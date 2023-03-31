

<body>
    <style>
        @page {
            header: page-header;
            footer: page-footer;
            margin-top: 120px; margin-bottom: 120px
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
                
        table tr:nth-child(2n+1)  {
            background-color: #DFE6F0;  
            
        }
        
        
    </style>
    <htmlpageheader  name="page-header" id="header">
        <table style="border: none;width:100%;">
            <tr style="background-color:white;">
                <td style="border: none;width:35%;text-align:center;"><img src="{{ asset('img/logo50.png') }}" alt=""></td>
                <td style="border: none;width:35%;text-align:center;"><h3><strong>Reporte de Ventas</strong></h3></td>
                <td style="border: none;width:30%;"><h4 style="margin-left:5px;"><strong>Fecha: </strong>{{ date('d-m-Y') }}</h4></td>
            </tr>
        </table>
        
    </htmlpageheader>
    
    
    <table class="table table-striped">
        <thead  class="thead-dark">
              <tr  style="color: white;
              background-color: #002E6B;
              border-color: #002E6B;">
                    
                    <th style="color: white;font-family:serif;">
                        <strong> Nro</strong>
                          
                    </th>
                    <th style="color: white;">
                        <strong> Cliente</strong>
                          
                    </th>
                    
                    <th style="color: white;">
                        <strong>Sub-total</strong>
                    </th>
                    <th style="color: white;">
                        <strong>Exento</strong>
                    </th>
                    <th style="color: white;">
                        <strong>IVA</strong>
                    </th>
                    <th style="color: white;">
                        <strong>Total</strong>
                          
                    </th>
                    <th style="color: white;">
                        <strong>Pagos</strong>
                          
                    </th>
                    
                    
              </tr>
        </thead>
        <tbody class="text-center" style="">
              
        
              @foreach ($reportData as $invoice)
                @if($invoice->cxc==1)
                <tr style="border-color:black;background-color:lightgreen">
                    @else
                    <tr style="border-color:black;">
                    @endif
                    <td class="d-none d-md-table-cell" style="font-size:14px;"><strong>{{ str_pad($invoice->nroControl, 10, "0", STR_PAD_LEFT) }}</strong></td>
                    <td class="d-none d-md-table-cell" style="font-size:14px;">
                        @if($invoice->client)
                        {{ $invoice->client->nombre}}
                    @else
                        N/A
                    @endif
                    </td>
                    <td class="text-left" style="font-size:14px;">Bs. {{ number_format($invoice->total,2,',','.') }}</td>
                    <td class="text-left" style="font-size:14px;">Bs. {{ number_format($invoice->exento,2,',','.') }}</td>
                    <td class="text-left" style="font-size:14px;">Bs. {{ number_format($invoice->iva,2,',','.') }}</td>
                    <td class="text-left" style="font-size:14px;">Bs. {{ number_format($invoice->total,2,',','.') }}</td>
                    <td class="text-left" style="font-size:14px;">  
                        @if ($invoice->cxc==1)
                        <strong>Cuenta por cobrar</strong> <br>
                        @endif
                    @if($invoice->pay->divisa>0)
                        
                        <strong> Divisa:</strong> $. {{ $invoice->pay->divisa }}<br>
                            
                    @endif
                    @if($invoice->pay->zelle>0)
                     
                                <strong>Zelle:</strong> $. {{ $invoice->pay->zelle }} Ref: {{ $invoice->pay->refZelle }}<br>
                     
                    @endif
                    @if($invoice->pay->Bolivares>0)
                     
                                <strong>Bs Efec:</strong>  Bs. {{ $invoice->pay->Bolivares }}<br>
                     
                    @endif
                    @if($invoice->pay->Debito>0)
                     
                                <strong> Debito:</strong>  Bs. {{ $invoice->pay->Debito }} Ref: {{ $invoice->pay->refDebito }}<br>
                     
                    @endif
                    @if($invoice->pay->Credito>0)
                     
                                <strong>Credito:</strong> Bs. {{ $invoice->pay->Credito }} Ref: {{ $invoice->pay->refCredito }}<br>
                     
                    @endif
                    @if($invoice->pay->Transferencia>0)
                        
                        <strong>Transf:</strong> Bs. {{ $invoice->pay->Transferencia }} Ref: {{ $invoice->pay->refTransferencia }}<br>
                          
                    @endif</td>
                    
                    
                        
                </tr>
              @endforeach
        
        </tbody>
    </table><br>
  
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr style="color: white;
            background-color: #002E6B;
            border-color: #002E6B;">
                <th colspan="3" style="text-align:center;color:white">
                    Totales generales
                </th>
            </tr>
            <tr style="color: white;
            background-color: #002E6B;
            border-color: #002E6B;">
                <th style="text-align:center;color:white">Sub-total</th>
                <th style="text-align:center;color:white">IVA</th>
                <th style="text-align:center;color:white">Total General</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center;font-size:14px;">Bs. {{ $reportData->sum('subtotal') }}</td>
                <td style="text-align:center;font-size:14px;">Bs. {{ $reportData->sum('iva') }}</td>
                <td style="text-align:center;font-size:14px;">Bs. {{ $reportData->sum('total') }}</td>
    
            </tr>
        </tbody>
    </table>
    <br>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr style="color: white;
            background-color: #002E6B;
            border-color: #002E6B;">
                <th colspan="6" style="text-align:center;color:white">
                    Totales pagos
                </th>
            </tr>
            <tr style="color: white;
            background-color: #002E6B;
            border-color: #002E6B;">
                <th style="text-align:center;color:white">Pagos Divisa:</th>
                <th style="text-align:center;color:white">Pagos Zelle</th>
                <th style="text-align:center;color:white">Pagos Bs Efectivo</th>
                <th style="text-align:center;color:white">Pagos Debito</th>
                <th style="text-align:center;color:white">Pagos Credito</th>
                <th style="text-align:center;color:white">Pagos Transferencia</th>
            </tr>
        </thead>
        <tbody>
            
            
            <tr>
                <td style="text-align:center;font-size:14px;">$. {{ $totalDivisa }}</td>
                <td style="text-align:center;font-size:14px;">$. {{ $totalZelle }}</td>
                <td style="text-align:center;font-size:14px;">Bs. {{ $totalBs }}</td>
                <td style="text-align:center;font-size:14px;">Bs. {{ $totalDebito }}</td>
                <td style="text-align:center;font-size:14px;">Bs. {{ $totalCredito }}</td>
                <td style="text-align:center;font-size:14px;">Bs. {{ $totalTransferencia }}</td>
            </tr>
        </tbody>
    </table>
   <htmlpagefooter  name="page-footer" >
        <div id="footer" style="width: 100%;text-align:center;">
            <span style="font-size:14px;"><a href="http://skyrisetechnology.com" target="_blank">Skyrise Technology Corporation C.A.</a> Copyright ©2020 Todos los derechos reservados</span><br>
            <span style="font-size:10px;width:100%;text-align:right;">Pagína: {PAGENO}/{nb}</span>
        </div><br>
        
    </htmlpagefooter>
</body>
