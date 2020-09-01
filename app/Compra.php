<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
  public $timestamps=true;
  protected $table = 'compras';
  public function Producto(){
      return $this->hasOne('App\Producto','id', 'id_Productos');
  }
  public function Promocion(){
      return $this->hasOne('App\PromocionDelProducto','id', 'idPromocionProducto')->with("ProductosPromocion1");
  }
  public function Registro(){
        return $this->hasOne('App\RegistroPromociones','id', 'idRegistros');
  }
  
}
