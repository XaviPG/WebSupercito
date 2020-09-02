<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromocionDelProducto extends Model
{
    public function Productos()
    {
        return $this->hasMany('App\Producto', 'id', 'idProducto');
    }
   
     public function ProductosPromocion1(){
      return $this->hasOne('App\Producto','id', 'idProducto');
     }
  
}
