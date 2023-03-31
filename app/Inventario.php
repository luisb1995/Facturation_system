<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable=[
        "category_id",
           "codigo",
           "descripcion",
           "cantidad",
           "costo",
           "ganancia",
           "precio",
           "divisa",
           "iva",
           "actualizar",
    ];

    public static function search($search)
    {
        return empty($search) ? static::query() : static::query()->Where('id', 'like', '%'.$search.'%')
                ->orWhere('codigo', 'like', '%'.$search.'%')
                ->orWhere('descripcion', 'like', '%'.$search.'%')
                ->orWhere('cantidad', 'like', '%'.$search.'%')
                ->orWhere('costo', 'like', '%'.$search.'%')
                ->orWhere('ganancia', 'like', '%'.$search.'%')
                ->orWhere('precio', 'like', '%'.$search.'%')
                ->orWhere('divisa', 'like', '%'.$search.'%');

        
    }
    public function scopeCategory($query,$category){
        if($category)
            return $query->where('category_id','=',$category);

    }
   
}
