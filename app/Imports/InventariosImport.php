<?php

namespace App\Imports;

use App\Inventario;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InventariosImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
               $gain=($row['venta']/$row['costo'])-1;
               $gain2=$gain*100;
               $validation=Inventario::where('codigo','=',$row['codigo'])->first();
            if($validation==null){
                return new Inventario([
                'codigo'     => $row['codigo'],
                'descripcion'    => $row['descripcion'], 
                'cantidad' => $row['cantidad'],
                'costo' => $row['costo'],
                'ganancia' => $gain2,
                'precio' => $row['venta'],
                'divisa' => $row['divisa'],
                'iva' => $row['exento'],
                'actualizar' => $row['actualizar'],
                ]);
            }
            else{
                return ;
            }
    }
}
