

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
                <td style="border: none;width:35%;text-align:center;"><h3><strong>Reporte de clientes</strong></h3></td>
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
                        <strong> Cod.</strong>
                          
                    </th>
                    <th style="color: white;">
                        <strong> Nombre</strong>
                          
                    </th>
                    <th style="color: white;">
                        <strong>Cedula</strong>
                          
                    </th>
                    <th style="color: white;">
                        <strong>Telefono</strong>
                    </th>
                    <th style="color: white;">
                        <strong>Email</strong>
                    </th>
                    <th style="color: white;">
                        <strong>Dirección</strong>
                    </th>
                   
                    
              </tr>
        </thead>
        <tbody class="text-center">
              
        
              @foreach ($reportData as $client)
                <tr style="border-color:black;">
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->nombre }}</td>
                    <td style="text-align:center;">{{ $client->cedula }}</td>
                    <td>{{ $client->telefono }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->direccion }}</td>
                    
                    
                        
                </tr>
              @endforeach
        
        </tbody>
    </table>
   
   <htmlpagefooter  name="page-footer" >
        <div id="footer" style="width: 100%;text-align:center;">
            <span style="font-size:16px;"><a href="http://skyrisetechnology.com" target="_blank">Skyrise Technology Corporation C.A.</a> Copyright ©2020 Todos los derechos reservados</span><br>
            <span style="font-size:10px;width:100%;text-align:right;">Pagína: {PAGENO}/{nb}</span>
        </div><br>
        
    </htmlpagefooter>
</body>
