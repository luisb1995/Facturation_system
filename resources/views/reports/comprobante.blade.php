<! DOCTYPE html>
<html>
<head>
    <title>{{ $reportData->codigo }}</title>
    <style>
        @page { margin-top: 120px; margin-bottom: 120px}
        header { position: fixed; left: 0px; top: -90px; right: 0px; height: 550px; text-align: left; }
        #footer { position: fixed; left: 0px; bottom: -145px; right: 0px; height: 150px; }
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
            border-collapse: collapse;
        }
        table td,
        table th {
            border-left: 0.01em solid #ccc;
            border-right:0.01em solid #ccc;
            border-top: 0.01em solid #ccc;
            border-bottom: 0.01em solid #ccc;
        }
        .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
        background-color: #DFE6F0;
        }
        .text-center{
            text-align:center;
        }
        .thead-dark{
            color: white;
            background-color: #002E6B;
            border-color: #002E6B;
        }
        .badge{
            display:inline-block;
            padding:.25em .4em;
            font-size:75%;
            font-weight:700;
            line-height:1;
            text-align:center;
            white-space:nowrap;
            vertical-align:baseline;
            border-radius:.25rem;
            -webkit-transition:color 
            .15s ease-in-out,
            background-color .15s ease-in-out,border-color 
            .15s ease-in-out,-webkit-box-shadow 
            .15s ease-in-out;transition:color 
            .15s ease-in-out,background-color 
            .15s ease-in-out,border-color 
            .15s ease-in-out,
            -webkit-box-shadow .15s ease-in-out;
            transition:color .15s ease-in-out,
            background-color .15s ease-in-out,
            border-color .15s ease-in-out,
            box-shadow .15s ease-in-out;
            transition:color .15s ease-in-out,
            background-color .15s ease-in-out,
            border-color .15s ease-in-out,
            box-shadow .15s ease-in-out,
            -webkit-box-shadow .15s ease-in-out}
            .badge-secondary-lighten{color:#6c757d;background-color:rgba(108,117,125,.18)}
            .badge-secondary-lighten[href]:focus,
            .badge-secondary-lighten[href]:hover{color:#6c757d;text-decoration:none;background-color:rgba(108,117,125,.4)}
            .badge-success-lighten{color:#0acf97;background-color:rgba(10,207,151,.18)}
            .badge-success-lighten[href]:focus,
            .badge-success-lighten[href]:hover{color:#0acf97;text-decoration:none;background-color:rgba(10,207,151,.4)}
            .badge-info-lighten{color:#39afd1;background-color:rgba(57,175,209,.18)}
            .badge-info-lighten[href]:focus,
            .badge-info-lighten[href]:hover{color:#39afd1;text-decoration:none;background-color:rgba(57,175,209,.4)}
            .badge-warning-lighten{color:#ffbc00;background-color:rgba(255,188,0,.18)}
            .badge-warning-lighten[href]:focus,
            .badge-warning-lighten[href]:hover{color:#ffbc00;text-decoration:none;background-color:rgba(255,188,0,.4)}
            .badge-danger-lighten{color:#fa5c7c;background-color:rgba(250,92,124,.18)}
            .badge-danger-lighten[href]:focus,
            .badge-danger-lighten[href]:hover{color:#fa5c7c;text-decoration:none;background-color:rgba(250,92,124,.4)}
    
    </style>
   
    
    
    
</head>
<body>
    <script type="text/php">
        if ( isset($pdf) ) {
            $y = $pdf->get_height() - 20; 
            $x = $pdf->get_width() - 15 - 50;
            $pdf->page_text($x, $y, "Página No: {PAGE_NUM} de {PAGE_COUNT}", '', 8, array(0,0,0));
        }
    </script> 
    <header style="width: 100%; margin-top: 0px; margin-bottom: 70px;height:250px;">
        <div style="width: 100%; margin:0px; text-align:center;">
            @switch($reportData->estado)
            @case(1)
                <h1 ><span class="badge badge-warning-lighten" style="width: 100%; margin:0px; text-align:center;"> En proceso</span></h1>
            @break
            @case(2)
                <h1 ><span class="badge badge-info-lighten" style="width: 100%; margin:0px; text-align:center;"> Pago registrado</span></h1>
            @break
            @case(3)
                <h1><span class="badge badge-success-lighten" style="width: 100%; margin:0px; text-align:center;"> Procesado</span></h1>
            @break
            @default
                <h1><span class="badge badge-secondary-lighten" style="width: 100%; margin:0px; text-align:center;"> Creado</span></h1>
        @endswitch  
        </div>
        <div style="float:left;">
        <img src="{{ asset('img/logo1.jpg') }}" alt="" class="img" height="50">
        </div>
        <div style="float:left;margin-left:65px;">
            <h2 ><strong>Pedido {{ $reportData->codigo }}</strong></h2>
        </div>
        <div style="float:left;margin-left:65px;">
            <h3 ><strong>Fecha: </strong>{{ $reportData->updated_at->format("d-m-Y") }}</h3>
        </div>
    </header>
    <footer style="width: 100%;text-align:center;" id="footer">
        <span style="font-size:16px;"><a href="http://blmundial.com" target="_blank">Baterias La Mundial C.A.</a> Copyright ©2020 Todos los derechos reservados</span><br>
    <span style="font-size:8px;">Desarrollado por Skyrise Technology Corporation C.A.</span>
    </footer>
   <div style="margin-top:80px;">
      
    
    <table class="table" style="border:none;">
     
        
        <tr style="border:none;">
            <td style="border:none;">Cliente: {{ $user2->name }}</td> 
            <td style="border:none;">C.I / RIF: {{ $user2->profile->preCedula.$user2->profile->cedula }}</td> 
        </tr>
        <tr style="border:none;">
            <td style="border:none;">Dirección: {{ $user2->profile->direccion }}</td> 
            <td style="border:none;">Teléfono: {{ $user2->profile->telefono }}</td> 
        </tr>
            
        
    </table>
    <table class="table table-striped">
        <thead  class="thead-dark text-center" style="font-weight:bold;">
              <tr>
                    
                    <th>
                        <strong> Codigo</strong>
                          
                    </th>
                    <th>
                        <strong>Producto</strong>
                    </th>
                    <th >
                        <strong> Precio</strong>
                    </th>
                    <th >
                        <strong> Cantidad</strong>
                    </th>
                    <th >
                        <strong> Total</strong>
                    </th>
                </tr>
        </thead>
        <tbody class="text-center">
              
        
              @foreach ($reportData->details as $register)
                <tr style="border-color:black;">
                    <td>{{ $register->codigo }}</td>
                    
                    <td>{{ $register->name }}</td>
                    <td>{{ $register->price }}</td>
                    <td>{{ $register->quantity }}</td>
                    <td>{{ $register->totalAmount }}</td>
                </tr>
                
              @endforeach
              <tr  style="background-color:#0E266B;">
                <td colspan="5" class="text-center" >
                   ----------------------------------------------------------
                </td>
                
            </tr>
              <tr  style="text-align:right;">
                <td colspan="4">
                   <strong> Sub-total:</strong>
                </td>
                <td  class="text-center"
                >
                    $ {{ $reportData->subtotal }}
                </td>
            </tr>
            <tr  style="text-align:right;">
                <td colspan="4">
                    <strong> Exento:</strong>
                </td>
                <td class="text-center" >
                    ${{ $reportData->exento }}
                </td>
            </tr>
            <tr style="text-align:right;">
                <td colspan="4"">
                    <strong>  IVA:</strong>
                </td>
                <td  class="text-center" ">
                    $ {{ $reportData->iva }}
                </td>
            </tr>
            <tr style="text-align:right;">
                <td colspan="4">
                    <strong> Total:</strong>
                </td>
                <td  class="text-center" >
                    $ {{ $reportData->total }}
                </td>
            </tr>
        </tbody>
  </table>
  
   </div>
</body>
</html>