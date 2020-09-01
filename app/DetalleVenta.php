<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    public function producto()
    {
        //return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        return $this->hasOne('App\Producto', 'id', 'idproducto');
    }    
}
