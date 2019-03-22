<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function areas(){
        return $this->hasMany("App\Area");
    }
    

    public function building(){
        return $this->belongsTo('App\Building');
    }

    
    
}
