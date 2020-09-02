<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    public function orden(){
        return $this->hasOne('App\Orden','id','idorden');
    }
}
