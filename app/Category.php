<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'name_en',
    ];

    //una categoria tiene muchas marcas
    public function brands(){
        return $this->belongsToMany(Brand::class);
    }
     //una categoria tiene muchos modelos
    public function modelos()
    {
        //hasMany tiene muchos modelos de vehiculos
        return $this->hasMany(Modelo::class);
    }

    //una categoria tiene muchos productos
    public function products(){
        //hasMany tiene muchos productos
        return $this->hasMany(Product::class);
    }

    public static function search($search)
    {
        return empty($search) ? static::query() : static::query()->where('id', 'like', '%'.$search.'%')
                ->orWhere('name', 'like', '%'.$search.'%')
                ->orWhere('name_en', 'like', '%'.$search.'%');
    }
}
