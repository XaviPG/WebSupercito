<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoPromocion extends Model
{
    public function registro()
    {
        return $this->hasMany('App\RegistroPromociones', 'idTipoPromocion', 'id');
    } 
    public function registro2()
    {
        return $this->hasMany('App\RegistroPromociones', 'idTipoPromocion', 'id')
        ->with('kits2')
        ->has('kits2', '>', 0)
        ->where([["estado_del","1"],["publicado","1"]]);
    } 
    
}
