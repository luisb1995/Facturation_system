<?php

namespace App\Exports;

use App\Inventario;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventariosExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($search,$category)
    {
        $this->search = $search;
        $this->category=$category;
    }
    public function query()
    {
        return Inventario::search($this->search)
        ->category($this->category)->select("codigo", "descripcion", "cantidad", "costo", "ganancia", "precio", "divisa", "iva", "actualizar");
    }

    public function headings(): array
    {
        return [
           
            'codigo',
            'descripcion',
            'cantidad',
            'costo',
            'ganancia',
            'venta',
            'divisa',
            'exento',
            'actualizar',
            

        ];
    }
    
}
