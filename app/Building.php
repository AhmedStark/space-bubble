<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    public function levels(){
        return $this->hasMany('App\Level');
    }
}
