<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'url', 'imageable_type', 'imageable_id',
    ];
    public function imageable()
    {
        //belongToMany poliformico
        return $this->morphTo();
    }
}
