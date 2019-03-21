<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function tables(){
        return $this->hasMany("App\Table");
    }

    public function levels(){
        return $this->belongsTo("App\Level");
    }
}
 