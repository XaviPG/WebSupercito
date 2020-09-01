<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $timestamps=false;
    
    protected $fillable = [
        'id_foraneo','NAME','PRICE','IDBRAND','MARCA', 'PESOITEM', 'stock', 'file_name', 'file_extension', 'file_ruta'
    ];
    public function  PromocionesProducto(){
        return $this->hasMany('App\ProductoPromociones','idProducto', 'id')->with("Promociones");
    }
    public function  PromocionesProducto2(){
        return $this->hasMany('App\ProductoPromociones','idProducto', 'id')->with("Promocion")->where('estado_del' , '1');
    }
    public function  PromocionesdelProducto(){
        return $this->hasOne('App\PromocionDelProducto', 'idProducto', 'id')->where('estado_del' , '1');
    }
    
}

