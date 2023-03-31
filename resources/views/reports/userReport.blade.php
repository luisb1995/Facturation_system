<! DOCTYPE html>
<html>
<head>
    <title>Reporte de usuarios</title>
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
        <img src="{{ asset('img/logo1.jpg') }}" alt="" class="img" height="50">
        </div>
        <div style="float:left;margin-left:65px;">
            <h2 ><strong>Reporte de usuarios</strong></h2>
        </div>
        <div style="float:left;margin-left:65px;">
            <h3 ><strong>Fecha: </strong>{{ date('d-m-Y') }}</h3>
        </div>
    </header>
    <footer style="width: 100%;text-align:center;" id="footer">
        <span style="font-size:16px;"><a href="http://blmundial.com" target="_blank">Baterias La Mundial C.A.</a> Copyright ©2020 Todos los derechos reservados</span><br>
    <span style="font-size:8px;">Desarrollado por Skyrise Technology Corporation C.A.</span>
    </footer>
   <div>
    <table class="table table-striped">
        <thead  class="thead-dark text-center" style="font-weight:bold;">
              <tr>
                    
                    <th>
                        <strong> Cod</strong>
                          
                    </th>
                    <th>
                        <strong> Nombre</strong>
                          
                    </th>
                    <th>
                        <strong>  Email</strong>
                          
                    </th>
                    <th >
                        <strong> Permisología</strong>
                    </th>
                    
                    
              </tr>
        </thead>
        <tbody class="text-center">
              
        
              @foreach ($reportData as $user)
                <tr style="border-color:black;">
                        <td><strong>{{ $user->id }}</strong></td>
                        <td>{{ $user->name }}</td>
                        <td class="d-none d-md-block" >{{ $user->email }}</td>
                        <td class="d-none d-md-table-cell">
                            @foreach ($user->getRoleNames() as $role)
                            {{ $role }} 
                            @endforeach 
                            
                            
                        </td>
                    
                        
                </tr>
              @endforeach
        
        </tbody>
  </table>
   </div>
</body>
</html>