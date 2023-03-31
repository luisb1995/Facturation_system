<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoiceDetail extends Model
{
    protected $fillable=[
        
        "invoice_id",
        "codigo",
        "descripcion",
        "cantidad",
        "precio",
        "iva",
        "total",
           
    ];

    public function invoice(){

        return $this->belongsTo(invoice::class);
        
    }
}
