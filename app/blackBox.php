<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blackBox extends Model
{
    protected $fillable = [
        'action','type', 'details', 'user',
    ];
    public static function search($search)
    {
        return empty($search) ? static::query() : static::query()->where('id', 'like', '%'.$search.'%')
                ->orWhere('action', 'like', '%'.$search.'%')
                ->orWhere('type', 'like', '%'.$search.'%')
                ->orWhere('details', 'like', '%'.$search.'%')
                ->orWhere('user', 'like', '%'.$search.'%')
                ->orWhere('created_at', 'like', '%'.$search.'%');
    }
    public function scopeModulo($query, $modulo) {
    	if ($modulo) {
    		return $query->where('type',$modulo);
    	}
    }
    public function scopeAccion($query, $accion) {
    	if ($accion) {
    		return $query->where('action',$accion);
    	}
    }
    public function scopeUsuario($query, $usuario) {
    	if ($usuario) {
    		return $query->where('user',$usuario);
    	}
    }
    public function scopeFecha($query,$fecha1,$fecha2) {
    	if ( $fecha1!=null && $fecha2!=null) {
    		return $query->whereBetween('created_at',[ $fecha1.' 00:00:00',$fecha2.' 23:59:59']);
    	}
    }
}
