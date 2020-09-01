<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public function estado()
    {
        //return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        return $this->hasOne('App\EstadoVenta', 'id', 'idestado');
    }

    public function cliente()
    {
        //return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        return $this->hasOne('App\User', 'id', 'idcliente');
    }
    public function courier()
    {
        //return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        return $this->hasOne('App\User', 'id', 'idcourier');
    }
    public function detalle()
    {
    	# code...
    	return $this->hasMany('App\DetalleVenta','idventa','id')->with('producto')->where('estado_del','1');
    }
}
