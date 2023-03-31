<! DOCTYPE html>
<html>
<head>
    <title>Reporte de inventario</title>
    <style>
        @page { margin-top: 120px; margin-bottom: 120px}
        header { position: fixed; left: 0px; top: -90px; right: 0px; height: 250px; text-align: left; }
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
    <header style="width: 100%; margin-top: 0px; margin-bottom: 10px;height:250px;">
        <div style="float:left;">
            <img src="{{ asset('img/logo50.png') }}" alt="">
        </div>
        <div style="float:left;margin-left:65px;">
            <h2 ><strong>Reporte de Inventario</strong></h2>
        </div>
        <div style="float:left;margin-left:65px;">
            <h3 ><strong>Fecha: </strong>{{ date('d-m-Y') }}</h3>
        </div>
    </header>
    <footer style="width: 100%;text-align:center;" id="footer">
        <span style="font-size:16px;"><a href="http://skyrisetechnology.com" target="_blank">Skyrise Technology Corporation C.A.</a> Copyright ©2020 Todos los derechos reservados</span><br>
    
    </footer>
   <div>
    <table class="table table-striped">
        <thead  class="thead-dark text-center" style="font-weight:bold;">
              <tr>
                    
                    <th>
                        <strong> Codigo</strong>
                          
                    </th>
                    <th>
                        <strong> Descripcion</strong>
                          
                    </th>
                    <th>
                        <strong>Cantidad</strong>
                          
                    </th>
                    <th >
                        <strong>Costo</strong>
                    </th>
                    <th >
                        <strong>% Ganancia</strong>
                    </th>
                    <th >
                        <strong>Precio</strong>
                    </th>
                    <th >
                        <strong>Divisa</strong>
                    </th>
                    
              </tr>
        </thead>
        <tbody class="text-center">
              
        
              @foreach ($reportData as $product)
                <tr style="border-color:black;">
                    <td>{{ $product->codigo }}</td>
                    <td>{{ $product->descripcion }}</td>
                    <td>{{ round($product->cantidad,3) }}</td>
                    <td>Bs. {{ round($product->costo,2) }}</td>
                    <td>{{ round($product->ganancia,2) }}%</td>
                    <td>Bs. {{ round($product->precio,2) }}</td>
                    <td>$ {{ round($product->divisa, 4) }}</td>
                    
                        
                </tr>
              @endforeach
        
        </tbody>
    </table>
   </div>
</body>
</html>