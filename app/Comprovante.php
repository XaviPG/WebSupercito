<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprovante extends Model
{
    public function orden(){
        return $this->hasOne('App\Orden','id','idorden');
    }
}
