<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $fillable=[
        "nombre",
        "cedula",
        "direccion",
        "email",
        "telefono",
           
    ];

    
    public function invoices()
    {
        //hasMany tiene muchos modelos de detalles de factura
        return $this->hasMany(invoice::class);
    }

    public static function search($search)
    {
        return empty($search) ? static::query() : static::query()->Where('nombre', 'like', '%'.$search.'%')
                ->orWhere('cedula', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('telefono', 'like', '%'.$search.'%');

        
    }
}
