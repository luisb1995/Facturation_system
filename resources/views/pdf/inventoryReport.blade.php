

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
                <td style="border: none;width:35%;text-align:center;"><h3><strong>Reporte de Inventario</strong></h3></td>
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
                        <strong> Codigo</strong>
                          
                    </th>
                    <th style="color: white;">
                        <strong> Descripcion</strong>
                          
                    </th>
                    <th style="color: white;">
                        <strong>Cantidad</strong>
                          
                    </th>
                    <th style="color: white;">
                        <strong>Costo</strong>
                    </th>
                    <th style="color: white;">
                        <strong>% Ganancia</strong>
                    </th>
                    <th style="color: white;">
                        <strong>Precio</strong>
                    </th>
                    <th style="color: white;">
                        <strong>Divisa</strong>
                    </th>
                    
              </tr>
        </thead>
        <tbody class="text-center">
              
        
              @foreach ($reportData as $product)
                <tr style="border-color:black;">
                    <td>{{ $product->codigo }}</td>
                    <td>{{ $product->descripcion }}</td>
                    <td style="text-align:center;">{{ round($product->cantidad,3) }}</td>
                    <td>Bs. {{ round($product->costo,2) }}</td>
                    <td>{{ round($product->ganancia,2) }}%</td>
                    <td>Bs. {{ round($product->precio,2) }}</td>
                    <td>$ {{ round($product->divisa, 4) }}</td>
                    
                        
                </tr>
              @endforeach
        
        </tbody>
    </table>
   
   <htmlpagefooter  name="page-footer" >
        <div id="footer" style="width: 100%;text-align:center;">
            <span style="font-size:16px;">Facturation System C.A.</a> Copyright ©2023 Todos los derechos reservados</span><br>
            <span style="font-size:10px;width:100%;text-align:right;">Pagína: {PAGENO}/{nb}</span>
        </div><br>
        
    </htmlpagefooter>
</body>
