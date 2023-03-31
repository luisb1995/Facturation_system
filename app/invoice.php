<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $fillable=[
        
        "nroControl",
        "client_id",
        "fecha",
        "fechaVencimiento",
        "subtotal",
        "exento",
        "iva",
        "total",
        "estado",
        "tipo",
        "cxc",
        "fechaCxc",
        "tasaCambio",
        "totalDolar",
        "descuento",
        "abonado",
        "user_id",
           
    ];

    public function client(){
        return $this->belongsTo(client::class);
    }
    
    public function details()
    {
        //hasMany tiene muchos modelos de detalles de factura
        return $this->hasMany(invoiceDetail::class);
    }
    public function pay()
    {
        //hasMany tiene muchos modelos de detalles de factura
        return $this->hasOne(Pay::class);
    }
    public function abonos()
    {
        return $this->hasMany(Abono::class, 'invoice_id', 'id')->where('tipo', '=', 1);
    }

    public function abonosFecha($fecha)
    {   
        return $this->hasMany(Abono::class, 'invoice_id', 'id')->where('tipo', '=', 1)->where('fecha','=',$fecha);
    }
   
    public function scopeClient($query,$client){
        if($client)
            return $query->where('client_id','=',$client);

    }
    
    public function scopeCaja($query,$user){
        if($user)
            return $query->where('user_id','=',$user);
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    

}
