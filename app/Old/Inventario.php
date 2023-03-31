<?php

namespace App\Old;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $connection ="mysql2";
    protected $table = "inventario";

    protected $fillable=[
        "codigoProducto",
        "descripcionProducto"
    ];
}
