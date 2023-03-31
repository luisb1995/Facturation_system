<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    protected $fillable = [
        'tasaInventario',
        'tasaVenta',
        'tasaVenta2',
        'ivaAdministracion',
        'claveautorizacion',
        'vencimiento',
        'telefono',
        'direccion',
        'rif',
        'empresa',
        'importado',
        'tickera',
    ];
}
