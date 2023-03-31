<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $fillable=[
        'invoice_id',
        'divisaBCV',
        'zelleBCV',
        'refZelleBCV',
        'divisa',
        'zelle',
        'refZelle',
        'Bolivares',
        'Debito',
        'refDebito',
        'Credito',
        'refCredito',
        'Transferencia',
        'refTransferencia'
        
    ];
}
