<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kit extends Model
{
    public function  ProductoKit(){
        
        return $this->hasMany('App\Producto','id', 'idProducto');
    }
    public function  ProductoKit2(){
        
        return $this->hasOne('App\Producto','id', 'idProducto');
    }
    public function RegistroKit(){
        return $this->hasOne('App\RegistroPromociones','id', 'idRegistro');
    }
    
}
